<?php
/**
 * Configure launch-critical WooCommerce operations defaults.
 *
 * Run with: wp eval-file scripts/wp-configure-launch.php --allow-root
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

update_option( 'admin_email', 'orders@azuresynthetics.com' );
update_option( 'woocommerce_email_from_name', 'Azure Synthetics' );
update_option( 'woocommerce_email_from_address', 'orders@azuresynthetics.com' );
update_option( 'woocommerce_currency', 'USD' );
update_option( 'woocommerce_default_country', 'US:CA' );
update_option( 'woocommerce_calc_shipping', 'yes' );
update_option( 'woocommerce_ship_to_destination', 'shipping' );

$bacs_settings = get_option( 'woocommerce_bacs_settings', array() );

if ( ! is_array( $bacs_settings ) ) {
	$bacs_settings = array();
}

$bacs_settings['enabled']      = 'yes';
$bacs_settings['title']        = 'Manual invoice review';
$bacs_settings['description']  = 'Submit your order for availability, documentation, payment, and shipping review. Azure Synthetics will confirm final payment instructions before fulfillment.';
$bacs_settings['instructions'] = 'Your order has been received for manual review. Do not send payment until Azure Synthetics confirms the lot reference, documentation path, shipping method, and final invoice.';

update_option( 'woocommerce_bacs_settings', $bacs_settings );

foreach ( array( 'cheque', 'cod' ) as $gateway_id ) {
	$settings = get_option( 'woocommerce_' . $gateway_id . '_settings', array() );

	if ( ! is_array( $settings ) ) {
		$settings = array();
	}

	$settings['enabled'] = 'no';
	update_option( 'woocommerce_' . $gateway_id . '_settings', $settings );
}

function azure_launch_find_shipping_zone_id( $zone_name ) {
	foreach ( WC_Shipping_Zones::get_zones() as $zone ) {
		if ( isset( $zone['zone_name'], $zone['zone_id'] ) && $zone_name === $zone['zone_name'] ) {
			return (int) $zone['zone_id'];
		}
	}

	return 0;
}

function azure_launch_configure_flat_rate_method( WC_Shipping_Zone $zone, $title, $cost = '0' ) {
	foreach ( $zone->get_shipping_methods( true ) as $method ) {
		if ( 'flat_rate' !== $method->id ) {
			$zone->delete_shipping_method( $method->instance_id );
		}
	}

	$flat_rate = null;

	foreach ( $zone->get_shipping_methods( true ) as $method ) {
		if ( 'flat_rate' === $method->id ) {
			$flat_rate = $method;
			break;
		}
	}

	if ( ! $flat_rate ) {
		$instance_id = $zone->add_shipping_method( 'flat_rate' );
		$flat_rate   = WC_Shipping_Zones::get_shipping_method( $instance_id );
	}

	if ( ! $flat_rate ) {
		return;
	}

	$settings = get_option( $flat_rate->get_instance_option_key(), array() );

	if ( ! is_array( $settings ) ) {
		$settings = array();
	}

	$settings['title']      = $title;
	$settings['tax_status'] = 'none';
	$settings['cost']       = $cost;

	update_option( $flat_rate->get_instance_option_key(), $settings );
}

function azure_launch_configure_shipping_zone( $zone_name, $country_code, $order ) {
	$zone_id = azure_launch_find_shipping_zone_id( $zone_name );
	$zone    = $zone_id ? new WC_Shipping_Zone( $zone_id ) : new WC_Shipping_Zone();

	$zone->set_zone_name( $zone_name );
	$zone->set_zone_order( $order );
	$zone->clear_locations();
	$zone->add_location( $country_code, 'country' );
	$zone->save();

	azure_launch_configure_flat_rate_method( $zone, 'Shipping quoted after review' );
}

azure_launch_configure_shipping_zone( 'United States research shipments', 'US', 1 );
azure_launch_configure_shipping_zone( 'Egypt research shipments', 'EG', 2 );

$rest_zone = new WC_Shipping_Zone( 0 );
azure_launch_configure_flat_rate_method( $rest_zone, 'International shipping quoted after review' );

if ( function_exists( 'wc_delete_product_transients' ) ) {
	wc_delete_product_transients();
}

if ( class_exists( 'WP_CLI' ) ) {
	WP_CLI::success( 'Azure Synthetics launch defaults configured.' );
}
