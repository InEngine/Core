<?php

/**
 * Host integration: disabled `inengine/alert` must not boot into Laravel
 * (providers, config, Artisan) even though Composer still autoloads the package.
 */

use Composer\InstalledVersions;
use Illuminate\Foundation\PackageManifest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;
use InEngine\Alert\AlertServiceProvider;
use InEngine\Modulus\Discovery\FilteringPackageManifest;
use InEngine\Modulus\ModuleRepository;

/**
 * Skip when Alert is not a local path / Step 13 dependency (CI Packagist-only Core).
 */
beforeEach(function () {
    if (! class_exists(InstalledVersions::class) || ! InstalledVersions::isInstalled('inengine/alert')) {
        $this->markTestSkipped('inengine/alert is installed only via composer.local for Step 13 local integration.');
    }
});

/**
 * Write a temp Modulus state file and return its absolute path.
 *
 * @param  array<string, array{enabled: bool, version: string}>  $modules
 */
function alertGatingStatePath(array $modules): string
{
    $path = sys_get_temp_dir().'/inengine-modulus-alert-gating-'.uniqid('', true).'.json';
    file_put_contents($path, json_encode($modules, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR));

    return $path;
}

/**
 * Boot a fresh Core Artisan process against an isolated Modulus state file.
 *
 * @param  list<string>  $artisanArgs
 * @return array{exitCode: int, output: string}
 */
function alertGatingArtisan(string $statePath, array $artisanArgs): array
{
    $result = Process::path(base_path())
        ->env([
            'APP_ENV' => 'testing',
            'MODULUS_STATE_PATH' => $statePath,
        ])
        ->run([PHP_BINARY, 'artisan', ...$artisanArgs, '--no-interaction']);

    return [
        'exitCode' => $result->exitCode(),
        'output' => $result->output().$result->errorOutput(),
    ];
}

/**
 * Probe a fresh boot: provider, config, enabled flag, and alert:* commands.
 *
 * @return array{provider: bool, config: bool, enabled: bool, commands: list<string>}
 */
function alertGatingBootProbe(string $statePath): array
{
    $script = <<<'PHP'
        require 'vendor/autoload.php';
        $app = require 'bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        $commands = array_values(array_filter(
            array_keys(Illuminate\Support\Facades\Artisan::all()),
            static fn (string $name): bool => str_starts_with($name, 'alert:')
        ));

        echo json_encode([
            'provider' => (bool) $app->getProvider(InEngine\Alert\AlertServiceProvider::class),
            'config' => $app->make('config')->has('alert'),
            'enabled' => $app->make(InEngine\Modulus\ModuleRepository::class)->isEnabled('inengine/alert'),
            'commands' => $commands,
        ], JSON_THROW_ON_ERROR);
        PHP;

    $result = Process::path(base_path())
        ->env([
            'APP_ENV' => 'testing',
            'MODULUS_STATE_PATH' => $statePath,
        ])
        ->run([PHP_BINARY, '-r', $script]);

    expect($result->successful())->toBeTrue(
        'boot probe failed: '.$result->output().$result->errorOutput()
    );

    /** @var array{provider: bool, config: bool, enabled: bool, commands: list<string>} $payload */
    $payload = json_decode($result->output(), true, 512, JSON_THROW_ON_ERROR);

    return $payload;
}

it('tracks inengine/alert in Modulus state on the host', function () {
    $repo = app(ModuleRepository::class);

    if ($repo->get('inengine/alert') === null) {
        $this->artisan('modulus:discover')->assertSuccessful();
    }

    expect($repo->get('inengine/alert'))->not->toBeNull()
        ->and(app(PackageManifest::class))->toBeInstanceOf(FilteringPackageManifest::class);
});

it('omits disabled alert from filtered discovery', function () {
    $repo = app(ModuleRepository::class);
    $wasEnabled = $repo->isEnabled('inengine/alert');

    if ($wasEnabled) {
        $repo->disable('inengine/alert');
    }

    try {
        /** @var FilteringPackageManifest $manifest */
        $manifest = app(PackageManifest::class);

        expect($manifest->shouldOmit('inengine/alert'))->toBeTrue()
            ->and($repo->isEnabled('inengine/alert'))->toBeFalse();
    } finally {
        if ($wasEnabled) {
            $repo->enable('inengine/alert');
        }
    }
});

it('does not load alert provider, config, or Artisan commands when disabled at boot', function () {
    $statePath = alertGatingStatePath([
        'inengine/modulus' => ['enabled' => true, 'version' => 'dev-main'],
        'inengine/alert' => ['enabled' => false, 'version' => '1.0.1'],
    ]);

    try {
        $probe = alertGatingBootProbe($statePath);

        expect($probe['enabled'])->toBeFalse()
            ->and($probe['provider'])->toBeFalse()
            ->and($probe['config'])->toBeFalse()
            ->and($probe['commands'])->toBe([]);

        $send = alertGatingArtisan($statePath, ['alert:send']);

        expect($send['output'])->toContain('no commands defined in the "alert" namespace');
    } finally {
        @unlink($statePath);
    }
});

it('loads alert on a fresh boot only after modulus enable', function () {
    $statePath = alertGatingStatePath([
        'inengine/modulus' => ['enabled' => true, 'version' => 'dev-main'],
        'inengine/alert' => ['enabled' => false, 'version' => '1.0.1'],
    ]);

    try {
        $before = alertGatingBootProbe($statePath);
        expect($before['provider'])->toBeFalse()
            ->and($before['commands'])->toBe([]);

        $enable = alertGatingArtisan($statePath, ['modulus:enable', 'inengine/alert']);
        expect($enable['exitCode'])->toBe(0, $enable['output']);

        $after = alertGatingBootProbe($statePath);

        expect($after['enabled'])->toBeTrue()
            ->and($after['provider'])->toBeTrue()
            ->and($after['config'])->toBeTrue()
            ->and($after['commands'])->toContain('alert:send');

        $disable = alertGatingArtisan($statePath, ['modulus:disable', 'inengine/alert']);
        expect($disable['exitCode'])->toBe(0, $disable['output']);

        $disabledAgain = alertGatingBootProbe($statePath);

        expect($disabledAgain['enabled'])->toBeFalse()
            ->and($disabledAgain['provider'])->toBeFalse()
            ->and($disabledAgain['config'])->toBeFalse()
            ->and($disabledAgain['commands'])->toBe([]);
    } finally {
        @unlink($statePath);
    }
});

it('skips Spatie boot when a disabled alert provider is force-registered', function () {
    $repo = app(ModuleRepository::class);
    $wasEnabled = $repo->isEnabled('inengine/alert');

    if ($wasEnabled) {
        $repo->disable('inengine/alert');
    }

    $hadCommand = array_key_exists('alert:send', Artisan::all());

    try {
        $provider = new AlertServiceProvider(app());
        $provider->register();

        expect($provider->shouldBootModule())->toBeFalse()
            ->and($provider->isEnabledInModulus())->toBeFalse();

        $provider->boot();

        if (! $hadCommand) {
            expect(Artisan::all())->not->toHaveKey('alert:send');
        }
    } finally {
        if ($wasEnabled) {
            $repo->enable('inengine/alert');
        }
    }
});
