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

function azure_synthetics_get_option_value( $key, $default = '' ) {
	if ( function_exists( 'azure_synthetics_get_option' ) ) {
		return azure_synthetics_get_option( $key, $default );
	}

	return $default;
}

function azure_synthetics_get_footer_disclaimer() {
	return azure_synthetics_get_option_value( 'footer_disclaimer', __( 'For research use only. Not for human consumption.', 'azure-synthetics' ) );
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
			'title'       => sprintf( __( 'Results for “%s”', 'azure-synthetics' ), get_search_query() ),
			'description' => __( 'Find products, compliance resources, and supporting research guidance across the storefront.', 'azure-synthetics' ),
		);
	}

	if ( is_404() ) {
		return array(
			'eyebrow'     => __( 'Lost in the catalog', 'azure-synthetics' ),
			'title'       => __( 'This route does not exist.', 'azure-synthetics' ),
			'description' => __( 'Use the catalog, FAQ, or compliance pages to get back on track.', 'azure-synthetics' ),
		);
	}

	if ( is_page_template( 'page-templates/template-faq.php' ) ) {
		return array(
			'eyebrow'     => __( 'Need a clearer path?', 'azure-synthetics' ),
			'title'       => __( 'Frequently asked questions', 'azure-synthetics' ),
			'description' => __( 'Concise answers on documentation, handling, and how the catalog is structured.', 'azure-synthetics' ),
		);
	}

	if ( is_page_template( 'page-templates/template-science.php' ) ) {
		return array(
			'eyebrow'     => __( 'Science and documentation', 'azure-synthetics' ),
			'title'       => __( 'A research-use catalog needs proof before persuasion.', 'azure-synthetics' ),
			'description' => __( 'How Azure Synthetics presents lot integrity, release data, form factors, and handling notes without drifting into consumer health claims.', 'azure-synthetics' ),
		);
	}

	if ( is_page_template( 'page-templates/template-contact.php' ) ) {
		return array(
			'eyebrow'     => __( 'Contact', 'azure-synthetics' ),
			'title'       => __( 'Talk to the support desk', 'azure-synthetics' ),
			'description' => __( 'Use this page for account help, documentation requests, shipping questions, and catalog assistance.', 'azure-synthetics' ),
		);
	}

	if ( is_page_template( 'page-templates/template-compliance.php' ) ) {
		return array(
			'eyebrow'     => __( 'Research use policy', 'azure-synthetics' ),
			'title'       => __( 'Compliance and handling', 'azure-synthetics' ),
			'description' => __( 'Keep legal, storage, and product-positioning language legible across the buying journey.', 'azure-synthetics' ),
		);
	}

	if ( is_singular( 'product' ) ) {
		global $product;

		return array(
			'eyebrow'     => __( 'Research catalog', 'azure-synthetics' ),
			'title'       => $product ? $product->get_name() : get_the_title(),
			'description' => function_exists( 'azure_synthetics_get_product_meta_value' ) && $product ? azure_synthetics_get_product_meta_value( $product->get_id(), 'subtitle', '' ) : '',
		);
	}

	return array(
		'eyebrow'     => __( 'Azure Synthetics', 'azure-synthetics' ),
		'title'       => get_the_title(),
		'description' => get_the_excerpt(),
	);
}

function azure_synthetics_render_section_heading( array $args ) {
	get_template_part( 'template-parts/components/section-heading', null, $args );
}
