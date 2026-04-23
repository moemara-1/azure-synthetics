<?php
/**
 * Home science grid section.
 *
 * @package AzureSynthetics
 */

$science      = azure_synthetics_get_science_cards();
$science_page = get_page_by_path( 'science' );
?>
<section class="azure-science-grid">
	<div class="azure-shell azure-science-grid__layout">
		<div class="azure-science-grid__copy">
			<p class="azure-kicker"><?php esc_html_e( 'Operational rigor', 'azure-synthetics' ); ?></p>
			<h2><?php esc_html_e( 'Compare compound identity, purity cues, and documentation without guessing.', 'azure-synthetics' ); ?></h2>
			<p><?php esc_html_e( 'The strongest peptide sites surface storage, technical context, and support near the buy path. Azure keeps those same decision points visible while staying research-use-only.', 'azure-synthetics' ); ?></p>
			<a class="azure-text-link azure-text-link--dark" href="<?php echo esc_url( $science_page ? get_permalink( $science_page ) : home_url( '/science/' ) ); ?>"><?php esc_html_e( 'Read the research guide', 'azure-synthetics' ); ?></a>
		</div>
		<div class="azure-science-grid__cards">
			<article class="azure-card azure-card--feature">
				<div class="azure-card__media">
					<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/science-assay.png' ) ); ?>" alt="<?php esc_attr_e( 'Assay and documentation workspace', 'azure-synthetics' ); ?>">
				</div>
				<div class="azure-card__body">
					<h3><?php echo esc_html( $science['main']['title'] ); ?></h3>
					<p><?php echo esc_html( $science['main']['description'] ); ?></p>
				</div>
			</article>
			<div class="azure-science-grid__subcards">
				<?php foreach ( $science['cards'] as $card ) : ?>
					<article class="azure-story-card azure-story-card--<?php echo esc_attr( $card['tone'] ); ?>">
						<h3><?php echo esc_html( $card['title'] ); ?></h3>
						<p><?php echo esc_html( $card['description'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
