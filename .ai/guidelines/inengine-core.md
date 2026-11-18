# InEngine Core (host)

Opinionated modular Laravel host. Product features live in Modulus feature modules (`inengine/{feature}`), not in `App\` by default.

## Architecture

- **Requires** `inengine/modulus`. Boot / install PackageManifest filtering early so discovery gating works before feature providers load.
- Publish Modulus config; `storage/modulus` (or configured `modulus.state_path`) must be writable.
- No default `User` model and no product features in Core — identity belongs in a future Users module.
- Local path modules: `composer.local.json` / merge plugin → `../Modules/*` `@dev`.

## Working with modules

- Prefer `Modulus::…` / Artisan `modulus:*` (as commands land) over editing `storage/modulus/modules.json` by hand.
- Install ≠ enable: require → `Modulus::publish()` → enable → optional confirmed seed.
- Follow `inengine/modulus` Boost guidelines (package `resources/boost/guidelines/core.blade.php`) for lifecycle, deps, and events.
- New feature modules: create from `InEngine/module-skeleton`, not hand-rolled providers.

## Quality

- PHP ^8.5, Laravel 13, Pest, Pint, PHPStan/Larastan, Livewire 4.
- Prefer PHPDoc over inline comments.
- Use Laravel Boost MCP (`search-docs`, etc.) for framework APIs; use Modulus docs/guidelines for module runtime behavior.

## Canonical docs

- Sibling Documentation repo: `Plan and Design.md`
- Modulus: `DESIGN.md`, `INTEGRATION.md`
- Skeleton: `TEMPLATE.md`, `resources/DEPENDENCIES.md`, `resources/INTEGRATION.md`
