$ErrorActionPreference = 'Stop'

$root = Split-Path -Parent $PSScriptRoot
$theme = Join-Path $root 'wp-content/themes/azure-synthetics'
$optimizationTheme = Join-Path $root 'wp-content/themes/azure-synthetics-optimization'
$plugin = Join-Path $root 'wp-content/plugins/azure-synthetics-core'

$header = Get-Content -LiteralPath (Join-Path $theme 'header.php') -Raw
$singleProduct = Get-Content -LiteralPath (Join-Path $theme 'woocommerce/content-single-product.php') -Raw
$optimizationHeader = Get-Content -LiteralPath (Join-Path $optimizationTheme 'header.php') -Raw
$optimizationSingleProduct = Get-Content -LiteralPath (Join-Path $optimizationTheme 'woocommerce/content-single-product.php') -Raw
$checkout = Get-Content -LiteralPath (Join-Path $plugin 'includes/class-checkout.php') -Raw
$gatewayCompat = Get-Content -LiteralPath (Join-Path $plugin 'includes/class-gateway-compat.php') -Raw

if ($singleProduct -notmatch 'wc_print_notices') {
    throw 'Single product template must render WooCommerce notices so add-to-cart feedback is visible.'
}

if ($singleProduct -notmatch 'azure-product-notices') {
    throw 'Single product notices must use the themed azure-product-notices wrapper.'
}

if ($header -notmatch 'azure-site-nav__account') {
    throw 'Header must expose a dedicated account icon link.'
}

if ($header -notmatch 'aria-label="<\?php echo esc_attr\( azure_synthetics_account_label\(\) \); \?>"') {
    throw 'Account icon link must have a dynamic accessible label.'
}

if ($optimizationSingleProduct -notmatch 'wc_print_notices') {
    throw 'Optimization product template must render WooCommerce notices so product-page add-to-cart feedback is visible.'
}

if ($optimizationSingleProduct -notmatch 'opt-product-notices') {
    throw 'Optimization product notices must use the themed opt-product-notices wrapper.'
}

if ($optimizationHeader -notmatch 'opt-account') {
    throw 'Optimization header must expose a dedicated account icon link.'
}

if ($optimizationHeader -notmatch 'aria-label="<\?php echo esc_attr\( azure_synthetics_account_label\(\) \); \?>"') {
    throw 'Optimization account icon link must have a dynamic accessible label.'
}

$requiredCheckoutSignals = @(
    'woocommerce_checkout_registration_required',
    'woocommerce_checkout_registration_enabled',
    'woocommerce_enable_guest_checkout',
    'woocommerce_enable_signup_and_login_from_checkout',
    'woocommerce_enable_myaccount_registration',
    'woocommerce_cart_redirect_after_add'
)

foreach ($signal in $requiredCheckoutSignals) {
    if ($checkout -notlike "*$signal*") {
        throw "Checkout/account support is missing required signal: $signal"
    }
}

if ($gatewayCompat -match 'woocommerce_review_order_before_payment') {
    throw 'Gateway placeholder must not render before payment methods while payment integration is pending.'
}

if ($gatewayCompat -match 'Payment methods remain WooCommerce-native') {
    throw 'Gateway placeholder copy must be removed while payment integration is pending.'
}

if ($gatewayCompat -notmatch 'woocommerce_available_payment_gateways') {
    throw 'Gateway compatibility must filter payment gateways.'
}

foreach ($manualGateway in @("'bacs'", "'cheque'", "'cod'")) {
    if ($gatewayCompat -notlike "*$manualGateway*") {
        throw "Manual gateway is not disabled: $manualGateway"
    }
}

Write-Host 'Commerce flow smoke checks passed.'
