# Content Map

## Compliance and disclaimer text
- Site-wide footer disclaimer:
  - `WooCommerce → Azure Synthetics → Footer disclaimer`
- Default product disclaimer fallback:
  - `WooCommerce → Azure Synthetics → Default product disclaimer`
- Default shipping note fallback:
  - `WooCommerce → Azure Synthetics → Default shipping note`
- Checkout acknowledgment checkbox label:
  - `WooCommerce → Azure Synthetics → Checkout acknowledgment label`
- Optional product-page catalog gate:
  - `WooCommerce → Azure Synthetics → Catalog gate scaffold`

## Product specifications
- Product subtitle:
  - Product edit screen → `Azure research data` → `Subtitle`
- Short lab descriptor:
  - Product edit screen → `Azure research data` → `Short lab descriptor`
- Purity %:
  - Product edit screen → `Azure research data` → `Purity %`
- Form factor:
  - Preferred: WooCommerce attributes/variations
  - Fallback display override: Product edit screen → `Azure research data` → `Form factor`
- Vial amount:
  - Preferred: WooCommerce attributes/variations
  - Fallback display override: Product edit screen → `Azure research data` → `Vial amount`
- Storage instructions:
  - Product edit screen → `Azure research data` → `Storage instructions`
- Shipping/storage warning:
  - Product edit screen → `Azure research data` → `Shipping/storage warning`
- Batch/testing reference:
  - Product edit screen → `Azure research data` → `Batch/testing reference`
- Reconstitution guidance:
  - Product edit screen → `Azure research data` → `Reconstitution guidance`
- Research disclaimer override:
  - Product edit screen → `Azure research data` → `Research disclaimer`
- Product FAQ accordion:
  - Product edit screen → `Product FAQ accordion`

## Marketing / editorial copy
- Homepage section copy:
  - `wp-content/themes/azure-synthetics/template-parts/sections/*.php`
  - Supporting arrays in `wp-content/themes/azure-synthetics/inc/content.php`
- Science page explainers:
  - `wp-content/themes/azure-synthetics/page-templates/template-science.php`
  - `azure_synthetics_get_science_explainers()` and `azure_synthetics_get_science_process_steps()` in `wp-content/themes/azure-synthetics/inc/content.php`
- Global contact details used in footer/contact page:
  - `wp-content/themes/azure-synthetics/inc/content.php`
- Search/404/page intros:
  - `wp-content/themes/azure-synthetics/inc/template-tags.php`

## Styling and design tokens
- Global color, spacing, and typography tokens:
  - `wp-content/themes/azure-synthetics/theme.json`
  - `wp-content/themes/azure-synthetics/assets/css/tokens.css`
- WooCommerce/classic styling:
  - `wp-content/themes/azure-synthetics/assets/css/woocommerce.css`
- WooCommerce block cart/checkout styling:
  - `wp-content/themes/azure-synthetics/assets/css/woocommerce-blocks.css`

## Email styling
- Visual email CSS:
  - `wp-content/themes/azure-synthetics/woocommerce/emails/email-styles.php`
- Email disclaimer/footer logic:
  - `wp-content/plugins/azure-synthetics-core/includes/class-email-branding.php`
  - `wp-content/plugins/azure-synthetics-core/includes/class-checkout.php`
