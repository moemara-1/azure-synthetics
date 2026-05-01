<?php
/**
 * Product loop card.
 *
 * @package AzureSynthetics
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product || ! $product->is_visible() ) {
	return;
}

$subtitle = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'lab_descriptor', '' ) : '';
$subtitle = azure_synthetics_get_localized_product_meta( $product->get_id(), 'lab_descriptor', $subtitle );
$card_mod = $product->is_featured() ? ' azure-product-card--feature' : '';
?>
<li <?php wc_product_class( 'azure-product-grid__item', $product ); ?>>
	<article class="azure-product-card<?php echo esc_attr( $card_mod ); ?>">
		<?php if ( $product->is_on_sale() ) : ?>
			<?php woocommerce_show_product_loop_sale_flash(); ?>
		<?php endif; ?>
		<a class="azure-product-card__image" href="<?php the_permalink(); ?>">
			<?php echo woocommerce_get_product_thumbnail( 'azure-product-card' ); ?>
		</a>
		<div class="azure-product-card__meta">
			<?php if ( $product->is_featured() ) : ?>
				<span class="azure-badge"><?php esc_html_e( 'Flagship', 'azure-synthetics' ); ?></span>
			<?php endif; ?>
			<?php if ( $product->is_type( 'variable' ) ) : ?>
				<span class="azure-badge"><?php esc_html_e( 'Variable format', 'azure-synthetics' ); ?></span>
			<?php endif; ?>
		</div>
		<h2 class="azure-product-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="azure-product-card__subtitle"><?php echo esc_html( $subtitle ?: wp_strip_all_tags( wc_get_product_category_list( $product->get_id(), ', ' ) ) ); ?></p>
		<div class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
		<?php woocommerce_template_loop_add_to_cart(); ?>
	</article>
</li>
