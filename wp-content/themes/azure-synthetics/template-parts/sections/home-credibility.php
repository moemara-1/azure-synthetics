<?php
/**
 * Home credibility rail.
 *
 * @package AzureSynthetics
 */
?>
<section class="azure-credibility-rail">
	<div class="azure-shell azure-credibility-rail__inner">
		<div class="azure-credibility-rail__lead">
			<p class="azure-kicker"><?php esc_html_e( 'Catalog confidence', 'azure-synthetics' ); ?></p>
		</div>
		<?php foreach ( azure_synthetics_get_home_metrics() as $metric ) : ?>
			<div class="azure-metric-card">
				<p class="azure-metric-card__value"><?php echo esc_html( $metric['value'] ); ?></p>
				<h2><?php echo esc_html( $metric['label'] ); ?></h2>
				<p><?php echo esc_html( $metric['copy'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>
