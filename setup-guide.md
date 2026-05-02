# Setup Guide

## Requirements
- Docker Desktop
- PowerShell

## Install and launch
1. Open PowerShell in the repository root:
   ```powershell
   cd C:\Users\User\Documents\AzureSynthetics
   ```
2. Run the bootstrap script:
   ```powershell
   powershell -ExecutionPolicy Bypass -File .\scripts\launch.ps1
   ```
3. Wait until the script prints:
   - `Storefront: http://localhost:8080`
   - `Admin: http://localhost:8080/wp-admin`
   - `Username: admin`
   - `Password: admin123!`

## What the launch script does
- Starts MariaDB and WordPress with Docker Compose.
- Installs WordPress if it is not already installed.
- Installs and activates WooCommerce.
- Activates the `azure-synthetics` theme.
- Activates the `azure-synthetics-core` companion plugin.
- Creates Home, Shop, Cart, Checkout, My Account, Science, FAQ, Contact, and Research Use Policy pages.
- Seeds categories, menus, and sample products.

## Theme and plugin locations
- Theme: `wp-content/themes/azure-synthetics`
- Companion plugin: `wp-content/plugins/azure-synthetics-core`

## WooCommerce settings to confirm
- `WooCommerce → Settings → Advanced`
  - Cart page = `Cart`
  - Checkout page = `Checkout`
  - My account page = `My Account`
  - Terms and conditions page = `Research Use Policy`
- `WooCommerce → Settings → Products`
  - Catalog behavior should remain default unless you want different sorting/filter behavior.
- `WooCommerce → Settings → Emails`
  - Review sender name/address and send a test order email.
- `WooCommerce → Azure Synthetics`
  - Edit disclaimer copy, shipping note, checkout acknowledgment text, and optional catalog gate behavior.

## Menus and pages
- The launch script seeds a primary menu and assigns it to both registered menu locations.
- To replace the menu manually: `Appearance → Menus`.
- Science, FAQ, Contact, and Research Use Policy pages use the included page templates:
  - `Science`
  - `FAQ`
  - `Contact`
  - `Compliance`

## Rebuilding or stopping
- Stop the containers:
  ```powershell
  docker compose down
  ```
- Stop and remove database/WordPress volumes for a clean reset:
  ```powershell
  docker compose down -v
  ```

## Deploying to Pantheon from macOS/Linux
1. Create a dedicated SSH key if this computer does not already have one:
   ```sh
   ssh-keygen -t rsa -b 4096 -C "pantheon-azure-synthetics" -f ~/.ssh/pantheon_azure_synthetics
   pbcopy < ~/.ssh/pantheon_azure_synthetics.pub
   ```
2. Add the copied public key to the target Pantheon site/user.
3. From the repository root, run:
   ```sh
   PANTHEON_SSH_KEY=~/.ssh/pantheon_azure_synthetics ./scripts/deploy-to-pantheon.sh
   ```
   If Pantheon already trusts your default SSH key, this also works:
   ```sh
   ./scripts/deploy-to-pantheon.sh
   ```
4. Import the Pantheon-clean database export in Pantheon:
   ```text
   migration_bundle/azure_synthetics_pantheon_import.sql.gz
   ```
5. After the import, replace the temporary tunnel URL in the database:
   ```text
   https://azure-synthetics.loca.lt
   ```
   with the Pantheon environment URL or final production domain.

## Deploying to Pantheon from Windows
1. Add this computer's SSH public key to the target Pantheon site/user.
2. From the repository root, run:
   ```powershell
   powershell -ExecutionPolicy Bypass -File .\scripts\deploy-to-pantheon.ps1
   ```
3. Import the database export in Pantheon:
   ```text
   migration_bundle/azure_synthetics_full_migration.sql
   ```
4. After the import, replace the temporary tunnel URL in the database:
   ```text
   https://azure-synthetics.loca.lt
   ```
   with the Pantheon environment URL or final production domain.

## Recommended plugins
- Required:
  - WooCommerce
- Optional but recommended:
  - SEO plugin of your choice for metadata management
  - WooCommerce payment gateway plugin compatible with your processor
  - Layered nav/filter plugin if you want richer archive filtering than the base category sidebar

## Hetzner launch operations
The live Hetzner WordPress root is:

```sh
/var/www/azuresynthetics/public
```

Before changing live product or WooCommerce settings, create a database backup:

```sh
ssh -i ~/.ssh/azure_synthetics_codex_setup root@178.105.69.197 \
  'cd /var/www/azuresynthetics/public && mkdir -p /var/backups/azuresynthetics && wp db export /var/backups/azuresynthetics/pre-change-$(date +%Y%m%d-%H%M%S).sql --allow-root'
```

Deploy theme/plugin code from the repository root:

```sh
rsync -az --delete -e "ssh -i ~/.ssh/azure_synthetics_codex_setup" \
  wp-content/themes/azure-synthetics/ \
  root@178.105.69.197:/var/www/azuresynthetics/public/wp-content/themes/azure-synthetics/

rsync -az --delete -e "ssh -i ~/.ssh/azure_synthetics_codex_setup" \
  wp-content/plugins/azure-synthetics-core/ \
  root@178.105.69.197:/var/www/azuresynthetics/public/wp-content/plugins/azure-synthetics-core/
```

Deploy and run the catalog/launch scripts:

```sh
rsync -az -e "ssh -i ~/.ssh/azure_synthetics_codex_setup" \
  scripts/wp-seed.php scripts/wp-configure-launch.php \
  root@178.105.69.197:/var/www/azuresynthetics/scripts/

ssh -i ~/.ssh/azure_synthetics_codex_setup root@178.105.69.197 \
  'cd /var/www/azuresynthetics/public && wp eval-file /var/www/azuresynthetics/scripts/wp-seed.php --allow-root'

ssh -i ~/.ssh/azure_synthetics_codex_setup root@178.105.69.197 \
  'cd /var/www/azuresynthetics/public && wp eval-file /var/www/azuresynthetics/scripts/wp-configure-launch.php --allow-root && wp cache flush --allow-root'
```

The launch config script sets:
- Store/admin sender defaults to `orders@azuresynthetics.com`.
- Store currency to USD.
- Manual invoice review as the enabled checkout payment method.
- US and Egypt shipping zones with `Shipping quoted after review`.
- Rest-of-world shipping with `International shipping quoted after review`.

Live server jobs already configured:
- `/etc/cron.d/azure-wp-cron` runs due WP-Cron events every 5 minutes.
- `/etc/cron.d/azure-synthetics-backup` runs the daily backup script.

Final launch dependency:
- Configure real transactional email delivery. The server currently has no `/usr/sbin/sendmail`, so WooCommerce can save sender settings but cannot reliably send order emails until SMTP, a transactional provider, or an MTA is configured.

Minimum live smoke checks:

```sh
curl -I https://azuresynthetics.com/
curl -L -s -o /dev/null -w '%{http_code}\n' https://azuresynthetics.com/compliance/
curl -s https://azuresynthetics.com/wp-json/wc/store/v1/products?per_page=100
```
