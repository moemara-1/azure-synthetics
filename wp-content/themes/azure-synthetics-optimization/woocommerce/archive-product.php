<?php
/**
 * Optimization product archive.
 *
 * @package AzureSyntheticsOptimization
 */

defined( 'ABSPATH' ) || exit;

get_header();

$title       = woocommerce_page_title( false );
$term        = is_tax( 'product_cat' ) ? get_queried_object() : null;
$profile     = $term ? azure_synthetics_get_collection_profile( $term->slug ) : array();
$description = ! empty( $profile['description'] ) ? $profile['description'] : ( is_tax( 'product_cat' ) ? term_description() : get_post_field( 'post_content', wc_get_page_id( 'shop' ) ) );
?>
<main class="opt-main opt-shop-page">
	<section class="opt-page-hero opt-shop-hero">
		<div class="opt-container opt-page-hero__grid">
			<div>
				<p class="opt-section-kicker"><?php echo is_tax( 'product_cat' ) ? esc_html__( 'Research family', 'azure-synthetics' ) : esc_html__( 'Shop', 'azure-synthetics' ); ?></p>
				<h1 class="opt-display"><?php echo esc_html( $title ); ?></h1>
				<?php if ( $description ) : ?>
					<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $description ), 34 ) ); ?></p>
				<?php else : ?>
					<p><?php esc_html_e( 'Premium research peptides with amount, form, purity cue, storage note, and certificate support.', 'azure-synthetics' ); ?></p>
				<?php endif; ?>
				<div class="opt-actions">
					<a class="opt-button opt-button--primary" href="#catalog-main"><?php esc_html_e( 'Search Compounds', 'azure-synthetics' ); ?><?php azure_opt_render_arrow_icon(); ?></a>
					<a class="opt-button opt-button--ghost" href="<?php echo esc_url( home_url( '/calculator/' ) ); ?>"><?php esc_html_e( 'Calculator', 'azure-synthetics' ); ?><?php azure_opt_render_arrow_icon(); ?></a>
				</div>
			</div>
			<div class="opt-specimen-panel">
				<div class="opt-panel-head">
					<span class="opt-label"><?php esc_html_e( 'Catalog checklist', 'azure-synthetics' ); ?></span>
					<span class="opt-live"><i></i><?php esc_html_e( 'Open', 'azure-synthetics' ); ?></span>
				</div>
				<dl class="opt-specimen-table">
					<div><dt><?php esc_html_e( 'Compound', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'Name + alias', 'azure-synthetics' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Purity', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'HPLC cue', 'azure-synthetics' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Certificate', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'By support', 'azure-synthetics' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Storage', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'Label noted', 'azure-synthetics' ); ?></dd></div>
				</dl>
			</div>
		</div>
	</section>

	<?php if ( $profile ) : ?>
		<section class="opt-section">
			<div class="opt-container opt-collection-spotlight opt-reveal">
				<div class="opt-collection-spotlight__media">
					<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/' . $profile['image'] ) ); ?>" alt="<?php echo esc_attr( $profile['title'] ); ?>">
				</div>
				<div>
					<p class="opt-section-kicker"><?php esc_html_e( 'Collection', 'azure-synthetics' ); ?></p>
					<h2 class="opt-display"><?php echo esc_html( $profile['title'] ); ?></h2>
					<p><?php echo esc_html( $profile['trust_copy'] ); ?></p>
					<span class="opt-pill"><?php echo esc_html( $profile['proof_status'] ); ?></span>
					<ul class="opt-bullet-list">
						<?php foreach ( $profile['bullets'] as $bullet ) : ?>
							<li><?php echo esc_html( $bullet ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="opt-section" id="catalog-main">
		<div class="opt-container opt-shop-layout">
			<aside class="opt-shop-sidebar">
				<div class="opt-sidebar-card">
					<h2><?php esc_html_e( 'Collections', 'azure-synthetics' ); ?></h2>
					<ul class="opt-term-list">
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
				<?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
					<?php dynamic_sidebar( 'shop-sidebar' ); ?>
				<?php endif; ?>
			</aside>
			<div class="opt-catalog-main">
				<?php wc_print_notices(); ?>
				<div class="opt-catalog-toolbar">
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
					<div class="opt-empty">
						<h2><?php esc_html_e( 'No compounds found.', 'azure-synthetics' ); ?></h2>
						<p><?php esc_html_e( 'Adjust the search or return to the full catalog.', 'azure-synthetics' ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
