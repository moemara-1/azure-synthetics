<?php
/**
 * Product metadata registration and rendering.
 *
 * @package AzureSyntheticsCore
 */

namespace AzureSynthetics\Core;

use WC_Product;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Product_Meta {
	/**
	 * Field definitions.
	 *
	 * @var array<string, array<string, string>>
	 */
	private $fields = array(
		'subtitle'                => array(
			'meta_key' => '_azure_subtitle',
			'label'    => 'Subtitle',
			'type'     => 'text',
		),
		'lab_descriptor'          => array(
			'meta_key' => '_azure_lab_descriptor',
			'label'    => 'Short lab descriptor',
			'type'     => 'text',
		),
		'purity_percent'          => array(
			'meta_key' => '_azure_purity_percent',
			'label'    => 'Purity %',
			'type'     => 'text',
		),
		'form_factor'             => array(
			'meta_key' => '_azure_form_factor',
			'label'    => 'Form factor',
			'type'     => 'text',
		),
		'vial_amount'             => array(
			'meta_key' => '_azure_vial_amount',
			'label'    => 'Vial amount',
			'type'     => 'text',
		),
		'storage_instructions'    => array(
			'meta_key' => '_azure_storage_instructions',
			'label'    => 'Storage instructions',
			'type'     => 'textarea',
		),
		'shipping_warning'        => array(
			'meta_key' => '_azure_shipping_warning',
			'label'    => 'Shipping/storage warning',
			'type'     => 'textarea',
		),
		'batch_reference'         => array(
			'meta_key' => '_azure_batch_reference',
			'label'    => 'Batch/testing reference',
			'type'     => 'text',
		),
		'reconstitution_guidance' => array(
			'meta_key' => '_azure_reconstitution_guidance',
			'label'    => 'Lab handling guidance',
			'type'     => 'textarea',
		),
		'mechanism_summary'       => array(
			'meta_key' => '_azure_mechanism_summary',
			'label'    => 'Mechanism summary',
			'type'     => 'textarea',
		),
		'verification_route'      => array(
			'meta_key' => '_azure_verification_route',
			'label'    => 'Verification route',
			'type'     => 'textarea',
		),
		'fulfillment_note'        => array(
			'meta_key' => '_azure_fulfillment_note',
			'label'    => 'Fulfillment note',
			'type'     => 'textarea',
		),
		'research_signals'        => array(
			'meta_key' => '_azure_research_signals',
			'label'    => 'Researched possible therapeutic effects',
			'type'     => 'textarea',
		),
		'research_disclaimer'     => array(
			'meta_key' => '_azure_research_disclaimer',
			'label'    => 'Research use notice',
			'type'     => 'textarea',
		),
	);

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_meta' ) );
		add_action( 'add_meta_boxes_product', array( $this, 'register_meta_boxes' ) );
		add_action( 'save_post_product', array( $this, 'save_meta_boxes' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
	}

	/**
	 * Register post meta.
	 *
	 * @return void
	 */
	public function register_meta() {
		foreach ( $this->fields as $field ) {
			register_post_meta(
				'product',
				$field['meta_key'],
				array(
					'type'              => 'string',
					'single'            => true,
					'show_in_rest'      => true,
					'sanitize_callback' => 'sanitize_textarea_field',
				)
			);
		}

		register_post_meta(
			'product',
			'_azure_product_faqs',
			array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => 'wp_kses_post',
			)
		);
	}

	/**
	 * Register admin meta boxes.
	 *
	 * @return void
	 */
	public function register_meta_boxes() {
		add_meta_box(
			'azure-research-data',
			__( 'Azure research data', 'azure-synthetics-core' ),
			array( $this, 'render_fields_meta_box' ),
			'product',
			'normal',
			'high'
		);

		add_meta_box(
			'azure-product-faqs',
			__( 'Buyer FAQ accordion', 'azure-synthetics-core' ),
			array( $this, 'render_faq_meta_box' ),
			'product',
			'normal',
			'default'
		);
	}

	/**
	 * Render fields meta box.
	 *
	 * @param \WP_Post $post Current post.
	 * @return void
	 */
	public function render_fields_meta_box( $post ) {
		wp_nonce_field( 'azure_research_data', 'azure_research_data_nonce' );
		?>
		<div class="azure-admin-grid">
			<?php foreach ( $this->fields as $field_key => $field ) : ?>
				<label class="azure-admin-field">
					<span><?php echo esc_html( $field['label'] ); ?></span>
					<?php if ( 'textarea' === $field['type'] ) : ?>
						<textarea name="azure_research_data[<?php echo esc_attr( $field_key ); ?>]" rows="4"><?php echo esc_textarea( get_post_meta( $post->ID, $field['meta_key'], true ) ); ?></textarea>
					<?php else : ?>
						<input type="text" name="azure_research_data[<?php echo esc_attr( $field_key ); ?>]" value="<?php echo esc_attr( get_post_meta( $post->ID, $field['meta_key'], true ) ); ?>">
					<?php endif; ?>
				</label>
			<?php endforeach; ?>
		</div>
		<p class="description"><?php esc_html_e( 'Use WooCommerce attributes for filterable options like vial size, quantity, and pack size. These fields handle descriptive, compliance, and content-block data.', 'azure-synthetics-core' ); ?></p>
		<?php
	}

	/**
	 * Render FAQ meta box.
	 *
	 * @param \WP_Post $post Current product.
	 * @return void
	 */
	public function render_faq_meta_box( $post ) {
		$faqs = $this->get_faqs( $post->ID );

		if ( empty( $faqs ) ) {
			$faqs = array(
				array(
					'question' => '',
					'answer'   => '',
				),
			);
		}
		?>
		<div class="azure-faq-repeater" data-azure-faq-repeater>
			<?php foreach ( $faqs as $index => $faq ) : ?>
				<div class="azure-faq-repeater__row">
					<label class="azure-admin-field">
						<span><?php esc_html_e( 'Question', 'azure-synthetics-core' ); ?></span>
						<input type="text" name="azure_product_faqs[<?php echo esc_attr( $index ); ?>][question]" value="<?php echo esc_attr( $faq['question'] ?? '' ); ?>">
					</label>
					<label class="azure-admin-field">
						<span><?php esc_html_e( 'Answer', 'azure-synthetics-core' ); ?></span>
						<textarea name="azure_product_faqs[<?php echo esc_attr( $index ); ?>][answer]" rows="3"><?php echo esc_textarea( $faq['answer'] ?? '' ); ?></textarea>
					</label>
					<button type="button" class="button button-secondary" data-azure-remove-faq><?php esc_html_e( 'Remove row', 'azure-synthetics-core' ); ?></button>
				</div>
			<?php endforeach; ?>
		</div>
		<p><button type="button" class="button" data-azure-add-faq><?php esc_html_e( 'Add FAQ row', 'azure-synthetics-core' ); ?></button></p>
		<script type="text/template" id="azure-faq-row-template">
			<div class="azure-faq-repeater__row">
				<label class="azure-admin-field">
					<span><?php esc_html_e( 'Question', 'azure-synthetics-core' ); ?></span>
					<input type="text" name="azure_product_faqs[__index__][question]" value="">
				</label>
				<label class="azure-admin-field">
					<span><?php esc_html_e( 'Answer', 'azure-synthetics-core' ); ?></span>
					<textarea name="azure_product_faqs[__index__][answer]" rows="3"></textarea>
				</label>
				<button type="button" class="button button-secondary" data-azure-remove-faq><?php esc_html_e( 'Remove row', 'azure-synthetics-core' ); ?></button>
			</div>
		</script>
		<?php
	}

	/**
	 * Save product metadata.
	 *
	 * @param int $post_id Product ID.
	 * @return void
	 */
	public function save_meta_boxes( $post_id ) {
		if ( ! isset( $_POST['azure_research_data_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['azure_research_data_nonce'] ) ), 'azure_research_data' ) ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$submitted = isset( $_POST['azure_research_data'] ) ? (array) wp_unslash( $_POST['azure_research_data'] ) : array();

		foreach ( $this->fields as $field_key => $field ) {
			$value = isset( $submitted[ $field_key ] ) ? $submitted[ $field_key ] : '';
			$value = 'textarea' === $field['type'] ? sanitize_textarea_field( $value ) : sanitize_text_field( $value );
			update_post_meta( $post_id, $field['meta_key'], $value );
		}

		$faqs          = isset( $_POST['azure_product_faqs'] ) ? (array) wp_unslash( $_POST['azure_product_faqs'] ) : array();
		$cleaned_faqs  = array();

		foreach ( $faqs as $faq ) {
			$question = sanitize_text_field( $faq['question'] ?? '' );
			$answer   = sanitize_textarea_field( $faq['answer'] ?? '' );

			if ( '' === $question && '' === $answer ) {
				continue;
			}

			$cleaned_faqs[] = array(
				'question' => $question,
				'answer'   => $answer,
			);
		}

		update_post_meta( $post_id, '_azure_product_faqs', wp_json_encode( $cleaned_faqs ) );
	}

	/**
	 * Enqueue admin assets.
	 *
	 * @param string $hook Current admin hook.
	 * @return void
	 */
	public function enqueue_admin_assets( $hook ) {
		global $post_type;

		if ( 'product' !== $post_type || ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
			return;
		}

		wp_enqueue_style(
			'azure-synthetics-core-admin',
			AZURE_SYNTHETICS_CORE_URL . 'assets/css/admin.css',
			array(),
			AZURE_SYNTHETICS_CORE_VERSION
		);
		wp_enqueue_script(
			'azure-synthetics-core-admin',
			AZURE_SYNTHETICS_CORE_URL . 'assets/js/admin-faq-repeater.js',
			array(),
			AZURE_SYNTHETICS_CORE_VERSION,
			true
		);
	}

	/**
	 * Get field value.
	 *
	 * @param int    $product_id Product ID.
	 * @param string $key Field key.
	 * @param string $default Default value.
	 * @return string
	 */
	public function get_value( $product_id, $key, $default = '' ) {
		if ( ! isset( $this->fields[ $key ] ) ) {
			return $default;
		}

		if ( function_exists( 'azure_synthetics_current_language' ) && 'ar' === azure_synthetics_current_language() ) {
			$localized = get_post_meta( $product_id, '_azure_' . $key . '_ar', true );

			if ( '' !== $localized ) {
				return $localized;
			}
		}

		$value = get_post_meta( $product_id, $this->fields[ $key ]['meta_key'], true );

		if ( $value ) {
			return $value;
		}

		if ( function_exists( 'azure_synthetics_catalog_product_profile_for_product_id' ) ) {
			$profile = azure_synthetics_catalog_product_profile_for_product_id( $product_id );
			$map     = array(
				'mechanism_summary'  => 'mechanism',
				'verification_route' => 'verification',
				'fulfillment_note'   => 'fulfillment',
				'research_signals'   => 'signals',
			);

			if ( isset( $map[ $key ], $profile[ $map[ $key ] ] ) ) {
				return is_array( $profile[ $map[ $key ] ] ) ? implode( "\n", $profile[ $map[ $key ] ] ) : (string) $profile[ $map[ $key ] ];
			}
		}

		$product = wc_get_product( $product_id );

		if ( ! $product instanceof WC_Product ) {
			return $default;
		}

		if ( 'form_factor' === $key ) {
			return $this->get_attribute_fallback( $product, array( 'pa_form-factor', 'Form Factor' ) ) ?: $default;
		}

		if ( 'vial_amount' === $key ) {
			return $this->get_attribute_fallback( $product, array( 'pa_vial-size', 'Vial Size' ) ) ?: $default;
		}

		return $default;
	}

	/**
	 * Return structured product sections.
	 *
	 * @param int $product_id Product ID.
	 * @return array<int, array<string, string>>
	 */
	public function get_sections( $product_id ) {
		$map = array(
			'purity_percent'          => __( 'Purity', 'azure-synthetics-core' ),
			'form_factor'             => __( 'Form', 'azure-synthetics-core' ),
			'vial_amount'             => __( 'Vial amount', 'azure-synthetics-core' ),
			'storage_instructions'    => __( 'Storage', 'azure-synthetics-core' ),
			'mechanism_summary'       => __( 'Mechanism', 'azure-synthetics-core' ),
			'verification_route'      => __( 'Verification route', 'azure-synthetics-core' ),
			'reconstitution_guidance' => __( 'Lab handling', 'azure-synthetics-core' ),
			'shipping_warning'        => __( 'Shipping notes', 'azure-synthetics-core' ),
			'batch_reference'         => __( 'Batch reference', 'azure-synthetics-core' ),
			'fulfillment_note'        => __( 'Fulfillment review', 'azure-synthetics-core' ),
		);

		$sections = array();

		foreach ( $map as $key => $label ) {
			$value = $this->get_value( $product_id, $key, '' );

			if ( '' === $value ) {
				continue;
			}

			$sections[] = array(
				'key'   => $key,
				'label' => $label,
				'value' => $value,
			);
		}

		return $sections;
	}

	/**
	 * Return product research signal bullets.
	 *
	 * @param int $product_id Product ID.
	 * @return array<int, string>
	 */
	public function get_research_signals( $product_id ) {
		$raw = $this->get_value( $product_id, 'research_signals', '' );

		if ( '' === $raw ) {
			return array();
		}

		$signals = preg_split( '/\r\n|\r|\n/', $raw );
		$signals = array_map( 'trim', is_array( $signals ) ? $signals : array() );
		$signals = array_filter( $signals );

		return array_values( $signals );
	}

	/**
	 * Return decoded FAQ rows.
	 *
	 * @param int $product_id Product ID.
	 * @return array<int, array<string, string>>
	 */
	public function get_faqs( $product_id ) {
		$raw = get_post_meta( $product_id, '_azure_product_faqs', true );

		if ( ! $raw ) {
			return array();
		}

		$decoded = json_decode( $raw, true );

		return is_array( $decoded ) ? $decoded : array();
	}

	/**
	 * Get attribute fallback value.
	 *
	 * @param WC_Product $product Product instance.
	 * @param array      $keys Candidate keys.
	 * @return string
	 */
	private function get_attribute_fallback( WC_Product $product, array $keys ) {
		foreach ( $keys as $key ) {
			$value = $product->get_attribute( $key );

			if ( $value ) {
				return $value;
			}
		}

		return '';
	}
}
