<?php
/**
 * Gateway compatibility.
 *
 * @package AzureSyntheticsCore
 */

namespace AzureSynthetics\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Gateway_Compat {
	/**
	 * Compliance manager.
	 *
	 * @var Compliance
	 */
	private $compliance;

	/**
	 * Constructor.
	 *
	 * @param Compliance $compliance Compliance manager.
	 */
	public function __construct( Compliance $compliance ) {
		$this->compliance = $compliance;

		add_action( 'woocommerce_review_order_before_payment', array( $this, 'render_gateway_notice' ), 5 );
	}

	/**
	 * Render gateway notice for shortcode checkout fallback.
	 *
	 * @return void
	 */
	public function render_gateway_notice() {
		return;
	}
}
