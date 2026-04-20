<?php
/**
 * Home hero section.
 *
 * @package AzureSynthetics
 */
?>
<section class="azure-hero">
	<div class="azure-shell azure-hero__grid">
		<div class="azure-hero__copy">
			<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Precision peptides', 'azure-synthetics' ); ?></p>
			<h1><?php esc_html_e( 'Performance biology, engineered for protocols that demand proof.', 'azure-synthetics' ); ?></h1>
			<p class="azure-hero__body"><?php esc_html_e( 'Azure Synthetics brings together clinical-grade compounds, transparent documentation, and an elevated storefront built for serious repeat buyers rather than casual wellness shoppers.', 'azure-synthetics' ); ?></p>
			<div class="azure-hero__actions">
				<a class="azure-button" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>"><?php esc_html_e( 'Explore catalog', 'azure-synthetics' ); ?></a>
				<div class="azure-pill-note">
					<span class="azure-pill-note__icon"></span>
					<span><?php esc_html_e( 'Every lot ships with a third-party COA.', 'azure-synthetics' ); ?></span>
				</div>
			</div>
			<p class="azure-meta-line"><?php esc_html_e( 'Used by performance clinics, longevity operators, and protocol-driven self-optimizers.', 'azure-synthetics' ); ?></p>
		</div>
		<div class="azure-hero__visual">
			<div class="azure-hero-card azure-hero-card--dark">
				<p class="azure-kicker"><?php esc_html_e( 'Batch traceability', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'Linked to assay, cold-chain route, and storage profile.', 'azure-synthetics' ); ?></p>
			</div>
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/hero-vial.png' ) ); ?>" alt="<?php esc_attr_e( 'Azure Synthetics vial render', 'azure-synthetics' ); ?>">
			<div class="azure-hero-card azure-hero-card--light">
				<p><?php esc_html_e( '99.1%–99.6% purity across flagship lots, packed in stability-preserving cold-chain kits.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</div>
</section>
