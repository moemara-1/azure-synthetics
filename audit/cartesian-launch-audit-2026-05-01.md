# Azure Synthetics Cartesian Launch Audit

Date: 2026-05-01

Launch status: **blocked**

Scope: live `https://azuresynthetics.com`, local repo implementation, WordPress theme, core plugin, seeder, product media fallback, translation layer, checkout compliance, domain/TLS/hosting headers, desktop HTTP/API checks, iPhone simulator mobile checks, English and Arabic paths.

Evidence rule: every surface started as rotten. Items below are marked proven only where backed by a live HTTP/API response, remote WP-CLI output, local code reference, simulator screenshot, or reproducible test result. Live commerce checks stopped at browse/cart/checkout readiness. No real order, payment, deletion, or live settings change was performed.

## Executive Summary

The storefront is visually much closer to launch quality than it was: the live site resolves on the domain with TLS, the homepage hero is deployed, mobile navigation works in the iPhone simulator, Arabic RTL renders, and the public Woo Store API exposes all 43 catalog products as variable products with prices and images.

The store is still **not launch-ready** because the commerce path is broken at the operational layer:

- Woo variation JSON is empty for all sampled live product variations, which can misbind amount/pack-size selections.
- No payment gateway is enabled.
- Shipping methods are not configured, and the cart API reports no shipping need even while products are physical.
- Store and Woo email sender values are still `admin@example.com`.

Those are P0 blockers. Product imagery and hero polish matter, but they should not outrank fixing the order path.

## Audit Health Score

This is a UI/technical health score, not launch approval. Launch approval is blocked by P0 commerce findings.

| Area | Score | Notes |
| --- | ---: | --- |
| Accessibility | 2/4 | Focus styling and mobile nav behavior exist, but Arabic Woo aria labels remain English and the hamburger uses a label/checkbox pattern rather than a native button. |
| Performance | 2/4 | Core pages respond, but product PNGs are heavy and the product-media fallback strips responsive `srcset`/`sizes`. |
| Responsive/mobile | 3/4 | iPhone homepage, hamburger nav, and shop cards work. Mobile hero crop can be improved and checkout still needs final responsive proof after payment/shipping are configured. |
| Theming/design system | 3/4 | Premium clinical direction is mostly coherent. Remaining risk is image consistency and some hard-coded Woo output. |
| Anti-pattern avoidance | 3/4 | Copy largely avoids wellness/dosing/treatment implications. Remaining issues are operational credibility, SEO metadata, and some AI/template feel in product media. |

Total: **13/20 technical UI health**, with **launch blocked** by P0 commerce and operations issues.

## Proven In This Pass

- Live `GET /`, `/shop/`, `/product/aicar/`, `/cart/`, `/my-account/`, `/faq/`, `/science/`, `/contact/`, `/research-use-policy/`, `/wp-json/wc/store/v1/products`, `/wp-sitemap.xml`, and `/robots.txt` return `200`.
- Live `/compliance/` returns `404`.
- Live `HEAD /` returns `200` on `nginx/1.24.0 (Ubuntu)`.
- TLS certificate is valid for `azuresynthetics.com`, issued by Let's Encrypt E8, valid from `May 1 12:55:40 2026 GMT` through `Jul 30 12:55:39 2026 GMT`.
- Woo Store API reports 43 products, all `variable`, all with prices, all with images, and currency `EUR`.
- Live home was updated to the new full-bleed generated hero image; local and live desktop hero hashes matched after deploy.
- Live Arabic shop returns `lang="ar" dir="rtl"`, sets `azure_lang=ar`, and renders Arabic visible button text.
- iPhone simulator evidence exists:
  - `audit/evidence/mobile-home-live-2026-05-01.jpg`
  - `audit/evidence/mobile-nav-live-2026-05-01.jpg`
  - `audit/evidence/mobile-shop-card-live-2026-05-01.jpg`
- Remote active plugins are `azure-synthetics-core`, `redis-cache`, and `woocommerce`.
- Checkout acknowledgment code exists for block checkout, classic checkout, order admin, and emails.

## Verification Limits

- Headless desktop Chrome aborts under the Codex macOS app environment with exit `134`; desktop screenshots were not captured in that path.
- iOS simulator Safari initially resumed an old Pantheon sandbox tab, then was manually driven to `https://azuresynthetics.com/`.
- The audit used a disposable cart cookie for browse/cart/checkout probing and did not create a real order.
- Payment, shipping, tax, SMTP, fraud, fulfillment, and real order emails remain unverified because live configuration is not ready.

## Surface Matrix

| Surface | Status | Evidence | Main Risk |
| --- | --- | --- | --- |
| Home | Proven with caveat | Live 200, deployed hero, mobile screenshot | Mobile crop can improve; SEO metadata thin. |
| Shop | Proven with caveat | Live 200, mobile shop screenshot, Store API 43 products | Variation data and heavy images. |
| Category/search archives | Partial | Category taxonomy exists and search URL 200 from earlier pass | Desktop visual archive proof still limited. |
| Product cards | Partial | Mobile screenshot; product buttons centered | Product media consistency and ARIA localization. |
| Product pages | Rotten until fixed | AICAR variation JSON has empty attributes | Selection can bind incorrectly. |
| Variation selection | Rotten | All 43 products checked had empty variation attributes | Wrong SKU/price/order risk. |
| Cart | Rotten until fixed | Disposable cart accepted AICAR, but Store API reports `needs_shipping:false` | Shipping/payment readiness unreliable. |
| Checkout | Rotten | Checkout page reachable with cart, but payment methods array empty | Cannot take paid orders. |
| Account | Basic 200 | `/my-account/` returns 200 | Needs final auth/email/payment path proof. |
| FAQ/science/contact | Basic 200 | All return 200 | Copy and metadata still need launch polish. |
| Compliance | Partial | Research-use policy 200, `/compliance/` 404 | Compliance URL gap and disabled catalog gate decision. |
| Header/nav/footer | Mostly proven | iPhone nav screenshot, header logo transparent on mobile | Hamburger semantics and final desktop parity checks. |
| Language switcher | Partial | Arabic query/cookie works | ARIA/compliance script not fully localized; URL strategy weak. |
| Emails/admin settings | Rotten | `admin@example.com` sender values | Order notifications and trust fail. |
| Product media | Partial | 43 images present | Heavy PNGs, no responsive srcset, quality consistency. |
| Catalog seeding | Rotten for variations | Local seeder uses display attribute names for variations | Must normalize and reseed. |
| Hosting/caching/domain | Partial | DNS/TLS/live 200, Redis active | Missing security headers; deployment/cache docs need hardening. |

## P0 Findings

### P0-1: Product variations are published with empty option attributes

Affected surface: product pages, variation selection, cart accuracy, catalog seeding.

Evidence: live `/product/aicar/` renders `data-product_variations` with variation IDs `479` and `480`, SKUs `AZ-AICAR-50MG-VIAL` and `AZ-AICAR-50MG-BOX`, but both have `attributes: {"attribute_amount":"","attribute_pack-size":""}`. The all-product check found 43/43 products with empty variation attributes. Local code shows product attributes created from display names in `scripts/wp-seed.php:191`-`204`; variation attributes are passed directly at `scripts/wp-seed.php:298`; definitions use `Amount` and `Pack Size` at `scripts/wp-seed.php:653`-`655`.

Impact: Buyers can see amount and pack-size selectors, but WooCommerce cannot reliably bind the selected amount/pack size to the correct variation. This can produce wrong SKUs, wrong prices, failed add-to-cart behavior, or box orders entering as vial orders.

Exact recommended fix: normalize variation attributes to Woo custom-attribute slugs before saving. The saved variation attributes should be `amount => "50mg"` and `pack-size => "1 vial"` or `pack-size => "Box (5 vials)"`, matching the rendered select names `attribute_amount` and `attribute_pack-size`. Add an assertion in the seeder that every generated variation has non-empty saved attributes after `save()`. Reseed live products and clear Woo product transients.

Verification step: fetch `/product/aicar/`, `/product/retatrutide/`, `/product/tirzepatide/`, and three random products. Assert every variation JSON object has non-empty `attribute_amount` and `attribute_pack-size`. Add one vial and one box variation to cart and confirm displayed SKU, price, and selected options match.

Owner area: seeder / WooCommerce admin.

### P0-2: No payment gateway is enabled

Affected surface: checkout, order placement, revenue capture.

Evidence: remote WP-CLI payment gateway list returns `bacs`, `cheque`, and `cod`, all with `"enabled":false`. The cart Store API response for the disposable cart returned `"payment_methods":[]`.

Impact: Buyers cannot complete a paid order. This is a hard revenue blocker.

Exact recommended fix: choose and configure a payment path that is acceptable for research peptide products. For fastest compliant launch, enable manual bank/wire transfer with clear B2B instructions and manual order review. For cards, confirm processor acceptance before connecting keys. Do not enable vague cash/check defaults with placeholder instructions.

Verification step: in staging or a controlled test mode, complete checkout through the chosen gateway and confirm Woo order status, payment metadata, admin notification, customer confirmation, research-use acknowledgment, and fulfillment notes.

Owner area: WooCommerce admin / operations.

### P0-3: Shipping and fulfillment path is not configured and cart shipping state is inconsistent

Affected surface: cart, checkout, fulfillment, US/Egypt shipping readiness.

Evidence: remote WP options show `woocommerce_calc_shipping = yes`. Shipping zone list contains only `Locations not covered by your other zones` and no configured methods. Remote product check shows AICAR parent `186` and variation `479` are physical: `virtual=no needs_shipping=yes`. The disposable cart Store API response for that AICAR line returned `items_count:1`, `needs_shipping:false`, `shipping_rates:0`, and `payment_methods:[]`.

Impact: Physical-product checkout cannot be trusted. Buyers may be blocked, charged without correct fulfillment terms, or routed through an order that does not collect/price shipping correctly.

Exact recommended fix: configure launch shipping deliberately. Minimum viable setup: US zone, Egypt zone, and Rest of World disabled or quote-only. Add methods/rates, delivery windows, cold-chain handling language, and unsupported-destination copy. Then investigate why Store API reports `needs_shipping:false` for a physical product cart.

Verification step: with a test cart, enter one US address and one Egypt address and confirm shipping methods/rates appear. Enter an unsupported country and confirm checkout blocks clearly. Confirm Store API cart reports `needs_shipping:true` for physical products.

Owner area: WooCommerce admin / operations / hosting if cache affects Store API.

### P0-4: Store/admin email is still placeholder

Affected surface: order notifications, customer trust, fulfillment operations.

Evidence: remote WP options return `admin_email = admin@example.com` and `woocommerce_email_from_address = admin@example.com`.

Impact: Order notifications can go nowhere, customers can receive untrustworthy sender details, and fulfillment/compliance follow-up can fail.

Exact recommended fix: set the WordPress admin email and WooCommerce From address/name to real domain mailboxes. Suggested baseline: `orders@azuresynthetics.com` for transactional mail and a monitored team inbox for admin copies. Configure SMTP or transactional email with SPF, DKIM, and DMARC.

Verification step: send WooCommerce test email and place a staging order. Confirm customer/admin emails are received, branded, signed by the domain, and include the research-use disclaimer.

Owner area: WooCommerce admin / operations / DNS.

## P1 Findings

### P1-1: `/compliance/` is a 404 while compliance content exists elsewhere

Affected surface: compliance, footer/header trust, SEO.

Evidence: live `/compliance/` returned `404`; `/research-use-policy/` returned `200`.

Impact: Any buyer, crawler, sales deck, or future link expecting a clean compliance page hits a dead route. For a research-use storefront, this weakens trust.

Exact recommended fix: create a `/compliance/` page that summarizes research-use limitations, documentation, shipping/returns, and storage/handling boundaries, or add a permanent redirect to `/research-use-policy/`.

Verification step: `GET /compliance/` returns `200` or `301` to `/research-use-policy/`; footer/header links resolve cleanly in English and Arabic.

Owner area: content / theme.

### P1-2: Currency is EUR despite US + Egypt target markets

Affected surface: shop, product cards, product pages, cart, checkout, emails.

Evidence: Store API product response returns `"currency_code":"EUR"` and mobile shop screenshot shows euro pricing.

Impact: US and Egypt buyers may hesitate or abandon if prices appear European without explanation. It also complicates payment processing, tax, shipping, and order reconciliation.

Exact recommended fix: decide the commercial currency strategy before launch. If US-first, switch Woo base currency to USD. If international, add a multi-currency layer and clear settlement copy. For Egypt, decide whether checkout is USD/EUR and how invoices/payment instructions handle local buyers.

Verification step: product cards, product pages, cart, checkout, order emails, and admin orders display the intended currency for US and Egypt scenarios.

Owner area: WooCommerce admin / operations.

### P1-3: Arabic visible text works, but Woo accessibility labels remain English

Affected surface: Arabic shop archives, product cards, accessibility, RTL parity.

Evidence: live `/shop/?lang=ar` returns `lang="ar" dir="rtl"` and visible Arabic button text, but the same HTML contains 32 occurrences of `aria-label="Select options...`.

Impact: Arabic screen-reader users receive mixed-language controls. This is an accessibility and localization parity miss.

Exact recommended fix: filter Woo loop add-to-cart output in Arabic mode and translate `aria-label`, hidden screen-reader text, and related control labels. Prefer a Woo filter if available in the installed WooCommerce version; otherwise post-process the link attributes in the theme wrapper.

Verification step: fetch `/shop/?lang=ar` and assert no English `aria-label="Select options` remains. Run a screen-reader pass over Arabic product cards.

Owner area: theme.

### P1-4: Compliance JavaScript/default text is English in Arabic mode

Affected surface: Arabic compliance, catalog gate, checkout/support parity.

Evidence: Arabic pages correctly render RTL visible content, but the localized `azureSyntheticsCompliance` script payload still includes the English default disclaimer string `For research use only...` from the compliance default layer.

Impact: If the catalog gate or any JS-driven compliance UI is enabled, Arabic users can receive English compliance text. That is a legal/trust parity risk for Egypt.

Exact recommended fix: route all compliance strings through the theme/plugin i18n layer, including JS-localized strings. Add Arabic values for footer disclaimer, product disclaimer, shipping note, checkout acknowledgment, and catalog gate copy.

Verification step: inspect Arabic page source and confirm JS compliance strings are Arabic; enable the catalog gate in staging and verify Arabic gate copy.

Owner area: plugin / theme.

### P1-5: SEO/social metadata is too thin

Affected surface: home, product pages, category pages, Arabic pages, search/social previews.

Evidence: sampled live pages expose canonical links, but not robust meta descriptions, Open Graph tags, Twitter card tags, or head-level alternate hreflang tags.

Impact: Search snippets and shared product links will look generic. Arabic and English versions also lack stronger index signals for their target markets.

Exact recommended fix: add a minimal SEO layer in the theme or configure a known SEO plugin. Generate Arabic-aware and English-aware descriptions for home, shop, categories, and product pages. Add OG/Twitter title/description/image and head-level `rel="alternate"` hreflang tags.

Verification step: inspect home, shop, one category, and three product pages in both languages for description, OG, Twitter, canonical, and hreflang tags. Validate with a social card debugger.

Owner area: theme / content.

### P1-6: Security headers are missing

Affected surface: hosting/security/browser hardening.

Evidence: live `HEAD /` shows `Server: nginx/1.24.0 (Ubuntu)` and WordPress links, but no `Strict-Transport-Security`, `X-Content-Type-Options`, `Referrer-Policy`, `Permissions-Policy`, `X-Frame-Options`, or CSP `frame-ancestors`.

Impact: Checkout/account pages have weaker browser-side protection than expected for ecommerce.

Exact recommended fix: add conservative Nginx headers: HSTS after confirming HTTPS-only, `X-Content-Type-Options: nosniff`, `Referrer-Policy: strict-origin-when-cross-origin`, `X-Frame-Options: SAMEORIGIN` or CSP `frame-ancestors 'self'`, and a measured `Permissions-Policy`. Defer strict script CSP until inline scripts are inventoried.

Verification step: `curl -I https://azuresynthetics.com/` and key Woo pages show the new headers; cart, checkout, language switcher, and admin remain functional.

Owner area: hosting.

### P1-7: Support identity looks incomplete for a US + Egypt launch

Affected surface: contact, footer, schema, customer trust, operations.

Evidence: live site has domain email direction in the design, but remote WordPress/Woo sender values are placeholders. Earlier schema/content review showed a Germany-style support phone, while the stated launch markets are US and Egypt.

Impact: Buyers may not trust the store, and post-order support can fail if contact channels are placeholder or regionally confusing.

Exact recommended fix: define real support channels before launch: order inbox, support inbox, WhatsApp/phone if used for Egypt, business address policy, response-time promise, and B2B documentation process. Align footer, contact page, schema, email sender, and order emails.

Verification step: footer, contact page, schema markup, Woo email sender, and test order emails all show the same real support identity.

Owner area: operations / content / WooCommerce admin.

## P2 Findings

### P2-1: Product image delivery is heavy and not responsive

Affected surface: product cards, product pages, shop performance, mobile bandwidth.

Evidence: product assets are PNGs, many around 1 MB. The product media fallback explicitly removes `srcset` and `sizes` at `wp-content/themes/azure-synthetics/inc/product-media.php:175`.

Impact: Mobile category/shop pages transfer more bytes than needed and cannot use smaller responsive images. This hurts speed and perceived polish.

Exact recommended fix: generate WebP/JPEG derivatives for card, single-product, and thumbnail sizes. Preserve fallback image correctness, but emit responsive `srcset`/`sizes` for theme-managed images instead of stripping them.

Verification step: mobile shop loads card-sized WebP/JPEG derivatives; Lighthouse or WebPageTest shows lower image transfer; no product image URL 404s.

Owner area: theme / media pipeline.

### P2-2: Product image art direction is present but not yet premium enough across all 43 products

Affected surface: product cards, product pages, conversion trust.

Evidence: mobile shop evidence shows coherent product cards, but current product image generation is template/composite driven. User-provided screenshots showed labels sometimes appearing pasted-on or less realistic than the best BPC-157 + TB-500 style image.

Impact: The catalog can feel partially AI-generated or templated, which undercuts premium/lab credibility.

Exact recommended fix: after P0 commerce blockers, run a dedicated media pass with one proven product-shot style: realistic glass curvature, natural label wrap/shadow, consistent cap/light reflections, no tiny fake text, and product-specific amount text that remains legible at card size. Generate a contact sheet for approval before replacing all 43.

Verification step: compare all 43 product images in a contact sheet plus desktop/mobile shop screenshots. Reject any image where the label looks flat, pasted, warped incorrectly, or unreadable.

Owner area: media pipeline / content.

### P2-3: Email branding code exists but the end-to-end email path is unproven

Affected surface: order emails, fulfillment, customer support.

Evidence: plugin code appends compliance text in `wp-content/plugins/azure-synthetics-core/includes/class-email-branding.php`, and checkout code stores/emails acknowledgment metadata. Live sender settings remain placeholders and no payment/shipping path is configured.

Impact: The code path is promising, but actual order communications are untrusted until SMTP, sender identity, payment, and shipping are configured.

Exact recommended fix: after fixing sender settings, place a staging order and inspect new order, processing, completed, and customer invoice emails for branding, disclaimer, product variation, SKU, shipping method, and lot/CoA notes.

Verification step: archived test emails show correct sender, branding, disclaimer, item SKU/variation, shipping method, and admin receipt.

Owner area: operations / WooCommerce admin.

### P2-4: Language persistence is query/cookie based, not URL-structured

Affected surface: Arabic SEO, analytics, sharing, cache behavior.

Evidence: language switcher uses `?lang=ar`; Arabic mode sets `azure_lang=ar`; links preserve language by query/cookie behavior in the theme i18n layer.

Impact: It works for users, but `/ar/...` URLs would be stronger for SEO, analytics, sharing, and caching. Shared links can lose language state if the query string is removed.

Exact recommended fix: for immediate launch, keep the current approach but add head-level hreflang and canonical rules. For a stronger version, migrate Arabic to `/ar/` routes through WordPress rewrites or a multilingual plugin.

Verification step: Arabic home -> shop -> product -> cart preserves language, and search engines see correct alternate tags.

Owner area: theme / SEO.

### P2-5: Catalog gate is disabled by default

Affected surface: compliance UX, first-visit consent.

Evidence: compliance defaults set `catalog_gate_enabled => false` in `wp-content/plugins/azure-synthetics-core/includes/class-compliance.php:34`.

Impact: The store relies on footer/product/checkout disclaimers only. This may be fine, but for research-use peptides, a restrained first-visit acknowledgment could reduce accidental consumer browsing.

Exact recommended fix: make an explicit business/legal decision. If enabled, build the gate as a one-time, accessible acknowledgment with no wellness language and no SEO-breaking crawler block.

Verification step: fresh visitor sees one compliant acknowledgment; returning visitor does not; product/cart/checkout and Arabic mode remain usable.

Owner area: compliance / theme.

### P2-6: Mobile hero is usable but the product competes with headline space

Affected surface: mobile home hero.

Evidence: `audit/evidence/mobile-home-live-2026-05-01.jpg` shows readable copy and CTA, but the vial sits behind the right side of the hero text area.

Impact: Not broken, but the crop can look less premium than the intended luxury/clinical direction.

Exact recommended fix: create a mobile-specific generated crop with more calm dark space behind the headline and the vial lower/right, or tune mobile `object-position` plus overlay. Keep next-section hint visible.

Verification step: iPhone screenshot shows full headline, CTA, proof chips, product, and next-section hint with no visual competition.

Owner area: media / theme.

### P2-7: Mobile nav works, but the toggle pattern is less semantic than ideal

Affected surface: header/nav accessibility, mobile interaction.

Evidence: iPhone simulator screenshot proves the hamburger menu opens and links are visible. Local header uses a hidden checkbox plus label with `role="button"` and ARIA attributes, while `assets/js/navigation.js` handles open/close, Escape, scrim, and touch navigation.

Impact: The current implementation is workable, but a native `<button>` is more robust for assistive tech and state management.

Exact recommended fix: replace the label/checkbox toggle with a real button controlling a menu container, preserving current styling, Escape handling, scrim close, and language switcher placement.

Verification step: keyboard, screen-reader, touch, Escape, outside-click, and link-click behavior all work on desktop and iPhone.

Owner area: theme.

### P2-8: XML-RPC discovery is exposed

Affected surface: security hardening.

Evidence: sampled page head includes WordPress discovery links such as `xmlrpc.php?rsd`.

Impact: This is common WordPress behavior, but it increases noise and attack surface if XML-RPC is not needed.

Exact recommended fix: disable XML-RPC if no integration requires it, and remove RSD/wlwmanifest discovery links from the head.

Verification step: `POST /xmlrpc.php` is blocked or disabled as intended; page head no longer exposes RSD if not needed.

Owner area: hosting / theme.

## P3 Findings

### P3-1: Desktop visual screenshot evidence should be re-run outside the crashing Chrome path

Affected surface: desktop QA evidence.

Evidence: headless desktop Chrome aborts in this Codex macOS app environment with exit `134`, while HTTP/API and iPhone simulator checks completed.

Impact: The desktop site likely works, but the evidence set is not as strong as it should be for a launch audit.

Exact recommended fix: run desktop browser screenshots through Safari, a stable Chrome profile, Playwright on the Hetzner server, or another non-crashing browser environment.

Verification step: save desktop home, shop, product, cart, checkout, Arabic home, and Arabic shop screenshots into `audit/evidence/`.

Owner area: QA / theme.

### P3-2: Product media polish should continue after commerce blockers

Affected surface: premium perception, product cards, product pages.

Evidence: product images exist for all 43 products and mobile cards are coherent, but user feedback still flags label realism and hero/product image premium quality.

Impact: The store can sell once P0s are fixed, but image polish will raise trust and conversion.

Exact recommended fix: after fixing variation/payment/shipping/email blockers, do a product-media sprint: generate the best-image style for all 43 products, compress responsive derivatives, and compare against the current catalog in a contact-sheet review.

Verification step: all product cards look consistent on desktop and iPhone; labels are integrated naturally; no obvious AI artifacts or fake lab graphics remain.

Owner area: media pipeline / content.

### P3-3: Deployment and cache runbook should be formalized

Affected surface: hosting/caching/deploy reliability.

Evidence: live deployment used direct SSH/rsync plus WordPress cache flushing; Redis cache plugin is active.

Impact: Manual deploys are workable now but can drift as the store grows.

Exact recommended fix: document deploy commands, cache flush steps, backup/rollback steps, and the difference between local, migration bundle, and live theme paths. Add a pre-launch checklist for product reseed, media generation, cache flush, and smoke tests.

Verification step: a second operator can deploy a change and roll it back using only the runbook.

Owner area: hosting / operations.

## Recommended Fix Order

1. Fix seeder variation attributes and reseed live products.
2. Configure real store/admin email and SMTP/domain authentication.
3. Configure shipping zones/methods and resolve the cart `needs_shipping:false` inconsistency.
4. Configure at least one compliant payment method.
5. Run a full buy-path test in staging: English and Arabic home -> shop -> product -> choose variation -> cart -> checkout acknowledgment -> payment/shipping proof.
6. Add SEO/social metadata, Arabic accessibility label fixes, and compliance route fix.
7. Add security headers and XML-RPC hardening.
8. Run image performance and product-media polish.
9. Capture final desktop/mobile evidence and create a launch signoff snapshot.

## Evidence Commands

Useful commands from this pass:

```sh
node -e '/* fetched https://azuresynthetics.com/wp-json/wc/store/v1/products?per_page=100 and summarized count/type/currency/images */'
curl -I https://azuresynthetics.com/
curl -L -s -o /dev/null -w '%{http_code}' https://azuresynthetics.com/compliance/
ssh -i ~/.ssh/azure_synthetics_codex_setup root@178.105.69.197 'cd /var/www/azuresynthetics/public && wp wc payment_gateway list --user=1 --allow-root --format=json'
ssh -i ~/.ssh/azure_synthetics_codex_setup root@178.105.69.197 'cd /var/www/azuresynthetics/public && wp wc shipping_zone list --user=1 --allow-root --format=json'
```
