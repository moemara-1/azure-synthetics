<?php
/**
 * Template Name: Science
 *
 * @package AzureSyntheticsOptimization
 */

get_header();

$dossiers       = azure_opt_get_science_research_dossiers();
$evidence_tiers = azure_opt_get_science_evidence_tiers();
$source_cards   = azure_opt_get_science_source_cards();
?>
<main class="opt-main opt-science-page">
	<section class="opt-page-hero">
		<div class="opt-container opt-page-hero__grid">
			<div>
				<p class="opt-section-kicker"><?php esc_html_e( 'Science', 'azure-synthetics' ); ?></p>
				<h1 class="opt-display"><?php esc_html_e( 'Peptide literature', 'azure-synthetics' ); ?></h1>
				<p><?php esc_html_e( 'Human trials where they exist. Mechanism and preclinical context where they do not. Sources stay visible.', 'azure-synthetics' ); ?></p>
			</div>
			<div class="opt-specimen-panel">
				<div class="opt-panel-head">
					<span class="opt-label"><?php esc_html_e( 'Science mode', 'azure-synthetics' ); ?></span>
					<span class="opt-live"><i></i><?php esc_html_e( 'Active', 'azure-synthetics' ); ?></span>
				</div>
				<p><?php esc_html_e( 'Compound class, evidence tier, source trail, and certificate support stay separate from personal-use guidance.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</section>

	<section class="opt-section">
		<div class="opt-container">
			<div class="opt-section-head opt-reveal">
				<p class="opt-section-kicker"><?php esc_html_e( '01 / Flagship compounds', 'azure-synthetics' ); ?></p>
				<h2 class="opt-display"><?php esc_html_e( 'Human signal where it exists. Mechanism where it does not.', 'azure-synthetics' ); ?></h2>
			</div>
			<div class="opt-dossier-grid opt-reveal-stagger">
				<?php foreach ( $dossiers as $dossier ) : ?>
					<article class="opt-dossier-card">
						<div class="opt-dossier-card__head">
							<span><?php echo esc_html( $dossier['tier'] ); ?></span>
							<p><?php echo esc_html( $dossier['category'] ); ?></p>
						</div>
						<div>
							<h3><?php echo esc_html( $dossier['title'] ); ?></h3>
							<p><?php echo esc_html( $dossier['summary'] ); ?></p>
							<p class="opt-boundary"><?php echo esc_html( $dossier['boundary'] ); ?></p>
						</div>
						<ul class="opt-source-list" aria-label="<?php echo esc_attr( sprintf( __( 'Sources for %s', 'azure-synthetics' ), $dossier['title'] ) ); ?>">
							<?php foreach ( $dossier['sources'] as $source ) : ?>
								<li><a href="<?php echo esc_url( $source['url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $source['label'] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="opt-section opt-dashboard">
		<div class="opt-container opt-science-grid">
			<div class="opt-section-head opt-reveal">
				<p class="opt-section-kicker"><?php esc_html_e( '02 / Evidence tiers', 'azure-synthetics' ); ?></p>
				<h2 class="opt-display"><?php esc_html_e( 'The stronger the evidence, the clearer the context can be.', 'azure-synthetics' ); ?></h2>
			</div>
			<div class="opt-card-grid opt-card-grid--four opt-reveal-stagger">
				<?php foreach ( $evidence_tiers as $tier ) : ?>
					<article class="opt-glass-card">
						<span class="opt-card-index"><?php echo esc_html( $tier['label'] ); ?></span>
						<h3><?php echo esc_html( $tier['title'] ); ?></h3>
						<p><?php echo esc_html( $tier['description'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="opt-section">
		<div class="opt-container">
			<div class="opt-section-head opt-reveal">
				<p class="opt-section-kicker"><?php esc_html_e( '03 / Why this matters', 'azure-synthetics' ); ?></p>
				<h2 class="opt-display"><?php esc_html_e( 'Proof before hype.', 'azure-synthetics' ); ?></h2>
			</div>
			<div class="opt-card-grid opt-card-grid--four opt-reveal-stagger">
				<?php foreach ( $source_cards as $card ) : ?>
					<article class="opt-culture-card opt-culture-card--compact">
						<h3><?php echo esc_html( $card['title'] ); ?></h3>
						<p><?php echo esc_html( $card['description'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
