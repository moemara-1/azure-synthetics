<?php
/**
 * Azure Synthetics theme bootstrap.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_request_origin() {
	$host = $_SERVER['HTTP_X_FORWARDED_HOST'] ?? $_SERVER['HTTP_HOST'] ?? '';

	if ( ! is_string( $host ) || '' === $host ) {
		return null;
	}

	$host = trim( explode( ',', $host )[0] );

	$forwarded_proto = $_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '';
	$scheme          = is_string( $forwarded_proto ) && '' !== $forwarded_proto
		? trim( explode( ',', $forwarded_proto )[0] )
		: ( ( ! empty( $_SERVER['HTTPS'] ) && 'off' !== strtolower( (string) $_SERVER['HTTPS'] ) ) ? 'https' : 'http' );

	return $scheme . '://' . $host;
}

function azure_synthetics_is_runtime_host( $host ) {
	if ( ! is_string( $host ) || '' === $host ) {
		return false;
	}

	$host = strtolower( trim( $host, '[]' ) );

	if ( in_array( $host, array( 'localhost', '127.0.0.1', '::1' ), true ) ) {
		return true;
	}

	return (bool) preg_match( '/(^|\.)((loca\.lt)|(trycloudflare\.com)|(ngrok(-free)?\.(app|io))|(pantheonsite\.io))$/', $host );
}

function azure_synthetics_apply_origin( $url, $origin = null ) {
	if ( ! is_string( $url ) || '' === $url ) {
		return $url;
	}

	$origin = $origin ?: azure_synthetics_request_origin();

	if ( ! $origin ) {
		return $url;
	}

	$url_parts    = wp_parse_url( $url );
	$origin_parts = wp_parse_url( $origin );

	if ( empty( $url_parts['host'] ) || empty( $origin_parts['host'] ) || empty( $origin_parts['scheme'] ) ) {
		return $url;
	}

	$url_host    = strtolower( trim( $url_parts['host'], '[]' ) );
	$origin_host = strtolower( trim( $origin_parts['host'], '[]' ) );

	if ( $url_host !== $origin_host && ! azure_synthetics_is_runtime_host( $url_host ) ) {
		return $url;
	}

	$rebuilt = $origin_parts['scheme'] . '://' . $origin_parts['host'];

	if ( ! empty( $origin_parts['port'] ) ) {
		$rebuilt .= ':' . $origin_parts['port'];
	}

	$rebuilt .= $url_parts['path'] ?? '';

	if ( ! empty( $url_parts['query'] ) ) {
		$rebuilt .= '?' . $url_parts['query'];
	}

	if ( ! empty( $url_parts['fragment'] ) ) {
		$rebuilt .= '#' . $url_parts['fragment'];
	}

	return $rebuilt;
}

define( 'AZURE_SYNTHETICS_THEME_VERSION', '1.0.0' );
define( 'AZURE_SYNTHETICS_THEME_DIR', get_template_directory() );
define( 'AZURE_SYNTHETICS_THEME_URI', azure_synthetics_apply_origin( get_template_directory_uri() ) );

$azure_synthetics_includes = array(
	'inc/setup.php',
	'inc/content.php',
	'inc/runtime-urls.php',
	'inc/assets.php',
	'inc/template-tags.php',
	'inc/seo.php',
	'inc/queries.php',
	'inc/schema.php',
	'inc/block-support.php',
	'inc/woocommerce-hooks.php',
);

foreach ( $azure_synthetics_includes as $azure_synthetics_file ) {
	require_once AZURE_SYNTHETICS_THEME_DIR . '/' . $azure_synthetics_file;
}
