<?php
/**
 * Home collections section.
 *
 * @package AzureSynthetics
 */
?>
<section class="azure-collections">
	<div class="azure-shell azure-collections__grid">
		<div class="azure-collections__copy">
			<p class="azure-kicker"><?php esc_html_e( 'Browse by research family', 'azure-synthetics' ); ?></p>
			<h2><?php esc_html_e( 'Collections organized around evidence posture, product logic, and buyer intent.', 'azure-synthetics' ); ?></h2>
			<div class="azure-collections__list">
				<?php foreach ( azure_synthetics_get_collection_cards() as $collection ) : ?>
					<?php $term = get_term_by( 'slug', $collection['slug'], 'product_cat' ); ?>
					<a class="azure-collection-row" href="<?php echo esc_url( $term ? get_term_link( $term ) : azure_synthetics_shop_url() ); ?>">
						<div>
							<h3><?php echo esc_html( $collection['title'] ); ?></h3>
							<p><?php echo esc_html( $collection['description'] ); ?></p>
						</div>
						<span aria-hidden="true">&rarr;</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="azure-collections__visual">
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/metabolic-retatrutide.png' ) ); ?>" alt="<?php esc_attr_e( 'Azure Synthetics metabolic flagship vial render', 'azure-synthetics' ); ?>">
		</div>
	</div>
</section>
