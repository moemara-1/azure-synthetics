<?php
/**
 * Site header template.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$is_dark    = is_front_page() || is_singular( 'product' );
$cart_count = azure_synthetics_cart_count();
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="azure-compliance-strip">
	<div class="azure-shell">
		<p><?php echo esc_html( azure_synthetics_get_footer_disclaimer() ); ?></p>
	</div>
</div>
<header class="azure-site-header <?php echo $is_dark ? 'azure-site-header--dark' : 'azure-site-header--light'; ?>">
	<div class="azure-shell azure-site-header__inner">
		<?php $brand_url = function_exists( 'azure_synthetics_preserve_language_url' ) ? azure_synthetics_preserve_language_url( home_url( '/' ) ) : home_url( '/' ); ?>
		<a class="azure-brand" href="<?php echo esc_url( $brand_url ); ?>">
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/azure-logo-transparent.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>">
			<span class="azure-brand__copy">
				<span class="azure-brand__name"><?php bloginfo( 'name' ); ?></span>
				<span class="azure-brand__tag"><?php echo esc_html( azure_synthetics_get_site_tagline() ); ?></span>
			</span>
		</a>
		<button class="azure-nav-toggle" type="button" aria-expanded="false" aria-controls="site-navigation">
			<span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation', 'azure-synthetics' ); ?></span>
			<span></span><span></span>
		</button>
		<nav class="azure-site-nav" id="site-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'azure-synthetics' ); ?>">
			<?php
			azure_synthetics_render_navigation( 'primary', 'azure-menu' );
			?>
			<div class="azure-site-nav__actions">
				<?php azure_synthetics_render_language_switcher(); ?>
				<?php $account_url = function_exists( 'azure_synthetics_preserve_language_url' ) ? azure_synthetics_preserve_language_url( azure_synthetics_account_url() ) : azure_synthetics_account_url(); ?>
				<?php $cart_url = function_exists( 'azure_synthetics_preserve_language_url' ) ? azure_synthetics_preserve_language_url( azure_synthetics_cart_url() ) : azure_synthetics_cart_url(); ?>
				<a class="azure-site-nav__link" href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'Account', 'azure-synthetics' ); ?></a>
				<a class="azure-site-nav__cart" href="<?php echo esc_url( $cart_url ); ?>" aria-label="<?php echo esc_attr( sprintf( _n( 'View cart, %d item', 'View cart, %d items', $cart_count, 'azure-synthetics' ), $cart_count ) ); ?>" data-cart-count="<?php echo esc_attr( $cart_count ); ?>">
					<span class="azure-site-nav__cart-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" focusable="false">
							<path d="M8.25 9.25V8.5a3.75 3.75 0 0 1 7.5 0v.75" />
							<path d="M6.75 9.25h10.5a1 1 0 0 1 1 1l-.65 7.15a2.25 2.25 0 0 1-2.24 2.05H8.64A2.25 2.25 0 0 1 6.4 17.4l-.65-7.15a1 1 0 0 1 1-1Z" />
						</svg>
					</span>
					<span class="azure-site-nav__cart-count"><?php echo esc_html( $cart_count ); ?></span>
				</a>
			</div>
		</nav>
	</div>
</header>
<div class="azure-nav-scrim" aria-hidden="true"></div>
