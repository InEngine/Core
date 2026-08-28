# InEngine Core

Opinionated modular Laravel application framework. Products (Provost, CMS, …) and client apps build on this shell plus Modulus-compatible modules.

## Stack

- Laravel 13 / PHP 8.5
- Livewire
- Tailwind CSS (Vite)
- Pest, Larastan, Laravel Debugbar, IDE Helper, Laravel Boost

## Local modules

Copy `composer.local.dist.json` to `composer.local.json` (gitignored). Path repositories point at `../Modules/*` via the Composer merge plugin. Add `"inengine/modulus": "@dev"` (and other modules) to the local `require` block when those packages support this Laravel major.

## Herd

Site: [https://inengine.app](https://inengine.app)

## Versioning

Semantic versioning. Merges into `master`/`main` trigger a version bump and GitHub Release (see `.github/workflows/release-on-merge.yml`).
