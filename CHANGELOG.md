# Changelog

All notable changes to InEngine Core will be documented in this file.

## Unreleased

### Changed

- Splash-only UI: replace Laravel welcome with InEngine Core splash (GitHub / website / Modulus links)
- Require `inengine/modulus` `^0.1` for Packagist; local/CI keep path `*@dev` via `composer.local.json`
- Release workflow strips `composer.local.json` before tagging
- Add MIT `LICENSE.txt` (Core remains MIT)

### Docs

- User-facing documentation under `docs/` (Getting started, architecture, local modules, Modulus host, development, related packages) for GitHub Pages

### Step 8b — Laravel Boost agent guidelines

- `.ai/guidelines/inengine-core.md`, `.ai/skills/modulus-modules`, `.ai/rules/inengine-modulus-host.md` (+ index)
- `boost.json` includes `inengine/modulus` (package guidelines/skills) and `modulus-modules` skill
- `AGENTS.md` project overview outside Boost block; `composer` `post-update-cmd` runs `boost:update`

### Modulus Step 6 host sync

- Published `config/modulus.php` gains `migrations` and `publish` options (install-time asset/config publish; migrate-on-enable)
- Composer lock refreshed (`composer update`)
- Session handoff notes Step 6 complete on Modulus path

### Earlier

- Fresh Laravel 13 application shell with Livewire, Pest, and modular tooling baseline.
- Default User model, factory, and users table migration removed (User will be a module).
