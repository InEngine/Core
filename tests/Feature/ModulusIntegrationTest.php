<?php

use InEngine\Modulus\Facades\Modulus;
use InEngine\Modulus\ModuleRepository;

it('runs modulus list and doctor on the host', function () {
    $this->artisan('modulus:list')->assertSuccessful();
    $this->artisan('modulus:doctor')->assertSuccessful();
});

it('discovers modules without throwing on a clean host', function () {
    $this->artisan('modulus:discover')->assertSuccessful();

    expect(app(ModuleRepository::class))->toBeInstanceOf(ModuleRepository::class);
});

it('exposes Modulus facade against the bound repository', function () {
    expect(Modulus::getFacadeRoot())->toBeInstanceOf(ModuleRepository::class);
});

it('keeps modulus state path writable for the host store', function () {
    $path = config('modulus.state_path');

    expect($path)->toBeString()->not->toBeEmpty();

    $dir = dirname($path);
    if (! is_dir($dir)) {
        mkdir($dir, 0775, true);
    }

    expect(is_dir($dir))->toBeTrue()
        ->and(is_writable($dir))->toBeTrue();
});
