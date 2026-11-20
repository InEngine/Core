<?php

use Illuminate\Foundation\PackageManifest;
use InEngine\Modulus\Contracts\ModulusStateStore;
use InEngine\Modulus\Discovery\FilteringPackageManifest;
use InEngine\Modulus\ModuleRepository;

it('boots Modulus as a required host dependency', function () {
    expect(app()->bound(ModuleRepository::class))->toBeTrue()
        ->and(app()->bound(ModulusStateStore::class))->toBeTrue()
        ->and(config('modulus.store'))->not->toBeEmpty()
        ->and(config('modulus.discovery.deny'))->toContain('inengine/modulus');
});

it('gates package discovery through FilteringPackageManifest', function () {
    expect(app()->make(PackageManifest::class))
        ->toBeInstanceOf(FilteringPackageManifest::class);
});
