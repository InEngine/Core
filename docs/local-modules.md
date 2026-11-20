# Local modules

Monorepo layout (sibling checkouts):

```text
InEngine/
  Core/
  Modules/
    Modulus/
    ModulusComposer/
    Skeleton/          # template source; not required via Composer as "skeleton"
    Alert/             # example feature, when present
```

## Path repos

1. Copy the dist file (gitignored target):

```bash
cp composer.local.dist.json composer.local.json
```

2. Dist content registers path repositories **and** overrides Modulus to `*@dev`:

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
    "inengine/modulus": "*@dev"
  }
}
```

The Wikimedia merge plugin merges `composer.local.json` into the root Composer config. Core currently requires `inengine/modulus` `*@dev` (path/VCS). After an intentional Packagist release, switch the root constraint to `^0.1` and keep path `*@dev` only in `composer.local.json`.

## Production / release

Remove `composer.local.json` before deploy or create-project packaging. The Core release workflow strips it so production never accidentally path-resolves sibling Modules.

## Optional: Modulus Composer

To exercise Composer I/O from Artisan locally, add to `composer.local.json` (not the shared `composer.json` require):

```json
{
  "require": {
    "inengine/modulus-composer": "*@dev"
  }
}
```

Then `composer update inengine/modulus-composer`.

## CI

GitHub Actions checks out Modulus beside Core and writes an equivalent path `composer.local.json`. Private sibling repos use the org `INENGINE_CI_TOKEN` secret when needed.
