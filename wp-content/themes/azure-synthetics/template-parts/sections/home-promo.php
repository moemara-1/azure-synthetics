<?php
/**
 * Home promo banner.
 *
 * @package AzureSynthetics
 */

$contact_page = get_page_by_path( 'contact' );
?>
<section class="azure-promo-banner">
	<div class="azure-shell azure-promo-banner__grid">
		<div class="azure-promo-banner__copy">
			<h2><?php esc_html_e( 'Need paperwork, storage help, or repeat-order support?', 'azure-synthetics' ); ?></h2>
			<p><?php esc_html_e( 'Contact the desk for batch questions, documentation requests, storage guidance, release alerts, and support before a research peptide reorder.', 'azure-synthetics' ); ?></p>
			<a class="azure-button" href="<?php echo esc_url( $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Open the support desk', 'azure-synthetics' ); ?></a>
		</div>
		<div class="azure-promo-banner__visual">
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/longevity-motsc.png' ) ); ?>" alt="<?php esc_attr_e( 'Azure Synthetics longevity research vial render', 'azure-synthetics' ); ?>">
		</div>
	</div>
</section>
