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
