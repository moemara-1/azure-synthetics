<?php
/**
 * 404 template.
 *
 * @package AzureSynthetics
 */

get_header();
?>
<main class="azure-page-shell azure-404-page">
	<section class="azure-page-hero">
		<div class="azure-shell">
			<?php azure_synthetics_render_section_heading( azure_synthetics_get_page_intro() ); ?>
			<div class="azure-hero-actions">
				<a class="azure-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return home', 'azure-synthetics' ); ?></a>
				<a class="azure-button azure-button--ghost" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>"><?php esc_html_e( 'Open catalog', 'azure-synthetics' ); ?></a>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
