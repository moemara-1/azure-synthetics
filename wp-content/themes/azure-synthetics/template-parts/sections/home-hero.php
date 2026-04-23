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
			<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Lab-grade research peptides', 'azure-synthetics' ); ?></p>
			<h1><?php esc_html_e( 'High-purity research peptides with clear storage and documentation guidance.', 'azure-synthetics' ); ?></h1>
			<p class="azure-hero__body"><?php esc_html_e( 'Shop Retatrutide, BPC-157, MOTS-c, and CJC-1295 / Ipamorelin with visible vial format, purity range, evidence tier, and support options before checkout.', 'azure-synthetics' ); ?></p>
			<div class="azure-hero__actions">
				<a class="azure-button" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>"><?php esc_html_e( 'Shop peptides', 'azure-synthetics' ); ?></a>
				<a class="azure-button azure-button--ghost azure-button--light" href="<?php echo esc_url( $science_page ? get_permalink( $science_page ) : home_url( '/science/' ) ); ?>"><?php esc_html_e( 'View research guide', 'azure-synthetics' ); ?></a>
			</div>
			<ul class="azure-hero__proof-list" aria-label="<?php esc_attr_e( 'Catalog proof highlights', 'azure-synthetics' ); ?>">
				<li><?php esc_html_e( 'Metabolic, recovery, and longevity peptides organized for fast comparison', 'azure-synthetics' ); ?></li>
				<li><?php esc_html_e( 'Vial format, purity range, and storage notes on flagship products', 'azure-synthetics' ); ?></li>
				<li><?php esc_html_e( 'Documentation and support path before reorder', 'azure-synthetics' ); ?></li>
			</ul>
			<p class="azure-meta-line"><?php esc_html_e( 'For research use only. Use the desk for documentation, storage, and reorder questions.', 'azure-synthetics' ); ?></p>
		</div>
		<div class="azure-hero__visual">
			<div class="azure-hero-card azure-hero-card--dark">
				<p class="azure-kicker"><?php esc_html_e( 'Lab checks', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'See purity range, documentation availability, and handling guidance without digging through policy pages.', 'azure-synthetics' ); ?></p>
			</div>
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/hero-vial.png' ) ); ?>" alt="<?php esc_attr_e( 'Azure Synthetics flagship peptide vial render', 'azure-synthetics' ); ?>">
			<div class="azure-hero-card azure-hero-card--light">
				<p><?php esc_html_e( 'Retatrutide leads the metabolic category with the clearest public research signal; other families stay tighter where evidence is earlier.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</div>
</section>
