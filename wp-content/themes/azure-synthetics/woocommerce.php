<?php
/**
 * Generic WooCommerce wrapper.
 *
 * @package AzureSynthetics
 */

get_header();
?>
<main class="azure-page-shell azure-shop-shell">
	<section class="azure-page-hero">
		<div class="azure-shell">
			<div class="azure-section-heading">
				<p class="azure-kicker"><?php esc_html_e( 'Catalog', 'azure-synthetics' ); ?></p>
				<h1><?php woocommerce_page_title(); ?></h1>
				<?php if ( is_product_taxonomy() ) : ?>
					<p class="azure-section-heading__description"><?php echo wp_kses_post( term_description() ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<section class="azure-page-section">
		<div class="azure-shell">
			<?php woocommerce_content(); ?>
		</div>
	</section>
</main>
<?php
get_footer();
