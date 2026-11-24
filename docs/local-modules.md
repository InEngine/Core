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
# path monorepo (composer.local.json already lists path *@dev requires)
composer update
php artisan modulus:discover
php artisan modulus:enable inengine/user   # libraries auto-enable / promote
php artisan modulus:publish inengine/user  # when you need published config/assets
php artisan migrate                        # host + any loaded local/ migrations
```

Herd site: **https://inengine.app** → `InEngine/Core` (symlink under Herd Sites).

## Local host playground (do not commit to Core)

Exercise migrations, UI, and routes on the Herd instance **without** dirtying Core’s tracked tree. Product code lives in `Modules/*` repos; Core only loads optional gitignored scratch.

| Path | Role |
|------|------|
| `composer.local.json` | Path `../Modules/*` + `@dev` requires (gitignored; copy from `.dist`) |
| `storage/modulus/` | Modulus enable state (`modules.json`) — local only |
| `routes/local.php` | Scratch web routes (copy from `stubs/local-host/routes.local.php.dist`) |
| `app/Providers/LocalServiceProvider.php` | Scratch bindings / view namespaces (copy from stub) |
| `database/migrations/local/` | Host-only throwaway migrations (loaded if the directory exists) |
| `resources/views/local/` | Optional scratch Blade |

`AppServiceProvider` auto-registers `LocalServiceProvider` and loads `routes/local.php` + `migrations/local` **when those files/dirs exist**.

### What to put where

- **Module migrations / routes / UI** → implement in the module package (`Modules/User`, `Modules/ModulusUI`, …), commit there, then `modulus:discover` / `enable` / `publish` on Core.
- **Temporary host probes** (ping routes, one-off seed, debug screens) → gitignored local playground files above — never `routes/web.php` or committed Core migrations for experiments.
- **Agents:** do not `git add` `composer.local.json`, `storage/modulus/`, `routes/local.php`, or `LocalServiceProvider.php`. Prefer committing feature work in the module repo.

### Typical Herd loop

```bash
cd /Users/jamesjohnson/Dropbox/Projects/InEngine/Core
# edit Modules/User or Modules/ModulusUI (symlink via path repo)
php artisan modulus:discover
php artisan modulus:enable inengine/modulus-ui
php artisan route:list --path=modulus   # or module prefix
# open https://inengine.app
```
