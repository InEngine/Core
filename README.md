# InEngine Core

[![Tests](https://img.shields.io/github/actions/workflow/status/InEngine/Core/tests.yml?branch=dev&label=tests&style=flat-square)](https://github.com/InEngine/Core/actions?query=workflow%3Atests+branch%3Adev)
[![PHPStan](https://img.shields.io/github/actions/workflow/status/InEngine/Core/phpstan.yml?branch=dev&label=phpstan&style=flat-square)](https://github.com/InEngine/Core/actions?query=workflow%3Aphpstan+branch%3Adev)
[![Pint](https://img.shields.io/github/actions/workflow/status/InEngine/Core/fix-php-code-style-issues.yml?branch=dev&label=pint&style=flat-square)](https://github.com/InEngine/Core/actions?query=workflow%3A%22Fix+PHP+code+style+issues%22+branch%3Adev)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE.txt)

**InEngine Core** is an **opinionated Laravel-based modular application builder framework**. Product and custom apps start from this host shell and grow through [Modulus](https://github.com/InEngine/Modulus)-compatible feature modules — not by stuffing product code into `App\` by default.

**Documentation:** [docs/](docs/) · [https://inengine.github.io/Core/](https://inengine.github.io/Core/)

## Attribution

Built on **[Laravel](https://laravel.com)** (MIT). InEngine Core is a specialized host and composition root; Laravel remains the underlying application framework. See [laravel/framework](https://github.com/laravel/framework) and the [Laravel license](https://github.com/laravel/framework/blob/12.x/LICENSE.md).

## What ships by default

| Layer | Packages / role |
|-------|-----------------|
| **Framework** | `laravel/framework` ^13, PHP ^8.5, `laravel/tinker` |
| **UI runtime (for modules/products)** | Livewire 4, Tailwind CSS (Vite) — Core itself only ships a splash page |
| **Module runtime** | **[`inengine/modulus`](https://github.com/InEngine/Modulus)** (required, `^0.1@beta`) — enable/disable, discovery gating, lifecycle, `modulus:*` |
| **Composer client** | **[Modulus Composer](https://github.com/InEngine/Modulus-Composer)** (`inengine/modulus-composer`, `^0.1@beta`) — require/remove/update/approve |
| **require-dev** | Laravel Debugbar, Laravel Boost, IDE Helper, Pest (+ plugins), Pint, Larastan, Ignition, Pail, … |

**Licensing:** Core, Modulus, Modulus Composer, and [Skeleton](https://github.com/InEngine/Skeleton) are **MIT**. `modulus-ui` will be **private Pro**.

## Quick start

**Greenfield (empty directory):**

```bash
composer create-project inengine/core:^0.1@beta my-app   # when Core is on Packagist
# or clone this repo into an empty dir, then:
composer install
php bin/setup
composer run dev
```

**Already a git repo / non-empty dir:** Composer `create-project` cannot target it. Clone or checkout Core, then:

```bash
composer install
php bin/setup                 # interactive: name, APP_ENV, URL, npm, migrate, optional git init
# php bin/setup --no-interaction --env=local --url=http://core.test
```

Monorepo path develop: `php bin/setup --with-composer-local` (or copy `composer.local.dist.json`).

Default `/` is a splash page.

## Modulus on Core

Early `PackageManifestInstaller` in `bootstrap/app.php` so discovery gating works before feature providers load. Day-to-day: `modulus:*` Artisan — [Modulus host](docs/modulus.md).

**Install ≠ enable ≠ seed.** Acquire with Composer / `modulus-composer:*`, then `modulus:enable`.

## Local modules

Copy `composer.local.dist.json` → `composer.local.json` (gitignored). Path `*@dev` for Modulus + Modulus Composer (merge-plugin `replace`). Published root constraints stay `^0.1@beta`.

**Production / release:** do **not** ship `composer.local.json` (release workflow strips it).

## Upstream (Laravel)

Core is a specialized host on top of Laravel. To pull framework-app skeleton changes:

```bash
./scripts/sync-upstream-laravel.sh
```

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
