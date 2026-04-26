<?php
/**
 * Query helpers.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_home_products_query() {
	if ( ! function_exists( 'wc_get_products' ) ) {
		return array();
	}

	$products        = array();
	$seen            = array();
	$preferred_slugs = array( 'bpc-157', 'bpc-157-tb-500-blend', 'mots-c', 'cjc-1295-ipamorelin' );

	foreach ( $preferred_slugs as $slug ) {
		$post = get_page_by_path( $slug, OBJECT, 'product' );

		if ( ! $post ) {
			continue;
		}

		$product = wc_get_product( $post->ID );

		if ( $product && $product->is_visible() ) {
			$products[]                  = $product;
			$seen[ $product->get_id() ] = true;
		}
	}

	$featured = wc_get_products(
		array(
			'status'   => 'publish',
			'limit'    => 8,
			'featured' => true,
			'orderby'  => 'menu_order',
			'order'    => 'ASC',
		)
	);

	$fallbacks = wc_get_products(
		array(
			'status'  => 'publish',
			'limit'   => 12,
			'orderby' => 'date',
			'order'   => 'DESC',
		)
	);

	foreach ( array_merge( $featured, $fallbacks ) as $product ) {
		if ( ! $product || ! $product->is_visible() || isset( $seen[ $product->get_id() ] ) ) {
			continue;
		}

		$products[]                  = $product;
		$seen[ $product->get_id() ] = true;

		if ( count( $products ) >= 4 ) {
			break;
		}
	}

	return array_slice( $products, 0, 4 );
}

function azure_synthetics_include_products_in_search( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return;
	}

	$query->set( 'post_type', array( 'post', 'page', 'product' ) );
}
add_action( 'pre_get_posts', 'azure_synthetics_include_products_in_search' );
