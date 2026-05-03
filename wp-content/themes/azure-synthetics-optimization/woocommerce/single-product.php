<?php
/**
 * Single product wrapper.
 *
 * @package AzureSyntheticsOptimization
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="opt-main opt-single-product">
	<?php
	while ( have_posts() ) :
		the_post();
		wc_get_template_part( 'content', 'single-product' );
	endwhile;
	?>
</main>
<?php
get_footer();
