# Session handoff (InEngine Core)

Use this file so new chats pick up **what we did last**, **what’s next**, and **open questions**. Newest sessions at the top below the intro. **No secrets.**

---

## Platform map (sibling code + GitHub)

| Kind | Typical absolute path | Relative from `InEngine/Core` | GitHub / project |
|------|----------------------|-------------------------------|------------------|
| **InEngine Core** | `…/InEngine/Core` | `.` | https://github.com/InEngine/Core — [InEngine #2](https://github.com/orgs/InEngine/projects/2) |
| **Modulus** | `…/InEngine/Modules/Modulus` | `../Modules/Modulus` | https://github.com/InEngine/Modulus — PR #7 L13 |
| **TableUI** | `…/InEngine/Modules/TableUI` | `../Modules/TableUI` | https://github.com/InEngine/TableUI |
| **Calendar** | `…/InEngine/Modules/Calendar` | `../Modules/Calendar` | https://github.com/InEngine/Calendar |
| **GoogleCalendarAdapter** | `…/InEngine/Modules/GoogleCalendarAdapter` | `../Modules/GoogleCalendarAdapter` | https://github.com/InEngine/GoogleCalendarAdapter |
| **Alert** | `…/InEngine/Modules/Alert` | `../Modules/Alert` | https://github.com/InEngine/Alert |
| **module-skeleton** | `…/InEngine/Modules/module-skeleton` | `../Modules/module-skeleton` | https://github.com/InEngine/module-skeleton — GitHub **template** only (not Packagist); issue #1 Step 4b |
| **Documentation** | `…/InEngine/Documentation` | `../Documentation` | Design docs (`Plan and Design.md`), logos, premise |
| **Provost** | `…/Provost/web` | `../../Provost/web` | https://github.com/excellentingenuity/Provost-Web — [Provost #4](https://github.com/users/excellentingenuity/projects/4) |
| **LTC app (legacy)** | `…/LegacyTradeCollege/app` | `../../LegacyTradeCollege/app` | https://github.com/excellentingenuity/LegacyTradeCollege — [LTC #3](https://github.com/users/excellentingenuity/projects/3) |

**Local modules:** `composer.local.dist.json` → `composer.local.json` (gitignored). Paths `../Modules/*` for Herd. Core **requires** `inengine/modulus` `*@dev` in `composer.json` (Step 5); CI checks out Modulus under `Modules/`.

**Herd:** https://inengine.app  

**PHPStorm:** Open `InEngine/Core`. Content roots include Alert, Calendar, GoogleCalendarAdapter, Modulus, module-skeleton, TableUI, Documentation.

**Cursor handoffs:** Every level above has `.cursor/SESSION_HANDOFF.md` (+ `session-handoff` rule). When switching roots, read that repo’s handoff.

---

## How to update

1. Paste a new block **below** `<!-- SESSION_LOG_START -->`.
2. Never store secrets.

### Session template

```markdown
### YYYY-MM-DD — short title

- **Branch:** …
- **Done:** …
- **Next:** …
- **Open questions:** …
```

<!-- SESSION_LOG_START -->

### 2026-11-03 — Step 5 Core requires Modulus

- **Branch (Core):** `dev`
- **Done:** `inengine/modulus` in Core `require`; published `config/modulus.php`; early `PackageManifestInstaller` kept; Pest host-contract + arch smoke; CI path-checkout Modulus. Modulus fix: installer uses concrete `Filesystem` before `files` is bound.
- **Next:** Step 6 lifecycle hooks + non-destructive rules + migrations on enable.
- **Open questions:** Retarget CI Modulus ref from `feat/modulus-state-store` → `main` after merge; Packagist when tagged.

### 2026-11-03 — Step 4b module-skeleton repo live

- **Branch (Core):** `dev` (reviewing Step 4 handshake)
- **Done:** Created `InEngine/Modules/module-skeleton` from Spatie fork; GitHub template repo https://github.com/InEngine/module-skeleton; PHPStorm content root + VCS; `ModuleServiceProvider` + capability stub; Pest green; project issue #1 (In progress).
- **Next:** Continue skeleton polish while reviewing Step 4; commit Modulus Step 4 handshake; later Core `require` Modulus (Step 5).
- **Open questions:** Capability descriptor format final shape; when to retarget skeleton CI from Modulus `feat/modulus-state-store` to `main`.

### 2026-11-03 — Modulus Steps 1–2 underway

- **Branch (Core):** `dev`
- **Done:** Modulus StateStore + Step 3 PackageManifest filter; Core `bootstrap/app.php` early installer. Design: module-skeleton required; capability catalog extension (inspect/compat) planned; marketplace separate.
- **Next:** Commit Step 3; ModuleRepository; handshake; full Core `require` Modulus when ready.
- **Open questions:** Capability descriptor format; marketplace/catalog package names.

### 2026-09-08 — Session pause (platform design locked)

- **Branch:** `dev`
- **Done:** Modular platform design agreed and written to Documentation `Plan and Design.md` (steps 0–13) + Modulus `DESIGN.md`. Key decisions: multi-class Modulus + `ModulusStateStore` (atomic file); Core requires Modulus + early boot; enable/disable via Laravel PackageManifest (not composer.json fights); bus + contracts/DTOs; Composer/Packagist/Git submodule; non-destructive disable/uninstall; migrations on enable/upgrade; `modulus:doctor`; SemVer/Pint/Pest/PHPStan everywhere; CLI/API first. Documentation content root in PHPStorm.
- **Next:** Merge Modulus PR #7 → Step 1–2 (service split + `ModulusStateStore`) → PackageManifest sync → Core `require` Modulus + early boot. See Documentation plan + Modulus DESIGN.md.
- **Open questions:** State file commit vs gitignore; Packagist client namespace vs separate package; PackageManifest decorate details.

### 2026-09-08 — Expanded platform plan (services, doctor, safety)


- **Branch:** `dev`
- **Done:** Rewrote Documentation `Plan and Design.md` with stepped plan (0–13): multi-class Modulus + **`ModulusStateStore`** (atomic swap); Core **requires Modulus** + early boot; SemVer/Pint/Pest/PHPStan everywhere; enable/disable via **Laravel PackageManifest** (not composer.json fights); bus + **contracts/DTOs**; Composer/Packagist/Git **submodule**; non-destructive disable/uninstall + migrations on enable/upgrade; **`modulus:doctor`**. Modulus `DESIGN.md` synced.
- **Next:** Merge Modulus PR #7; start Step 1–2 (service split + state store), then Core require + early boot.
- **Open questions:** State file commit vs gitignore; PackageManifest decorate details; private Packagist auth UX.

### 2026-09-08 — Modulus plan + Documentation in PHPStorm

- **Branch:** `dev`
- **Done:** Documented modular platform design (CLI/API-first, Spatie skeleton, Laravel providers only, file registry, CLI/UI parity). Modules **register with Modulus** when present; disabled until enabled. Modulus syncs enable/disable through Laravel **package discovery** (`PackageManifest` / packages cache). Docs: Documentation `Plan and Design.md`; Modulus `DESIGN.md` / README / handoff. PHPStorm content root for Documentation.
- **Next:** Merge Modulus PR #7; implement file store, discovery sync, register-with-Modulus base provider, full modulus:* CLI; create `InEngine/module-skeleton`.
- **Open questions:** State file path/format; PackageManifest decorate vs rewrite `packages.php`; uninstall always `composer remove` vs forget-only.

### 2026-08-28 — Session pause (platform bootstrap complete)

- **Branch:** `dev`
- **Done:** Multi-level Cursor handoffs everywhere; Provost parity issues **#1–#32** on project Backlog; Modulus L13 PR #7 + local `@dev` wiring; Core/Provost/Alert/TableUI/Modulus docs pushed.
- **Next:** Merge Modulus PR #7 when CI green; start Provost Backlog from #1 (Require Modulus).
- **Open questions:** Core `dev` → `master` via PR (not force-push); Tailwind Plus deferred (Spatie auth).

### 2026-08-28 — Fresh Laravel 13 Core bootstrap

- **Branch:** `dev`
- **Done:** Laravel 13.29 shell; Livewire/Pest/Boost tooling; User removed; Herd `inengine.app` HTTPS; LTC-style Cursor/CI.
- **Next:** (see newer entry)
