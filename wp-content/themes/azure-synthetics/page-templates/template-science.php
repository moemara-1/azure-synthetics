<?php
/**
 * Template Name: Science
 *
 * @package AzureSynthetics
 */

get_header();

$explainers = azure_synthetics_get_science_explainers();
$steps      = azure_synthetics_get_science_process_steps();
?>
<main class="azure-page-shell azure-science-page">
	<section class="azure-page-hero azure-science-page__hero">
		<div class="azure-shell azure-science-page__hero-grid">
			<?php azure_synthetics_render_section_heading( azure_synthetics_get_page_intro() ); ?>
			<div class="azure-science-page__hero-note">
				<p class="azure-kicker"><?php esc_html_e( 'Research use only', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'The science page is written to support purchase diligence: what was tested, how it is handled, and where batch context appears. It does not make diagnosis, treatment, mitigation, cure, or human-use claims.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__overview">
		<div class="azure-shell azure-two-column">
			<div class="azure-editorial-section__media">
				<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/science-assay.png' ) ); ?>" alt="<?php esc_attr_e( 'Assay documentation workspace', 'azure-synthetics' ); ?>">
			</div>
			<div class="azure-prose">
				<p class="azure-kicker"><?php esc_html_e( 'How to read a release', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Technical context belongs next to the product, not buried after checkout.', 'azure-synthetics' ); ?></h2>
				<p><?php esc_html_e( 'Each product page is structured around the evidence a research buyer needs before placing an order: form factor, amount, storage, shipping warning, batch reference, and product-specific FAQ context.', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'That structure keeps the storefront premium without hiding the operational details that make repeat purchasing safer and easier to audit.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__explainers">
		<div class="azure-shell">
			<div class="azure-section-heading azure-section-heading--split">
				<div>
					<p class="azure-kicker"><?php esc_html_e( 'Buyer diligence', 'azure-synthetics' ); ?></p>
					<h2><?php esc_html_e( 'What the storefront should explain clearly.', 'azure-synthetics' ); ?></h2>
				</div>
				<p class="azure-section-heading__description"><?php esc_html_e( 'These modules map to the research data fields managed on each product.', 'azure-synthetics' ); ?></p>
			</div>
			<div class="azure-science-explainer-grid">
				<?php foreach ( $explainers as $explainer ) : ?>
					<article class="azure-science-explainer">
						<h3><?php echo esc_html( $explainer['title'] ); ?></h3>
						<p><?php echo esc_html( $explainer['description'] ); ?></p>
						<p class="azure-meta-line"><?php echo esc_html( $explainer['detail'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__process">
		<div class="azure-shell azure-two-column">
			<div>
				<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Release workflow', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'A clean path from batch data to reorder confidence.', 'azure-synthetics' ); ?></h2>
			</div>
			<div class="azure-science-process-list">
				<?php foreach ( $steps as $step ) : ?>
					<article class="azure-science-process-step">
						<span><?php echo esc_html( $step['label'] ); ?></span>
						<div>
							<h3><?php echo esc_html( $step['title'] ); ?></h3>
							<p><?php echo esc_html( $step['copy'] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
