# Assumptions

## Design coverage
- `WebsiteUII.pen` is the storefront source of truth and represents a single desktop home page.
- `Branding.pen` is treated as a supporting brand/packaging reference, not as a second storefront layout.
- No dedicated `.pen` screens were present for shop archives, category pages, single product pages, cart, checkout, account, search, contact, compliance pages, or 404.

## Responsive behavior
- Mobile and tablet layouts were inferred from the desktop composition and the existing spacing/radius system.
- Archive grids collapse from 4-up on desktop to 2-up on tablet and 1-up on phone.
- Product pages collapse to a single column on tablet/phone, with gallery first and purchase panel second.
- Shop filters use an off-canvas sidebar on smaller screens because the `.pen` file did not provide a mobile filter behavior.

## States and interactions
- Hover/focus/disabled/loading/empty/error states were derived from the existing palette and card system because the `.pen` file did not include explicit state boards.
- FAQ rows, product FAQs, and mobile navigation use minimal custom JavaScript rather than brittle WooCommerce DOM manipulation.

## WooCommerce implementation
- Cart and checkout are block-first. The setup script seeds `<!-- wp:woocommerce/cart /-->` and `<!-- wp:woocommerce/checkout /-->` pages instead of relying on classic shortcode flows.
- The required checkout acknowledgment is implemented with the WooCommerce additional checkout fields API for block checkout and a shortcode fallback for classic checkout.
- Product detail merchandising uses a custom single-product template while still calling WooCommerce-native image and add-to-cart functions.

## Data model
- Filterable purchase options like vial size and pack size are expected to live in WooCommerce attributes and/or variations.
- Descriptive technical fields such as storage, purity, shipping warning, batch reference, and research disclaimer are stored as product meta managed by `azure-synthetics-core`.

## Seed content and media
- The launch flow seeds demo products, categories, menus, and pages so the site is immediately explorable after bootstrap.
- The theme uses image assets copied from the provided workspace. These are starter/demo assets and should be replaced with final optimized production photography before launch.
