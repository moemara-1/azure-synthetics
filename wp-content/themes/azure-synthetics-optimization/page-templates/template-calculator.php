<?php
/**
 * Template Name: Calculator
 *
 * @package AzureSyntheticsOptimization
 */

get_header();
?>
<main class="opt-main opt-calculator-page">
	<section class="opt-section opt-calculator-section">
		<div class="opt-container opt-calculator-grid">
			<div class="opt-calc-card opt-reveal">
				<div class="opt-tool-head">
					<p class="opt-section-kicker"><?php esc_html_e( 'Calculator', 'azure-synthetics' ); ?></p>
					<h1><?php esc_html_e( 'Reconstitution calculator', 'azure-synthetics' ); ?></h1>
					<p><?php esc_html_e( 'Enter vial amount, fluid volume, target amount, and syringe type.', 'azure-synthetics' ); ?></p>
				</div>
				<div class="opt-calc-group">
					<h2><?php esc_html_e( 'Syringe type', 'azure-synthetics' ); ?></h2>
					<div class="opt-syringe-grid" data-calc-syringes>
						<button type="button" data-syringe-index="0" aria-pressed="false">
							<?php azure_opt_render_syringe_icon(); ?>
							<span><?php esc_html_e( '0.3 mL', 'azure-synthetics' ); ?></span>
							<small><?php esc_html_e( '30 units', 'azure-synthetics' ); ?></small>
						</button>
						<button type="button" data-syringe-index="1" aria-pressed="false">
							<?php azure_opt_render_syringe_icon(); ?>
							<span><?php esc_html_e( '0.5 mL', 'azure-synthetics' ); ?></span>
							<small><?php esc_html_e( '50 units', 'azure-synthetics' ); ?></small>
						</button>
						<button type="button" data-syringe-index="2" class="is-selected" aria-pressed="true">
							<?php azure_opt_render_syringe_icon(); ?>
							<span><?php esc_html_e( '1.0 mL', 'azure-synthetics' ); ?></span>
							<small><?php esc_html_e( '100 units', 'azure-synthetics' ); ?></small>
						</button>
					</div>
				</div>

				<div class="opt-calc-group">
					<h2><?php esc_html_e( 'Peptide vial size (mg)', 'azure-synthetics' ); ?></h2>
					<div class="opt-calc-chips" data-calc-chips="mass">
						<button type="button" data-value="5"><?php esc_html_e( '5 mg', 'azure-synthetics' ); ?></button>
						<button type="button" data-value="10" class="is-selected"><?php esc_html_e( '10 mg', 'azure-synthetics' ); ?></button>
						<button type="button" data-value="30"><?php esc_html_e( '30 mg', 'azure-synthetics' ); ?></button>
						<button type="button" data-value="100"><?php esc_html_e( '100 mg', 'azure-synthetics' ); ?></button>
					</div>
					<label class="opt-other-row" for="calc-mass">
						<span><?php esc_html_e( 'Other', 'azure-synthetics' ); ?></span>
						<input id="calc-mass" data-calc-field="mass" data-calc-other="mass" type="number" min="0.1" step="0.1" placeholder="--">
						<em><?php esc_html_e( 'mg', 'azure-synthetics' ); ?></em>
					</label>
				</div>

				<div class="opt-calc-group">
					<h2><?php esc_html_e( 'Bacteriostatic water added (mL)', 'azure-synthetics' ); ?></h2>
					<div class="opt-calc-chips" data-calc-chips="fluid">
						<button type="button" data-value="1"><?php esc_html_e( '1 mL', 'azure-synthetics' ); ?></button>
						<button type="button" data-value="2" class="is-selected"><?php esc_html_e( '2 mL', 'azure-synthetics' ); ?></button>
						<button type="button" data-value="3"><?php esc_html_e( '3 mL', 'azure-synthetics' ); ?></button>
						<button type="button" data-value="5"><?php esc_html_e( '5 mL', 'azure-synthetics' ); ?></button>
					</div>
					<label class="opt-other-row" for="calc-fluid">
						<span><?php esc_html_e( 'Other', 'azure-synthetics' ); ?></span>
						<input id="calc-fluid" data-calc-field="fluid" data-calc-other="fluid" type="number" min="0.1" step="0.1" placeholder="--">
						<em><?php esc_html_e( 'mL', 'azure-synthetics' ); ?></em>
					</label>
				</div>

				<div class="opt-calc-group">
					<h2><?php esc_html_e( 'Target research quantity (mcg)', 'azure-synthetics' ); ?></h2>
					<div class="opt-calc-chips" data-calc-chips="target">
						<button type="button" data-value="100" class="is-selected"><?php esc_html_e( '100 mcg', 'azure-synthetics' ); ?></button>
						<button type="button" data-value="250"><?php esc_html_e( '250 mcg', 'azure-synthetics' ); ?></button>
						<button type="button" data-value="500"><?php esc_html_e( '500 mcg', 'azure-synthetics' ); ?></button>
						<button type="button" data-value="1000"><?php esc_html_e( '1000 mcg', 'azure-synthetics' ); ?></button>
					</div>
					<label class="opt-other-row" for="calc-target">
						<span><?php esc_html_e( 'Other', 'azure-synthetics' ); ?></span>
						<input id="calc-target" data-calc-field="target" data-calc-other="target" type="number" min="1" step="1" placeholder="--">
						<em><?php esc_html_e( 'mcg', 'azure-synthetics' ); ?></em>
					</label>
				</div>

				<div class="opt-calc-results">
					<div>
						<span><?php esc_html_e( 'Draw volume', 'azure-synthetics' ); ?></span>
						<strong data-calc-output="volume">--</strong>
					</div>
					<div>
						<span><?php esc_html_e( 'Draw to unit', 'azure-synthetics' ); ?></span>
						<strong data-calc-output="units">--</strong>
					</div>
				</div>

				<div class="opt-calc-scale" aria-hidden="true">
					<svg data-calc-scale viewBox="0 0 540 70" preserveAspectRatio="none"></svg>
				</div>
				<p class="opt-calc-note" data-calc-output="targets"><?php esc_html_e( 'Targets per vial at this quantity: --', 'azure-synthetics' ); ?></p>
			</div>

			<aside class="opt-specimen-panel opt-reveal">
				<div class="opt-panel-head">
					<span class="opt-label"><?php esc_html_e( 'Tool note', 'azure-synthetics' ); ?></span>
					<span class="opt-live"><i></i><?php esc_html_e( 'Live', 'azure-synthetics' ); ?></span>
				</div>
				<p><?php esc_html_e( 'Arithmetic only. No protocol builder, medical guidance, or personal-use instructions.', 'azure-synthetics' ); ?></p>
				<dl class="opt-specimen-table">
					<div><dt><?php esc_html_e( 'Inputs', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'mg / mL / mcg', 'azure-synthetics' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Output', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'volume + unit mark', 'azure-synthetics' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Use', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'Math only', 'azure-synthetics' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Policy', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'Research use', 'azure-synthetics' ); ?></dd></div>
				</dl>
			</aside>
		</div>
	</section>
</main>
<?php
get_footer();
