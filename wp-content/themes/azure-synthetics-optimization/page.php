<?php
/**
 * Generic optimization page.
 *
 * @package AzureSyntheticsOptimization
 */

get_header();

$is_cart_page     = function_exists( 'is_cart' ) && is_cart();
$is_checkout_page = function_exists( 'is_checkout' ) && is_checkout();

if ( $is_cart_page || $is_checkout_page ) :
	$page_title = $is_cart_page ? __( 'Cart', 'azure-synthetics' ) : __( 'Checkout', 'azure-synthetics' );
	?>
	<main class="opt-main opt-commerce-page">
		<section class="opt-page-hero opt-commerce-hero">
			<div class="opt-container opt-page-hero__grid">
				<div>
					<p class="opt-section-kicker"><?php esc_html_e( 'Azure Synthetics', 'azure-synthetics' ); ?></p>
					<h1 class="opt-display"><?php echo esc_html( $page_title ); ?></h1>
				</div>
				<div class="opt-specimen-panel">
					<div class="opt-panel-head">
						<span class="opt-label"><?php esc_html_e( 'Order review', 'azure-synthetics' ); ?></span>
						<span class="opt-live"><i></i><?php esc_html_e( 'Secure', 'azure-synthetics' ); ?></span>
					</div>
					<p><?php esc_html_e( 'Review items, quantities, shipping details, and payment route before placing an order.', 'azure-synthetics' ); ?></p>
				</div>
			</div>
		</section>
		<section class="opt-section opt-commerce-section">
			<div class="opt-container opt-commerce-shell">
				<?php echo do_shortcode( $is_cart_page ? '[woocommerce_cart]' : '[woocommerce_checkout]' ); ?>
			</div>
		</section>
	</main>
	<?php
	get_footer();
	return;
endif;
?>
<main class="opt-main opt-page-shell">
	<section class="opt-page-hero">
		<div class="opt-container opt-page-hero__grid">
			<div>
				<p class="opt-section-kicker"><?php esc_html_e( 'Azure Synthetics', 'azure-synthetics' ); ?></p>
				<h1 class="opt-display"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
			</div>
			<?php azure_opt_render_research_notice(); ?>
		</div>
	</section>
	<section class="opt-section">
		<div class="opt-container opt-prose">
			<?php
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
			?>
		</div>
	</section>
</main>
<?php
get_footer();
