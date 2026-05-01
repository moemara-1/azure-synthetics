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
			<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Research-use peptides', 'azure-synthetics' ); ?></p>
			<h1><?php esc_html_e( 'Buy research peptides with proof where your team needs it.', 'azure-synthetics' ); ?></h1>
			<p class="azure-hero__body"><?php esc_html_e( 'Azure Synthetics helps qualified labs source lyophilized research peptides with lot-aware CoA context, clear vial formats, and storage notes visible before checkout.', 'azure-synthetics' ); ?></p>
			<div class="azure-hero__actions">
				<a class="azure-button" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>"><?php esc_html_e( 'Shop research catalog', 'azure-synthetics' ); ?></a>
				<div class="azure-pill-note">
					<span class="azure-pill-note__icon"></span>
					<span><?php esc_html_e( 'CoA, purity range, and handling notes on flagship lots.', 'azure-synthetics' ); ?></span>
				</div>
			</div>
			<p class="azure-meta-line"><?php esc_html_e( 'For laboratory, analytical, and investigational use only. Not for human or veterinary use.', 'azure-synthetics' ); ?></p>
		</div>
		<div class="azure-hero__visual">
			<div class="azure-hero-card azure-hero-card--dark">
				<p class="azure-kicker"><?php esc_html_e( 'Lot visibility', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'Batch references, assay method notes, and storage profile stay close to each vial.', 'azure-synthetics' ); ?></p>
			</div>
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/hero-vial.png' ) ); ?>" alt="<?php esc_attr_e( 'Azure Synthetics vial render', 'azure-synthetics' ); ?>">
			<div class="azure-hero-card azure-hero-card--light">
				<p><?php esc_html_e( 'Designed for faster reorder decisions: purity range, format, amount, and handling notes in one view.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</div>
</section>
