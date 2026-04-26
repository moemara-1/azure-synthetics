<?php
/**
 * Home collections section.
 *
 * @package AzureSynthetics
 */

$catalog_images = array(
	array(
		'slug' => 'bpc-157',
		'path' => 'images/products/bpc-157.png',
		'alt'  => __( 'Azure Synthetics BPC-157 research vial', 'azure-synthetics' ),
	),
	array(
		'slug' => 'bpc-157-tb-500-blend',
		'path' => 'images/products/bpc-157-tb-500-blend.png',
		'alt'  => __( 'Azure Synthetics BPC-157 and TB-500 research vial', 'azure-synthetics' ),
	),
	array(
		'slug' => 'mots-c',
		'path' => 'images/products/mots-c.png',
		'alt'  => __( 'Azure Synthetics MOTS-C research vial', 'azure-synthetics' ),
	),
	array(
		'slug' => 'retatrutide',
		'path' => 'images/products/retatrutide.png',
		'alt'  => __( 'Azure Synthetics Retatrutide research vial', 'azure-synthetics' ),
	),
);
?>
<section class="azure-collections">
	<div class="azure-shell azure-collections__grid">
		<div class="azure-collections__copy">
			<p class="azure-kicker"><?php esc_html_e( 'Browse by research family', 'azure-synthetics' ); ?></p>
			<h2><?php esc_html_e( 'Start with the research question, then compare the product details.', 'azure-synthetics' ); ?></h2>
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
		<div class="azure-collections__visual azure-collections__visual--catalog">
			<div class="azure-catalog-collage">
				<?php foreach ( $catalog_images as $catalog_image ) : ?>
					<?php
					$product_post = get_page_by_path( $catalog_image['slug'], OBJECT, 'product' );
					$product_url  = $product_post ? get_permalink( $product_post ) : azure_synthetics_shop_url();
					?>
					<a href="<?php echo esc_url( $product_url ); ?>">
						<img src="<?php echo esc_url( azure_synthetics_asset_url( $catalog_image['path'] ) ); ?>" alt="<?php echo esc_attr( $catalog_image['alt'] ); ?>">
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
