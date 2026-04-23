<?php
/**
 * Template Name: Science
 *
 * @package AzureSynthetics
 */

get_header();

$explainers     = azure_synthetics_get_science_explainers();
$steps          = azure_synthetics_get_science_process_steps();
$evidence_tiers = azure_synthetics_get_science_evidence_tiers();
?>
<main class="azure-page-shell azure-science-page">
	<section class="azure-page-hero azure-science-page__hero">
		<div class="azure-shell azure-science-page__hero-grid">
			<?php azure_synthetics_render_section_heading( azure_synthetics_get_page_intro() ); ?>
			<div class="azure-science-page__hero-note">
				<p class="azure-kicker"><?php esc_html_e( 'Research use only', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'Use this guide to compare research peptides by alias, vial format, evidence tier, purity cues, documentation availability, handling notes, and RUO claim boundaries before ordering.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__overview">
		<div class="azure-shell azure-two-column">
			<div class="azure-editorial-section__media">
				<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/science-assay.png' ) ); ?>" alt="<?php esc_attr_e( 'Assay and documentation workspace', 'azure-synthetics' ); ?>">
			</div>
			<div class="azure-prose">
				<p class="azure-kicker"><?php esc_html_e( 'How to read a flagship page', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Read the product facts that matter before a peptide goes in the cart.', 'azure-synthetics' ); ?></h2>
				<p><?php esc_html_e( 'Each flagship product page brings the practical details forward: compound alias, form factor, evidence tier, purity cue, documentation availability, handling notes, and product-specific FAQ guidance.', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'That helps experienced buyers move quickly while giving newer research buyers a safer way to understand what they are comparing.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__tiers">
		<div class="azure-shell">
			<div class="azure-section-heading azure-section-heading--split">
				<div>
					<p class="azure-kicker"><?php esc_html_e( 'Evidence tiers', 'azure-synthetics' ); ?></p>
					<h2><?php esc_html_e( 'How to compare research strength across peptide categories.', 'azure-synthetics' ); ?></h2>
				</div>
				<p class="azure-section-heading__description"><?php esc_html_e( 'Evidence tiers show where the literature is current, where it is narrower, and where buyers should expect more conservative language.', 'azure-synthetics' ); ?></p>
			</div>
			<div class="azure-science-tier-grid">
				<?php foreach ( $evidence_tiers as $tier ) : ?>
					<article class="azure-science-tier-card">
						<span><?php echo esc_html( $tier['label'] ); ?></span>
						<h3><?php echo esc_html( $tier['title'] ); ?></h3>
						<p><?php echo esc_html( $tier['description'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__explainers">
		<div class="azure-shell">
			<div class="azure-section-heading azure-section-heading--split">
				<div>
					<p class="azure-kicker"><?php esc_html_e( 'Buyer diligence', 'azure-synthetics' ); ?></p>
					<h2><?php esc_html_e( 'What to check before comparing products side by side.', 'azure-synthetics' ); ?></h2>
				</div>
				<p class="azure-section-heading__description"><?php esc_html_e( 'These fields help buyers move from search intent to a cleaner research-use-only purchase decision.', 'azure-synthetics' ); ?></p>
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
				<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Buyer workflow', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'A cleaner path from compound search to confident RUO ordering.', 'azure-synthetics' ); ?></h2>
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
