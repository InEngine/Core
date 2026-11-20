#!/usr/bin/env bash
# Fetch laravel/laravel upstream and summarize commits/tags to consider merging.
# Core diverges heavily — never auto-merge; review splash, Modulus boot, no default User.
set -euo pipefail
cd "$(dirname "$0")/.."

if ! git remote get-url upstream >/dev/null 2>&1; then
  git remote add upstream https://github.com/laravel/laravel.git
  echo "Added remote: upstream → https://github.com/laravel/laravel.git"
fi

git fetch upstream --tags --prune
echo
echo "Current HEAD: $(git rev-parse --short HEAD) ($(git branch --show-current))"
echo "Upstream default tip (upstream/master or upstream/main):"
git rev-parse --short upstream/main 2>/dev/null || git rev-parse --short upstream/master
echo
echo "Recent upstream tags:"
git tag -l 'v*' --sort=-v:refname | head -15
echo
echo "Commits on upstream not in HEAD (first 20):"
BASE=$(git merge-base HEAD upstream/main 2>/dev/null || git merge-base HEAD upstream/master 2>/dev/null || true)
if [ -n "${BASE:-}" ]; then
  git log --oneline "${BASE}..upstream/main" 2>/dev/null | head -20 || git log --oneline "${BASE}..upstream/master" | head -20
else
  echo "(no merge-base yet — inspect upstream manually)"
fi
echo
echo "Suggested next step (manual):"
echo "  git checkout -b chore/sync-laravel-upstream"
echo "  git merge upstream/main   # or cherry-pick selected commits"
echo "  # Resolve conflicts; keep PackageManifestInstaller, splash, Modulus requires."
