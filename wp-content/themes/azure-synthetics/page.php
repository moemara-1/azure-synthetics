<?php
/**
 * Default page template.
 *
 * @package AzureSynthetics
 */

$queried_page_id   = (int) get_queried_object_id();
$is_cart_page      = ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'wc_get_page_id' ) && $queried_page_id === (int) wc_get_page_id( 'cart' ) ) || is_page( 'cart' );
$is_checkout_page  = ( function_exists( 'is_checkout' ) && is_checkout() ) || ( function_exists( 'wc_get_page_id' ) && $queried_page_id === (int) wc_get_page_id( 'checkout' ) ) || is_page( 'checkout' );
$is_account_page   = ( function_exists( 'is_account_page' ) && is_account_page() ) || ( function_exists( 'wc_get_page_id' ) && $queried_page_id === (int) wc_get_page_id( 'myaccount' ) ) || is_page( 'my-account' );
$is_commerce_page  = $is_cart_page || $is_checkout_page || $is_account_page;
$main_classes      = 'azure-page-shell';
$content_classes   = 'azure-shell azure-prose';

if ( $is_commerce_page ) {
	$main_classes    .= ' azure-commerce-page';
	$content_classes  = 'azure-shell azure-commerce-content';
}

get_header();
?>
<main class="<?php echo esc_attr( $main_classes ); ?>">
	<section class="azure-page-hero">
		<div class="azure-shell">
			<?php azure_synthetics_render_section_heading( azure_synthetics_get_page_intro() ); ?>
		</div>
	</section>
	<section class="azure-page-section">
		<div class="<?php echo esc_attr( $content_classes ); ?>">
			<?php
			while ( have_posts() ) :
				the_post();
				ob_start();
				the_content();
				$page_content = trim( ob_get_clean() );
				$content_text = trim( wp_strip_all_tags( $page_content ) );

				if ( '' === $content_text && $is_commerce_page ) {
					if ( $is_cart_page ) {
						$page_content = do_shortcode( '[woocommerce_cart]' );
					} elseif ( $is_checkout_page ) {
						$page_content = do_shortcode( '[woocommerce_checkout]' );
					} elseif ( $is_account_page ) {
						$page_content = do_shortcode( '[woocommerce_my_account]' );
					}
				}

				echo $page_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			endwhile;
			?>
		</div>
	</section>
</main>
<?php
get_footer();
