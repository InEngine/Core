# Local modules

Monorepo layout (sibling checkouts):

```text
InEngine/
  Core/
  Modules/
    Modulus/
    ModulusComposer/
    Skeleton/          # template source; not required via Composer as "skeleton"
    Alert/             # Step 13 pilot feature module
```

## Path repos

1. Copy the dist file (gitignored target):

```bash
cp composer.local.dist.json composer.local.json
# or: php bin/setup --with-composer-local
```

2. Dist content registers path repositories **and** overrides Packagist constraints to `*@dev`:

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "../Modules/*",
      "options": { "symlink": true }
    }
  ],
  "require": {
    "inengine/modulus": "*@dev",
    "inengine/modulus-composer": "*@dev"
  }
}
```

The Wikimedia merge plugin merges `composer.local.json` with `"replace": true` so path `*@dev` replaces root `^0.1@beta` for those packages. Path packages use `extra.branch-alias` `dev-main` → `0.1.x-dev` so dependents that require `^0.1@beta || 0.1.x-dev` still resolve.

**Without** `composer.local.json`, Core resolves Modulus + Modulus Composer from Packagist (`^0.1@beta`).

**Production / release:** do **not** ship `composer.local.json`.

## Install flows

| Situation | Command |
|-----------|---------|
| Empty directory | `composer create-project …` then `php bin/setup` (also runs from `post-create-project-cmd`) |
| Existing git / non-empty | `composer install` then `php bin/setup` — create-project cannot use a non-empty dir |

## Feature modules on Core

```bash
# path monorepo
composer require inengine/alert:@dev
php artisan modulus:discover
php artisan modulus:enable inengine/alert
```
