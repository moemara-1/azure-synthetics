<?php
/**
 * Template helpers.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_asset_url( $path ) {
	return AZURE_SYNTHETICS_THEME_URI . '/assets/' . ltrim( $path, '/' );
}

function azure_synthetics_get_product_asset_map() {
	return array(
		'bpc-157'             => 'products/bpc-157.png',
		'mots-c'              => 'products/mots-c.png',
		'cjc-1295-ipamorelin' => 'products/cjc-1295-ipamorelin.png',
		'retatrutide'         => 'products/retatrutide.png',
		'glp-3'               => 'products/retatrutide.png',
		'cjc-ipa'             => 'products/cjc-1295-ipamorelin.png',
	);
}

function azure_synthetics_get_product_asset_url( $product ) {
	if ( ! class_exists( 'WC_Product' ) || ! $product instanceof WC_Product ) {
		return '';
	}

	$asset_map = azure_synthetics_get_product_asset_map();
	$slug      = $product->get_slug();
	$path      = 'images/products/' . $slug . '.png';

	if ( file_exists( AZURE_SYNTHETICS_THEME_DIR . '/assets/' . $path ) ) {
		return azure_synthetics_asset_url( $path );
	}

	if ( empty( $asset_map[ $slug ] ) ) {
		return '';
	}

	return azure_synthetics_asset_url( 'images/' . $asset_map[ $slug ] );
}

function azure_synthetics_render_product_asset_image( $product, $context = 'card' ) {
	$image_url = azure_synthetics_get_product_asset_url( $product );

	if ( ! $image_url ) {
		return '';
	}

	$title = function_exists( 'azure_synthetics_get_product_display_title' )
		? azure_synthetics_get_product_display_title( $product->get_id() )
		: $product->get_name();

	$attributes = array(
		'src'      => esc_url( $image_url ),
		'alt'      => esc_attr( sprintf( __( '%s Azure Synthetics research vial with branded label', 'azure-synthetics' ), $title ) ),
		'width'    => '1024',
		'height'   => '1024',
		'decoding' => 'async',
	);

	if ( 'hero' === $context ) {
		$attributes['fetchpriority'] = 'high';
	} else {
		$attributes['loading'] = 'lazy';
	}

	$markup = '<img';

	foreach ( $attributes as $name => $value ) {
		$markup .= ' ' . $name . '="' . $value . '"';
	}

	$markup .= '>';

	return $markup;
}

function azure_synthetics_get_option_value( $key, $default = '' ) {
	if ( function_exists( 'azure_synthetics_get_option' ) ) {
		return azure_synthetics_get_option( $key, $default );
	}

	return $default;
}

function azure_synthetics_get_footer_disclaimer() {
	return azure_synthetics_get_option_value( 'footer_disclaimer', __( 'For laboratory research use only. Not for human or veterinary use.', 'azure-synthetics' ) );
}

/**
 * Safe shop URL helper.
 *
 * @return string
 */
function azure_synthetics_shop_url() {
	return function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
}

/**
 * Safe account URL helper.
 *
 * @return string
 */
function azure_synthetics_account_url() {
	return function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : wp_login_url();
}

/**
 * Accessible account link label.
 *
 * @return string
 */
function azure_synthetics_account_label() {
	return is_user_logged_in() ? __( 'My account', 'azure-synthetics' ) : __( 'Account and sign in', 'azure-synthetics' );
}

/**
 * Safe cart URL helper.
 *
 * @return string
 */
function azure_synthetics_cart_url() {
	return function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' );
}

/**
 * Safe cart count helper.
 *
 * @return int
 */
function azure_synthetics_cart_count() {
	return function_exists( 'WC' ) && WC()->cart ? (int) WC()->cart->get_cart_contents_count() : 0;
}

function azure_synthetics_get_page_intro() {
	if ( is_search() ) {
		return array(
			'eyebrow'     => __( 'Search', 'azure-synthetics' ),
			'title'       => sprintf( __( 'Results for "%s"', 'azure-synthetics' ), get_search_query() ),
			'description' => __( 'Find research peptides, documentation status, storage notes, and category guidance across Azure Synthetics.', 'azure-synthetics' ),
		);
	}

	if ( is_404() ) {
		return array(
			'eyebrow'     => __( 'Lost in the catalog', 'azure-synthetics' ),
			'title'       => __( 'This route does not exist.', 'azure-synthetics' ),
			'description' => __( 'Use the catalog, science pages, or documentation desk to get back on track.', 'azure-synthetics' ),
		);
	}

	if ( is_page_template( 'page-templates/template-faq.php' ) ) {
		return array(
			'eyebrow'     => __( 'Buyer FAQ', 'azure-synthetics' ),
			'title'       => __( 'Answers for research-use orders.', 'azure-synthetics' ),
			'description' => __( 'Check evidence tiers, documentation status, storage notes, support routing, and research-use boundaries before ordering.', 'azure-synthetics' ),
		);
	}

	if ( is_page_template( 'page-templates/template-science.php' ) ) {
		return array(
			'eyebrow'     => __( 'Research standards', 'azure-synthetics' ),
			'title'       => __( 'Compare peptide pages by proof, not promises.', 'azure-synthetics' ),
			'description' => __( 'Use compound identity, evidence maturity, documentation status, and handling requirements to evaluate Retatrutide, BPC-157, MOTS-c, and CJC-1295 / Ipamorelin.', 'azure-synthetics' ),
		);
	}

	if ( is_page_template( 'page-templates/template-contact.php' ) ) {
		return array(
			'eyebrow'     => __( 'Support desk', 'azure-synthetics' ),
			'title'       => __( 'Get a documented answer from support.', 'azure-synthetics' ),
			'description' => __( 'Send documentation requests, order questions, storage issues, and repeat-buyer setup details through one routed form.', 'azure-synthetics' ),
		);
	}

	if ( is_page_template( 'page-templates/template-compliance.php' ) ) {
		return array(
			'eyebrow'     => __( 'Research use policy', 'azure-synthetics' ),
			'title'       => __( 'Research-use boundaries and support standards.', 'azure-synthetics' ),
			'description' => __( 'Review the public claim boundary, documentation posture, handling notes, and support routing that guide the catalog.', 'azure-synthetics' ),
		);
	}

	if ( is_singular( 'product' ) ) {
		global $product;
		$product_id = $product ? $product->get_id() : get_the_ID();

		return array(
			'eyebrow'     => __( 'Research catalog', 'azure-synthetics' ),
			'title'       => function_exists( 'azure_synthetics_get_product_display_title' ) && $product_id ? azure_synthetics_get_product_display_title( $product_id ) : ( $product ? $product->get_name() : get_the_title() ),
			'description' => function_exists( 'azure_synthetics_get_product_meta_value' ) && $product_id ? azure_synthetics_get_product_meta_value( $product_id, 'subtitle', '' ) : '',
		);
	}

	return array(
		'eyebrow'     => __( 'Azure Synthetics', 'azure-synthetics' ),
		'title'       => get_the_title(),
		'description' => get_the_excerpt() ?: __( 'Research peptides with evidence tiers, documentation support, and storage guidance.', 'azure-synthetics' ),
	);
}

function azure_synthetics_render_section_heading( array $args ) {
	get_template_part( 'template-parts/components/section-heading', null, $args );
}
