<?php
/**
 * Home FAQ section.
 *
 * @package AzureSynthetics
 */
?>
<section class="azure-home-faq">
		<div class="azure-shell azure-home-faq__grid">
			<div class="azure-home-faq__intro">
				<h2><?php esc_html_e( 'Need a clearer path through the catalog?', 'azure-synthetics' ); ?></h2>
				<p><?php esc_html_e( 'Fast answers on product form, documentation, handling, and account support.', 'azure-synthetics' ); ?></p>
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
					<h3><?php esc_html_e( 'Get release updates without inbox noise.', 'azure-synthetics' ); ?></h3>
					<p><?php esc_html_e( 'Batch releases, CoA availability, cold-chain notices, and preferred reorder windows.', 'azure-synthetics' ); ?></p>
				</div>
			<form class="azure-inline-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
				<label for="azure-newsletter-email" class="screen-reader-text"><?php esc_html_e( 'Email address', 'azure-synthetics' ); ?></label>
				<input id="azure-newsletter-email" type="email" placeholder="<?php esc_attr_e( 'your@email.com', 'azure-synthetics' ); ?>" disabled>
				<button class="azure-button azure-button--ghost" type="button" disabled><?php esc_html_e( 'Coming soon', 'azure-synthetics' ); ?></button>
			</form>
		</div>
	</div>
</section>
