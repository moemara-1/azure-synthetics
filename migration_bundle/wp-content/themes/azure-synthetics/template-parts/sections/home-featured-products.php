<?php
/**
 * Home featured products section.
 *
 * @package AzureSynthetics
 */

$products = azure_synthetics_home_products_query();
?>
<section class="azure-featured-products">
	<div class="azure-shell">
		<div class="azure-section-heading azure-section-heading--split">
			<div>
				<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Flagship research materials', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Popular catalog entries', 'azure-synthetics' ); ?></h2>
			</div>
			<a class="azure-text-link" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>"><?php esc_html_e( 'Open full catalog', 'azure-synthetics' ); ?></a>
		</div>
		<ul class="azure-product-grid">
			<?php
			foreach ( $products as $product ) {
				setup_postdata( $GLOBALS['post'] =& get_post( $product->get_id() ) );
				wc_get_template_part( 'content', 'product' );
			}
			wp_reset_postdata();
			?>
		</ul>
	</div>
</section>
