<?php
/**
 * Azure Synthetics theme bootstrap.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AZURE_SYNTHETICS_THEME_VERSION', '1.0.0' );
define( 'AZURE_SYNTHETICS_THEME_DIR', get_template_directory() );
define( 'AZURE_SYNTHETICS_THEME_URI', get_template_directory_uri() );

$azure_synthetics_includes = array(
	'inc/setup.php',
	'inc/content.php',
	'inc/assets.php',
	'inc/template-tags.php',
	'inc/queries.php',
	'inc/schema.php',
	'inc/block-support.php',
	'inc/woocommerce-hooks.php',
);

foreach ( $azure_synthetics_includes as $azure_synthetics_file ) {
	require_once AZURE_SYNTHETICS_THEME_DIR . '/' . $azure_synthetics_file;
}
