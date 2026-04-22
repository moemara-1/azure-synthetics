<?php
/**
 * Generic WooCommerce wrapper.
 *
 * @package AzureSynthetics
 */

get_header();

$is_single_product = function_exists( 'is_product' ) && is_product();
?>
<main class="azure-page-shell azure-shop-shell<?php echo $is_single_product ? ' azure-product-shell' : ''; ?>">
	<?php if ( ! $is_single_product ) : ?>
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
	<?php endif; ?>

	<section class="azure-page-section">
		<?php if ( ! $is_single_product ) : ?>
			<div class="azure-shell">
		<?php endif; ?>

			<?php woocommerce_content(); ?>

		<?php if ( ! $is_single_product ) : ?>
			</div>
		<?php endif; ?>
	</section>
</main>
<?php
get_footer();
