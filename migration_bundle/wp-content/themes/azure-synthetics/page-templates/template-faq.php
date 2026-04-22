<?php
/**
 * Template Name: FAQ
 *
 * @package AzureSynthetics
 */

get_header();
?>
<main class="azure-page-shell azure-faq-page">
	<section class="azure-page-hero">
		<div class="azure-shell">
			<?php azure_synthetics_render_section_heading( azure_synthetics_get_page_intro() ); ?>
		</div>
	</section>
	<section class="azure-page-section">
		<div class="azure-shell azure-two-column">
			<div class="azure-faq-guidance">
				<?php
				while ( have_posts() ) :
					the_post();
					$content = trim( get_the_content() );

					if ( $content ) :
						?>
						<div class="azure-prose">
							<?php the_content(); ?>
						</div>
						<?php
					else :
							?>
							<div class="azure-faq-guidance__intro">
								<p class="azure-kicker"><?php esc_html_e( 'Start here', 'azure-synthetics' ); ?></p>
								<h2><?php esc_html_e( 'Quick diligence checklist.', 'azure-synthetics' ); ?></h2>
								<p><?php esc_html_e( 'Product form, documentation, handling, and account questions together.', 'azure-synthetics' ); ?></p>
							</div>
						<div class="azure-faq-guidance__cards">
							<?php foreach ( azure_synthetics_get_faq_guidance_cards() as $card ) : ?>
								<article class="azure-card">
									<h3><?php echo esc_html( $card['title'] ); ?></h3>
									<p><?php echo esc_html( $card['description'] ); ?></p>
								</article>
							<?php endforeach; ?>
						</div>
						<?php
					endif;
				endwhile;
				?>
			</div>
			<div class="azure-accordion-list">
				<?php
				foreach ( azure_synthetics_get_default_faqs() as $faq ) {
					get_template_part( 'template-parts/components/accordion', null, $faq );
				}
				?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
