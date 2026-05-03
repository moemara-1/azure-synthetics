<?php
/**
 * Fallback template for the optimization child theme.
 *
 * @package AzureSyntheticsOptimization
 */

get_header();
?>
<main class="opt-main opt-page-shell">
	<section class="opt-page-hero">
		<div class="opt-container opt-page-hero__grid">
			<div>
				<p class="opt-section-kicker"><?php esc_html_e( 'Azure Synthetics', 'azure-synthetics' ); ?></p>
				<h1 class="opt-display"><?php single_post_title(); ?></h1>
				<p><?php esc_html_e( 'Research-use content for fitness, self-care, and evidence-aware optimization buyers.', 'azure-synthetics' ); ?></p>
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
					<h2><?php esc_html_e( 'No content found.', 'azure-synthetics' ); ?></h2>
		<p><?php esc_html_e( 'Open the shop, FAQ, calculator, or contact desk to continue browsing.', 'azure-synthetics' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
