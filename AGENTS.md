# InEngine Core

Modular Laravel host (PHP 8.5, Laravel 13). Product features belong in Modulus modules (`inengine/{feature}`), not in Core `App\` by default.

## Build and test

- `composer test` / `php artisan test --compact`
- `composer phpstan` / `vendor/bin/phpstan analyse`
- `vendor/bin/pint --dirty --format agent`
- `composer run dev` for local server stack

## Project docs

- User docs (GitHub Pages): `docs/`

## Git

- Work on **`dev`**; open a PR into **`master`** (never land feature work straight on `master`).
- Same pattern for all InEngine packages: **`dev` → `main`** (or `master` where that is the release branch). See Documentation `Git workflow.md`.

## InEngine / Modulus

- Follow `.ai/guidelines/inengine-core.md` and the `modulus-modules` skill when touching modules.
- Package guidelines ship from `inengine/modulus` via `resources/boost/guidelines/`.
- Canonical plan: sibling Documentation `Plan and Design.md`.
- Project rules index: `.ai/rules/index.md` — read matching rules before planning or editing.

<laravel-boost-guidelines>
=== .ai/inengine-core rules ===

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
- New feature modules: create from `InEngine/Skeleton`, not hand-rolled providers.

## Quality

- PHP ^8.5, Laravel 13, Pest, Pint, PHPStan/Larastan, Livewire 4.
- Prefer PHPDoc over inline comments.
- Use Laravel Boost MCP (`search-docs`, etc.) for framework APIs; use Modulus docs/guidelines for module runtime behavior.

## Canonical docs

- Sibling Documentation repo: `Plan and Design.md`
- Modulus: `DESIGN.md`, `INTEGRATION.md`
- Skeleton: `TEMPLATE.md`, `resources/DEPENDENCIES.md`, `resources/INTEGRATION.md`

=== foundation rules ===

# Laravel Boost Guidelines

## Foundational Context

This application is a Laravel application running on PHP 8.5. Always use the APIs that match the installed major version of each package — do not assume a version.

Before relying on a package's API, confirm its installed version:
- PHP packages: run `composer show --direct` to list direct dependencies with versions, or `composer show <vendor/package>` for a single package.
- JS packages: check `package.json` for the installed versions.

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If a frontend change doesn't show in the UI or you get a "Unable to locate file in Vite manifest" error, run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Use `search-docs` before changes that depend on Laravel ecosystem APIs, behavior, configuration, or version-specific syntax. Skip it for copy-only edits and other changes where package documentation is irrelevant. Reuse sufficient results already in context instead of searching again.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Project Rules

- This project contains committed, area-grouped rules in `.ai/rules` when that directory exists, including path-scoped framework guidelines under `.ai/rules/boost`. Before you enter plan mode or create/edit any file, you MUST first: open @.ai/rules/index.md (it maps file globs to rule files), read every rule file whose globs cover the path(s) in scope, and run `grep -rin 'keyword' .ai/rules` to catch what a path match alone misses. Do not write code until you have read and are following every matching rule. If `.ai/rules` does not exist, continue without it.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.

=== tests rules ===

# Test Enforcement

- Add or update tests for behavior and logic changes when a test provides meaningful regression coverage.
- Pure copy, styling, and layout-only changes do not require new or updated tests.
- When test coverage applies, run the affected tests and ensure they pass.
- Test the changed behavior and its important failure modes, but do not add tests beyond them.
- Read the `testing-best-practices` skill before writing tests.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

=== livewire/core rules ===

# Livewire

- Livewire allows you to build dynamic, reactive interfaces in PHP without writing JavaScript.
- You can use Alpine.js for client-side interactions instead of JavaScript frameworks.
- Keep state server-side so the UI reflects it. Validate and authorize in actions as you would in HTTP requests.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

# Pest

- This project uses Pest. Create tests with `php artisan make:test --pest {name}`.
- Do not include the test suite directory in `{name}`. Use `SomeFeatureTest`, not `Feature/SomeFeatureTest`.
- Read the `testing-best-practices` skill for guidance on coverage, naming, structure, dependency isolation, and review.
- Do not delete tests or test files without approval. They are part of the application.

## Running Tests

- Run the narrowest set of tests that covers the change. Pass a file path or `--filter=testName` to `php artisan test --compact`.
- Rerun a test after each change to it.
- Run `vendor/bin/pest` to call the test runner directly. It accepts the same file path and `--filter=testName` arguments.

=== inengine/modulus/core rules ===

## inengine/modulus

Module runtime for InEngine hosts: file-backed enable/disable state, Laravel `PackageManifest` filtering, register-with-Modulus handshake, lifecycle hooks, Composer dependency guards, publish/seed APIs, and lifecycle events.

Prefer `InEngine\Modulus\Facades\Modulus` / `ModuleRepository` over touching the state store or discovery syncer directly.

### Install ≠ enable

1. Composer require (or path `@dev`) installs the package.
2. `Modulus::publish($package)` on install/update (config + `resources/dist` → `public/vendor/{name}`) — owned by `inengine/modulus-composer` later; call manually until then.
3. Packages default **disabled** until `Modulus::enable($package)` (or future `modulus:enable`).
4. Enable runs dependency checks → activating → migrate → state → discovery sync → activated. It does **not** publish assets or seed.
5. Seed only via `Modulus::seed($package, confirmed: true)`.

### Naming

- Runtime: `inengine/modulus`
- Extensions: `inengine/modulus-{role}` only (`composer`, `marketplace`, `ui`, `inspect`) — never fold Composer hooks or operator UI into this package
- Feature modules: `inengine/{feature}` from `InEngine/Skeleton` — never `modulus-*`

### Feature modules

- Extend `InEngine\Modulus\ModuleServiceProvider`; declare `modulusPackageName()`.
- Discovery only via `extra.laravel.providers`.
- Migrations on enable/upgrade; disable/forget/uninstall are non-destructive (no schema wipe).
- Migrations must guard `Schema::hasTable` for re-enable after non-destructive uninstall.

### Dependencies (Step 7)

- Hard graph = package `composer.json` `require` (skip php/ext/composer-* platform keys).
- Required **Modulus modules** must be installed **and** enabled before enable.
- **Non-Modulus** Composer packages must be installed only; they keep normal Laravel discovery / `vendor:publish`.
- Modules may optionally reach down in `activating()` / `bootstrapNonModulusDependencies()` for config, UI dist → `public/vendor`, or migrations.
- Cannot disable/forget while enabled dependents still require the package.

### Integration (Step 8)

- Owning module side effects: `ModuleLifecycle` hooks on the provider.
- Peers/host: listen to `InEngine\Modulus\Events\*` (`ModuleEnabled`, `ModuleDisabled`, `ModuleForgotten`, `ModuleUpgraded`, `ModuleRegistered`, `ModulePublished`, `ModuleSeeded`). Payload often includes `ModuleStateData`.
- Cross-module APIs: PHP interfaces + readonly DTOs, bound in the Laravel container when the providing module is enabled. No custom plugin registry.
- Author detail: package `INTEGRATION.md`.

### Artisan (Step 9)

- `modulus:list`, `discover`, `enable`, `disable`, `uninstall`, `status`, `publish`, `seed`, `upgrade`, `outdated`, `update`, `doctor`
- `modulus:upgrade` applies the *installed* Composer version (migrate/hooks); `--publish` republishes assets; `--approve=` messages constraint bump (modulus-composer / UI rewrites `composer.json`)
- `modulus:outdated` / `modulus:update` check Packagist via Composer; dispatch `ModuleUpdateAvailable` for modulus-ui; `--auto` applies patch-within-constraint when `modulus.updates.auto_patch` and a real `ModuleUpdateApplier` are bound
- `modulus:doctor` exits non-zero when enabled packages are missing; findings (incl. `update_available`) feed modulus-ui

### Upgrades & SemVer policy

- Default host constraint style: **patch** → `~x.y.z` (same minor only) via `modulus.upgrades.default_constraint`
- Enabled modules auto-apply installed version on handshake when `auto_apply_installed` is true
- Available updates: listen to `ModuleUpdateAvailable` or poll doctor / `modulus:outdated` in CLI and UI
- Optional auto-patch: `modulus.updates.auto_patch=true` + modulus-composer applier; minor/major still need approval
- Minor/major bumps require operator approval (CLI/UI) — never silent Composer constraint widening
- Override `modulusManualAttentionItems()` for post-upgrade checklists; dispatches `ModuleManualAttentionRequired` for modulus-ui

### Host wiring (Core)

- Require `inengine/modulus` in the host `composer.json`.
- Call `PackageManifestInstaller` early so filtering is active before feature providers load.
- Publish Modulus config; keep `modulus.state_path` writable.
- Do not put product features or a default `User` model in Core.

### Tests & quality

- Pest + PHPStan + Pint; PHP `^8.5`, Laravel 12/13 contracts.
- Prefer PHPDoc over inline comments.
- Canonical plan: InEngine Documentation `Plan and Design.md`.

</laravel-boost-guidelines>
