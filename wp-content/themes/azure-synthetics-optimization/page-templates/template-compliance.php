<?php
/**
 * Template Name: Compliance
 *
 * @package AzureSyntheticsOptimization
 */

get_header();
?>
<main class="opt-main opt-page-shell">
	<section class="opt-page-hero">
		<div class="opt-container opt-page-hero__grid">
			<div>
				<p class="opt-section-kicker"><?php esc_html_e( 'Research Use Policy', 'azure-synthetics' ); ?></p>
				<h1 class="opt-display"><?php esc_html_e( 'Research use policy', 'azure-synthetics' ); ?></h1>
				<p><?php esc_html_e( 'Premium research materials with clear limits: no personal-use, clinical, veterinary, preparation, or outcome guidance.', 'azure-synthetics' ); ?></p>
			</div>
			<div class="opt-specimen-panel">
				<div class="opt-panel-head">
					<span class="opt-label"><?php esc_html_e( 'Policy status', 'azure-synthetics' ); ?></span>
					<span class="opt-live"><i></i><?php esc_html_e( 'Active', 'azure-synthetics' ); ?></span>
				</div>
				<p><?php echo esc_html( azure_opt_research_boundary_text() ); ?></p>
			</div>
		</div>
	</section>
	<section class="opt-section">
		<div class="opt-container opt-compliance-grid">
			<article class="opt-glass-card">
				<span class="opt-card-index"><?php esc_html_e( 'Core', 'azure-synthetics' ); ?></span>
				<h2><?php esc_html_e( 'Use policy', 'azure-synthetics' ); ?></h2>
				<p><?php echo esc_html( azure_opt_research_boundary_text() ); ?></p>
			</article>
			<article class="opt-glass-card">
				<span class="opt-card-index"><?php esc_html_e( 'Handling', 'azure-synthetics' ); ?></span>
				<h2><?php esc_html_e( 'Storage note', 'azure-synthetics' ); ?></h2>
				<p><?php esc_html_e( 'Keep products sealed, organized, and stored according to product-specific label and support guidance.', 'azure-synthetics' ); ?></p>
			</article>
			<article class="opt-glass-card opt-prose">
				<h2><?php esc_html_e( 'Plain-language policy', 'azure-synthetics' ); ?></h2>
				<p><?php esc_html_e( 'Azure Synthetics lists premium research materials with product identity, amount, form, storage, certificate support, and order support.', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'Listings show compound class, research interest, storage expectations, and certificate pathways. They do not provide personal protocols, treatment advice, or guaranteed outcomes.', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'For documentation questions, wholesale setup, certificate requests, or order support, use the contact desk and include the product or batch reference when available.', 'azure-synthetics' ); ?></p>
			</article>
		</div>
	</section>
	<section class="opt-section">
		<div class="opt-container opt-card-grid opt-card-grid--three opt-reveal-stagger">
			<?php foreach ( azure_opt_get_compliance_principles() as $principle ) : ?>
				<article class="opt-culture-card opt-culture-card--compact">
					<h2><?php echo esc_html( $principle['title'] ); ?></h2>
					<p><?php echo esc_html( $principle['description'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</section>
</main>
<?php
get_footer();
