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

if ( is_tax( 'product_cat' ) ) {
	$term       = get_queried_object();
	$categories = azure_synthetics_get_catalog_categories();

	if ( $term && ! empty( $categories[ $term->slug ] ) ) {
		$title       = azure_synthetics_localized_catalog_category_field( $categories[ $term->slug ], 'name' );
		$description = azure_synthetics_localized_catalog_category_field( $categories[ $term->slug ], 'description' );
	}
}

if ( ! $description && ! is_tax( 'product_cat' ) ) {
	$description = 'ar' === azure_synthetics_current_language()
		? 'قارن الببتيدات البحثية حسب هدف نقاء 99%+، مسار COA والدفعة، تسعير الفيال، وقيمة الصناديق قبل الدفع.'
		: __( 'Compare research peptides by 99%+ target purity, COA and lot workflow, vial pricing, and box value before checkout.', 'azure-synthetics' );
}

if ( ! is_tax( 'product_cat' ) && 'ar' === azure_synthetics_current_language() ) {
	$title = 'المتجر';
}
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
						<?php foreach ( azure_synthetics_get_collection_cards() as $collection ) : ?>
							<?php $term = get_term_by( 'slug', $collection['slug'], 'product_cat' ); ?>
							<?php if ( $term && ! is_wp_error( $term ) ) : ?>
								<li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $collection['title'] ); ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="azure-sidebar-card">
					<h2 class="azure-sidebar-card__title"><?php esc_html_e( 'Search', 'azure-synthetics' ); ?></h2>
					<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<label class="screen-reader-text" for="azure-product-search"><?php esc_html_e( 'Search products', 'azure-synthetics' ); ?></label>
						<input id="azure-product-search" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>">
						<input type="hidden" name="post_type" value="product">
						<button type="submit"><?php esc_html_e( 'Search', 'azure-synthetics' ); ?></button>
					</form>
				</div>
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
						<p><?php esc_html_e( 'Adjust your filters or check back when the next batch is published.', 'azure-synthetics' ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
