<?php
/**
 * Plugin Name: Azure Synthetics Pantheon Runtime
 * Description: Keeps migrated database URLs aligned with the current Pantheon host.
 *
 * @package AzureSynthetics
 */

function azure_synthetics_pantheon_runtime_origin() {
	if ( empty( $_SERVER['HTTP_HOST'] ) ) {
		return '';
	}

	$host = strtolower( sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) );

	if ( ! preg_match( '/(^|\\.)pantheonsite\\.io$/', $host ) && ! in_array( $host, array( 'azuresynthetics.com', 'www.azuresynthetics.com' ), true ) ) {
		return '';
	}

	return 'https://' . $host;
}

function azure_synthetics_pantheon_runtime_url_option( $value ) {
	$origin = azure_synthetics_pantheon_runtime_origin();

	return $origin ?: $value;
}

add_filter( 'pre_option_home', 'azure_synthetics_pantheon_runtime_url_option' );
add_filter( 'pre_option_siteurl', 'azure_synthetics_pantheon_runtime_url_option' );

function azure_synthetics_pantheon_live_store_option( $value ) {
	return azure_synthetics_pantheon_runtime_origin() ? 'no' : $value;
}

add_filter( 'pre_option_woocommerce_coming_soon', 'azure_synthetics_pantheon_live_store_option' );
