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

2. Dist content registers path repositories:

```json
{
  "repositories": [
    {
      "type": "path",
      "url": "../Modules/*",
      "options": { "symlink": true }
    }
  ]
}
```

The Wikimedia merge plugin merges `composer.local.json` into the root Composer config. Core’s `composer.json` already requires `inengine/modulus` as `*@dev`; path resolution supplies the package from `../Modules/Modulus`.

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
