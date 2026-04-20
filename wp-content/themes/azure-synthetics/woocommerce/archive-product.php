<?php
/**
 * Product archive template.
 *
 * @package AzureSynthetics
 */

defined( 'ABSPATH' ) || exit;

get_header();

$title       = woocommerce_page_title( false );
$description = is_tax( 'product_cat' ) ? term_description() : get_post_field( 'post_content', wc_get_page_id( 'shop' ) );
?>
<main class="azure-shop-shell">
	<section class="azure-page-hero">
		<div class="azure-shell">
			<div class="azure-section-heading">
				<p class="azure-kicker"><?php echo is_tax( 'product_cat' ) ? esc_html__( 'Product category', 'azure-synthetics' ) : esc_html__( 'Shop', 'azure-synthetics' ); ?></p>
				<h1><?php echo esc_html( $title ); ?></h1>
				<?php if ( $description ) : ?>
					<p class="azure-section-heading__description"><?php echo wp_kses_post( wp_trim_words( wp_strip_all_tags( $description ), 28 ) ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="azure-page-section">
		<div class="azure-shell azure-shop-layout">
			<aside class="azure-shop-sidebar">
				<div class="azure-sidebar-card">
					<h2 class="azure-sidebar-card__title"><?php esc_html_e( 'Collections', 'azure-synthetics' ); ?></h2>
					<ul class="azure-term-list">
						<?php
						wp_list_categories(
							array(
								'taxonomy'   => 'product_cat',
								'title_li'   => '',
								'show_count' => false,
							)
						);
						?>
					</ul>
				</div>
				<div class="azure-sidebar-card">
					<h2 class="azure-sidebar-card__title"><?php esc_html_e( 'Compliance', 'azure-synthetics' ); ?></h2>
					<p><?php echo esc_html( azure_synthetics_get_footer_disclaimer() ); ?></p>
				</div>
				<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
					<?php dynamic_sidebar( 'shop-sidebar' ); ?>
				<?php endif; ?>
			</aside>

			<div class="azure-catalog-main">
				<?php wc_print_notices(); ?>

				<div class="azure-catalog-toolbar">
					<button class="azure-button azure-button--ghost azure-shop-sidebar__filters-button" type="button" data-azure-filter-toggle>
						<?php esc_html_e( 'Filters', 'azure-synthetics' ); ?>
					</button>
					<?php woocommerce_result_count(); ?>
					<?php woocommerce_catalog_ordering(); ?>
				</div>

				<?php if ( woocommerce_product_loop() ) : ?>
					<?php woocommerce_product_loop_start(); ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
					<?php woocommerce_product_loop_end(); ?>
					<?php do_action( 'woocommerce_after_shop_loop' ); ?>
				<?php else : ?>
					<div class="azure-empty-state">
						<h2><?php esc_html_e( 'No products found.', 'azure-synthetics' ); ?></h2>
						<p><?php esc_html_e( 'Adjust your filters or return later when the next release batch is published.', 'azure-synthetics' ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
