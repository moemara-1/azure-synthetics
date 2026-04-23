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

$descriptor           = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'lab_descriptor', '' ) : '';
$alias                = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'compound_alias', '' ) : '';
$summary              = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'research_summary', '' ) : '';
$evidence_tier        = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'evidence_tier', '' ) : '';
$documentation_status = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), 'documentation_status', '' ) : '';
$title                = function_exists( 'azure_synthetics_get_product_display_title' ) ? azure_synthetics_get_product_display_title( $product->get_id() ) : get_the_title();
$card_mod             = $product->is_featured() ? ' azure-product-card--feature' : '';
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
			<?php if ( $evidence_tier ) : ?>
				<span class="azure-badge azure-badge--soft"><?php echo esc_html( $evidence_tier ); ?></span>
			<?php endif; ?>
		</div>
		<h2 class="azure-product-card__title"><a href="<?php the_permalink(); ?>"><?php echo esc_html( $title ); ?></a></h2>
		<?php if ( $alias ) : ?>
			<p class="azure-product-card__alias"><?php echo esc_html( $alias ); ?></p>
		<?php endif; ?>
		<p class="azure-product-card__subtitle"><?php echo esc_html( $descriptor ?: wp_strip_all_tags( wc_get_product_category_list( $product->get_id(), ', ' ) ) ); ?></p>
		<?php if ( $summary ) : ?>
			<p class="azure-product-card__summary"><?php echo esc_html( wp_trim_words( $summary, 26 ) ); ?></p>
		<?php endif; ?>
		<?php if ( $documentation_status ) : ?>
			<p class="azure-product-card__proof"><?php echo esc_html( $documentation_status ); ?></p>
		<?php endif; ?>
		<div class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
		<?php woocommerce_template_loop_add_to_cart(); ?>
	</article>
</li>
