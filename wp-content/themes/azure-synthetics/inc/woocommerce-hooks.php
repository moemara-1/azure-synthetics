<?php
/**
 * WooCommerce integration hooks.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_sale_flash( $html, $post, $product ) {
	$label = $product->is_on_sale() ? __( 'On sale', 'azure-synthetics' ) : __( 'Featured', 'azure-synthetics' );

	return '<span class="azure-badge azure-badge--sale">' . esc_html( $label ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'azure_synthetics_sale_flash', 10, 3 );

function azure_synthetics_loop_add_to_cart_args( $args, $product ) {
	$args['class'] = trim( ( $args['class'] ?? '' ) . ' azure-button azure-button--ghost' );

	if ( $product->is_type( 'variable' ) ) {
		$args['text'] = __( 'Choose options', 'azure-synthetics' );
	}

	return $args;
}
add_filter( 'woocommerce_loop_add_to_cart_args', 'azure_synthetics_loop_add_to_cart_args', 10, 2 );

function azure_synthetics_product_tabs( $tabs ) {
	unset( $tabs['reviews'] );
	unset( $tabs['additional_information'] );

	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'azure_synthetics_product_tabs', 20 );
