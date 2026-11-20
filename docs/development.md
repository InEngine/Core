# Development

## Quality gates (Step 11)

Step 11 is **reliability**, not operator UI:

| Gate | Where |
|------|--------|
| Pest | Core `composer test`; packages `vendor/bin/pest` |
| PHPStan / Larastan | `composer phpstan` / `composer analyse` |
| Pint | `vendor/bin/pint --dirty` |
| SemVer + Conventional Commits | package changelogs / release discipline when cutting tags |

Shared package workflow templates: Documentation [`ci/`](https://github.com/InEngine/Documentation/tree/master/ci).

Host **integration** tests live under `tests/Feature/` (Modulus boot, discovery filter, `modulus:*`).

**UI:** `inengine/modulus-ui` is **private Pro** and is **not** part of Step 11.

## Quality commands

```bash
composer test          # Pest via artisan test
composer phpstan       # Larastan
vendor/bin/pint --dirty
```

Prefer PHPDoc blocks over inline comments. Match existing patterns in neighboring files.

## Frontend

Vite + Tailwind exist for modules/products. Core’s default `/` is splash-only.

```bash
npm install
npm run build
composer run dev
```

## Versioning

Semantic versioning. Merges into the release branch trigger a version bump and GitHub Release (see `.github/workflows/release-on-merge.yml`). Day-to-day work lands on **`dev`**. Do not tag/Packagist-publish Modulus packages until an intentional release.

## Agent tooling

- [`AGENTS.md`](../AGENTS.md) — host rules + Laravel Boost guidelines
- `.ai/guidelines/inengine-core.md` — Core architecture for agents
- Skill `modulus-modules` — when touching modules or Modulus wiring
