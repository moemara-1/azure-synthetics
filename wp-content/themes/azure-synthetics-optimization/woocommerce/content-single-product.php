<?php
/**
 * Optimization single product content.
 *
 * @package AzureSyntheticsOptimization
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_id           = $product->get_id();
$title                = azure_opt_product_title( $product_id );
$alias                = azure_opt_meta( $product_id, 'compound_alias', '' );
$subtitle             = azure_opt_meta( $product_id, 'subtitle', '' );
$descriptor           = azure_opt_meta( $product_id, 'lab_descriptor', __( 'Research catalog', 'azure-synthetics' ) );
$copy                 = azure_opt_get_product_copy( $product );
$evidence_tier        = azure_opt_meta( $product_id, 'evidence_tier', '' );
$mechanism_summary    = azure_opt_meta( $product_id, 'mechanism_summary', '' );
$documentation_status = azure_opt_meta( $product_id, 'documentation_status', '' );
$proof_surface_label  = azure_opt_meta( $product_id, 'proof_surface_label', '' );
$disclaimer           = azure_opt_research_boundary_text();
$sections             = function_exists( 'azure_synthetics_get_product_sections' ) ? azure_synthetics_get_product_sections( $product_id ) : array();
$faqs                 = function_exists( 'azure_synthetics_get_product_faqs' ) ? azure_synthetics_get_product_faqs( $product_id ) : array();
$sources              = azure_opt_get_product_sources( $product->get_slug() );
$sections             = array_map(
	static function ( $section ) {
		if ( ! isset( $section['label'] ) ) {
			return $section;
		}

		$label = strtolower( (string) $section['label'] );

		if ( 'research disclaimer' === $label ) {
			$section['label'] = __( 'Use policy', 'azure-synthetics' );
			$section['value'] = azure_opt_research_boundary_text();
		} elseif ( 'lab handling' === $label ) {
			$section['label'] = __( 'Calculator', 'azure-synthetics' );
		} elseif ( 'fulfillment review' === $label ) {
			$section['label'] = __( 'Fulfillment', 'azure-synthetics' );
		} elseif ( 'verification route' === $label ) {
			$section['label'] = __( 'Certificate route', 'azure-synthetics' );
		}

		return $section;
	},
	$sections
);
$sections             = array_values(
	array_filter(
		$sections,
		static function ( $section ) {
			$label = isset( $section['label'] ) ? strtolower( (string) $section['label'] ) : '';

			return ! in_array( $label, array( 'mechanism', 'use policy' ), true );
		}
	)
);
$research_focus       = $mechanism_summary ?: $copy['research'];
$highlights           = array_filter(
	array(
		$evidence_tier,
		$documentation_status,
		azure_opt_meta( $product_id, 'purity_percent', '' ),
		azure_opt_meta( $product_id, 'form_factor', '' ),
		azure_opt_meta( $product_id, 'vial_amount', '' ),
	)
);
?>
<article id="product-<?php the_ID(); ?>" <?php wc_product_class( 'opt-product-dossier', $product ); ?>>
	<section class="opt-product-hero">
		<div class="opt-container opt-product-hero__grid">
			<div class="opt-product-visual opt-reveal">
				<?php echo wp_kses_post( azure_opt_product_image( $product, 'hero' ) ); ?>
				<?php azure_opt_render_molecule( 'opt-molecule opt-molecule--product' ); ?>
			</div>
			<div class="opt-product-buybox opt-reveal">
				<?php woocommerce_breadcrumb(); ?>
				<p class="opt-section-kicker"><?php echo esc_html( $descriptor ); ?></p>
				<h1 class="opt-display"><?php echo esc_html( $title ); ?></h1>
				<?php if ( $alias ) : ?>
					<p class="opt-product-alias"><?php echo esc_html( $alias ); ?></p>
				<?php endif; ?>
				<?php if ( $subtitle ) : ?>
					<p class="opt-product-subtitle"><?php echo esc_html( $subtitle ); ?></p>
				<?php endif; ?>
				<p><?php echo esc_html( $copy['summary'] ); ?></p>
				<div class="opt-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
				<?php if ( $highlights ) : ?>
					<div class="opt-chip-list">
						<?php foreach ( $highlights as $highlight ) : ?>
							<span><?php echo esc_html( $highlight ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<div class="opt-proof-card">
					<strong><?php esc_html_e( 'Certificate support', 'azure-synthetics' ); ?></strong>
					<p><?php echo esc_html( $copy['verification'] ?: $proof_surface_label ?: $documentation_status ); ?></p>
				</div>
				<div class="opt-buy-actions">
					<?php woocommerce_template_single_add_to_cart(); ?>
				</div>
				<p class="opt-fine-print"><?php echo esc_html( $disclaimer ); ?></p>
			</div>
		</div>
	</section>

	<?php if ( $sections ) : ?>
		<section class="opt-section">
			<div class="opt-container opt-card-grid opt-card-grid--four opt-reveal-stagger">
				<?php foreach ( $sections as $section ) : ?>
					<article class="opt-glass-card">
						<span class="opt-card-index"><?php echo esc_html( $section['label'] ); ?></span>
						<p><?php echo esc_html( $section['value'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

	<section class="opt-section">
		<div class="opt-container opt-two-column">
			<div class="opt-prose opt-reveal">
				<p class="opt-section-kicker"><?php esc_html_e( 'Literature', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Research focus', 'azure-synthetics' ); ?></h2>
				<p><?php echo esc_html( $research_focus ); ?></p>
			</div>
			<div class="opt-card-grid opt-reveal-stagger">
				<article class="opt-glass-card">
					<span class="opt-card-index"><?php esc_html_e( 'Compare', 'azure-synthetics' ); ?></span>
					<h3><?php esc_html_e( 'Key checks', 'azure-synthetics' ); ?></h3>
					<p><?php esc_html_e( 'Confirm category, vial amount, form, storage note, purity cue, and certificate support before ordering.', 'azure-synthetics' ); ?></p>
				</article>
			</div>
		</div>
	</section>

	<?php if ( $sources ) : ?>
		<section class="opt-section opt-dashboard">
			<div class="opt-container">
				<div class="opt-section-head opt-reveal">
					<p class="opt-section-kicker"><?php esc_html_e( 'Science', 'azure-synthetics' ); ?></p>
					<h2 class="opt-display"><?php esc_html_e( 'Sources', 'azure-synthetics' ); ?></h2>
				</div>
				<ul class="opt-source-list opt-source-list--large opt-reveal-stagger">
					<?php foreach ( $sources as $source ) : ?>
						<li><a href="<?php echo esc_url( $source['url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $source['label'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( $faqs ) : ?>
		<section class="opt-section">
			<div class="opt-container opt-two-column">
				<div>
					<p class="opt-section-kicker"><?php esc_html_e( 'Product FAQ', 'azure-synthetics' ); ?></p>
					<h2 class="opt-display"><?php esc_html_e( 'Product details', 'azure-synthetics' ); ?></h2>
				</div>
				<div class="opt-accordion-list opt-reveal-stagger">
					<?php foreach ( $faqs as $faq ) : ?>
						<details class="opt-accordion">
							<summary><?php echo esc_html( $faq['question'] ); ?></summary>
							<div><p><?php echo esc_html( $faq['answer'] ); ?></p></div>
						</details>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="opt-section opt-cta">
		<div class="opt-container opt-cta__inner">
			<p class="opt-section-kicker"><?php esc_html_e( 'Continue shopping', 'azure-synthetics' ); ?></p>
			<h2 class="opt-display"><?php esc_html_e( 'Related products', 'azure-synthetics' ); ?></h2>
			<div class="opt-related-products">
				<?php
				woocommerce_output_related_products(
					array(
						'posts_per_page' => 3,
						'columns'        => 3,
						'orderby'        => 'rand',
					)
				);
				?>
			</div>
		</div>
	</section>
</article>
