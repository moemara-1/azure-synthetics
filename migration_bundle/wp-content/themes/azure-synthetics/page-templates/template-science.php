<?php
/**
 * Template Name: Science
 *
 * @package AzureSynthetics
 */

get_header();

$metrics       = azure_synthetics_get_science_quality_metrics();
$assay_bars    = azure_synthetics_get_science_assay_bars();
$documents     = azure_synthetics_get_science_document_matrix();
$release_steps = azure_synthetics_get_science_release_timeline();
$storage_bands = azure_synthetics_get_science_storage_bands();
$profiles      = azure_synthetics_get_science_compound_profiles();
$explainers    = azure_synthetics_get_science_explainers();
$steps         = azure_synthetics_get_science_process_steps();
?>
<main class="azure-page-shell azure-science-page">
	<section class="azure-page-hero azure-science-page__hero">
		<div class="azure-shell azure-science-page__hero-grid">
			<?php azure_synthetics_render_section_heading( azure_synthetics_get_page_intro() ); ?>
			<div class="azure-science-page__hero-note">
				<p class="azure-kicker"><?php esc_html_e( 'For research purposes only.', 'azure-synthetics' ); ?></p>
				<p><?php esc_html_e( 'Use this page to check the proof path: target purity, COA handoff, lot record, storage profile, and order review.', 'azure-synthetics' ); ?></p>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__dashboard">
		<div class="azure-shell">
			<div class="azure-science-dashboard">
				<div class="azure-science-dashboard__intro">
					<p class="azure-kicker"><?php esc_html_e( 'Proof dashboard', 'azure-synthetics' ); ?></p>
					<h2><?php esc_html_e( 'The data buyers want before they choose a vial.', 'azure-synthetics' ); ?></h2>
					<p><?php esc_html_e( 'A clean release view beats a wall of disclaimers: purity target, assay path, lot handoff, and fulfillment review stay in one place.', 'azure-synthetics' ); ?></p>
					<div class="azure-science-metric-grid">
						<?php foreach ( $metrics as $metric ) : ?>
							<article class="azure-science-metric">
								<strong><?php echo esc_html( $metric['value'] ); ?></strong>
								<span><?php echo esc_html( $metric['label'] ); ?></span>
								<p><?php echo esc_html( $metric['copy'] ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="azure-assay-panel" aria-labelledby="azure-assay-title">
					<div class="azure-assay-panel__header">
						<div>
							<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'HPLC-style view', 'azure-synthetics' ); ?></p>
							<h3 id="azure-assay-title"><?php esc_html_e( 'Release profile at a glance', 'azure-synthetics' ); ?></h3>
						</div>
						<span><?php esc_html_e( '99%+ target', 'azure-synthetics' ); ?></span>
					</div>
					<svg class="azure-assay-chart" viewBox="0 0 520 240" role="img" aria-labelledby="azure-assay-chart-title azure-assay-chart-desc">
						<title id="azure-assay-chart-title"><?php esc_html_e( 'HPLC-style target purity profile', 'azure-synthetics' ); ?></title>
						<desc id="azure-assay-chart-desc"><?php esc_html_e( 'Illustrative release dashboard showing a main purity peak and support readings for buyer comparison.', 'azure-synthetics' ); ?></desc>
						<line class="azure-assay-chart__axis" x1="34" y1="202" x2="486" y2="202"></line>
						<line class="azure-assay-chart__axis" x1="34" y1="34" x2="34" y2="202"></line>
						<rect class="azure-assay-chart__target" x="178" y="42" width="126" height="160" rx="8"></rect>
						<path class="azure-assay-chart__baseline" d="M40 196 C82 194 110 190 142 184 C156 181 166 178 178 171 C189 165 198 150 208 118 C219 78 234 35 252 35 C270 35 286 80 298 121 C309 157 321 176 338 184 C372 198 416 197 480 194"></path>
						<path class="azure-assay-chart__trace" d="M40 196 C82 194 110 190 142 184 C156 181 166 178 178 171 C189 165 198 150 208 118 C219 78 234 35 252 35 C270 35 286 80 298 121 C309 157 321 176 338 184 C372 198 416 197 480 194"></path>
						<circle class="azure-assay-chart__point" cx="252" cy="35" r="6"></circle>
						<text x="310" y="64"><?php esc_html_e( 'main peak', 'azure-synthetics' ); ?></text>
						<text x="52" y="222"><?php esc_html_e( 'assay window', 'azure-synthetics' ); ?></text>
					</svg>
					<div class="azure-assay-bars">
						<?php foreach ( $assay_bars as $bar ) : ?>
							<div class="azure-assay-bar" style="--azure-assay-width: <?php echo esc_attr( max( 0, min( 100, (int) $bar['percent'] ) ) ); ?>%;">
								<div class="azure-assay-bar__row">
									<span><?php echo esc_html( $bar['label'] ); ?></span>
									<strong><?php echo esc_html( $bar['value'] ); ?></strong>
								</div>
								<span class="azure-assay-bar__track" aria-hidden="true"><span></span></span>
								<p><?php echo esc_html( $bar['note'] ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php if ( ! empty( $profiles ) ) : ?>
		<section class="azure-page-section azure-science-page__profiles">
			<div class="azure-shell">
				<div class="azure-section-heading azure-section-heading--split">
					<div>
						<p class="azure-kicker"><?php esc_html_e( 'Substance profiles', 'azure-synthetics' ); ?></p>
						<h2><?php esc_html_e( 'Click through the compounds buyers compare first.', 'azure-synthetics' ); ?></h2>
					</div>
					<p class="azure-section-heading__description"><?php esc_html_e( 'A current proof dashboard mixed with the older profile idea: each substance gets its own price, format, document, storage, and reorder snapshot.', 'azure-synthetics' ); ?></p>
				</div>

				<div class="azure-science-profiles" aria-label="<?php esc_attr_e( 'Substance profile selector', 'azure-synthetics' ); ?>">
					<?php foreach ( $profiles as $index => $profile ) : ?>
						<input
							type="radio"
							name="azure-science-profile"
							id="azure-science-profile-<?php echo esc_attr( (string) $index ); ?>"
							<?php checked( 0, $index ); ?>
						>
					<?php endforeach; ?>

					<div class="azure-science-profile-tabs" role="list">
						<?php foreach ( $profiles as $index => $profile ) : ?>
							<label role="listitem" for="azure-science-profile-<?php echo esc_attr( (string) $index ); ?>">
								<span><?php echo esc_html( $profile['eyebrow'] ); ?></span>
								<strong><?php echo esc_html( $profile['name'] ); ?></strong>
							</label>
						<?php endforeach; ?>
					</div>

					<div class="azure-science-profile-panels">
						<?php foreach ( $profiles as $profile ) : ?>
							<article class="azure-science-profile-panel">
								<div class="azure-science-profile-panel__copy">
									<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Profile snapshot', 'azure-synthetics' ); ?></p>
									<h3><?php echo esc_html( $profile['name'] ); ?></h3>
									<p><?php echo esc_html( $profile['focus'] ); ?></p>
									<p><?php echo esc_html( $profile['copy'] ); ?></p>
									<a class="azure-button azure-button--light" href="<?php echo esc_url( $profile['url'] ); ?>"><?php esc_html_e( 'View product', 'azure-synthetics' ); ?></a>
								</div>
								<div class="azure-science-profile-panel__stats">
									<dl class="azure-science-profile-stat-grid">
										<div>
											<dt><?php esc_html_e( 'Target band', 'azure-synthetics' ); ?></dt>
											<dd><?php esc_html_e( '99%+ target', 'azure-synthetics' ); ?></dd>
										</div>
										<div>
											<dt><?php esc_html_e( 'Formats', 'azure-synthetics' ); ?></dt>
											<dd><?php echo esc_html( $profile['amounts'] ); ?></dd>
										</div>
										<div>
											<dt><?php esc_html_e( 'Vial range', 'azure-synthetics' ); ?></dt>
											<dd><?php echo esc_html( $profile['vial'] ); ?></dd>
										</div>
										<div>
											<dt><?php esc_html_e( 'Box range', 'azure-synthetics' ); ?></dt>
											<dd><?php echo esc_html( $profile['box'] ); ?></dd>
										</div>
										<div>
											<dt><?php esc_html_e( 'Assay path', 'azure-synthetics' ); ?></dt>
											<dd><?php echo esc_html( $profile['assay'] ); ?></dd>
										</div>
										<div>
											<dt><?php esc_html_e( 'Document path', 'azure-synthetics' ); ?></dt>
											<dd><?php echo esc_html( $profile['doc'] ); ?></dd>
										</div>
										<div>
											<dt><?php esc_html_e( 'Storage', 'azure-synthetics' ); ?></dt>
											<dd><?php echo esc_html( $profile['storage'] ); ?></dd>
										</div>
										<div>
											<dt><?php esc_html_e( 'Evidence context', 'azure-synthetics' ); ?></dt>
											<dd><?php echo esc_html( $profile['evidence'] ); ?></dd>
										</div>
									</dl>
									<div class="azure-science-profile-signals">
										<h4><?php esc_html_e( 'Researched therapeutic signals', 'azure-synthetics' ); ?></h4>
										<ul>
											<?php foreach ( $profile['signals'] as $signal ) : ?>
												<li><?php echo esc_html( $signal ); ?></li>
											<?php endforeach; ?>
										</ul>
									</div>
									<div class="azure-science-profile-bars">
										<?php foreach ( $profile['bars'] as $bar ) : ?>
											<div class="azure-science-profile-bar" style="--azure-profile-width: <?php echo esc_attr( max( 0, min( 100, (int) $bar['percent'] ) ) ); ?>%;">
												<div class="azure-science-profile-bar__row">
													<span><?php echo esc_html( $bar['label'] ); ?></span>
													<strong><?php echo esc_html( $bar['value'] ); ?></strong>
												</div>
												<span class="azure-science-profile-bar__track" aria-hidden="true"><span></span></span>
												<p><?php echo esc_html( $bar['note'] ); ?></p>
											</div>
										<?php endforeach; ?>
									</div>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<section class="azure-page-section azure-science-page__explainers">
		<div class="azure-shell">
			<div class="azure-section-heading azure-section-heading--split">
				<div>
					<p class="azure-kicker"><?php esc_html_e( 'Buyer diligence', 'azure-synthetics' ); ?></p>
					<h2><?php esc_html_e( 'The comparison layer.', 'azure-synthetics' ); ?></h2>
				</div>
			</div>
			<div class="azure-science-explainer-grid">
				<?php foreach ( $explainers as $explainer ) : ?>
					<article class="azure-science-explainer">
						<h3><?php echo esc_html( $explainer['title'] ); ?></h3>
						<p><?php echo esc_html( $explainer['description'] ); ?></p>
						<?php if ( ! empty( $explainer['detail'] ) ) : ?>
							<p class="azure-meta-line"><?php echo esc_html( $explainer['detail'] ); ?></p>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__matrix">
		<div class="azure-shell azure-science-matrix-layout">
			<div>
				<p class="azure-kicker"><?php esc_html_e( 'COA and lot matrix', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Documentation is treated as part of the product.', 'azure-synthetics' ); ?></h2>
				<p><?php esc_html_e( 'The order path keeps proof, storage, and support context close enough to compare before money moves.', 'azure-synthetics' ); ?></p>
			</div>
			<div class="azure-science-document-grid">
				<?php foreach ( $documents as $document ) : ?>
					<article class="azure-science-document">
						<span aria-hidden="true"></span>
						<h3><?php echo esc_html( $document['label'] ); ?></h3>
						<p><?php echo esc_html( $document['copy'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__storage">
		<div class="azure-shell azure-science-storage-grid">
			<div>
				<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Storage and transit', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Temperature notes are not an afterthought.', 'azure-synthetics' ); ?></h2>
			</div>
			<div class="azure-science-storage-bands">
				<?php foreach ( $storage_bands as $band ) : ?>
					<article>
						<span><?php echo esc_html( $band['label'] ); ?></span>
						<strong><?php echo esc_html( $band['value'] ); ?></strong>
						<p><?php echo esc_html( $band['copy'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__release">
		<div class="azure-shell">
			<div class="azure-section-heading">
				<p class="azure-kicker"><?php esc_html_e( 'Release workflow', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'From batch proof to repeat order.', 'azure-synthetics' ); ?></h2>
			</div>
			<div class="azure-science-release-timeline">
				<?php foreach ( $release_steps as $step ) : ?>
					<article>
						<span><?php echo esc_html( $step['label'] ); ?></span>
						<h3><?php echo esc_html( $step['title'] ); ?></h3>
						<p><?php echo esc_html( $step['copy'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="azure-page-section azure-science-page__process">
		<div class="azure-shell azure-two-column">
			<div>
				<p class="azure-kicker azure-kicker--gold"><?php esc_html_e( 'Order workflow', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Fast enough for comparison buyers. Careful enough for research orders.', 'azure-synthetics' ); ?></h2>
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
