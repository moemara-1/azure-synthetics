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

## Recommended plugins
- Required:
  - WooCommerce
- Optional but recommended:
  - SEO plugin of your choice for metadata management
  - WooCommerce payment gateway plugin compatible with your processor
  - Layered nav/filter plugin if you want richer archive filtering than the base category sidebar
