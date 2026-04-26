<?php
/**
 * Home FAQ section.
 *
 * @package AzureSynthetics
 */

$contact_page = get_page_by_path( 'contact' );
$science_page = get_page_by_path( 'science' );
?>
<section class="azure-home-faq">
	<div class="azure-shell azure-home-faq__grid">
		<div class="azure-home-faq__intro">
			<h2><?php esc_html_e( 'Need a faster route through the buying questions?', 'azure-synthetics' ); ?></h2>
			<p><?php esc_html_e( 'Use the FAQ to check evidence tiers, documentation status, research-use boundaries, storage notes, and where to ask for batch support before you add a peptide to cart.', 'azure-synthetics' ); ?></p>
		</div>
		<div class="azure-accordion-list">
			<?php
			foreach ( azure_synthetics_get_default_faqs() as $faq ) {
				get_template_part( 'template-parts/components/accordion', null, $faq );
			}
			?>
		</div>
	</div>
	<div class="azure-shell">
		<div class="azure-newsletter-card">
			<div>
				<h3><?php esc_html_e( 'Need documents or storage guidance?', 'azure-synthetics' ); ?></h3>
				<p><?php esc_html_e( 'Use the support form for documentation requests, shipping questions, storage clarification, and repeat-buyer setup.', 'azure-synthetics' ); ?></p>
			</div>
			<div class="azure-inline-actions">
				<a class="azure-button" href="<?php echo esc_url( $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Support', 'azure-synthetics' ); ?></a>
				<a class="azure-button azure-button--ghost" href="<?php echo esc_url( $science_page ? get_permalink( $science_page ) : home_url( '/science/' ) ); ?>"><?php esc_html_e( 'Read Standards', 'azure-synthetics' ); ?></a>
			</div>
		</div>
	</div>
</section>
