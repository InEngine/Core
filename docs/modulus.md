# Modulus host

Core is a first-class Modulus host. Full runtime docs: [InEngine/Modulus docs](https://github.com/InEngine/Modulus/tree/feat/modulus-state-store/docs).

## Early boot (required)

Laravel registers discovered providers before package providers boot. After `Application::configure(...)->create()`, Core installs the filtered manifest:

```php
use InEngine\Modulus\Discovery\PackageManifestInstaller;

$app = Application::configure(basePath: dirname(__DIR__))
    // ...
    ->create();

if (class_exists(PackageManifestInstaller::class)) {
    PackageManifestInstaller::install($app);
}

return $app;
```

See `bootstrap/app.php`. Without this, enable/disable cannot gate discovery in time.

## Host config

Published at `config/modulus.php`. Keep `state_path` (default `storage/modulus/modules.json`) writable. `inengine/modulus` itself is denylisted so it cannot be disabled out of the host.

## Day-to-day

```bash
php artisan modulus:list
php artisan modulus:discover
php artisan modulus:enable {package}
php artisan modulus:disable {package}
php artisan modulus:publish {package}
php artisan modulus:seed {package}     # confirmation required
php artisan modulus:doctor
```

Default upgrade constraint policy: **patch** → `~x.y.z`. Minor/major bumps go through **Modulus Composer** (`modulus-composer:approve`) or UI later.

## Extensions

| Package | Display name | In Core |
|---------|--------------|---------|
| [`inengine/modulus-composer`](https://github.com/InEngine/ModulusComposer) | **Modulus Composer** | Opt-in only (path / Packagist); public MIT |
| `inengine/modulus-marketplace` | (planned) | Opt-in |
| `inengine/modulus-ui` | (planned) | Opt-in — **private Pro** (not public Packagist) |
