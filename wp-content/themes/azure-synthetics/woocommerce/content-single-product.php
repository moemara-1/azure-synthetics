<?php
/**
 * Single product content template.
 *
 * @package AzureSynthetics
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_id            = $product->get_id();
$alias                 = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'compound_alias', '' ) : '';
$subtitle              = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'subtitle', '' ) : '';
$descriptor            = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'lab_descriptor', '' ) : '';
$research_summary      = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'research_summary', '' ) : '';
$evidence_tier         = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'evidence_tier', '' ) : '';
$mechanism_summary     = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'mechanism_summary', '' ) : '';
$documentation_status  = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'documentation_status', '' ) : '';
$proof_surface_label   = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'proof_surface_label', '' ) : '';
$disclaimer            = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'research_disclaimer', azure_synthetics_get_option_value( 'default_product_disclaimer', azure_synthetics_get_footer_disclaimer() ) ) : azure_synthetics_get_footer_disclaimer();
$sections              = function_exists( 'azure_synthetics_get_product_sections' ) ? azure_synthetics_get_product_sections( $product_id ) : array();
$faqs                  = function_exists( 'azure_synthetics_get_product_faqs' ) ? azure_synthetics_get_product_faqs( $product_id ) : array();
$title                 = function_exists( 'azure_synthetics_get_product_display_title' ) ? azure_synthetics_get_product_display_title( $product_id ) : get_the_title( $product_id );
$product_notices       = '';
$highlights            = array_filter(
	array(
		$evidence_tier,
		$documentation_status,
		function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'purity_percent', '' ) : '',
		function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'form_factor', '' ) : '',
		function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product_id, 'vial_amount', '' ) : '',
	)
);

if ( function_exists( 'wc_print_notices' ) ) {
	ob_start();
	wc_print_notices();
	$product_notices = trim( ob_get_clean() );
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="azure-shell">
		<?php woocommerce_breadcrumb(); ?>
		<?php if ( $product_notices ) : ?>
			<div class="azure-product-notices" role="status" aria-live="polite">
				<?php echo $product_notices; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		<?php endif; ?>
		<div class="azure-product-layout">
			<div class="azure-product-gallery">
				<?php
				$asset_image = function_exists( 'azure_synthetics_render_product_asset_image' ) ? azure_synthetics_render_product_asset_image( $product, 'hero' ) : '';

				if ( $asset_image ) {
					echo '<div class="azure-product-gallery__branded-image">' . wp_kses_post( $asset_image ) . '</div>';
				} else {
					do_action( 'woocommerce_before_single_product_summary' );
				}
				?>
			</div>
			<div class="azure-product-summary-card">
				<p class="azure-kicker"><?php echo esc_html( $descriptor ?: __( 'Research catalog', 'azure-synthetics' ) ); ?></p>
				<h1><?php echo esc_html( $title ); ?></h1>
				<?php if ( $alias ) : ?>
					<p class="azure-product-alias"><?php echo esc_html( $alias ); ?></p>
				<?php endif; ?>
				<?php if ( $subtitle ) : ?>
					<p class="azure-section-heading__description"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
				<?php if ( $research_summary ) : ?>
					<p class="azure-product-summary-card__lead"><?php echo esc_html( $research_summary ); ?></p>
				<?php endif; ?>
				<div class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
				<?php if ( has_excerpt() ) : ?>
					<p><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
				<?php if ( $highlights ) : ?>
					<div class="azure-product-chip-list">
						<?php foreach ( $highlights as $highlight ) : ?>
							<span class="azure-badge"><?php echo esc_html( $highlight ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php if ( $proof_surface_label || $documentation_status ) : ?>
					<div class="azure-product-proof-card">
						<strong><?php esc_html_e( 'Batch and Documentation', 'azure-synthetics' ); ?></strong>
						<p><?php echo esc_html( $proof_surface_label ?: $documentation_status ); ?></p>
					</div>
				<?php endif; ?>
				<div class="azure-product-compliance">
					<strong><?php esc_html_e( 'Research notice', 'azure-synthetics' ); ?></strong>
					<p><?php echo esc_html( $disclaimer ); ?></p>
				</div>
				<?php woocommerce_template_single_add_to_cart(); ?>
			</div>
		</div>

		<?php if ( $sections ) : ?>
			<div class="azure-product-tech-grid">
				<?php foreach ( $sections as $section ) : ?>
					<article class="azure-product-tech-card">
						<h3><?php echo esc_html( $section['label'] ); ?></h3>
						<p><?php echo esc_html( $section['value'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="azure-product-sections">
			<section class="azure-product-section">
				<h2><?php esc_html_e( 'Compound overview', 'azure-synthetics' ); ?></h2>
				<div class="azure-prose">
					<?php the_content(); ?>
				</div>
			</section>

			<?php if ( $mechanism_summary || $documentation_status ) : ?>
				<section class="azure-product-section">
					<h2><?php esc_html_e( 'Lab notes', 'azure-synthetics' ); ?></h2>
					<div class="azure-product-insight-grid">
						<?php if ( $mechanism_summary ) : ?>
							<article class="azure-product-insight-card">
								<h3><?php esc_html_e( 'Mechanism', 'azure-synthetics' ); ?></h3>
								<p><?php echo esc_html( $mechanism_summary ); ?></p>
							</article>
						<?php endif; ?>
						<?php if ( $documentation_status ) : ?>
							<article class="azure-product-insight-card">
								<h3><?php esc_html_e( 'Documentation', 'azure-synthetics' ); ?></h3>
								<p><?php echo esc_html( $documentation_status ); ?></p>
							</article>
						<?php endif; ?>
					</div>
				</section>
			<?php endif; ?>

			<?php if ( $faqs ) : ?>
				<section class="azure-product-section azure-product-section--dark">
					<h2><?php esc_html_e( 'Product FAQ', 'azure-synthetics' ); ?></h2>
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
				<h2><?php esc_html_e( 'Related SKUs', 'azure-synthetics' ); ?></h2>
			</div>
			<?php woocommerce_upsell_display(); ?>
			<?php woocommerce_output_related_products(); ?>
		</section>
	</div>
</div>
