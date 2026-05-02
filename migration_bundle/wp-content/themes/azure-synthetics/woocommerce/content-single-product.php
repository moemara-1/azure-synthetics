<?php
/**
 * Single product content template.
 *
 * @package AzureSynthetics
 */

defined( 'ABSPATH' ) || exit;

global $product;

$subtitle    = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'subtitle', '' ) : '';
$subtitle    = azure_synthetics_get_localized_product_meta( $product->get_id(), 'subtitle', $subtitle );
$descriptor  = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'lab_descriptor', '' ) : '';
$descriptor  = azure_synthetics_get_localized_product_meta( $product->get_id(), 'lab_descriptor', $descriptor );
$disclaimer  = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'research_disclaimer', azure_synthetics_get_option_value( 'default_product_disclaimer', azure_synthetics_get_footer_disclaimer() ) ) : azure_synthetics_get_footer_disclaimer();
$disclaimer  = azure_synthetics_translate_string( $disclaimer );
$short_copy  = azure_synthetics_get_localized_product_meta( $product->get_id(), 'short_description', get_the_excerpt() );
$long_copy   = azure_synthetics_get_localized_product_meta( $product->get_id(), 'description', get_the_content() );
$sections    = function_exists( 'azure_synthetics_get_product_sections' ) ? azure_synthetics_get_product_sections( $product->get_id() ) : array();
$faqs        = function_exists( 'azure_synthetics_get_product_faqs' ) ? azure_synthetics_get_product_faqs( $product->get_id() ) : array();
$highlights  = array_filter(
	array(
		function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'purity_percent', '' ) : '',
		function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'form_factor', '' ) : '',
		function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'vial_amount', '' ) : '',
		function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'batch_reference', '' ) : '',
	)
);

$highlights = array_map( 'azure_synthetics_translate_string', $highlights );

if ( 'ar' === azure_synthetics_current_language() ) {
	$faqs = array(
		array(
			'question' => 'ما المعلومات التي يجب مراجعتها قبل الطلب؟',
			'answer'   => 'راجع الكمية، حجم العبوة، السعر، هدف النقاء، مسار COA والدفعة، ومراجعة الشحن قبل الدفع.',
		),
		array(
			'question' => 'هل يتضمن المنتج توثيق الدفعة؟',
			'answer'   => 'تم تنظيم منتجات الكتالوج حول مسار COA والدفعة مع توفير مرجع الدفعة أثناء التجهيز.',
		),
	);
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="azure-shell">
		<?php woocommerce_breadcrumb(); ?>
		<div class="azure-product-layout">
			<div class="azure-product-gallery">
				<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
			</div>
			<div class="azure-product-summary-card">
				<p class="azure-kicker"><?php echo esc_html( $descriptor ?: __( 'Research catalog', 'azure-synthetics' ) ); ?></p>
				<h1><?php the_title(); ?></h1>
				<?php if ( $subtitle ) : ?>
					<p class="azure-section-heading__description"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
				<div class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
				<?php if ( $short_copy ) : ?>
					<p><?php echo esc_html( wp_strip_all_tags( $short_copy ) ); ?></p>
				<?php endif; ?>
				<?php if ( $highlights ) : ?>
					<div class="azure-product-chip-list">
						<?php foreach ( $highlights as $highlight ) : ?>
							<span class="azure-badge"><?php echo esc_html( $highlight ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<div class="azure-product-compliance">
					<strong><?php esc_html_e( 'Research use', 'azure-synthetics' ); ?></strong>
					<p><?php echo esc_html( $disclaimer ); ?></p>
				</div>
				<?php do_action( 'azure_synthetics_before_payment_methods' ); ?>
				<?php woocommerce_template_single_add_to_cart(); ?>
			</div>
		</div>

		<?php if ( $sections ) : ?>
			<div class="azure-product-tech-grid">
				<?php foreach ( $sections as $section ) : ?>
					<article class="azure-product-tech-card">
						<h3><?php echo esc_html( $section['label'] ); ?></h3>
						<p><?php echo esc_html( azure_synthetics_translate_string( $section['value'] ) ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="azure-product-sections">
			<section class="azure-product-section">
				<h2><?php esc_html_e( 'Proof at a glance', 'azure-synthetics' ); ?></h2>
				<div class="azure-prose">
					<p><?php echo esc_html( wp_strip_all_tags( $long_copy ) ); ?></p>
				</div>
			</section>

			<?php if ( $faqs ) : ?>
				<section class="azure-product-section azure-product-section--dark">
					<h2><?php esc_html_e( 'Buyer FAQ', 'azure-synthetics' ); ?></h2>
					<div class="azure-product-faqs">
						<?php
						foreach ( $faqs as $faq ) {
							get_template_part( 'template-parts/components/accordion', null, $faq );
						}
						?>
					</div>
				</section>
			<?php endif; ?>
		</div>

		<section class="azure-page-section">
			<div class="azure-section-heading">
				<p class="azure-kicker"><?php esc_html_e( 'Continue browsing', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Related compounds', 'azure-synthetics' ); ?></h2>
			</div>
			<?php woocommerce_upsell_display(); ?>
			<?php woocommerce_output_related_products(); ?>
		</section>
	</div>
</div>
