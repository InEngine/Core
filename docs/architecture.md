# Architecture

**InEngine Core** is an opinionated **Laravel-based modular application builder framework**. It is a **thin host**: product features belong in Modulus feature modules, not in `App\` by default. There is no default `User` model — identity belongs in a future Users module.

Built on **[Laravel](https://laravel.com)**. Core does not replace Laravel; it composes Laravel with Modulus and optional extensions.

## Layers

| Layer | Role |
|-------|------|
| **Laravel** | Application framework (`laravel/framework` ^13, PHP ^8.5) |
| **Core** (`inengine/core`) | Opinionated host / create-project root: early Modulus boot, Vite/Tailwind, Livewire available for modules, splash-only default UI |
| **Modulus** (`inengine/modulus`) | **Required** — enable/disable, discovery filter, lifecycle, `modulus:*` Artisan |
| **Modulus Composer** (`inengine/modulus-composer`) | **Opt-in** — Composer require/remove/update/approve + `ModuleUpdateApplier` |
| **Feature modules** (`inengine/{feature}`) | Product capabilities from [Skeleton](https://github.com/InEngine/Skeleton) (GitHub template; not Packagist) |
| **Extensions** (`inengine/modulus-*`) | Optional tools (`modulus-ui` = **private Pro**; marketplace/inspect planned) |
| **Products** | Core-shaped apps that require and enable feature modules |

## Default packages (Core)

**require**

- `laravel/framework`, `laravel/tinker`
- `livewire/livewire` (for modules/products; Core ships no Livewire screens)
- `inengine/modulus` `*@dev` (until Packagist `^0.1`)

**require-dev (selected)**

- `barryvdh/laravel-debugbar`, `laravel/boost`, `barryvdh/laravel-ide-helper`
- Pest (+ Laravel/Livewire/Faker plugins), Pint, Larastan
- `spatie/laravel-ignition`, Pail, merge-plugin (local path modules)

**Not required by Core:** Modulus Composer — install when the host should drive Composer I/O from Artisan.

## Rules of thumb

1. Prefer `Modulus::…` / `modulus:*` over editing module state files by hand.
2. **Install ≠ enable ≠ seed** — Composer acquire, publish, enable, and confirmed seed are separate steps.
3. Use **[Modulus Composer](https://github.com/InEngine/Modulus-Composer)** for acquire/remove/update when opted in; Core must **not** hard-require it.
4. New features: create from Skeleton as `inengine/{feature}` — never `inengine/modulus-*`.
