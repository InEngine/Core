---
name: modulus-modules
description: "Use when enabling/disabling InEngine modules, publishing module assets, seeding modules, wiring ModuleServiceProvider, Composer deps between modules, or cross-module events/contracts/DTOs. Covers install≠enable, Modulus facade APIs, skeleton conventions, and non-destructive lifecycle."
---

# Modulus modules (InEngine)

## When to use

Working on Core host wiring, `inengine/modulus`, `InEngine/module-skeleton`, or any `inengine/{feature}` module.

## Install ≠ enable ≠ seed

1. `composer require inengine/{feature}` (or path `@dev`)
2. `Modulus::publish('inengine/{feature}')` — config + `resources/dist` → `public/vendor/{name}`
3. `Modulus::enable('inengine/{feature}')` — deps check, migrate, boot
4. `Modulus::seed('inengine/{feature}', confirmed: true)` — never on enable

## APIs

- Facade: `InEngine\Modulus\Facades\Modulus`
- Events: `InEngine\Modulus\Events\ModuleEnabled` (and Disabled, Forgotten, Upgraded, Registered, Published, Seeded)
- Base provider: `InEngine\Modulus\ModuleServiceProvider`

## Dependencies

- Composer `require` graph. Modulus siblings must be **enabled**. Plain packages: installed + normal Laravel discovery.
- Optional module reach-down: `bootstrapNonModulusDependencies()`, `publishDependencyConfig()`, `publishDependencyDistAssets()`.

## Do not

- Put Composer hooks / marketplace / operator UI in `inengine/modulus`
- Name features `inengine/modulus-*`
- Drop schema on disable/forget
- Edit module state JSON by hand when the repository API exists

## Read next

- Package Boost guideline: `vendor/inengine/modulus/resources/boost/guidelines/core.blade.php` (or `../Modules/Modulus/...`)
- `INTEGRATION.md` in Modulus; skeleton `resources/INTEGRATION.md` / `DEPENDENCIES.md`
