<?php
/**
 * Lightweight metadata for launch pages.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

remove_action( 'wp_head', 'rel_canonical' );

function azure_synthetics_clean_meta_text( $text, $limit = 165 ) {
	$text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( (string) $text ) ) );

	if ( strlen( $text ) <= $limit ) {
		return $text;
	}

	return rtrim( substr( $text, 0, $limit - 1 ), " \t\n\r\0\x0B.,;" ) . '.';
}

function azure_synthetics_current_request_url() {
	global $wp;

	$path = isset( $wp->request ) ? $wp->request : trim( wp_parse_url( home_url( add_query_arg( array() ) ), PHP_URL_PATH ), '/' );
	$url  = home_url( $path ? '/' . $path . '/' : '/' );

	if ( is_search() ) {
		$url = add_query_arg( 's', get_search_query(), home_url( '/' ) );
	}

	return $url;
}

function azure_synthetics_language_variant_url( $lang ) {
	$url = azure_synthetics_current_request_url();

	return 'ar' === $lang ? add_query_arg( 'lang', 'ar', $url ) : remove_query_arg( 'lang', $url );
}

function azure_synthetics_meta_image_url() {
	if ( is_singular( 'product' ) && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( get_the_ID() );

		if ( $product && $product->get_image_id() ) {
			$image = wp_get_attachment_image_url( $product->get_image_id(), 'large' );

			if ( $image ) {
				return $image;
			}
		}
	}

	return azure_synthetics_asset_url( 'images/hero-home-desktop.jpg' );
}

function azure_synthetics_meta_description() {
	if ( is_front_page() ) {
		return __( 'Research peptides with 99%+ target purity, COA and lot workflow, clear vial and box pricing, and order review before fulfillment.', 'azure-synthetics' );
	}

	if ( function_exists( 'is_shop' ) && ( is_shop() || is_product_taxonomy() ) ) {
		return __( 'Browse Azure Synthetics by compound, amount, pack size, target purity, COA path, lot handoff, and box value before checkout.', 'azure-synthetics' );
	}

	if ( is_singular( 'product' ) && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( get_the_ID() );

		if ( $product ) {
			$description = $product->get_short_description() ?: $product->get_description();

			if ( function_exists( 'azure_synthetics_get_localized_product_meta' ) ) {
				$description = azure_synthetics_get_localized_product_meta( $product->get_id(), 'short_description', $description );
			}

			return azure_synthetics_clean_meta_text( $description );
		}
	}

	$intro = function_exists( 'azure_synthetics_get_page_intro' ) ? azure_synthetics_get_page_intro() : array();

	if ( ! empty( $intro['description'] ) ) {
		return azure_synthetics_clean_meta_text( $intro['description'] );
	}

	return azure_synthetics_clean_meta_text( get_bloginfo( 'description' ) );
}

function azure_synthetics_meta_title() {
	if ( is_front_page() ) {
		return get_bloginfo( 'name' ) . ' | ' . __( 'Research peptides with price, purity target, and proof up front.', 'azure-synthetics' );
	}

	if ( is_singular( 'product' ) ) {
		return get_the_title() . ' | ' . get_bloginfo( 'name' );
	}

	if ( function_exists( 'is_shop' ) && is_shop() ) {
		return __( 'Research Peptide Catalog', 'azure-synthetics' ) . ' | ' . get_bloginfo( 'name' );
	}

	return wp_get_document_title();
}

function azure_synthetics_output_meta_tags() {
	$title       = azure_synthetics_clean_meta_text( azure_synthetics_meta_title(), 90 );
	$description = azure_synthetics_clean_meta_text( azure_synthetics_meta_description() );
	$canonical   = azure_synthetics_language_variant_url( azure_synthetics_current_language() );
	$image       = azure_synthetics_meta_image_url();
	$locale      = 'ar' === azure_synthetics_current_language() ? 'ar_EG' : 'en_US';
	$type        = is_singular( 'product' ) ? 'product' : 'website';
	?>
	<link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">
	<link rel="alternate" hreflang="en" href="<?php echo esc_url( azure_synthetics_language_variant_url( 'en' ) ); ?>">
	<link rel="alternate" hreflang="ar" href="<?php echo esc_url( azure_synthetics_language_variant_url( 'ar' ) ); ?>">
	<link rel="alternate" hreflang="x-default" href="<?php echo esc_url( azure_synthetics_language_variant_url( 'en' ) ); ?>">
	<meta name="description" content="<?php echo esc_attr( $description ); ?>">
	<meta property="og:locale" content="<?php echo esc_attr( $locale ); ?>">
	<meta property="og:type" content="<?php echo esc_attr( $type ); ?>">
	<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $canonical ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $image ); ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">
	<meta name="twitter:image" content="<?php echo esc_url( $image ); ?>">
	<?php
}
add_action( 'wp_head', 'azure_synthetics_output_meta_tags', 2 );
