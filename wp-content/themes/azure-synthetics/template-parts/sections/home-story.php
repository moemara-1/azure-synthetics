<?php
/**
 * Home story section.
 *
 * @package AzureSynthetics
 */

$cards = azure_synthetics_get_story_cards();
?>
<section class="azure-editorial-section azure-editorial-section--light">
	<div class="azure-shell azure-editorial-section__grid">
		<div class="azure-editorial-section__copy">
			<p class="azure-kicker"><?php esc_html_e( 'Why the catalog feels faster', 'azure-synthetics' ); ?></p>
			<h2><?php esc_html_e( 'The product path starts with verification, not slogans.', 'azure-synthetics' ); ?></h2>
			<p><?php esc_html_e( 'Research buyers scan for the same facts: compound name, alias, amount, format, storage, documentation status, and a clear research-use boundary. Azure keeps those answers near the product instead of hiding them in policy text.', 'azure-synthetics' ); ?></p>
			<p class="azure-meta-line"><?php esc_html_e( 'Specific details. Shorter decisions.', 'azure-synthetics' ); ?></p>
		</div>
		<div class="azure-editorial-section__media">
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/promo-vials.png' ) ); ?>" alt="<?php esc_attr_e( 'Azure Synthetics peptide vial lineup with branded labels', 'azure-synthetics' ); ?>">
		</div>
	</div>
	<div class="azure-shell azure-story-grid">
		<?php foreach ( $cards as $card ) : ?>
			<article class="azure-story-card azure-story-card--<?php echo esc_attr( $card['tone'] ); ?>">
				<h3><?php echo esc_html( $card['title'] ); ?></h3>
				<p><?php echo esc_html( $card['description'] ); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</section>
