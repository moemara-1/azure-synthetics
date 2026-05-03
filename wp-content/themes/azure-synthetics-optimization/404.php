<?php
/**
 * 404 template.
 *
 * @package AzureSyntheticsOptimization
 */

get_header();
?>
<main class="opt-main opt-page-shell">
	<section class="opt-page-hero">
		<div class="opt-container opt-page-hero__grid">
			<div>
				<p class="opt-section-kicker"><?php esc_html_e( 'Route not found', 'azure-synthetics' ); ?></p>
			<h1 class="opt-display"><?php esc_html_e( 'This page is not in the catalog.', 'azure-synthetics' ); ?></h1>
			<p><?php esc_html_e( 'Return to the shop, FAQ, calculator, or contact desk to keep browsing.', 'azure-synthetics' ); ?></p>
				<div class="opt-actions">
					<a class="opt-button opt-button--primary" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>"><?php esc_html_e( 'Open Catalog', 'azure-synthetics' ); ?><?php azure_opt_render_arrow_icon(); ?></a>
			<a class="opt-button opt-button--ghost" href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'Read FAQ', 'azure-synthetics' ); ?><?php azure_opt_render_arrow_icon(); ?></a>
				</div>
			</div>
			<?php azure_opt_render_molecule( 'opt-molecule opt-molecule--page' ); ?>
		</div>
	</section>
</main>
<?php
get_footer();
