<?php
/**
 * Email branding helpers.
 *
 * @package AzureSyntheticsCore
 */

namespace AzureSynthetics\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Email_Branding {
	/**
	 * Compliance settings.
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

		add_filter( 'woocommerce_email_footer_text', array( $this, 'filter_footer_text' ) );
	}

	/**
	 * Filter email footer text.
	 *
	 * @param string $footer Existing footer text.
	 * @return string
	 */
	public function filter_footer_text( $footer ) {
		return $footer . ' | ' . $this->compliance->get_option( 'footer_disclaimer' );
	}
}
