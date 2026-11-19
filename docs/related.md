# Related packages

| Repo | Package / role |
|------|----------------|
| [Laravel](https://github.com/laravel/framework) | Underlying application framework (MIT) — Core is built on Laravel |
| [InEngine/Modulus](https://github.com/InEngine/Modulus) | `inengine/modulus` — **required** module runtime ([docs](https://github.com/InEngine/Modulus/tree/main/docs)) |
| [InEngine/Modulus-Composer](https://github.com/InEngine/Modulus-Composer) | **Modulus Composer** (`inengine/modulus-composer`) — **opt-in** Composer I/O + `ModuleUpdateApplier` |
| [InEngine/Skeleton](https://github.com/InEngine/Skeleton) | Public GitHub **template** for `inengine/{feature}` (not Packagist); forked from [spatie/package-skeleton-laravel](https://github.com/spatie/package-skeleton-laravel) |
| `inengine/modulus-ui` | Operator UI — **private Pro** (planned; not public) |
| Innkeeper | Product on Core — **unreleased source** (not public yet) |

**Licensing:** Core, Modulus, Modulus Composer, and Skeleton are **MIT**. Pro UI stays private. Product apps (Innkeeper) stay unreleased until published. Canonical notes: Documentation [Plan and Design](https://github.com/InEngine/Documentation/blob/master/Plan%20and%20Design.md) · [Distribution and Installation](https://github.com/InEngine/Documentation/blob/master/Distribution%20and%20Installation.md) · [Packagist](https://github.com/InEngine/Documentation/blob/master/Packagist.md).

**Spine status:** Steps **0–10 + 8b** done (OSS). Skeleton public as template. Next: Packagist submit for Modulus packages; Step 11 quality-gate audit; Step 13 Alert pilot.

Core **requires** Modulus. **Modulus Composer** and other extensions stay optional on the host.
