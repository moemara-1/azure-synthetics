<?php
/**
 * Checkout compliance handling.
 *
 * @package AzureSyntheticsCore
 */

namespace AzureSynthetics\Core;

use WC_Order;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Checkout {
	/**
	 * Field key.
	 *
	 * @var string
	 */
	private $field_key = 'azure-synthetics/research-acknowledgment';

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

		add_action( 'woocommerce_init', array( $this, 'register_block_field' ) );
		add_filter( 'woocommerce_checkout_fields', array( $this, 'register_classic_field' ) );
		add_action( 'woocommerce_checkout_process', array( $this, 'validate_classic_field' ) );
		add_action( 'woocommerce_checkout_create_order', array( $this, 'save_classic_field' ) );
		add_action( 'woocommerce_set_additional_field_value', array( $this, 'sync_block_field' ), 10, 4 );
		add_action( 'woocommerce_admin_order_data_after_billing_address', array( $this, 'render_admin_meta' ) );
		add_action( 'woocommerce_email_after_order_table', array( $this, 'render_email_meta' ), 20, 4 );
	}

	/**
	 * Register block checkout field.
	 *
	 * @return void
	 */
	public function register_block_field() {
		if ( ! function_exists( 'woocommerce_register_additional_checkout_field' ) ) {
			return;
		}

		woocommerce_register_additional_checkout_field(
			array(
				'id'            => $this->field_key,
				'label'         => $this->compliance->get_option( 'checkout_ack_label' ),
				'optionalLabel' => $this->compliance->get_option( 'checkout_ack_label' ),
				'location'      => 'order',
				'type'          => 'checkbox',
				'required'      => true,
			)
		);
	}

	/**
	 * Register classic checkout field.
	 *
	 * @param array $fields Existing checkout fields.
	 * @return array
	 */
	public function register_classic_field( $fields ) {
		$fields['order']['azure_research_acknowledgment'] = array(
			'type'     => 'checkbox',
			'label'    => $this->compliance->get_option( 'checkout_ack_label' ),
			'required' => true,
			'class'    => array( 'form-row-wide' ),
			'priority' => 120,
		);

		return $fields;
	}

	/**
	 * Validate classic shortcode checkout field.
	 *
	 * @return void
	 */
	public function validate_classic_field() {
		if ( ! isset( $_POST['azure_research_acknowledgment'] ) ) {
			wc_add_notice( __( 'You must confirm the research-use acknowledgment before checkout.', 'azure-synthetics-core' ), 'error' );
		}
	}

	/**
	 * Save classic field value.
	 *
	 * @param WC_Order $order Current order.
	 * @return void
	 */
	public function save_classic_field( $order ) {
		if ( isset( $_POST['azure_research_acknowledgment'] ) ) {
			$order->update_meta_data( '_azure_research_acknowledgment', 'yes' );
		}
	}

	/**
	 * Sync block checkout field into a readable meta key.
	 *
	 * @param string $key Registered field key.
	 * @param mixed  $value Saved value.
	 * @param string $group Field location group.
	 * @param mixed  $wc_object Woo object.
	 * @return void
	 */
	public function sync_block_field( $key, $value, $group, $wc_object ) {
		if ( $this->field_key !== $key || ! is_object( $wc_object ) || ! method_exists( $wc_object, 'update_meta_data' ) ) {
			return;
		}

		$wc_object->update_meta_data( '_azure_research_acknowledgment', $value ? 'yes' : 'no', true );
	}

	/**
	 * Render saved value in the order admin.
	 *
	 * @param WC_Order $order Order object.
	 * @return void
	 */
	public function render_admin_meta( $order ) {
		$value = $order->get_meta( '_azure_research_acknowledgment' );

		if ( ! $value ) {
			return;
		}
		?>
		<p><strong><?php esc_html_e( 'Research acknowledgment:', 'azure-synthetics-core' ); ?></strong> <?php echo esc_html( ucfirst( $value ) ); ?></p>
		<?php
	}

	/**
	 * Render order email note.
	 *
	 * @param WC_Order $order Order object.
	 * @param bool     $sent_to_admin Admin email flag.
	 * @param bool     $plain_text Plain text flag.
	 * @param mixed    $email Email object.
	 * @return void
	 */
	public function render_email_meta( $order, $sent_to_admin, $plain_text, $email ) {
		$value = $order->get_meta( '_azure_research_acknowledgment' );

		if ( 'yes' !== $value ) {
			return;
		}

		$message = $this->compliance->get_option( 'default_product_disclaimer' );

		if ( $plain_text ) {
			echo "\n" . wp_strip_all_tags( $message ) . "\n";
			return;
		}
		?>
		<p style="margin-top:20px;font-size:13px;color:#52697B;"><?php echo esc_html( $message ); ?></p>
		<?php
	}
}
