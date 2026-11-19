# Development

## Quality

```bash
composer test          # Pest via artisan test
composer phpstan       # Larastan
vendor/bin/pint --dirty
```

Prefer PHPDoc blocks over inline comments. Match existing patterns in neighboring files.

## Frontend

Vite + Tailwind. After dependency changes:

```bash
npm install
npm run build
# or with the PHP stack:
composer run dev
```

## Versioning

Semantic versioning. Merges into the release branch trigger a version bump and GitHub Release (see `.github/workflows/release-on-merge.yml`). Day-to-day work lands on **`dev`** (default branch).

## Agent tooling

- [`AGENTS.md`](../AGENTS.md) — host rules + Laravel Boost guidelines
- `.ai/guidelines/inengine-core.md` — Core architecture for agents
- Skill `modulus-modules` — when touching modules or Modulus wiring
