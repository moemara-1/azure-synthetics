<?php
/**
 * Product archive template.
 *
 * @package AzureSynthetics
 */

defined( 'ABSPATH' ) || exit;

get_header();

$title       = woocommerce_page_title( false );
$term        = is_tax( 'product_cat' ) ? get_queried_object() : null;
$profile     = $term ? azure_synthetics_get_collection_profile( $term->slug ) : array();
$description = ! empty( $profile['description'] ) ? $profile['description'] : ( is_tax( 'product_cat' ) ? term_description() : get_post_field( 'post_content', wc_get_page_id( 'shop' ) ) );
?>
<main class="azure-shop-shell">
	<section class="azure-page-hero azure-page-hero--catalog">
		<div class="azure-shell azure-shop-hero">
			<div class="azure-section-heading">
				<p class="azure-kicker"><?php echo is_tax( 'product_cat' ) ? esc_html__( 'Research family', 'azure-synthetics' ) : esc_html__( 'Shop', 'azure-synthetics' ); ?></p>
				<h1><?php echo esc_html( $title ); ?></h1>
				<?php if ( $description ) : ?>
					<p class="azure-section-heading__description"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $description ), 34 ) ); ?></p>
				<?php endif; ?>
			</div>
			<div class="azure-shop-hero__note">
				<p class="azure-kicker"><?php esc_html_e( 'What buyers check first', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'Compare category fit, vial format, evidence tier, documentation availability, and storage guidance before adding a peptide to cart.', 'azure-synthetics' ); ?></p>
				<?php if ( ! empty( $profile['proof_status'] ) ) : ?>
					<p class="azure-meta-line"><?php echo esc_html( $profile['proof_status'] ); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="azure-shell azure-shop-highlight-grid">
			<?php foreach ( azure_synthetics_get_shop_highlights() as $highlight ) : ?>
				<article class="azure-card azure-card--minimal">
					<h2><?php echo esc_html( $highlight['title'] ); ?></h2>
					<p><?php echo esc_html( $highlight['description'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<?php if ( $profile ) : ?>
		<section class="azure-page-section azure-collection-spotlight">
			<div class="azure-shell azure-collection-spotlight__grid">
				<div class="azure-card__media azure-card__media--tall">
					<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/' . $profile['image'] ) ); ?>" alt="<?php echo esc_attr( $profile['title'] ); ?>">
				</div>
				<div class="azure-collection-spotlight__copy">
					<p class="azure-kicker"><?php esc_html_e( 'Collection posture', 'azure-synthetics' ); ?></p>
					<h2><?php echo esc_html( $profile['title'] ); ?></h2>
					<p><?php echo esc_html( $profile['trust_copy'] ); ?></p>
					<div class="azure-product-chip-list">
						<span class="azure-badge"><?php echo esc_html( $profile['proof_status'] ); ?></span>
					</div>
					<ul class="azure-collection-spotlight__bullets">
						<?php foreach ( $profile['bullets'] as $bullet ) : ?>
							<li><?php echo esc_html( $bullet ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</section>
	<?php endif; ?>

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
					<h2 class="azure-sidebar-card__title"><?php esc_html_e( 'Batch & document support', 'azure-synthetics' ); ?></h2>
					<p><?php esc_html_e( 'Flagship products surface evidence tiers, purity range, and documentation availability on the card or product page. Request-based support is clearly labeled.', 'azure-synthetics' ); ?></p>
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

	<?php if ( ! empty( $profile['faqs'] ) ) : ?>
		<section class="azure-page-section">
			<div class="azure-shell azure-two-column">
				<div class="azure-prose">
					<p class="azure-kicker"><?php esc_html_e( 'Collection FAQ', 'azure-synthetics' ); ?></p>
					<h2><?php esc_html_e( 'What serious buyers usually check before comparing SKUs.', 'azure-synthetics' ); ?></h2>
					<p><?php esc_html_e( 'Use these answers to understand the collection, then review the product page for compound-specific documentation, storage, and RUO guidance.', 'azure-synthetics' ); ?></p>
				</div>
				<div class="azure-accordion-list">
					<?php
					foreach ( $profile['faqs'] as $faq ) {
						get_template_part( 'template-parts/components/accordion', null, $faq );
					}
					?>
				</div>
			</div>
		</section>
	<?php endif; ?>
</main>
<?php
get_footer();
