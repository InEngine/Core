# InEngine Core

[![Tests](https://img.shields.io/github/actions/workflow/status/InEngine/Core/tests.yml?branch=dev&label=tests&style=flat-square)](https://github.com/InEngine/Core/actions?query=workflow%3Atests+branch%3Adev)
[![PHPStan](https://img.shields.io/github/actions/workflow/status/InEngine/Core/phpstan.yml?branch=dev&label=phpstan&style=flat-square)](https://github.com/InEngine/Core/actions?query=workflow%3Aphpstan+branch%3Adev)

Opinionated modular Laravel application framework. Products (Provost, Innkeeper, …) and client apps build on this shell plus [Modulus](https://github.com/InEngine/Modulus)-compatible modules.

**Documentation:** [docs/](docs/) · [https://inengine.github.io/Core/](https://inengine.github.io/Core/)

**Licensing:** Core is **MIT**. Modulus / Modulus Composer / Skeleton are MIT. Operator UI (`modulus-ui`) will be **private Pro**. Innkeeper stays **unreleased source** until published.

## Stack

- Laravel 13 / PHP 8.5
- Livewire
- Tailwind CSS (Vite)
- Pest, Larastan, Laravel Debugbar, IDE Helper, Laravel Boost

## Quick start

```bash
composer run setup
composer run dev
```

Herd site: [https://inengine.app](https://inengine.app)

## Local modules

Copy `composer.local.dist.json` → `composer.local.json` (gitignored). Path repositories point at `../Modules/*` via the Composer merge plugin. Core requires `inengine/modulus` `*@dev`; do **not** hard-require **Modulus Composer** in Core.

See [Local modules](docs/local-modules.md).

## Modulus

Early `PackageManifestInstaller` in `bootstrap/app.php` so discovery gating works before feature providers load. Day-to-day: `modulus:*` Artisan — details in [Modulus host](docs/modulus.md).

## Versioning

Semantic versioning. Merges into `master`/`main` trigger a version bump and GitHub Release (see `.github/workflows/release-on-merge.yml`). Default branch for development: **`dev`**.

## License

The MIT License (MIT). See [LICENSE.txt](LICENSE.txt).
