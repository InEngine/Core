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

    /*
    |--------------------------------------------------------------------------
    | Module migrations
    |--------------------------------------------------------------------------
    |
    | On enable and on version-bump upgrade while enabled, Modulus runs pending
    | migrations from each package's install path + this relative directory
    | (Spatie / Skeleton default: database/migrations).
    |
    | Disable and forget/uninstall never migrate and never drop schema.
    | Module migrations should guard Schema::hasTable so re-enable after a
    | non-destructive uninstall does not fail when tables already exist.
    |
    */
    'migrations' => [
        'path' => 'database/migrations',
    ],

    /*
    |--------------------------------------------------------------------------
    | Publish on install / Composer update (not enable)
    |--------------------------------------------------------------------------
    |
    | ModuleRepository::publish() copies conventional paths from the Composer
    | install root. Call it from inengine/modulus-composer after require/update
    | (and before modulus:enable). Enable only migrates + boots — Install ≠ enable.
    |
    | Why not vendor:publish? Disabled modules are filtered out of PackageManifest,
    | so Spatie publish tags are not registered until after enable.
    |
    | Resource policy:
    | - config: optional host copies (runtime still mergeConfigFrom vendor on boot)
    | - assets: public/vendor/{name} from resources/dist — needed for browser UI
    | - views / lang / inertia: opt-in overrides; packages load these from vendor
    |   Operator UI chrome belongs in inengine/modulus-ui, not each feature module
    |
    */
    'publish' => [
        'config' => true,
        'assets' => true,
        'views' => false,
        'lang' => false,
        'inertia' => false,
        'force_config' => false,
        'force_assets' => true,
        'force_views' => false,
        'force_lang' => false,
        'force_inertia' => false,
    ],

];
