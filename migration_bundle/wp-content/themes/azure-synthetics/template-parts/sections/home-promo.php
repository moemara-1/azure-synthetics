<?php
/**
 * Home promo banner.
 *
 * @package AzureSynthetics
 */
?>
<section class="azure-promo-banner">
	<div class="azure-shell azure-promo-banner__grid">
		<div class="azure-promo-banner__copy">
			<h2><?php esc_html_e( 'Subscribe for release windows and 10% off your first qualified order.', 'azure-synthetics' ); ?></h2>
			<p><?php esc_html_e( 'A sharper cadence for research buyers: batch releases, CoA availability, cold-chain notices, and preferred pricing when catalog inventory changes.', 'azure-synthetics' ); ?></p>
			<?php $contact_page = get_page_by_path( 'contact' ); ?>
			<a class="azure-button" href="<?php echo esc_url( $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Request bulk support', 'azure-synthetics' ); ?></a>
		</div>
		<div class="azure-promo-banner__visual">
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/promo-vials.png' ) ); ?>" alt="<?php esc_attr_e( 'Promo vials artwork', 'azure-synthetics' ); ?>">
		</div>
	</div>
</section>
