<?php
/**
 * Optimization home.
 *
 * @package AzureSyntheticsOptimization
 */

get_header();

$calculator_url = home_url( '/calculator/' );
$products       = azure_opt_get_featured_products( 6 );
$protocols      = array(
	array(
		'title' => __( 'Shop.', 'azure-synthetics' ),
		'copy'  => __( 'Browse by category, compound, amount, and form from one organized catalog.', 'azure-synthetics' ),
	),
	array(
		'title' => __( 'Check.', 'azure-synthetics' ),
		'copy'  => __( 'Review purity cue, storage note, certificate support, and product details.', 'azure-synthetics' ),
	),
	array(
		'title' => __( 'Order.', 'azure-synthetics' ),
		'copy'  => __( 'Use the cart, confirm the order, and contact support for documentation or shipping questions.', 'azure-synthetics' ),
	),
);

$culture = array(
	array(
		'title' => __( 'Peptides', 'azure-synthetics' ),
		'copy'  => __( 'Single-compound listings with amount, form, and purity cues visible.', 'azure-synthetics' ),
	),
	array(
		'title' => __( 'Blends', 'azure-synthetics' ),
		'copy'  => __( 'Multi-compound formats grouped by research category.', 'azure-synthetics' ),
	),
	array(
		'title' => __( 'Longevity', 'azure-synthetics' ),
		'copy'  => __( 'Mitochondrial, redox, senescence, and cellular-resilience research.', 'azure-synthetics' ),
	),
	array(
		'title' => __( 'Nootropics', 'azure-synthetics' ),
		'copy'  => __( 'Focus, sleep, stress, and neuro-signaling categories.', 'azure-synthetics' ),
	),
	array(
		'title' => __( 'Recovery', 'azure-synthetics' ),
		'copy'  => __( 'Repair-pathway, connective-tissue, epithelial, and matrix research.', 'azure-synthetics' ),
	),
	array(
		'title' => __( 'Metabolic', 'azure-synthetics' ),
		'copy'  => __( 'Incretin, AMPK, adipose, GH-fragment, and energy-use literature.', 'azure-synthetics' ),
	),
	array(
		'title' => __( 'Aesthetic', 'azure-synthetics' ),
		'copy'  => __( 'Skin, pigment, melanocortin, copper peptide, and dermal matrix research.', 'azure-synthetics' ),
	),
	array(
		'title' => __( 'Supplies', 'azure-synthetics' ),
		'copy'  => __( 'Support items for calculator math and clean catalog pairing.', 'azure-synthetics' ),
	),
);
?>
<main class="opt-main">
	<section class="opt-hero">
		<div class="opt-hero__molecule" aria-hidden="true">
			<?php azure_opt_render_molecule( 'opt-molecule opt-molecule--hero' ); ?>
		</div>
		<div class="opt-container opt-hero__grid">
			<div class="opt-hero__copy">
				<div class="opt-eyebrow">
					<span></span>
					<?php esc_html_e( 'Premium research peptides', 'azure-synthetics' ); ?>
				</div>
				<h1 class="opt-display opt-hero__title">
					<span><b><?php esc_html_e( 'Research', 'azure-synthetics' ); ?></b></span>
					<span><b><?php esc_html_e( 'peptides,', 'azure-synthetics' ); ?></b></span>
					<span class="opt-rotator" data-optimization-rotator data-words="<?php echo esc_attr( wp_json_encode( array( 'organized.', 'clear.', 'verified.', 'simple.' ) ) ); ?>">organized.</span>
				</h1>
				<p class="opt-hero__lead"><?php esc_html_e( 'Shop premium research peptides by category, amount, form, storage note, and certificate support.', 'azure-synthetics' ); ?></p>
				<div class="opt-actions">
					<a class="opt-button opt-button--primary" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>">
						<?php esc_html_e( 'Shop Peptides', 'azure-synthetics' ); ?>
						<?php azure_opt_render_arrow_icon(); ?>
					</a>
					<a class="opt-button opt-button--ghost" href="<?php echo esc_url( $calculator_url ); ?>">
						<?php esc_html_e( 'Open Calculator', 'azure-synthetics' ); ?>
						<?php azure_opt_render_arrow_icon(); ?>
					</a>
				</div>
				<p class="opt-compliance-line"><?php echo esc_html( azure_opt_research_boundary_text() ); ?></p>
			</div>
			<aside class="opt-specimen-panel opt-tilt">
				<?php azure_opt_render_molecule( 'opt-molecule opt-molecule--panel' ); ?>
				<div class="opt-panel-head">
					<span class="opt-label"><?php esc_html_e( 'Catalog status', 'azure-synthetics' ); ?></span>
					<span class="opt-live"><i></i><?php esc_html_e( 'Online', 'azure-synthetics' ); ?></span>
				</div>
				<dl class="opt-specimen-table">
					<div><dt><?php esc_html_e( 'Catalog', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'Peptides, blends, longevity, recovery, nootropics, and supplies', 'azure-synthetics' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Listings', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'Amount, form, storage, and purity cue', 'azure-synthetics' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Documents', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'Certificate requests through support', 'azure-synthetics' ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Orders', 'azure-synthetics' ); ?></dt><dd><?php esc_html_e( 'Cart review and tracked support', 'azure-synthetics' ); ?></dd></div>
				</dl>
				<p class="opt-panel-note"><?php esc_html_e( 'Everything important stays close to the buying path.', 'azure-synthetics' ); ?></p>
			</aside>
		</div>
	</section>

	<div class="opt-ticker" aria-hidden="true">
		<div class="opt-ticker__track">
			<?php for ( $i = 0; $i < 2; $i++ ) : ?>
				<span><?php esc_html_e( 'Premium research peptides', 'azure-synthetics' ); ?></span>
				<span><?php esc_html_e( 'Clear product details', 'azure-synthetics' ); ?></span>
				<span><?php esc_html_e( 'Certificate support', 'azure-synthetics' ); ?></span>
				<span><?php esc_html_e( 'Simple checkout', 'azure-synthetics' ); ?></span>
			<?php endfor; ?>
		</div>
	</div>

	<section class="opt-section opt-manifesto" id="manifesto">
		<div class="opt-container">
			<div class="opt-section-head opt-reveal">
				<p class="opt-section-kicker"><?php esc_html_e( '01 / How it works', 'azure-synthetics' ); ?></p>
				<h2 class="opt-display"><?php esc_html_e( 'Shop. Check. Order.', 'azure-synthetics' ); ?></h2>
			</div>
			<p class="opt-lede opt-reveal"><?php esc_html_e( 'Azure keeps the essentials visible: category, amount, form, storage note, purity cue, certificate support, and checkout.', 'azure-synthetics' ); ?></p>
			<div class="opt-card-grid opt-card-grid--three opt-reveal-stagger">
				<?php foreach ( $protocols as $index => $protocol ) : ?>
					<article class="opt-glass-card opt-tilt">
						<span class="opt-card-index"><?php echo esc_html( sprintf( '%03d', $index + 1 ) ); ?></span>
						<h3><?php echo esc_html( $protocol['title'] ); ?></h3>
						<p><?php echo esc_html( $protocol['copy'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="opt-section opt-culture" id="culture">
		<div class="opt-container">
			<div class="opt-section-head opt-reveal">
				<p class="opt-section-kicker"><?php esc_html_e( '02 / Catalog', 'azure-synthetics' ); ?></p>
				<h2 class="opt-display"><?php esc_html_e( 'Shop by category.', 'azure-synthetics' ); ?></h2>
			</div>
		</div>
		<div class="opt-culture-grid opt-reveal-stagger">
			<?php foreach ( $culture as $index => $item ) : ?>
				<article class="opt-culture-card">
					<span><?php echo esc_html( sprintf( '%02d / 08', $index + 1 ) ); ?></span>
					<?php azure_opt_render_molecule( 'opt-molecule opt-molecule--mini' ); ?>
					<h3><?php echo esc_html( $item['title'] ); ?></h3>
					<p><?php echo esc_html( $item['copy'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="opt-section opt-catalogue" id="specimens">
		<div class="opt-container">
			<div class="opt-section-head opt-reveal">
				<p class="opt-section-kicker"><?php esc_html_e( '03 / Featured peptides', 'azure-synthetics' ); ?></p>
				<h2 class="opt-display"><?php esc_html_e( 'Featured products.', 'azure-synthetics' ); ?></h2>
			</div>
			<div class="opt-product-grid opt-reveal-stagger">
				<?php foreach ( $products as $product ) : ?>
					<?php
					$product_id = $product->get_id();
					$tier       = function_exists( 'azure_opt_get_product_evidence_tier' ) ? azure_opt_get_product_evidence_tier( $product ) : azure_opt_meta( $product_id, 'evidence_tier', __( 'Tier B/C', 'azure-synthetics' ) );
					$status     = azure_opt_meta( $product_id, 'documentation_status', __( 'Documentation by support', 'azure-synthetics' ) );
					$copy       = azure_opt_get_product_copy( $product );
					?>
					<article class="opt-product-card opt-tilt">
						<div class="opt-product-card__strip">
							<span><?php echo esc_html( $tier ); ?></span>
							<span><?php echo esc_html( $status ); ?></span>
						</div>
						<a class="opt-product-card__image" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
							<?php echo wp_kses_post( azure_opt_product_image( $product ) ); ?>
						</a>
						<div class="opt-product-card__body">
							<h3><a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php echo esc_html( azure_opt_product_title( $product_id ) ); ?></a></h3>
							<p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $copy['summary'] ), 24 ) ); ?></p>
							<div class="opt-product-card__foot">
								<span><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
								<a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php esc_html_e( 'View', 'azure-synthetics' ); ?></a>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="opt-section opt-dashboard" id="lab">
		<div class="opt-container">
			<div class="opt-section-head opt-reveal">
				<p class="opt-section-kicker"><?php esc_html_e( '04 / Peptide science', 'azure-synthetics' ); ?></p>
				<h2 class="opt-display"><?php esc_html_e( 'Research context.', 'azure-synthetics' ); ?></h2>
			</div>
			<div class="opt-dashboard-grid opt-peptide-science opt-reveal-stagger">
				<div class="opt-panel opt-panel--molecule opt-science-visual">
					<div class="opt-panel-head">
						<span><?php esc_html_e( 'Peptide chain', 'azure-synthetics' ); ?></span>
						<code><?php esc_html_e( 'Amino acid sequence', 'azure-synthetics' ); ?></code>
					</div>
					<div class="opt-crosshair">
						<?php azure_opt_render_molecule( 'opt-molecule opt-molecule--dashboard' ); ?>
					</div>
					<div class="opt-peptide-chain" aria-hidden="true">
						<span>Gly</span><i></i><span>His</span><i></i><span>Lys</span><i></i><span>Arg</span><i></i><span>Ser</span>
					</div>
				</div>
				<div class="opt-panel">
					<div class="opt-panel-head">
						<span><?php esc_html_e( 'Metabolic', 'azure-synthetics' ); ?></span>
						<code><?php esc_html_e( 'GLP-1 / GIP / glucagon', 'azure-synthetics' ); ?></code>
					</div>
					<p><?php esc_html_e( 'Retatrutide, tirzepatide, semaglutide, and mazdutide belong to incretin-family research around receptor signaling, appetite biology, and energy-balance markers.', 'azure-synthetics' ); ?></p>
				</div>
				<div class="opt-panel">
					<div class="opt-panel-head">
						<span><?php esc_html_e( 'Recovery', 'azure-synthetics' ); ?></span>
						<code><?php esc_html_e( 'Matrix / repair pathways', 'azure-synthetics' ); ?></code>
					</div>
					<p><?php esc_html_e( 'BPC-157, TB-500, GHK-Cu, KPV, and LL-37 are grouped around tissue-stress, collagen matrix, epithelial, immune, and antimicrobial research.', 'azure-synthetics' ); ?></p>
				</div>
				<div class="opt-panel opt-panel--wide">
					<div class="opt-panel-head">
						<span><?php esc_html_e( 'Cellular performance', 'azure-synthetics' ); ?></span>
						<code><?php esc_html_e( 'Mitochondria / redox / GH axis', 'azure-synthetics' ); ?></code>
					</div>
					<div class="opt-science-lanes">
						<span><?php esc_html_e( 'MOTS-c: mitochondrial-derived peptide and AMPK-adjacent literature.', 'azure-synthetics' ); ?></span>
						<span><?php esc_html_e( 'SS-31: cardiolipin and mitochondrial membrane research.', 'azure-synthetics' ); ?></span>
						<span><?php esc_html_e( 'CJC / Ipamorelin: GHRH and GHS-R signaling studies.', 'azure-synthetics' ); ?></span>
						<span><?php esc_html_e( 'Semax / Selank / DSIP: neuropeptide, stress, and sleep-adjacent literature.', 'azure-synthetics' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="opt-section opt-field-notes" id="field-notes">
		<div class="opt-container opt-field-grid">
			<aside class="opt-field-side opt-reveal">
				<p class="opt-section-kicker"><?php esc_html_e( '05 / Science notes', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Evidence varies by compound.', 'azure-synthetics' ); ?></h2>
				<p><?php esc_html_e( 'Some metabolic peptides have human trial literature. Many recovery, aesthetic, and longevity compounds are still mechanism-led or preclinical-heavy.', 'azure-synthetics' ); ?></p>
			</aside>
			<div class="opt-feed opt-reveal-stagger">
				<article>
					<span><?php esc_html_e( 'Retatrutide', 'azure-synthetics' ); ?></span>
					<p><?php esc_html_e( 'Strong human-trial maturity in metabolic research, without consumer outcome claims.', 'azure-synthetics' ); ?></p>
					<time><?php esc_html_e( 'Tier A', 'azure-synthetics' ); ?></time>
				</article>
				<article>
					<span><?php esc_html_e( 'BPC-157', 'azure-synthetics' ); ?></span>
					<p><?php esc_html_e( 'Recovery-category interest with a preclinical-heavy evidence profile.', 'azure-synthetics' ); ?></p>
					<time><?php esc_html_e( 'Tier C', 'azure-synthetics' ); ?></time>
				</article>
				<article>
					<span><?php esc_html_e( 'MOTS-c', 'azure-synthetics' ); ?></span>
					<p><?php esc_html_e( 'Mitochondrial and longevity-adjacent research context.', 'azure-synthetics' ); ?></p>
					<time><?php esc_html_e( 'Tier C', 'azure-synthetics' ); ?></time>
				</article>
			</div>
		</div>
	</section>

	<section class="opt-section opt-cta">
		<div class="opt-container opt-cta__inner opt-reveal">
			<?php azure_opt_render_molecule( 'opt-molecule opt-molecule--cta' ); ?>
			<p class="opt-section-kicker"><?php esc_html_e( 'Home / Shop / FAQ / Calculator / Contact', 'azure-synthetics' ); ?></p>
			<h2 class="opt-display"><?php esc_html_e( 'Key details up front.', 'azure-synthetics' ); ?></h2>
			<p><?php esc_html_e( 'Open the catalog, compare product details, use the calculator, and contact support for certificates.', 'azure-synthetics' ); ?></p>
			<div class="opt-actions opt-actions--center">
				<a class="opt-button opt-button--primary" href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>"><?php esc_html_e( 'Shop', 'azure-synthetics' ); ?><?php azure_opt_render_arrow_icon(); ?></a>
				<a class="opt-button opt-button--ghost" href="<?php echo esc_url( $calculator_url ); ?>"><?php esc_html_e( 'Calculator', 'azure-synthetics' ); ?><?php azure_opt_render_arrow_icon(); ?></a>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
