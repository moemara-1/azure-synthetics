<?php
/**
 * Template Name: Compliance
 *
 * @package AzureSynthetics
 */

get_header();
?>
<main class="azure-page-shell azure-compliance-page">
	<section class="azure-page-hero">
		<div class="azure-shell">
			<?php azure_synthetics_render_section_heading( azure_synthetics_get_page_intro() ); ?>
		</div>
	</section>
	<section class="azure-page-section">
		<div class="azure-shell azure-compliance-grid">
			<div class="azure-compliance-card">
				<h2><?php esc_html_e( 'Core disclaimer', 'azure-synthetics' ); ?></h2>
				<p><?php echo esc_html( azure_synthetics_get_option_value( 'default_product_disclaimer', azure_synthetics_get_footer_disclaimer() ) ); ?></p>
			</div>
			<div class="azure-compliance-card">
				<h2><?php esc_html_e( 'Shipping note', 'azure-synthetics' ); ?></h2>
				<p><?php echo esc_html( azure_synthetics_get_option_value( 'default_shipping_note', '' ) ); ?></p>
			</div>
			<div class="azure-compliance-card azure-prose">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>
		</div>
	</section>
	<section class="azure-page-section">
		<div class="azure-shell azure-science-explainer-grid">
			<?php foreach ( azure_synthetics_get_compliance_principles() as $principle ) : ?>
				<article class="azure-science-explainer">
					<h3><?php echo esc_html( $principle['title'] ); ?></h3>
					<p><?php echo esc_html( $principle['description'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</section>
</main>
<?php
get_footer();
