# InEngine Core

[![Tests](https://img.shields.io/github/actions/workflow/status/InEngine/Core/tests.yml?branch=dev&label=tests&style=flat-square)](https://github.com/InEngine/Core/actions?query=workflow%3Atests+branch%3Adev)
[![PHPStan](https://img.shields.io/github/actions/workflow/status/InEngine/Core/phpstan.yml?branch=dev&label=phpstan&style=flat-square)](https://github.com/InEngine/Core/actions?query=workflow%3Aphpstan+branch%3Adev)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE.txt)

**InEngine Core** is an **opinionated Laravel-based modular application builder framework**. Products (Provost, Innkeeper, …) and custom apps start from this host shell and grow through [Modulus](https://github.com/InEngine/Modulus)-compatible feature modules — not by stuffing product code into `App\` by default.

**Documentation:** [docs/](docs/) · [https://inengine.github.io/Core/](https://inengine.github.io/Core/)

## Attribution

Built on **[Laravel](https://laravel.com)** (MIT). InEngine Core is a specialized host and composition root; Laravel remains the underlying application framework. See [laravel/framework](https://github.com/laravel/framework) and the [Laravel license](https://github.com/laravel/framework/blob/12.x/LICENSE.md).

## What ships by default

| Layer | Packages / role |
|-------|-----------------|
| **Framework** | `laravel/framework` ^13, PHP ^8.5, `laravel/tinker` |
| **UI runtime (for modules/products)** | Livewire 4, Tailwind CSS (Vite) — Core itself only ships a splash page |
| **Module runtime** | **[`inengine/modulus`](https://github.com/InEngine/Modulus)** (required) — enable/disable, discovery gating, lifecycle, `modulus:*` |
| **Composer client (opt-in)** | **[Modulus Composer](https://github.com/InEngine/Modulus-Composer)** (`inengine/modulus-composer`) — require/remove/update/approve; **not** hard-required by Core |
| **require-dev** | Laravel Debugbar, Laravel Boost, IDE Helper, Pest (+ plugins), Pint, Larastan, Ignition, Pail, … |

**Licensing:** Core, Modulus, Modulus Composer, and [Skeleton](https://github.com/InEngine/Skeleton) are **MIT**. `modulus-ui` will be **private Pro**. Innkeeper stays **unreleased source** until published.

## Quick start

```bash
composer run setup
composer run dev
```

Default `/` is a splash page (“InEngine Core · built on Laravel”) with links to GitHub and the site. No product UI ships in Core.

Herd: [https://inengine.app](https://inengine.app)

## Modulus on Core

Early `PackageManifestInstaller` in `bootstrap/app.php` so discovery gating works before feature providers load. Day-to-day: `modulus:*` Artisan — [Modulus host](docs/modulus.md).

**Install ≠ enable ≠ seed.** Acquire packages with Composer (or **Modulus Composer** when opted in), then `modulus:enable`.

## Local modules

Copy `composer.local.dist.json` → `composer.local.json` (gitignored). Path repos + `inengine/modulus` `*@dev` via the merge plugin. Published Core requires `inengine/modulus` `^0.1` from Packagist.

**Production / release:** do **not** ship `composer.local.json` (release workflow strips it). Keep it for local/dev.

See [Local modules](docs/local-modules.md).

## Feature modules

Create from **[InEngine/Skeleton](https://github.com/InEngine/Skeleton)** (public GitHub **template**, not Packagist) — forked from Spatie [package-skeleton-laravel](https://github.com/spatie/package-skeleton-laravel).

## Versioning

Semantic versioning. Merges into `master`/`main` trigger a version bump and GitHub Release. Default development branch: **`dev`**.

## Credits

- [Laravel](https://laravel.com) / [Taylor Otwell](https://github.com/taylorotwell) and contributors
- [Modulus](https://github.com/InEngine/Modulus) & [Modulus Composer](https://github.com/InEngine/Modulus-Composer)
- [James Johnson](https://github.com/excellentingenuity)

## License

The MIT License (MIT). See [LICENSE.txt](LICENSE.txt). Laravel and other dependencies retain their own licenses.
