<?php
/**
 * Block/theme helper classes.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_body_classes( $classes ) {
	$classes[] = 'azure-site';

	if ( is_front_page() ) {
		$classes[] = 'azure-site--home';
	}

	if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
		$classes[] = 'azure-site--commerce';
	}

	return $classes;
}
add_filter( 'body_class', 'azure_synthetics_body_classes' );
