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
			<h2><?php esc_html_e( 'Subscribe for early-access drops and 10% off the first order.', 'azure-synthetics' ); ?></h2>
			<p><?php esc_html_e( 'A sharper cadence for serious buyers: release alerts, protocol updates, and preferred pricing when new compounds go live.', 'azure-synthetics' ); ?></p>
			<?php $faq_page = get_page_by_path( 'faq' ); ?>
			<a class="azure-button" href="<?php echo esc_url( $faq_page ? get_permalink( $faq_page ) : home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'Join the list', 'azure-synthetics' ); ?></a>
		</div>
		<div class="azure-promo-banner__visual">
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/promo-vials.png' ) ); ?>" alt="<?php esc_attr_e( 'Promo vials artwork', 'azure-synthetics' ); ?>">
		</div>
	</div>
</section>
