# Getting started

## Requirements

- PHP ^8.5
- Composer 2
- Node (Vite / Tailwind)
- [Laravel Herd](https://herd.laravel.com) recommended on macOS

## Bootstrap

```bash
git clone git@github.com:InEngine/Core.git
cd Core
composer run setup
```

`setup` installs PHP deps, copies `.env` if missing, generates `APP_KEY`, runs migrations, then `npm install` + `npm run build`.

### Herd

Point Herd at this directory. Default local URL: [https://inengine.app](https://inengine.app).

### Dev stack

```bash
composer run dev
```

## Modulus

Core **requires** `inengine/modulus`. In monorepo develop, resolve it via [local modules](local-modules.md). Publish config once if you need host overrides:

```bash
php artisan vendor:publish --tag="modulus-config"
```

State defaults to `storage/modulus/modules.json` (writable; typically gitignored content).

Continue with [Modulus host](modulus.md) for early boot and enable/disable.
