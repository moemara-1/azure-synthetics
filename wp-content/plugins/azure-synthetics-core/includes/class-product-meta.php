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
		'compound_alias'          => array(
			'meta_key' => '_azure_compound_alias',
			'label'    => 'Compound alias',
			'type'     => 'text',
		),
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
		'research_summary'        => array(
			'meta_key' => '_azure_research_summary',
			'label'    => 'Research summary',
			'type'     => 'textarea',
		),
		'evidence_tier'           => array(
			'meta_key' => '_azure_evidence_tier',
			'label'    => 'Evidence tier',
			'type'     => 'text',
		),
		'mechanism_summary'       => array(
			'meta_key' => '_azure_mechanism_summary',
			'label'    => 'Mechanism summary',
			'type'     => 'textarea',
		),
		'documentation_status'    => array(
			'meta_key' => '_azure_documentation_status',
			'label'    => 'Documentation status',
			'type'     => 'text',
		),
		'proof_surface_label'     => array(
			'meta_key' => '_azure_proof_surface_label',
			'label'    => 'Proof surface label',
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
			'label'    => 'Reconstitution guidance',
			'type'     => 'textarea',
		),
		'research_disclaimer'     => array(
			'meta_key' => '_azure_research_disclaimer',
			'label'    => 'Research disclaimer',
			'type'     => 'textarea',
		),
		'seo_focus_keyphrase'     => array(
			'meta_key' => '_azure_seo_focus_keyphrase',
			'label'    => 'SEO focus keyphrase',
			'type'     => 'text',
		),
		'meta_description'        => array(
			'meta_key' => '_azure_meta_description',
			'label'    => 'Meta description',
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
					'sanitize_callback' => 'textarea' === $field['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field',
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
			__( 'Product FAQ accordion', 'azure-synthetics-core' ),
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
		<p class="description"><?php esc_html_e( 'Use WooCommerce attributes for filterable options like vial size, quantity, and pack size. These fields handle research details, SEO, compliance, and product-story data.', 'azure-synthetics-core' ); ?></p>
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

		$value = get_post_meta( $product_id, $this->fields[ $key ]['meta_key'], true );

		if ( $value ) {
			return $this->normalize_legacy_value( $key, $value );
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

		$profile = $this->get_product_profile_defaults( $product_id );

		if ( isset( $profile[ $key ] ) && '' !== $profile[ $key ] ) {
			return $profile[ $key ];
		}

		return $default;
	}

	/**
	 * Keep older seeded database rows aligned with the current public copy.
	 *
	 * @param string $key Field key.
	 * @param string $value Stored value.
	 * @return string
	 */
	private function normalize_legacy_value( $key, $value ) {
		$legacy_values = array(
			'research_disclaimer' => array(
				'For research use only. Not for human consumption.' => 'For laboratory research use only. Not for human or veterinary use.',
			),
			'lab_descriptor'      => array(
				'Recovery / repair'  => 'Recovery + repair',
				'Longevity + energy' => 'Mitochondrial research',
				'Body composition'   => 'Metabolic research',
			),
			'research_summary'    => array(
				'BPC-157 for buyers comparing repair-focused peptides, lyophilized format, purity range, storage notes, and documentation support before ordering.' => 'BPC-157 for buyers comparing repair-category peptides, lyophilized format, vial amount, storage notes, and documentation support before ordering.',
			),
			'proof_surface_label' => array(
				'Batch-linked support, purity range, and handling notes are available through the desk.' => 'Batch-linked support, vial amount, and handling notes are available through the desk.',
				'Flagship research summary, purity cue, refrigerated-handling guidance, and documentation availability are visible on-page.' => 'Flagship research summary, vial amount, refrigerated-handling guidance, and documentation availability are visible on-page.',
			),
			'mechanism_summary'   => array(
				'The research context can reference endocrine signaling literature and stack architecture while avoiding body-composition, anti-aging, or performance promises.' => 'The research context can reference endocrine signaling literature and stack architecture while avoiding transformation, anti-aging, or performance promises.',
			),
			'meta_description'    => array(
				'Shop BPC-157 research peptide with lyophilized format, purity cues, handling notes, documentation options, and RUO-first product details.' => 'Shop BPC-157 research peptide with lyophilized format, handling notes, documentation options, and RUO-first product details.',
			),
		);

		if ( isset( $legacy_values[ $key ][ $value ] ) ) {
			return $legacy_values[ $key ][ $value ];
		}

		return $value;
	}

	/**
	 * Return the preferred storefront title for a product.
	 *
	 * @param int $product_id Product ID.
	 * @return string
	 */
	public function get_display_name( $product_id ) {
		$profile = $this->get_product_profile_defaults( $product_id );

		if ( ! empty( $profile['title'] ) ) {
			return $profile['title'];
		}

		$product = wc_get_product( $product_id );

		if ( $product instanceof WC_Product ) {
			return $product->get_name();
		}

		return get_the_title( $product_id );
	}

	/**
	 * Return structured product sections.
	 *
	 * @param int $product_id Product ID.
	 * @return array<int, array<string, string>>
	 */
	public function get_sections( $product_id ) {
		$map = array(
			'evidence_tier'           => __( 'Evidence tier', 'azure-synthetics-core' ),
			'documentation_status'    => __( 'Documentation status', 'azure-synthetics-core' ),
			'proof_surface_label'     => __( 'Proof surface', 'azure-synthetics-core' ),
			'purity_percent'          => __( 'Purity', 'azure-synthetics-core' ),
			'storage_instructions'    => __( 'Storage', 'azure-synthetics-core' ),
			'reconstitution_guidance' => __( 'Reconstitution', 'azure-synthetics-core' ),
			'shipping_warning'        => __( 'Shipping notes', 'azure-synthetics-core' ),
			'batch_reference'         => __( 'Batch reference', 'azure-synthetics-core' ),
			'research_disclaimer'     => __( 'Research disclaimer', 'azure-synthetics-core' ),
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
	 * Return decoded FAQ rows.
	 *
	 * @param int $product_id Product ID.
	 * @return array<int, array<string, string>>
	 */
	public function get_faqs( $product_id ) {
		$raw = get_post_meta( $product_id, '_azure_product_faqs', true );

		if ( ! $raw ) {
			$profile = $this->get_product_profile_defaults( $product_id );
			return ! empty( $profile['faqs'] ) && is_array( $profile['faqs'] ) ? $profile['faqs'] : array();
		}

		$decoded = json_decode( $raw, true );

		return is_array( $decoded ) ? $decoded : array();
	}

	/**
	 * Return curated storefront defaults for known demo products when the DB is stale.
	 *
	 * @param int $product_id Product ID.
	 * @return array<string, mixed>
	 */
	private function get_product_profile_defaults( $product_id ) {
		static $profiles = null;

		if ( null === $profiles ) {
			$bpc_profile = array(
				'title'                  => 'BPC-157',
				'compound_alias'         => 'Body Protection Compound 157',
				'subtitle'               => 'Lyophilized repair peptide for lab research',
				'lab_descriptor'         => 'Recovery + repair',
				'research_summary'       => 'BPC-157 for buyers comparing repair-category peptides, lyophilized format, vial amount, storage notes, and documentation support before ordering.',
				'evidence_tier'          => 'Tier C',
				'mechanism_summary'      => 'BPC-157 belongs in an investigational repair context with musculoskeletal and cytoprotective literature references, not promised human outcomes.',
				'documentation_status'   => 'Available on request',
				'proof_surface_label'    => 'Batch-linked support, vial amount, and handling notes are available through the desk.',
				'purity_percent'         => '99.1%-99.6%',
				'form_factor'            => 'Lyophilized powder',
				'vial_amount'            => '10 mg',
				'storage_instructions'   => 'Store frozen for long-term stability; refrigerate after reconstitution when applicable.',
				'shipping_warning'       => 'Cold-chain stabilizing pack included on every order.',
				'batch_reference'        => 'Lot-linked support language available through the desk.',
				'reconstitution_guidance'=> 'Use only validated sterile lab diluent according to your internal protocol.',
				'research_disclaimer'    => 'For laboratory research use only. Not for human or veterinary use.',
				'seo_focus_keyphrase'    => 'BPC-157 research peptide',
				'meta_description'       => 'Shop BPC-157 research peptide with lyophilized format, handling notes, documentation options, and RUO-first product details.',
				'faqs'                   => array(
					array(
						'question' => 'How should a buyer read this page?',
						'answer'   => 'Start with the evidence tier and documentation availability. This SKU is intentionally centered on research context and handling discipline rather than outcome promises.',
					),
					array(
						'question' => 'Is the vial pre-mixed?',
						'answer'   => 'No. The default catalog presentation is lyophilized powder unless a product explicitly states another form factor.',
					),
				),
			);

			$motsc_profile = array(
				'title'                  => 'MOTS-c',
				'compound_alias'         => 'Mitochondrial-derived peptide MOTS-c',
				'subtitle'               => 'Lyophilized mitochondrial research peptide',
				'lab_descriptor'         => 'Mitochondrial research',
				'research_summary'       => 'MOTS-c for buyers comparing mitochondrial research peptides, lyophilized format, storage notes, documentation support, and evidence tier.',
				'evidence_tier'          => 'Tier C',
				'mechanism_summary'      => 'MOTS-c is best understood through metabolic and mitochondrial literature context rather than promises about energy, fat loss, or lifespan outcomes.',
				'documentation_status'   => 'Available on request',
				'proof_surface_label'    => 'Research summary, handling guidance, and batch-support path are shown early; deeper documentation is supported through the desk.',
				'purity_percent'         => '98.8%-99.4%',
				'form_factor'            => 'Lyophilized powder',
				'vial_amount'            => '10 mg',
				'storage_instructions'   => 'Freeze unopened inventory and minimize repeated temperature cycling.',
				'shipping_warning'       => 'Insulated packaging used for transit stability.',
				'batch_reference'        => 'Lot-linked analytical release context available on request.',
				'reconstitution_guidance'=> 'Follow validated internal handling procedures only.',
				'research_disclaimer'    => 'For laboratory research use only. Not for human or veterinary use.',
				'seo_focus_keyphrase'    => 'MOTS-c research peptide',
				'meta_description'       => 'Explore MOTS-c research peptide with lyophilized format, mechanism summary, documentation options, storage notes, and RUO-first product guidance.',
				'faqs'                   => array(
					array(
						'question' => 'Why is the language more restrained here?',
						'answer'   => 'This category has meaningful mechanistic and preclinical literature, but product language still avoids direct human outcome promises.',
					),
				),
			);

			$cjc_profile = array(
				'title'                  => 'CJC-1295 / Ipamorelin',
				'compound_alias'         => 'CJC-1295 / Ipamorelin stack',
				'subtitle'               => 'Dual-vial GH secretagogue stack',
				'lab_descriptor'         => 'Recovery + repair',
				'research_summary'       => 'CJC-1295 / Ipamorelin for buyers comparing dual-vial GH secretagogue stacks, component identity, storage notes, and documentation availability.',
				'evidence_tier'          => 'Tier B',
				'mechanism_summary'      => 'The research context can reference endocrine signaling literature and stack architecture while avoiding transformation, anti-aging, or performance promises.',
				'documentation_status'   => 'Available on request',
				'proof_surface_label'    => 'Paired component context, handling guidance, and repeat-buyer support are available through the desk.',
				'purity_percent'         => '97.9%-99.1%',
				'form_factor'            => 'Dual-vial kit',
				'vial_amount'            => '5 mg / 5 mg',
				'storage_instructions'   => 'Store at frozen temperatures until validated use.',
				'shipping_warning'       => 'Ships in insulated kit packaging.',
				'batch_reference'        => 'Paired analytical context available on request.',
				'reconstitution_guidance'=> 'Reference internal SOPs for multi-vial handling.',
				'research_disclaimer'    => 'For laboratory research use only. Not for human or veterinary use.',
				'seo_focus_keyphrase'    => 'CJC-1295 Ipamorelin research peptide',
				'meta_description'       => 'View CJC-1295 and Ipamorelin research stack options with dual-vial format, variable pack sizes, evidence-tier labeling, and RUO-first product guidance.',
				'faqs'                   => array(
					array(
						'question' => 'Can I purchase multiple kits in one line item?',
						'answer'   => 'Yes. Use the Pack Size selector to place a WooCommerce-native variation order.',
					),
					array(
						'question' => 'Why is this listed as Tier B instead of Tier A?',
						'answer'   => 'Human signaling literature exists, but the public evidence base is narrower and older than current flagship metabolic compounds.',
					),
				),
			);

			$retatrutide_profile = array(
				'title'                  => 'Retatrutide',
				'compound_alias'         => 'GLP-3 series',
				'subtitle'               => 'Lyophilized tri-agonist metabolic research peptide',
				'lab_descriptor'         => 'Metabolic research',
				'research_summary'       => 'Retatrutide for buyers comparing high-interest metabolic peptides, lyophilized format, tri-agonist research context, refrigerated handling, and documentation availability.',
				'evidence_tier'          => 'Tier A',
				'mechanism_summary'      => 'Retatrutide is a tri-agonist research compound associated with GIP, GLP-1, and glucagon receptor activity in the current literature. Azure keeps the framing investigational and RUO-first.',
				'documentation_status'   => 'Documented now',
				'proof_surface_label'    => 'Flagship research summary, vial amount, refrigerated-handling guidance, and documentation availability are visible on-page.',
				'purity_percent'         => '98.5%-99.2%',
				'form_factor'            => 'Lyophilized powder',
				'vial_amount'            => '15 mg',
				'storage_instructions'   => 'Frozen storage recommended; avoid heat exposure during staging.',
				'shipping_warning'       => 'Priority handling recommended for warm-weather routes.',
				'batch_reference'        => 'Batch archive language available through the desk.',
				'reconstitution_guidance'=> 'Reference lab SOPs before handling.',
				'research_disclaimer'    => 'For laboratory research use only. Not for human or veterinary use.',
				'seo_focus_keyphrase'    => 'Retatrutide research peptide',
				'meta_description'       => 'Shop Retatrutide research peptide with lyophilized format, evidence-tier guidance, tri-agonist literature context, refrigerated-handling notes, and RUO-first product details.',
				'faqs'                   => array(
					array(
						'question' => 'Is this written as a direct-to-consumer weight-loss product?',
						'answer'   => 'No. The product page is restricted to research and laboratory context, current literature signal, and handling discipline.',
					),
					array(
						'question' => 'Why does this read differently from recovery-category SKUs?',
						'answer'   => 'Because the current human evidence signal in metabolic research is materially stronger, which allows sharper public language while still remaining RUO-first.',
					),
				),
			);

			$profiles = array(
				'bpc-157'             => $bpc_profile,
				'mots-c'              => $motsc_profile,
				'cjc-ipa'             => $cjc_profile,
				'cjc-1295-ipamorelin' => $cjc_profile,
				'glp-3'               => $retatrutide_profile,
				'retatrutide'         => $retatrutide_profile,
			);
		}

		$product = wc_get_product( $product_id );

		if ( ! $product instanceof WC_Product ) {
			return array();
		}

		$slug = $product->get_slug();

		if ( isset( $profiles[ $slug ] ) ) {
			return $profiles[ $slug ];
		}

		$sku = $product->get_sku();

		if ( 'AZ-GLP3-15' === $sku ) {
			return $profiles['glp-3'];
		}

		if ( 'AZ-CJCIPA' === $sku ) {
			return $profiles['cjc-ipa'];
		}

		return array();
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
