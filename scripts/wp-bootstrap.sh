#!/bin/sh
set -eu

SITE_URL="http://localhost:8080"
SITE_TITLE="Azure Synthetics"
ADMIN_USER="admin"
ADMIN_PASSWORD="admin123!"
ADMIN_EMAIL="admin@example.com"

until wp db check --allow-root >/dev/null 2>&1; do
  sleep 2
done

if ! wp core is-installed --allow-root >/dev/null 2>&1; then
  wp core install \
    --url="$SITE_URL" \
    --title="$SITE_TITLE" \
    --admin_user="$ADMIN_USER" \
    --admin_password="$ADMIN_PASSWORD" \
    --admin_email="$ADMIN_EMAIL" \
    --skip-email \
    --allow-root
fi

if ! wp plugin is-installed woocommerce --allow-root >/dev/null 2>&1; then
  wp plugin install woocommerce --activate --allow-root
else
  wp plugin activate woocommerce --allow-root >/dev/null 2>&1 || true
fi

if ! wp theme is-active azure-synthetics --allow-root >/dev/null 2>&1; then
  wp theme activate azure-synthetics --allow-root
fi

if ! wp plugin is-active azure-synthetics-core --allow-root >/dev/null 2>&1; then
  wp plugin activate azure-synthetics-core --allow-root
fi

wp option update blogname "$SITE_TITLE" --allow-root
wp option update blogdescription "Lab-grade research peptides with documentation and storage guidance" --allow-root
wp option update home "$SITE_URL" --allow-root
wp option update siteurl "$SITE_URL" --allow-root
wp option update permalink_structure "/%postname%/" --allow-root
wp rewrite flush --allow-root

wp eval-file /workspace/scripts/wp-seed.php --allow-root
