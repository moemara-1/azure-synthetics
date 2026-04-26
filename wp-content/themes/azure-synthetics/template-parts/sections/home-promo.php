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
			<h2><?php esc_html_e( 'Need documents, storage help, or repeat-order support?', 'azure-synthetics' ); ?></h2>
			<p><?php esc_html_e( 'Send the support desk the SKU, order reference, and question. We route documentation, handling, shipping, and repeat-buyer requests without making you dig through generic help text.', 'azure-synthetics' ); ?></p>
			<a class="azure-button" href="<?php echo esc_url( $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Support', 'azure-synthetics' ); ?></a>
		</div>
		<div class="azure-promo-banner__visual">
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/longevity-motsc.png' ) ); ?>" alt="<?php esc_attr_e( 'Azure Synthetics longevity research vial render', 'azure-synthetics' ); ?>">
		</div>
	</div>
</section>
