<?php
/**
 * Optimization product card.
 *
 * @package AzureSyntheticsOptimization
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product || ! $product->is_visible() ) {
	return;
}

$product_id = $product->get_id();
$title      = azure_opt_product_title( $product_id );
$tier       = function_exists( 'azure_opt_get_product_evidence_tier' ) ? azure_opt_get_product_evidence_tier( $product ) : azure_opt_meta( $product_id, 'evidence_tier', __( 'Tier B/C', 'azure-synthetics' ) );
$copy       = azure_opt_get_product_copy( $product );
$alias      = azure_opt_meta( $product_id, 'compound_alias', '' );
$form       = azure_opt_meta( $product_id, 'form_factor', '' );
$amount     = azure_opt_meta( $product_id, 'vial_amount', '' );
?>
<li <?php wc_product_class( 'opt-product-grid__item', $product ); ?>>
	<article class="opt-product-card opt-tilt">
		<?php if ( $product->is_on_sale() ) : ?>
			<?php woocommerce_show_product_loop_sale_flash(); ?>
		<?php endif; ?>
		<div class="opt-product-card__strip">
			<span><?php echo esc_html( $tier ); ?></span>
			<span><?php echo esc_html( $copy['badge'] ); ?></span>
		</div>
		<a class="opt-product-card__image" href="<?php the_permalink(); ?>">
			<?php echo wp_kses_post( azure_opt_product_image( $product ) ); ?>
		</a>
		<div class="opt-product-card__body">
			<h2><a href="<?php the_permalink(); ?>"><?php echo esc_html( $title ); ?></a></h2>
			<?php if ( $alias ) : ?>
				<p class="opt-product-card__alias"><?php echo esc_html( $alias ); ?></p>
			<?php endif; ?>
			<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $copy['summary'] ), 24 ) ); ?></p>
			<dl class="opt-product-mini-specs">
				<?php if ( $form ) : ?><div><dt><?php esc_html_e( 'Form', 'azure-synthetics' ); ?></dt><dd><?php echo esc_html( $form ); ?></dd></div><?php endif; ?>
				<?php if ( $amount ) : ?><div><dt><?php esc_html_e( 'Amount', 'azure-synthetics' ); ?></dt><dd><?php echo esc_html( $amount ); ?></dd></div><?php endif; ?>
			</dl>
			<div class="opt-product-card__foot">
				<span><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
				<?php woocommerce_template_loop_add_to_cart(); ?>
			</div>
		</div>
	</article>
</li>
