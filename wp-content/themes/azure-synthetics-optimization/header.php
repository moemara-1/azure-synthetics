<?php
/**
 * Optimization header.
 *
 * @package AzureSyntheticsOptimization
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cart_count = azure_synthetics_cart_count();
$nav_items  = azure_opt_get_primary_nav_items();
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<meta name="theme-color" content="#071114">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="opt-grain" aria-hidden="true"></div>
<div class="opt-scanlines" aria-hidden="true"></div>
<header class="opt-nav" id="opt-nav">
	<a class="opt-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Azure Synthetics home', 'azure-synthetics' ); ?>">
		<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/azure-logo-transparent.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>">
		<span>
			<strong><?php bloginfo( 'name' ); ?></strong>
			<em><?php esc_html_e( 'Premium research peptides', 'azure-synthetics' ); ?></em>
		</span>
	</a>
	<nav class="opt-nav__links" aria-label="<?php esc_attr_e( 'Primary navigation', 'azure-synthetics' ); ?>">
		<?php foreach ( $nav_items as $item ) : ?>
			<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
		<?php endforeach; ?>
	</nav>
	<div class="opt-nav__actions">
		<a class="opt-cart" href="<?php echo esc_url( azure_synthetics_cart_url() ); ?>" aria-label="<?php echo esc_attr( sprintf( _n( 'View cart, %d item', 'View cart, %d items', $cart_count, 'azure-synthetics' ), $cart_count ) ); ?>">
			<span><?php esc_html_e( 'Cart', 'azure-synthetics' ); ?></span>
			<b><?php echo esc_html( $cart_count ); ?></b>
		</a>
		<a class="opt-button opt-button--primary" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>">
			<?php esc_html_e( 'Shop', 'azure-synthetics' ); ?>
			<?php azure_opt_render_arrow_icon(); ?>
		</a>
		<button class="opt-menu-button" type="button" data-optimization-drawer="open" aria-label="<?php esc_attr_e( 'Open menu', 'azure-synthetics' ); ?>">
			<span></span>
		</button>
	</div>
</header>
<div class="opt-drawer-overlay" data-optimization-drawer="close"></div>
<aside class="opt-drawer" id="opt-drawer" aria-hidden="true">
	<div class="opt-drawer__head">
		<span class="opt-label"><?php esc_html_e( 'Index', 'azure-synthetics' ); ?></span>
		<button type="button" data-optimization-drawer="close" aria-label="<?php esc_attr_e( 'Close menu', 'azure-synthetics' ); ?>">×</button>
	</div>
	<nav class="opt-drawer__links" aria-label="<?php esc_attr_e( 'Mobile navigation', 'azure-synthetics' ); ?>">
		<?php foreach ( $nav_items as $index => $item ) : ?>
			<a href="<?php echo esc_url( $item['url'] ); ?>" data-optimization-drawer="close"><?php echo esc_html( $item['label'] ); ?><span><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span></a>
		<?php endforeach; ?>
	</nav>
	<a class="opt-button opt-button--primary" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>" data-optimization-drawer="close">
		<?php esc_html_e( 'Shop Peptides', 'azure-synthetics' ); ?>
		<?php azure_opt_render_arrow_icon(); ?>
	</a>
</aside>
