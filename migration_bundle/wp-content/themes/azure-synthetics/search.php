<?php
/**
 * Search results template.
 *
 * @package AzureSynthetics
 */

get_header();
?>
<main class="azure-page-shell azure-search-page">
	<section class="azure-page-hero">
		<div class="azure-shell">
			<?php azure_synthetics_render_section_heading( azure_synthetics_get_page_intro() ); ?>
		</div>
	</section>
	<section class="azure-page-section">
		<div class="azure-shell">
			<?php if ( have_posts() ) : ?>
				<div class="azure-search-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						$post_type_object = get_post_type_object( get_post_type() );
						?>
						<article <?php post_class( 'azure-search-card' ); ?>>
							<p class="azure-kicker"><?php echo esc_html( $post_type_object ? $post_type_object->labels->singular_name : __( 'Result', 'azure-synthetics' ) ); ?></p>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt() ?: wp_strip_all_tags( get_the_content() ), 24 ) ); ?></p>
						</article>
						<?php
					endwhile;
					?>
				</div>
				<?php the_posts_pagination(); ?>
			<?php else : ?>
				<div class="azure-empty-state">
					<h2><?php esc_html_e( 'No matching results.', 'azure-synthetics' ); ?></h2>
					<p><?php esc_html_e( 'Try searching for a compound name, category, or compliance topic.', 'azure-synthetics' ); ?></p>
					<a class="azure-button" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Browse the catalog', 'azure-synthetics' ); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php
get_footer();
