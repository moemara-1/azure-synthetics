<?php
/**
 * Home hero section.
 *
 * @package AzureSynthetics
 */

$science_page = get_page_by_path( 'science' );
?>
<section class="azure-hero">
	<div class="azure-shell azure-hero__grid">
		<div class="azure-hero__copy">
			<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Research-use catalog', 'azure-synthetics' ); ?></p>
			<h1><?php esc_html_e( 'Research peptides with the details serious buyers check first.', 'azure-synthetics' ); ?></h1>
			<p class="azure-hero__body"><?php esc_html_e( 'Compare Retatrutide, BPC-157, MOTS-c, and CJC-1295 / Ipamorelin by compound identity, vial amount, proof status, storage notes, and support path before checkout.', 'azure-synthetics' ); ?></p>
			<div class="azure-hero__actions">
				<a class="azure-button" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>"><?php esc_html_e( 'Shop Catalog', 'azure-synthetics' ); ?></a>
				<a class="azure-button azure-button--ghost azure-button--light" href="<?php echo esc_url( $science_page ? get_permalink( $science_page ) : home_url( '/science/' ) ); ?>"><?php esc_html_e( 'Review Standards', 'azure-synthetics' ); ?></a>
			</div>
			<ul class="azure-hero__proof-list" aria-label="<?php esc_attr_e( 'Catalog proof highlights', 'azure-synthetics' ); ?>">
				<li><?php esc_html_e( 'Branded vial imagery tied to the product, not decorative badges', 'azure-synthetics' ); ?></li>
				<li><?php esc_html_e( 'Evidence tier, amount, format, and storage cues visible early', 'azure-synthetics' ); ?></li>
				<li><?php esc_html_e( 'Documentation requests and handling questions routed to support', 'azure-synthetics' ); ?></li>
			</ul>
			<p class="azure-meta-line"><?php esc_html_e( 'For laboratory research use only. Not for human or veterinary use.', 'azure-synthetics' ); ?></p>
		</div>
		<div class="azure-hero__visual">
			<div class="azure-hero-card azure-hero-card--dark">
				<p class="azure-kicker"><?php esc_html_e( 'Release checks', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'Check documentation status and handling notes while the SKU is still in view.', 'azure-synthetics' ); ?></p>
			</div>
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/hero-vial.png' ) ); ?>" alt="<?php esc_attr_e( 'Azure Synthetics flagship peptide vial render', 'azure-synthetics' ); ?>">
			<div class="azure-hero-card azure-hero-card--light">
				<p><?php esc_html_e( 'Clear product pages matter here because buyers check identity, proof status, and boundaries before price.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</div>
</section>
