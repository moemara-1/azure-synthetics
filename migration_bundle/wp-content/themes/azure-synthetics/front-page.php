<?php
/**
 * Front page template.
 *
 * @package AzureSynthetics
 */

get_header();
?>
<main class="azure-front-page">
	<?php get_template_part( 'template-parts/sections/home', 'hero' ); ?>
	<?php get_template_part( 'template-parts/sections/home', 'credibility' ); ?>
	<?php get_template_part( 'template-parts/sections/home', 'story' ); ?>
	<?php get_template_part( 'template-parts/sections/home', 'featured-products' ); ?>
	<?php get_template_part( 'template-parts/sections/home', 'science-grid' ); ?>
	<?php get_template_part( 'template-parts/sections/home', 'collections' ); ?>
	<?php get_template_part( 'template-parts/sections/home', 'promo' ); ?>
	<?php get_template_part( 'template-parts/sections/home', 'faq' ); ?>
</main>
<?php
get_footer();
