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
| **Provost** | `…/Provost/web` | `../../Provost/web` | https://github.com/excellentingenuity/Provost-Web — [Provost #4](https://github.com/users/excellentingenuity/projects/4) |
| **LTC app (legacy)** | `…/LegacyTradeCollege/app` | `../../LegacyTradeCollege/app` | https://github.com/excellentingenuity/LegacyTradeCollege — [LTC #3](https://github.com/users/excellentingenuity/projects/3) |

**Local modules:** `composer.local.dist.json` → `composer.local.json` (gitignored). Paths `../Modules/*`; currently requires `inengine/modulus` `@dev`.

**Herd:** https://inengine.app  

**PHPStorm:** Open `InEngine/Core`. Content roots include Alert, Calendar, GoogleCalendarAdapter, Modulus, TableUI.

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

### 2026-08-28 — Multi-level handoffs; Modulus L13 wired locally

- **Branch:** `dev`
- **Done:** Platform GH project; Provost parity issues filed; Modulus L13 PR open; Core local composer requires Modulus `@dev`; Cursor handoffs ensured across Core, modules, and umbrellas.
- **Next:** Merge Modulus PR #7 when CI green; keep handoffs current when cutting module work.

### 2026-08-28 — Fresh Laravel 13 Core bootstrap

- **Branch:** `dev`
- **Done:** Laravel 13.29 shell; Livewire/Pest/Boost tooling; User removed; Herd `inengine.app` HTTPS; LTC-style Cursor/CI.
- **Next:** (see newer entry)
