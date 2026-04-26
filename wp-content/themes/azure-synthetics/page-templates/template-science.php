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
$dossiers       = azure_synthetics_get_science_research_dossiers();
$source_cards   = azure_synthetics_get_science_source_cards();
?>
<main class="azure-page-shell azure-science-page">
	<section class="azure-page-hero azure-science-page__hero">
		<div class="azure-shell azure-science-page__hero-grid">
			<?php azure_synthetics_render_section_heading( azure_synthetics_get_page_intro() ); ?>
			<div class="azure-science-page__hero-note">
				<p class="azure-kicker"><?php esc_html_e( 'Research use only', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'No human-use instructions. No outcome promises. Use this page to compare peptide identity, evidence maturity, documentation status, and handling before ordering.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__overview">
		<div class="azure-shell azure-two-column">
			<div class="azure-editorial-section__media">
				<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/lab-equipment-review.png' ) ); ?>" alt="<?php esc_attr_e( 'Laboratory equipment review during peptide handling workflow', 'azure-synthetics' ); ?>">
			</div>
			<div class="azure-prose">
				<p class="azure-kicker"><?php esc_html_e( 'How this source is built', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'A peptide page should help you verify the product.', 'azure-synthetics' ); ?></h2>
				<p><?php esc_html_e( 'Azure Synthetics organizes the questions serious buyers ask first: What compound is this? What aliases point to it? How mature is the published evidence? What documentation can be checked? How should the vial be handled?', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'The science model is practical, not decorative. It gives enough context to compare research-use-only products while keeping therapeutic, dosing, and human-administration claims off the storefront.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__research">
		<div class="azure-shell">
			<div class="azure-section-heading azure-section-heading--split">
				<div>
				<p class="azure-kicker"><?php esc_html_e( 'Flagship research snapshot', 'azure-synthetics' ); ?></p>
					<h2><?php esc_html_e( 'Peptide context buyers can use.', 'azure-synthetics' ); ?></h2>
				</div>
				<p class="azure-section-heading__description"><?php esc_html_e( 'The current catalog is clearly tiered: Retatrutide carries a later-stage evidence record, while BPC-157 and MOTS-c require more conservative mechanism-led copy.', 'azure-synthetics' ); ?></p>
			</div>
			<div class="azure-science-dossier-grid">
				<?php foreach ( $dossiers as $dossier ) : ?>
					<article class="azure-science-dossier-card">
						<div class="azure-science-dossier-card__head">
							<span><?php echo esc_html( $dossier['tier'] ); ?></span>
							<p><?php echo esc_html( $dossier['category'] ); ?></p>
						</div>
						<div class="azure-science-dossier-card__body">
							<h3><?php echo esc_html( $dossier['title'] ); ?></h3>
							<p><?php echo esc_html( $dossier['summary'] ); ?></p>
							<p class="azure-science-claim-boundary"><?php echo esc_html( $dossier['boundary'] ); ?></p>
						</div>
						<ul class="azure-science-source-list" aria-label="<?php echo esc_attr( sprintf( __( 'Sources for %s', 'azure-synthetics' ), $dossier['title'] ) ); ?>">
							<?php foreach ( $dossier['sources'] as $source ) : ?>
								<li>
									<a href="<?php echo esc_url( $source['url'] ); ?>" target="_blank" rel="noopener noreferrer">
										<?php echo esc_html( $source['label'] ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__source">
		<div class="azure-shell azure-science-source-layout">
			<div class="azure-science-source-panel">
				<p class="azure-kicker"><?php esc_html_e( 'Why use Azure as a source', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Built for buyers comparing research peptides, not supplement-style promises.', 'azure-synthetics' ); ?></h2>
				<p><?php esc_html_e( 'The storefront turns scattered peptide search behavior into a cleaner product workflow: compound identity, research maturity, proof status, storage, and support path stay visible together.', 'azure-synthetics' ); ?></p>
			</div>
			<div class="azure-science-source-media">
				<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/lab-sample-rack.png' ) ); ?>" alt="<?php esc_attr_e( 'Laboratory sample rack used as peptide research workflow imagery', 'azure-synthetics' ); ?>">
			</div>
			<div class="azure-science-source-card-grid">
				<?php foreach ( $source_cards as $card ) : ?>
					<article class="azure-science-source-card">
						<h3><?php echo esc_html( $card['title'] ); ?></h3>
						<p><?php echo esc_html( $card['description'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__tiers">
		<div class="azure-shell">
			<div class="azure-section-heading azure-section-heading--split">
				<div>
					<p class="azure-kicker"><?php esc_html_e( 'Evidence tiers', 'azure-synthetics' ); ?></p>
					<h2><?php esc_html_e( 'How the storefront decides how specific the copy can be.', 'azure-synthetics' ); ?></h2>
				</div>
				<p class="azure-section-heading__description"><?php esc_html_e( 'Every tier is a public-copy rule. Stronger evidence earns clearer context; thinner evidence earns tighter claim boundaries.', 'azure-synthetics' ); ?></p>
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
					<h2><?php esc_html_e( 'What to check before a peptide reaches the cart.', 'azure-synthetics' ); ?></h2>
				</div>
				<p class="azure-section-heading__description"><?php esc_html_e( 'These are the fields that make the site useful for both fast repeat buyers and newer researchers comparing products carefully.', 'azure-synthetics' ); ?></p>
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
				<h2><?php esc_html_e( 'From compound search to a cleaner RUO order path.', 'azure-synthetics' ); ?></h2>
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
