# Architecture

Core is a **thin host**. Product features belong in Modulus feature modules, not in `App\` by default. There is no default `User` model — identity will live in a future Users module.

## Layers

| Layer | Role |
|-------|------|
| **Core** (`inengine/core`) | Laravel shell, Livewire, Tailwind, host wiring for Modulus |
| **Modulus** (`inengine/modulus`) | Enable/disable, discovery filter, lifecycle, `modulus:*` Artisan |
| **Feature modules** (`inengine/{feature}`) | Product capabilities from [Skeleton](https://github.com/InEngine/Skeleton) |
| **Extensions** (`inengine/modulus-*`) | Optional runtime tools (Composer client public MIT; **`modulus-ui` private Pro**; marketplace/inspect planned) |
| **Products** (e.g. Innkeeper) | App products on Core — Innkeeper is **unreleased source** (not public yet) |

## Rules of thumb

1. Prefer `Modulus::…` / `modulus:*` over editing module state files by hand.
2. **Install ≠ enable ≠ seed** — Composer acquire, publish, enable, and confirmed seed are separate steps.
3. Extensions such as **[Modulus Composer](https://github.com/InEngine/ModulusComposer)** are opt-in. Core must **not** hard-require them.
4. New features: create from Skeleton as `inengine/{feature}` — never `inengine/modulus-*`.

## Stack

- Laravel 13 / PHP 8.5
- Livewire 4
- Tailwind CSS (Vite)
- Pest, Larastan/PHPStan, Pint, Laravel Debugbar, IDE Helper, Laravel Boost
