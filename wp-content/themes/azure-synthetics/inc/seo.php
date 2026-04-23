<?php
/**
 * Lightweight SEO helpers.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_get_seo_description() {
	if ( is_front_page() ) {
		return __( 'Shop lab-grade research peptides with evidence tiers, purity cues, documentation support, storage notes, and RUO guidance for Retatrutide, BPC-157, MOTS-c, and CJC-1295 / Ipamorelin.', 'azure-synthetics' );
	}

	if ( is_singular( 'product' ) && function_exists( 'azure_synthetics_get_product_meta_value' ) ) {
		$product_id = get_queried_object_id();
		$custom     = azure_synthetics_get_product_meta_value( $product_id, 'meta_description', '' );

		if ( $custom ) {
			return $custom;
		}

		$summary = azure_synthetics_get_product_meta_value( $product_id, 'research_summary', '' );
		$excerpt = get_the_excerpt();

		return $summary ?: ( $excerpt ?: get_bloginfo( 'description' ) );
	}

	if ( is_tax( 'product_cat' ) ) {
		$term    = get_queried_object();
		$profile = $term ? azure_synthetics_get_collection_profile( $term->slug ) : array();

		if ( ! empty( $profile['description'] ) ) {
			return $profile['description'];
		}

		$description = term_description();

		return $description ? wp_strip_all_tags( $description ) : get_bloginfo( 'description' );
	}

	if ( is_search() ) {
		return sprintf( __( 'Search Azure Synthetics for products, documentation guidance, and research-category pages matching "%s".', 'azure-synthetics' ), get_search_query() );
	}

	$intro = azure_synthetics_get_page_intro();

	if ( ! empty( $intro['description'] ) ) {
		return $intro['description'];
	}

	return get_bloginfo( 'description' );
}

function azure_synthetics_get_seo_image_url() {
	if ( is_singular( 'product' ) && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( get_queried_object_id() );

		if ( $product && $product->get_image_id() ) {
			$image = wp_get_attachment_image_url( $product->get_image_id(), 'full' );

			if ( $image ) {
				return $image;
			}
		}
	}

	if ( has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url( null, 'full' );

		if ( $image ) {
			return $image;
		}
	}

	if ( is_tax( 'product_cat' ) ) {
		$term    = get_queried_object();
		$profile = $term ? azure_synthetics_get_collection_profile( $term->slug ) : array();

		if ( ! empty( $profile['image'] ) ) {
			return azure_synthetics_asset_url( 'images/' . $profile['image'] );
		}
	}

	return azure_synthetics_asset_url( 'images/story-branded-vials.png' );
}

function azure_synthetics_filter_document_title_parts( $parts ) {
	if ( is_front_page() ) {
		$parts['title'] = __( 'Lab-Grade Research Peptides With Documentation and Storage Guidance', 'azure-synthetics' );
		return $parts;
	}

	if ( is_singular( 'product' ) && function_exists( 'azure_synthetics_get_product_meta_value' ) ) {
		$product_id = get_queried_object_id();
		$alias      = azure_synthetics_get_product_meta_value( $product_id, 'compound_alias', '' );
		$title      = function_exists( 'azure_synthetics_get_product_display_title' ) ? azure_synthetics_get_product_display_title( $product_id ) : get_the_title();

		$parts['title'] = $alias ? sprintf( __( '%1$s (%2$s)', 'azure-synthetics' ), $title, $alias ) : $title;
		return $parts;
	}

	if ( is_tax( 'product_cat' ) ) {
		$term = get_queried_object();

		if ( $term ) {
			$parts['title'] = sprintf( __( '%s Research Peptides', 'azure-synthetics' ), $term->name );
		}

		return $parts;
	}

	if ( is_search() ) {
		$parts['title'] = sprintf( __( 'Search Results for "%s"', 'azure-synthetics' ), get_search_query() );
	}

	return $parts;
}
add_filter( 'document_title_parts', 'azure_synthetics_filter_document_title_parts' );

function azure_synthetics_output_seo_meta() {
	$title       = wp_get_document_title();
	$description = wp_strip_all_tags( azure_synthetics_get_seo_description() );
	$image       = azure_synthetics_get_seo_image_url();
	$url         = is_singular() ? get_permalink() : home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
	$type        = is_front_page() ? 'website' : ( is_singular( 'product' ) ? 'product' : 'article' );

	if ( ! $description ) {
		return;
	}
	?>
	<meta name="description" content="<?php echo esc_attr( wp_trim_words( $description, 28, '' ) ); ?>">
	<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
	<meta property="og:description" content="<?php echo esc_attr( wp_trim_words( $description, 28, '' ) ); ?>">
	<meta property="og:type" content="<?php echo esc_attr( $type ); ?>">
	<meta property="og:url" content="<?php echo esc_url( $url ); ?>">
	<meta property="og:image" content="<?php echo esc_url( $image ); ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( wp_trim_words( $description, 28, '' ) ); ?>">
	<meta name="twitter:image" content="<?php echo esc_url( $image ); ?>">
	<?php
}
add_action( 'wp_head', 'azure_synthetics_output_seo_meta', 8 );
