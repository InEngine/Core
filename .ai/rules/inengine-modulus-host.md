---
paths:
  - app/**
  - bootstrap/**
  - config/modulus.php
  - composer.json
  - composer.local.json
  - tests/**
---

# InEngine Modulus host rules

- Core must require `inengine/modulus` and install PackageManifest filtering early.
- Do not add product features or a default `User` to Core; use feature modules.
- Prefer `Modulus::` APIs over hand-editing module state files.
- Install ≠ enable ≠ seed. Publish on install; migrate on enable; seed only with confirmation.
- New modules come from `InEngine/Skeleton` as `inengine/{feature}`, never `inengine/modulus-*`.
