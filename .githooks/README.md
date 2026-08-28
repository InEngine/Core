# Git hooks (optional)

Repository-local hooks keep commit messages aligned with workspace rules (no automatic `Co-authored-by:` trailers from the IDE).

## Enable

From the repository root:

```bash
git config core.hooksPath .githooks
chmod +x .githooks/commit-msg
```

## `commit-msg`

Strips IDE-injected Cursor co-author trailers (`Co-authored-by: Cursor`, `cursoragent@cursor.com`) so commits stay attributed to **James Johnson** / **excellentingenuity** unless you add credit intentionally.

Bypass for one commit: `git commit --no-verify`.
