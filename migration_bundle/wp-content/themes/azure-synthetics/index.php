<?php
/**
 * Theme fallback template.
 *
 * @package AzureSynthetics
 */

get_header();
?>
<main class="azure-page-shell">
	<section class="azure-page-hero">
		<div class="azure-shell">
			<?php azure_synthetics_render_section_heading( azure_synthetics_get_page_intro() ); ?>
		</div>
	</section>
	<section class="azure-page-section">
		<div class="azure-shell azure-prose">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
			endif;
			?>
		</div>
	</section>
</main>
<?php
get_footer();
