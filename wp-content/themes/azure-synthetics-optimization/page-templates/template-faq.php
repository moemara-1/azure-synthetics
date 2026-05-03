<?php
/**
 * Template Name: FAQ
 *
 * @package AzureSyntheticsOptimization
 */

get_header();
?>
<main class="opt-main opt-page-shell">
	<section class="opt-page-hero">
		<div class="opt-container opt-page-hero__grid">
			<div>
				<p class="opt-section-kicker"><?php esc_html_e( 'FAQ', 'azure-synthetics' ); ?></p>
				<h1 class="opt-display"><?php esc_html_e( 'FAQ', 'azure-synthetics' ); ?></h1>
				<p><?php esc_html_e( 'Certificates, purity cues, storage, shipping support, catalog categories, calculator use, and product-use policy.', 'azure-synthetics' ); ?></p>
			</div>
			<div class="opt-specimen-panel">
				<div class="opt-panel-head">
					<span class="opt-label"><?php esc_html_e( 'Quick links', 'azure-synthetics' ); ?></span>
					<span class="opt-live"><i></i><?php esc_html_e( 'Open', 'azure-synthetics' ); ?></span>
				</div>
				<dl class="opt-specimen-table">
					<div><dt><?php esc_html_e( 'Certificates', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'Request by product or batch', 'azure-synthetics' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Calculator', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'Arithmetic only', 'azure-synthetics' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Support', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'Order and storage help', 'azure-synthetics' ); ?></dd></div>
				</dl>
			</div>
		</div>
	</section>
	<section class="opt-section">
		<div class="opt-container opt-two-column">
			<div class="opt-card-grid opt-reveal-stagger">
				<?php foreach ( azure_opt_get_faq_guidance_cards() as $card ) : ?>
					<article class="opt-glass-card">
						<h2><?php echo esc_html( $card['title'] ); ?></h2>
						<p><?php echo esc_html( $card['description'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
			<div class="opt-accordion-list opt-reveal-stagger">
				<?php foreach ( azure_opt_get_default_faqs() as $faq ) : ?>
					<details class="opt-accordion">
						<summary><?php echo esc_html( $faq['question'] ); ?></summary>
						<div><p><?php echo esc_html( $faq['answer'] ); ?></p></div>
					</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
