<?php
/**
 * Home hero section.
 *
 * @package AzureSynthetics
 */
?>
<?php
$is_rtl      = function_exists( 'azure_synthetics_current_language' ) && 'ar' === azure_synthetics_current_language();
$hero_suffix = $is_rtl ? '-rtl' : '';
?>
<section class="azure-hero">
	<picture class="azure-hero__media" aria-hidden="true">
		<source media="(max-width: 640px)" srcset="<?php echo esc_url( azure_synthetics_asset_url( 'images/hero-home-mobile' . $hero_suffix . '.jpg' ) ); ?>">
		<source media="(max-width: 1080px)" srcset="<?php echo esc_url( azure_synthetics_asset_url( 'images/hero-home-tablet' . $hero_suffix . '.jpg' ) ); ?>">
		<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/hero-home-desktop' . $hero_suffix . '.jpg' ) ); ?>" alt="" fetchpriority="high" decoding="async">
	</picture>
	<div class="azure-hero__scrim" aria-hidden="true"></div>
	<div class="azure-shell azure-hero__inner">
		<div class="azure-hero__copy">
			<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Research peptides', 'azure-synthetics' ); ?></p>
			<h1><?php esc_html_e( 'Know the price. Check the proof. Order faster.', 'azure-synthetics' ); ?></h1>
			<p class="azure-hero__body"><?php esc_html_e( 'Built for vendor-aware buyers comparing 99%+ target purity, COA and lot workflow, vial and box pricing, and order review before fulfillment.', 'azure-synthetics' ); ?></p>
			<div class="azure-hero__actions">
				<a class="azure-button" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>"><?php esc_html_e( 'Shop catalog', 'azure-synthetics' ); ?></a>
				<ul class="azure-hero__proof-chips" aria-label="<?php esc_attr_e( 'Catalog proof points', 'azure-synthetics' ); ?>">
					<li><?php esc_html_e( '99%+ target purity', 'azure-synthetics' ); ?></li>
					<li><?php esc_html_e( 'COA + lot workflow', 'azure-synthetics' ); ?></li>
					<li><?php esc_html_e( 'Vial + box value', 'azure-synthetics' ); ?></li>
				</ul>
			</div>
		</div>
	</div>
</section>
