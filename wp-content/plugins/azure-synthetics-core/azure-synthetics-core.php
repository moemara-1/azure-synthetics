<?php
/**
 * Plugin Name: Azure Synthetics Core
 * Plugin URI: https://example.com/azure-synthetics-core
 * Description: Peptide product metadata, compliance settings, checkout acknowledgment, and gateway scaffolding for the Azure Synthetics WooCommerce theme.
 * Version: 1.0.0
 * Author: OpenAI Codex
 * Text Domain: azure-synthetics-core
 *
 * @package AzureSyntheticsCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AZURE_SYNTHETICS_CORE_VERSION', '1.0.0' );
define( 'AZURE_SYNTHETICS_CORE_FILE', __FILE__ );
define( 'AZURE_SYNTHETICS_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'AZURE_SYNTHETICS_CORE_URL', plugin_dir_url( __FILE__ ) );

require_once AZURE_SYNTHETICS_CORE_DIR . 'includes/class-plugin.php';
require_once AZURE_SYNTHETICS_CORE_DIR . 'includes/class-product-meta.php';
require_once AZURE_SYNTHETICS_CORE_DIR . 'includes/class-compliance.php';
require_once AZURE_SYNTHETICS_CORE_DIR . 'includes/class-checkout.php';
require_once AZURE_SYNTHETICS_CORE_DIR . 'includes/class-gateway-compat.php';
require_once AZURE_SYNTHETICS_CORE_DIR . 'includes/class-email-branding.php';

function azure_synthetics_core() {
	return AzureSynthetics\Core\Plugin::instance();
}

azure_synthetics_core();

function azure_synthetics_get_option( $key, $default = '' ) {
	return azure_synthetics_core()->compliance->get_option( $key, $default );
}

function azure_synthetics_get_product_meta_value( $product_id, $key, $default = '' ) {
	return azure_synthetics_core()->product_meta->get_value( $product_id, $key, $default );
}

function azure_synthetics_get_product_display_title( $product_id ) {
	return azure_synthetics_core()->product_meta->get_display_name( $product_id );
}

function azure_synthetics_get_product_sections( $product_id ) {
	return azure_synthetics_core()->product_meta->get_sections( $product_id );
}

function azure_synthetics_get_product_faqs( $product_id ) {
	return azure_synthetics_core()->product_meta->get_faqs( $product_id );
}
