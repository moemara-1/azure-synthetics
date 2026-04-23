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
			<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Research peptide catalog', 'azure-synthetics' ); ?></p>
			<h1><?php esc_html_e( 'Research peptides for buyers who need clarity before checkout.', 'azure-synthetics' ); ?></h1>
			<p class="azure-hero__body"><?php esc_html_e( 'Browse Retatrutide, BPC-157, MOTS-c, and CJC-1295 / Ipamorelin with clear aliases, evidence tiers, storage notes, and documentation options before you order.', 'azure-synthetics' ); ?></p>
			<div class="azure-hero__actions">
				<a class="azure-button" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>"><?php esc_html_e( 'Shop research peptides', 'azure-synthetics' ); ?></a>
				<a class="azure-button azure-button--ghost azure-button--light" href="<?php echo esc_url( $science_page ? get_permalink( $science_page ) : home_url( '/science/' ) ); ?>"><?php esc_html_e( 'Check evidence tiers', 'azure-synthetics' ); ?></a>
			</div>
			<ul class="azure-hero__proof-list" aria-label="<?php esc_attr_e( 'Catalog proof highlights', 'azure-synthetics' ); ?>">
				<li><?php esc_html_e( 'Metabolic, recovery, and longevity peptides organized by research family', 'azure-synthetics' ); ?></li>
				<li><?php esc_html_e( 'COA and documentation request path before checkout', 'azure-synthetics' ); ?></li>
				<li><?php esc_html_e( 'Cold-chain and storage notes on product pages', 'azure-synthetics' ); ?></li>
			</ul>
			<p class="azure-meta-line"><?php esc_html_e( 'For research use only. Built for careful browsing, reorders, and documentation requests.', 'azure-synthetics' ); ?></p>
		</div>
		<div class="azure-hero__visual">
			<div class="azure-hero-card azure-hero-card--dark">
				<p class="azure-kicker"><?php esc_html_e( 'Before you order', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'See what is shown now, what the support desk can provide, and which handling notes matter before a reorder.', 'azure-synthetics' ); ?></p>
			</div>
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/hero-vial.png' ) ); ?>" alt="<?php esc_attr_e( 'Azure Synthetics flagship peptide vial render', 'azure-synthetics' ); ?>">
			<div class="azure-hero-card azure-hero-card--light">
				<p><?php esc_html_e( 'Retatrutide buyers get the clearest evidence tier, mechanism summary, and warm-route handling notes up front.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</div>
</section>
