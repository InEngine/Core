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
| **Skeleton** | `…/InEngine/Modules/Skeleton` | `../Modules/Skeleton` | https://github.com/InEngine/Skeleton — GitHub **template** only (not Packagist); issue #1 Step 4b |
| **ModulusComposer** | `…/InEngine/Modules/ModulusComposer` | `../Modules/ModulusComposer` | https://github.com/InEngine/ModulusComposer — `inengine/modulus-composer` (Step 10; optional host require) |
| **Documentation** | `…/InEngine/Documentation` | `../Documentation` | Design docs (`Plan and Design.md`), logos, premise |
| **Provost** | `…/Provost/web` | `../../Provost/web` | https://github.com/excellentingenuity/Provost-Web — [Provost #4](https://github.com/users/excellentingenuity/projects/4) |
| **LTC app (legacy)** | `…/LegacyTradeCollege/app` | `../../LegacyTradeCollege/app` | https://github.com/excellentingenuity/LegacyTradeCollege — [LTC #3](https://github.com/users/excellentingenuity/projects/3) |

**Local modules:** `composer.local.dist.json` → `composer.local.json` (gitignored). Path repos `../Modules/*` live only in composer.local (merge plugin). Core **requires** `inengine/modulus` `*@dev` in `composer.json`; resolution is local-path via composer.local — no GitHub VCS/token. CI writes path `Modules/*` into `composer.local.json`.

**Herd:** https://inengine.app  

**PHPStorm:** Open `InEngine/Core`. Content roots include Alert, Calendar, GoogleCalendarAdapter, Modulus, ModulusComposer, Skeleton, TableUI, Documentation.

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

### 2026-11-19 — Step 10 ModulusComposer shipped; Skeleton rename

- **Branches:** Core `dev`; Modulus `feat/modulus-state-store`; ModulusComposer `main`; Skeleton `main`.
- **Done:** `inengine/modulus-composer` committed/pushed (Pest **28**, Pint, PHPStan; hooks/AGENTS/attribution rules). Skeleton renamed + attribution rules pushed. Modulus docs point `modulus:upgrade --approve` at `modulus-composer:approve`. PHPStorm roots for both.
- **Next:** Optional Core path opt-in require of modulus-composer; marketplace/UI later; Step 11/13 as planned.
- **Open questions:** Capability descriptor final shape; doctor substitution UX.

### 2026-11-19 — Resume on this machine after Atlas; past Step 6

- **Branches:** Core `dev`; Modulus `feat/modulus-state-store` (ff to `754dedd`).
- **Done (since Atlas 11-17 handoff):** Steps **6–9 + 8b** on Modulus. Core Step 5/6/8b present.
- **Next:** Step 10 (see newer entry).
- **Open questions:** Capability descriptor; doctor substitution UX.

### 2026-11-17 — Modulus Step 6 on Atlas; Core config synced

- **Branches:** Core `dev`; Modulus `feat/modulus-state-store` (Step 6 ready for review).
- **Done:** Modulus Step 6 lifecycle + migrate-on-enable; publish on install; **`Modulus::seed(..., confirmed: true)`** only (skeleton confirming ModuleSeeder). Core `config/modulus.php` has `migrations` + `publish`. Suite: Modulus Pest **95** + PHPStan OK on Atlas.
- **Next:** Review/commit Modulus Step 6 (+ skeleton stub) → Step 7 deps; Step 10 wires composer → publish. *(Superseded: 6–9 done; see 2026-11-19.)*
- **Open questions:** Capability descriptor final shape; doctor substitution UX.

### 2026-11-03 — Checkpoint: Steps 0–5 + 4b done; next is Step 6

- **Branches:** Core `dev` (ahead of origin); Modulus `feat/modulus-state-store` (ahead of origin); skeleton `main` on GitHub template.
- **Where we are (Plan):** Steps **0–5** and **4b** complete. Runtime: state store, PackageManifest filter, ModuleRepository, handshake, Core requires Modulus (path via `composer.local`), invalid-store exceptions, missing enabled→throw / disabled→log. Skeleton live. Doctor missing-module **remediation** documented for Step 9 (not built).
- **Done this arc:** Core Step 5 + local composer.local path (no GitHub token); Modulus coverage ~91%+; missing-package validation; Plan Step 9 repair options (install / supply / substitute).
- **Next:** **Step 6** — lifecycle hooks + non-destructive disable/uninstall + migrations on enable/upgrade. Then 7 deps → 8 events/contracts → 9 Artisan/doctor (+ missing repair) → 10 modulus-composer → 13 Alert pilot.
- **Push/merge:** Push Modulus commits then Core; retarget CI Modulus ref to `main` after merge; Packagist when tagged.
- **Open questions:** Capability descriptor final shape; doctor substitution UX (capability match vs explicit rename).

### 2026-11-03 — Doctor missing-module remediation (planned)

- **Done (docs):** Step 9 plan: `modulus:doctor` lists missing tracked packages; repair via Composer install, supply path/VCS, or substitute another module (`modulus-composer` does I/O).
- **Next:** Step 6 lifecycle; implement doctor remediation with Step 9/10.
- **Open questions:** Substitution UX (capability match vs explicit package rename).

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
