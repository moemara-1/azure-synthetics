<?php
/**
 * Core plugin bootstrapper.
 *
 * @package AzureSyntheticsCore
 */

namespace AzureSynthetics\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin {
	/**
	 * Singleton instance.
	 *
	 * @var Plugin|null
	 */
	private static $instance;

	/**
	 * Product meta manager.
	 *
	 * @var Product_Meta
	 */
	public $product_meta;

	/**
	 * Compliance settings manager.
	 *
	 * @var Compliance
	 */
	public $compliance;

	/**
	 * Checkout manager.
	 *
	 * @var Checkout
	 */
	public $checkout;

	/**
	 * Gateway compatibility manager.
	 *
	 * @var Gateway_Compat
	 */
	public $gateway_compat;

	/**
	 * Email branding manager.
	 *
	 * @var Email_Branding
	 */
	public $email_branding;

	/**
	 * Return the singleton instance.
	 *
	 * @return Plugin
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->product_meta   = new Product_Meta();
		$this->compliance     = new Compliance();
		$this->checkout       = new Checkout( $this->compliance );
		$this->gateway_compat = new Gateway_Compat();
		$this->email_branding = new Email_Branding( $this->compliance );

		register_activation_hook( AZURE_SYNTHETICS_CORE_FILE, array( __CLASS__, 'activate' ) );
	}

	/**
	 * Activation callback.
	 *
	 * @return void
	 */
	public static function activate() {
		foreach ( Compliance::defaults() as $key => $value ) {
			if ( false === get_option( Compliance::option_key( $key ), false ) ) {
				update_option( Compliance::option_key( $key ), $value );
			}
		}

		update_option( 'woocommerce_enable_guest_checkout', 'yes' );
		update_option( 'woocommerce_enable_signup_and_login_from_checkout', 'yes' );
		update_option( 'woocommerce_enable_myaccount_registration', 'yes' );
		update_option( 'woocommerce_registration_generate_username', 'yes' );
		update_option( 'woocommerce_registration_generate_password', 'yes' );
		update_option( 'woocommerce_cart_redirect_after_add', 'no' );
	}
}
