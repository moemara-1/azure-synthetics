<?php
/**
 * Compliance settings management.
 *
 * @package AzureSyntheticsCore
 */

namespace AzureSynthetics\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Compliance {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Default settings.
	 *
	 * @return array<string, mixed>
	 */
	public static function defaults() {
		return array(
			'footer_disclaimer'         => 'For research use only. Not for human consumption.',
			'default_product_disclaimer'=> 'For research use only. Not for human or veterinary use. Not for diagnosis, treatment, injection, or consumption. Handle and store according to the published product guidance.',
			'default_shipping_note'     => 'Cold-chain shipping is reviewed for each qualified order. Inspect temperature-sensitive inventory immediately upon delivery and reconcile the lot reference with the supplied CoA.',
			'checkout_ack_label'        => 'I confirm this order is placed for lawful laboratory or research use only, and not for human consumption.',
			'catalog_gate_enabled'      => false,
		);
	}

	/**
	 * Build option key.
	 *
	 * @param string $key Key slug.
	 * @return string
	 */
	public static function option_key( $key ) {
		return 'azure_synthetics_' . $key;
	}

	/**
	 * Register submenu.
	 *
	 * @return void
	 */
	public function register_menu() {
		add_submenu_page(
			'woocommerce',
			__( 'Azure Synthetics', 'azure-synthetics-core' ),
			__( 'Azure Synthetics', 'azure-synthetics-core' ),
			'manage_woocommerce',
			'azure-synthetics-settings',
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Register settings.
	 *
	 * @return void
	 */
	public function register_settings() {
		foreach ( self::defaults() as $key => $default ) {
			register_setting(
				'azure_synthetics_settings',
				self::option_key( $key ),
				array(
					'type'              => is_bool( $default ) ? 'boolean' : 'string',
					'sanitize_callback' => is_bool( $default ) ? 'rest_sanitize_boolean' : 'sanitize_textarea_field',
					'default'           => $default,
				)
			);
		}
	}

	/**
	 * Return stored option.
	 *
	 * @param string $key Key slug.
	 * @param mixed  $default Default value.
	 * @return mixed
	 */
	public function get_option( $key, $default = '' ) {
		$defaults = self::defaults();

		if ( array_key_exists( $key, $defaults ) ) {
			$default = $defaults[ $key ];
		}

		return get_option( self::option_key( $key ), $default );
	}

	/**
	 * Render settings page.
	 *
	 * @return void
	 */
	public function render_settings_page() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Azure Synthetics settings', 'azure-synthetics-core' ); ?></h1>
			<form action="options.php" method="post">
				<?php settings_fields( 'azure_synthetics_settings' ); ?>
				<table class="form-table" role="presentation">
					<tbody>
						<tr>
							<th scope="row"><label for="azure_synthetics_footer_disclaimer"><?php esc_html_e( 'Footer disclaimer', 'azure-synthetics-core' ); ?></label></th>
							<td><textarea id="azure_synthetics_footer_disclaimer" class="large-text" rows="3" name="azure_synthetics_footer_disclaimer"><?php echo esc_textarea( $this->get_option( 'footer_disclaimer' ) ); ?></textarea></td>
						</tr>
						<tr>
							<th scope="row"><label for="azure_synthetics_default_product_disclaimer"><?php esc_html_e( 'Default product disclaimer', 'azure-synthetics-core' ); ?></label></th>
							<td><textarea id="azure_synthetics_default_product_disclaimer" class="large-text" rows="3" name="azure_synthetics_default_product_disclaimer"><?php echo esc_textarea( $this->get_option( 'default_product_disclaimer' ) ); ?></textarea></td>
						</tr>
						<tr>
							<th scope="row"><label for="azure_synthetics_default_shipping_note"><?php esc_html_e( 'Default shipping note', 'azure-synthetics-core' ); ?></label></th>
							<td><textarea id="azure_synthetics_default_shipping_note" class="large-text" rows="3" name="azure_synthetics_default_shipping_note"><?php echo esc_textarea( $this->get_option( 'default_shipping_note' ) ); ?></textarea></td>
						</tr>
						<tr>
							<th scope="row"><label for="azure_synthetics_checkout_ack_label"><?php esc_html_e( 'Checkout acknowledgment label', 'azure-synthetics-core' ); ?></label></th>
							<td><textarea id="azure_synthetics_checkout_ack_label" class="large-text" rows="3" name="azure_synthetics_checkout_ack_label"><?php echo esc_textarea( $this->get_option( 'checkout_ack_label' ) ); ?></textarea></td>
						</tr>
						<tr>
								<th scope="row"><?php esc_html_e( 'Catalog gate', 'azure-synthetics-core' ); ?></th>
							<td>
								<label for="azure_synthetics_catalog_gate_enabled">
									<input id="azure_synthetics_catalog_gate_enabled" type="checkbox" name="azure_synthetics_catalog_gate_enabled" value="1" <?php checked( (bool) $this->get_option( 'catalog_gate_enabled', false ) ); ?>>
									<?php esc_html_e( 'Enable a front-end acknowledgment overlay before product browsing.', 'azure-synthetics-core' ); ?>
								</label>
							</td>
						</tr>
					</tbody>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}
}
