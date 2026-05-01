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
				<p class="azure-kicker"><?php esc_html_e( 'Why researchers stay', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Less uncertainty between product search and purchase.', 'azure-synthetics' ); ?></h2>
				<p><?php esc_html_e( 'Every page is written to answer the questions that slow qualified buyers down: what the vial is, what documentation exists, how it ships, and what support can provide.', 'azure-synthetics' ); ?></p>
				<p class="azure-meta-line"><?php esc_html_e( 'Clarity before checkout.', 'azure-synthetics' ); ?></p>
			</div>
		<div class="azure-editorial-section__media">
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/story-lab.png' ) ); ?>" alt="<?php esc_attr_e( 'Laboratory detail', 'azure-synthetics' ); ?>">
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
