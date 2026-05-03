<?php
/**
 * Search template.
 *
 * @package AzureSyntheticsOptimization
 */

get_header();
?>
<main class="opt-main opt-page-shell">
	<section class="opt-page-hero">
		<div class="opt-container opt-page-hero__grid">
			<div>
				<p class="opt-section-kicker"><?php esc_html_e( 'Search', 'azure-synthetics' ); ?></p>
				<h1 class="opt-display"><?php echo esc_html( sprintf( __( 'Results for "%s"', 'azure-synthetics' ), get_search_query() ) ); ?></h1>
				<p><?php esc_html_e( 'Search the shop, FAQ, calculator, and support pages by compound, family, or proof signal.', 'azure-synthetics' ); ?></p>
			</div>
			<?php azure_opt_render_research_notice(); ?>
		</div>
	</section>
	<section class="opt-section">
		<div class="opt-container opt-search-results">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<article class="opt-search-card">
						<p class="opt-label"><?php echo esc_html( get_post_type() ); ?></p>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
					</article>
				<?php endwhile; ?>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<div class="opt-empty">
					<h2><?php esc_html_e( 'No matching compounds.', 'azure-synthetics' ); ?></h2>
					<p><?php esc_html_e( 'Try a compound name, category, or evidence term.', 'azure-synthetics' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
