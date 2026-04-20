# QA Checklist

## Responsive
- Verify the homepage at roughly `390px`, `768px`, `1024px`, and `1440px`.
- Confirm mobile navigation opens/closes cleanly and traps no content off-screen.
- Confirm archive filter drawer opens on mobile and the catalog remains scrollable.
- Confirm single product pages collapse to one column without clipped gallery or add-to-cart controls.

## Catalog and product flow
- Confirm featured products render on the homepage.
- Confirm shop and category archives render result count, ordering, product cards, and the category sidebar.
- Confirm a simple product can be added to cart.
- Confirm a variable product requires option selection before add-to-cart.
- Confirm related products and upsells render beneath the product detail page.

## Cart and checkout
- Confirm the Cart block page loads and updates quantities correctly.
- Confirm coupon apply/remove works on the Cart page.
- Confirm the Checkout block page loads without broken styling.
- Confirm the required research-use acknowledgment checkbox blocks checkout until checked.
- Confirm payment areas remain WooCommerce-native and do not assume a specific gateway.

## Account
- Confirm registration/login works from My Account.
- Confirm order history, account details, and address screens inherit the theme styling.

## Compliance
- Confirm the footer disclaimer appears site-wide.
- Confirm the product-level research disclaimer appears on all seeded products.
- Confirm checkout acknowledgment text is editable in WooCommerce → Azure Synthetics.
- If catalog gate is enabled, confirm the acknowledgment overlay appears and can be dismissed once per browser.

## Emails
- Place a test order and verify the email header/footer styling is branded.
- Confirm the research disclaimer appears in customer emails.

## Gateway compatibility
- Activate at least one standard WooCommerce gateway and confirm checkout still renders correctly.
- Confirm no Stripe-specific copy or layout assumptions exist in checkout markup or styles.

## Content editing
- Edit a seeded product’s Azure research fields and confirm changes appear on the single-product page.
- Edit a seeded product FAQ and confirm the accordion updates.
- Edit footer disclaimer and shipping note settings and confirm the front end reflects the updates.
