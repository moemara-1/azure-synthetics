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

	$featured = wc_get_products(
		array(
			'status'   => 'publish',
			'limit'    => 4,
			'featured' => true,
			'orderby'  => 'menu_order',
			'order'    => 'ASC',
		)
	);

	if ( count( $featured ) < 4 ) {
		$featured = wc_get_products(
			array(
				'status'  => 'publish',
				'limit'   => 4,
				'orderby' => 'date',
				'order'   => 'DESC',
			)
		);
	}

	return $featured;
}

function azure_synthetics_include_products_in_search( $query ) {
	if ( is_admin() || ! $query->is_main_query() || ! $query->is_search() ) {
		return;
	}

	$query->set( 'post_type', array( 'post', 'page', 'product' ) );
}
add_action( 'pre_get_posts', 'azure_synthetics_include_products_in_search' );
