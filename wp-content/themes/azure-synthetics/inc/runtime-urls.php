<?php
/**
 * Runtime URL rewriting for tunnels and reverse proxies.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_filter_runtime_url( $url ) {
	return azure_synthetics_apply_origin( $url );
}

add_filter( 'option_home', 'azure_synthetics_filter_runtime_url' );
add_filter( 'option_siteurl', 'azure_synthetics_filter_runtime_url' );
add_filter( 'home_url', 'azure_synthetics_filter_runtime_url' );
add_filter( 'site_url', 'azure_synthetics_filter_runtime_url' );
add_filter( 'content_url', 'azure_synthetics_filter_runtime_url' );
add_filter( 'plugins_url', 'azure_synthetics_filter_runtime_url' );
add_filter( 'theme_file_uri', 'azure_synthetics_filter_runtime_url' );
add_filter( 'script_loader_src', 'azure_synthetics_filter_runtime_url' );
add_filter( 'style_loader_src', 'azure_synthetics_filter_runtime_url' );
add_filter( 'wp_get_attachment_url', 'azure_synthetics_filter_runtime_url' );

function azure_synthetics_filter_upload_dir( $uploads ) {
	if ( ! is_array( $uploads ) ) {
		return $uploads;
	}

	if ( ! empty( $uploads['baseurl'] ) ) {
		$uploads['baseurl'] = azure_synthetics_apply_origin( $uploads['baseurl'] );
	}

	if ( ! empty( $uploads['url'] ) ) {
		$uploads['url'] = azure_synthetics_apply_origin( $uploads['url'] );
	}

	return $uploads;
}

add_filter( 'upload_dir', 'azure_synthetics_filter_upload_dir' );

function azure_synthetics_filter_image_srcset( $sources ) {
	if ( ! is_array( $sources ) ) {
		return $sources;
	}

	foreach ( $sources as $width => $source ) {
		if ( ! empty( $source['url'] ) ) {
			$sources[ $width ]['url'] = azure_synthetics_apply_origin( $source['url'] );
		}
	}

	return $sources;
}

add_filter( 'wp_calculate_image_srcset', 'azure_synthetics_filter_image_srcset' );

function azure_synthetics_filter_nav_menu_link_attributes( $atts ) {
	if ( ! is_array( $atts ) || empty( $atts['href'] ) ) {
		return $atts;
	}

	$atts['href'] = azure_synthetics_apply_origin( $atts['href'] );

	return $atts;
}

add_filter( 'nav_menu_link_attributes', 'azure_synthetics_filter_nav_menu_link_attributes' );

function azure_synthetics_product_alias_map() {
	return array(
		'glp-3'   => 'retatrutide',
		'cjc-ipa' => 'cjc-1295-ipamorelin',
	);
}

function azure_synthetics_filter_product_permalink( $post_link, $post ) {
	if ( ! $post instanceof WP_Post || 'product' !== $post->post_type ) {
		return $post_link;
	}

	if ( ! isset( azure_synthetics_product_alias_map()[ $post->post_name ] ) ) {
		return $post_link;
	}

	return home_url( '/product/' . azure_synthetics_product_alias_map()[ $post->post_name ] . '/' );
}

add_filter( 'post_type_link', 'azure_synthetics_filter_product_permalink', 10, 2 );

function azure_synthetics_get_request_path() {
	$request_uri = $_SERVER['REQUEST_URI'] ?? '';

	if ( ! is_string( $request_uri ) || '' === $request_uri ) {
		return '';
	}

	$request_path = trim( (string) wp_parse_url( $request_uri, PHP_URL_PATH ), '/' );
	$site_path    = trim( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ), '/' );

	if ( $site_path && 0 === strpos( $request_path, $site_path . '/' ) ) {
		$request_path = substr( $request_path, strlen( $site_path ) + 1 );
	}

	return $request_path;
}

function azure_synthetics_redirect_legacy_product_paths() {
	if ( is_admin() ) {
		return;
	}

	$request_path = azure_synthetics_get_request_path();

	foreach ( azure_synthetics_product_alias_map() as $legacy_slug => $canonical_slug ) {
		if ( 'product/' . $legacy_slug !== $request_path ) {
			continue;
		}

		$product = get_page_by_path( $canonical_slug, OBJECT, 'product' );

		if ( $product instanceof WP_Post ) {
			wp_safe_redirect( home_url( '/product/' . $canonical_slug . '/' ), 301 );
			exit;
		}
	}
}

add_action( 'template_redirect', 'azure_synthetics_redirect_legacy_product_paths', 0 );

function azure_synthetics_filter_product_alias_request( $query_vars ) {
	if ( ! is_array( $query_vars ) ) {
		return $query_vars;
	}

	foreach ( array( 'product', 'name' ) as $query_key ) {
		if ( empty( $query_vars[ $query_key ] ) ) {
			continue;
		}

		$requested_slug = (string) $query_vars[ $query_key ];

		if ( isset( azure_synthetics_product_alias_map()[ $requested_slug ] ) ) {
			$query_vars[ $query_key ] = azure_synthetics_product_alias_map()[ $requested_slug ];
		}
	}

	return $query_vars;
}

add_filter( 'request', 'azure_synthetics_filter_product_alias_request', 1 );

function azure_synthetics_redirect_seeded_product_slugs() {
	if ( is_admin() || ! is_singular( 'product' ) ) {
		return;
	}

	$queried_product = get_queried_object();

	if ( ! $queried_product instanceof WP_Post ) {
		return;
	}

	$request_path = azure_synthetics_get_request_path();

	foreach ( azure_synthetics_product_alias_map() as $legacy_slug => $canonical_slug ) {
		if ( $canonical_slug !== $queried_product->post_name ) {
			continue;
		}

		if ( 'product/' . $legacy_slug !== $request_path ) {
			return;
		}

		wp_safe_redirect( home_url( '/product/' . $canonical_slug . '/' ), 301 );
		exit;
	}
}

add_action( 'template_redirect', 'azure_synthetics_redirect_seeded_product_slugs', 1 );
