<?php

use InEngine\Modulus\State\FileModulusStateStore;

// config for InEngine/Modulus
return [

    /*
    |--------------------------------------------------------------------------
    | Module state store
    |--------------------------------------------------------------------------
    |
    | Class that implements InEngine\Modulus\Contracts\ModulusStateStore.
    | Defaults to the flat JSON file store. Swap this for another implementation
    | (Redis, database, etc.) without changing Modulus orchestration code.
    |
    */
    'store' => FileModulusStateStore::class,

    /*
    |--------------------------------------------------------------------------
    | Module state file
    |--------------------------------------------------------------------------
    |
    | Used by FileModulusStateStore. Absolute path to the JSON file that tracks
    | which Composer module packages are enabled or disabled. Defaults under
    | storage/ (typically gitignored).
    |
    | Writes default to Laravel Filesystem::replace() (atomic temp + rename).
    | Set state_fsync to true only when durable fsync-before-rename is required
    | (e.g. hostile power-loss environments); most hosts should leave this false.
    |
    */
    'state_path' => storage_path('modulus/modules.json'),

    'state_fsync' => false,

    /*
    |--------------------------------------------------------------------------
    | Package discovery gating
    |--------------------------------------------------------------------------
    |
    | Modulus filters Laravel's PackageManifest at read time so disabled
    | packages are omitted from auto-discovered providers/aliases.
    |
    | scope:
    |   - modules (default): only packages tracked in the state store are gated
    |   - all: same filter once discover tracks non-module packages too
    |
    | deny: package names that are never omitted (even if state says disabled).
    |
    */
    'discovery' => [
        'scope' => 'modules',
        'deny' => [
            'inengine/modulus',
        ],
    ],

];
