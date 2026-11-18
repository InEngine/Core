# Changelog

All notable changes to InEngine Core will be documented in this file.

## Unreleased

### Modulus Step 6 host sync

- Published `config/modulus.php` gains `migrations` and `publish` options (install-time asset/config publish; migrate-on-enable)
- Composer lock refreshed (`composer update`)
- Session handoff notes Step 6 complete on Modulus path

### Earlier

- Fresh Laravel 13 application shell with Livewire, Pest, and modular tooling baseline.
- Default User model, factory, and users table migration removed (User will be a module).
