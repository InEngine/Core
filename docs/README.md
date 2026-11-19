# InEngine Core documentation

**InEngine Core** is an **opinionated Laravel-based modular application builder framework**. It is a thin composition root: Laravel supplies the application runtime; Modulus supplies module enable/disable and lifecycle; feature modules (from Skeleton) supply product capabilities.

Built on **[Laravel](https://laravel.com)** (MIT). Default product surface is a splash page only — no product UI in Core.

| Page | Topic |
|------|--------|
| [Getting started](getting-started.md) | Clone, Composer, Herd, first boot |
| [Architecture](architecture.md) | Host vs modules vs extensions; default packages |
| [Local modules](local-modules.md) | `composer.local.json` path develop |
| [Modulus host](modulus.md) | Early boot, enable/disable, Artisan; Modulus Composer opt-in |
| [Development](development.md) | Quality tools, CI, versioning |
| [Related packages](related.md) | Modulus, Modulus Composer, Skeleton |

Agent / contributor notes: [`AGENTS.md`](../AGENTS.md).
