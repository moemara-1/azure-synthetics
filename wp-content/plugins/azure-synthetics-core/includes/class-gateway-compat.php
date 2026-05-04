<?php
/**
 * Future gateway compatibility extension point.
 *
 * @package AzureSyntheticsCore
 */

namespace AzureSynthetics\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Gateway_Compat {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'woocommerce_available_payment_gateways', array( $this, 'remove_manual_gateways' ) );
	}

	/**
	 * Remove offline/manual gateways until a real payment integration is configured.
	 *
	 * @param array $gateways Available gateways keyed by gateway ID.
	 * @return array
	 */
	public function remove_manual_gateways( $gateways ) {
		foreach ( array( 'bacs', 'cheque', 'cod' ) as $gateway_id ) {
			unset( $gateways[ $gateway_id ] );
		}

		return $gateways;
	}
}
