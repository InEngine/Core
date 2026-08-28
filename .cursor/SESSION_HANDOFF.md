# Session handoff (InEngine Core)

Use this file so new chats pick up **what we did last**, **what’s next**, and **open questions**. Update it at natural breakpoints or when the user asks to **refresh / save session context**.

**Convention:** Add newest sessions **at the top** (below this intro). Keep entries concise.

---

## Platform map (sibling code + GitHub)

| Kind | Typical absolute path | Relative from `InEngine/Core` | GitHub |
|------|----------------------|-------------------------------|--------|
| **InEngine Core** | `…/InEngine/Core` | `.` | https://github.com/InEngine/Core |
| **InEngine Modules** | `…/InEngine/Modules/*` | `../Modules/*` | Various `InEngine/*` / `inengine/*` |
| **Modulus** | `…/InEngine/Modules/Modulus` | `../Modules/Modulus` | https://github.com/InEngine/Modulus |
| **Provost** | `…/Provost/web` | `../../Provost/web` | https://github.com/excellentingenuity/Provost-Web |
| **LTC app (legacy)** | `…/LegacyTradeCollege/app` | `../../LegacyTradeCollege/app` | https://github.com/excellentingenuity/LegacyTradeCollege |

**Local modules:** copy `composer.local.dist.json` → `composer.local.json` (gitignored). Merge plugin path-repos `../Modules/*`.

**Herd:** `https://inengine.app` → this directory.

---

## How to update

1. **Session block** — Copy the template, fill it in, paste **below** `<!-- SESSION_LOG_START -->`.
2. **Never store secrets.**
3. Optional: commit this file for shared history.

### Session template

```markdown
### YYYY-MM-DD — short title

- **Branch:** …
- **Done:** …
- **Next:** …
- **Open questions:** …
```

<!-- SESSION_LOG_START -->

### 2026-08-28 — Fresh Laravel 13 Core bootstrap

- **Branch:** `dev`
- **Done:** Replaced tree with Laravel 13.29 while keeping git history; Livewire, Pest, Debugbar, IDE Helper, Larastan, Boost; User model/factory/users migration removed (sessions + password_reset_tokens kept); LTC-style Cursor rules/skills, githooks, GH workflows, `composer.local*.json`; Herd site `inengine.app`; semver release-on-merge workflow.
- **Next:** Push `dev`/`master` as needed; wire Modulus as required dependency when package is ready; Tailwind Plus when license/auth available; bootstrap Provost from this Core.
- **Open questions:** Confirm default branch (`master` vs `main`); GitHub `gh auth login` for issue creation.
