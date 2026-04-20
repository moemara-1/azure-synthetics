<?php
/**
 * Single product wrapper.
 *
 * @package AzureSynthetics
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="azure-product-shell">
	<?php
	while ( have_posts() ) :
		the_post();
		wc_get_template_part( 'content', 'single-product' );
	endwhile;
	?>
</main>
<?php
get_footer();
