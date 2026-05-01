#!/usr/bin/env bash
set -euo pipefail

PANTHEON_GIT_URL="${PANTHEON_GIT_URL:-ssh://codeserver.dev.40264a91-6a93-4042-a9b5-a73e0b8b55f3@codeserver.dev.40264a91-6a93-4042-a9b5-a73e0b8b55f3.drush.in:2222/~/repository.git}"
PANTHEON_BRANCH="${PANTHEON_BRANCH:-master}"
COMMIT_MESSAGE="${COMMIT_MESSAGE:-Deploy Azure Synthetics storefront}"
PANTHEON_SSH_KEY="${PANTHEON_SSH_KEY:-}"
WOOCOMMERCE_VERSION="${WOOCOMMERCE_VERSION:-10.7.0}"

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
REPO_ROOT="$(cd "$SCRIPT_DIR/.." && pwd)"
BUNDLE_DIR="$REPO_ROOT/migration_bundle"
WORK_DIR="$(mktemp -d "${TMPDIR:-/tmp}/azure-pantheon.XXXXXX")"
KNOWN_HOSTS_FILE="$WORK_DIR/known_hosts"

cleanup() {
	rm -rf "$WORK_DIR"
}
trap cleanup EXIT

if [[ ! -d "$BUNDLE_DIR/wp-content" ]]; then
	echo "Migration bundle not found: $BUNDLE_DIR/wp-content" >&2
	exit 1
fi

if [[ ! -f "$BUNDLE_DIR/azure_synthetics_full_migration.sql" ]]; then
	echo "Database export not found: $BUNDLE_DIR/azure_synthetics_full_migration.sql" >&2
	exit 1
fi

echo "--- Azure Synthetics Pantheon deploy ---"
echo "Cloning Pantheon repository..."

SSH_KEY_OPTION=""
if [[ -n "$PANTHEON_SSH_KEY" ]]; then
	if [[ "$PANTHEON_SSH_KEY" == "~/"* ]]; then
		PANTHEON_SSH_KEY="$HOME/${PANTHEON_SSH_KEY#~/}"
	fi

	if [[ ! -f "$PANTHEON_SSH_KEY" ]]; then
		echo "Pantheon SSH key not found: $PANTHEON_SSH_KEY" >&2
		exit 1
	fi

	PANTHEON_SSH_KEY="$(cd "$(dirname "$PANTHEON_SSH_KEY")" && pwd)/$(basename "$PANTHEON_SSH_KEY")"
	SSH_KEY_OPTION="-i $PANTHEON_SSH_KEY -o IdentitiesOnly=yes"
fi

export GIT_SSH_COMMAND="ssh $SSH_KEY_OPTION -o BatchMode=yes -o ConnectTimeout=20 -o StrictHostKeyChecking=accept-new -o UserKnownHostsFile=$KNOWN_HOSTS_FILE"
if ! git clone "$PANTHEON_GIT_URL" "$WORK_DIR/repository"; then
	echo ""
	echo "Could not clone the Pantheon repository." >&2
	echo "Make sure this computer's SSH public key is added to Pantheon for the target site." >&2
	echo "If you generated a dedicated key, rerun with PANTHEON_SSH_KEY=/path/to/private/key." >&2
	echo "Pantheon Git URL: $PANTHEON_GIT_URL" >&2
	exit 2
fi

cd "$WORK_DIR/repository"

echo "Copying custom theme and plugin..."
mkdir -p wp-content/themes wp-content/plugins
rm -rf wp-content/themes/azure-synthetics
rm -rf wp-content/plugins/azure-synthetics-core
rm -rf wp-content/plugins/woocommerce
cp -R "$BUNDLE_DIR/wp-content/themes/azure-synthetics" wp-content/themes/
cp -R "$BUNDLE_DIR/wp-content/plugins/azure-synthetics-core" wp-content/plugins/

if [[ -d "$BUNDLE_DIR/wp-content/mu-plugins" ]]; then
	mkdir -p wp-content/mu-plugins
	cp -R "$BUNDLE_DIR/wp-content/mu-plugins/." wp-content/mu-plugins/
fi

mkdir -p scripts
cp "$REPO_ROOT/scripts/wp-seed.php" scripts/wp-seed.php

if [[ -d "$BUNDLE_DIR/wp-content/plugins/woocommerce" ]]; then
	cp -R "$BUNDLE_DIR/wp-content/plugins/woocommerce" wp-content/plugins/
else
	echo "Downloading WooCommerce $WOOCOMMERCE_VERSION..."
	curl -fsSL "https://downloads.wordpress.org/plugin/woocommerce.${WOOCOMMERCE_VERSION}.zip" -o "$WORK_DIR/woocommerce.zip"
	unzip -q "$WORK_DIR/woocommerce.zip" -d "$WORK_DIR"
	cp -R "$WORK_DIR/woocommerce" wp-content/plugins/
fi

if [[ -z "$(git config user.name || true)" ]]; then
	git config user.name "Azure Synthetics Deploy"
fi

if [[ -z "$(git config user.email || true)" ]]; then
	git config user.email "deploy@azuresynthetics.local"
fi

DEPLOY_PATHS=(
	wp-content/themes/azure-synthetics
	wp-content/plugins/azure-synthetics-core
	wp-content/plugins/woocommerce
	scripts/wp-seed.php
)

if [[ -d wp-content/mu-plugins ]]; then
	DEPLOY_PATHS+=(wp-content/mu-plugins)
fi

if [[ -z "$(git status --porcelain -- "${DEPLOY_PATHS[@]}")" ]]; then
	echo "No code changes to deploy."
else
	git add "${DEPLOY_PATHS[@]}"
	git commit -m "$COMMIT_MESSAGE"
	git push origin "HEAD:$PANTHEON_BRANCH"
	echo "Code pushed to Pantheon branch: $PANTHEON_BRANCH"
fi

echo ""
echo "Next: import this database export in the Pantheon dashboard:"
echo "$BUNDLE_DIR/azure_synthetics_full_migration.sql"
