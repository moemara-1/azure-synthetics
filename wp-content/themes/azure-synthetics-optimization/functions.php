<?php
/**
 * Optimization child theme bootstrap.
 *
 * @package AzureSyntheticsOptimization
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_opt_asset_url( $path ) {
	return get_stylesheet_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

function azure_opt_enqueue_assets() {
	$parent_styles = array(
		'azure-synthetics-tokens',
		'azure-synthetics-base',
		'azure-synthetics-layout',
		'azure-synthetics-components',
		'azure-synthetics-woocommerce',
		'azure-synthetics-woocommerce-blocks',
		'azure-synthetics-pages',
	);

	foreach ( $parent_styles as $style ) {
		wp_dequeue_style( $style );
	}

	$parent_scripts = array(
		'azure-synthetics-navigation',
		'azure-synthetics-faq',
		'azure-synthetics-filters',
		'azure-synthetics-motion',
		'azure-synthetics-compliance',
	);

	foreach ( $parent_scripts as $script ) {
		wp_dequeue_script( $script );
	}

	$css_path = get_stylesheet_directory() . '/assets/css/optimization.css';
	$js_path  = get_stylesheet_directory() . '/assets/js/optimization.js';

	wp_enqueue_style(
		'azure-synthetics-optimization',
		azure_opt_asset_url( 'css/optimization.css' ),
		array(),
		file_exists( $css_path ) ? filemtime( $css_path ) : wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_script(
		'azure-synthetics-optimization',
		azure_opt_asset_url( 'js/optimization.js' ),
		array(),
		file_exists( $js_path ) ? filemtime( $js_path ) : wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'azure_opt_enqueue_assets', 20 );

function azure_opt_site_tagline() {
	return __( 'Premium research peptides', 'azure-synthetics' );
}

function azure_opt_research_boundary_text() {
	return __( 'Research use only. Not for personal, clinical, or veterinary use. No preparation, treatment, or outcome guidance is provided.', 'azure-synthetics' );
}

function azure_opt_filter_blogdescription( $description ) {
	return azure_opt_site_tagline();
}
add_filter( 'option_blogdescription', 'azure_opt_filter_blogdescription', 20 );

function azure_opt_document_title_parts( $parts ) {
	if ( is_front_page() ) {
		$parts['title']   = __( 'Azure Synthetics', 'azure-synthetics' );
		$parts['tagline'] = azure_opt_site_tagline();
		return $parts;
	}

	if ( is_post_type_archive( 'product' ) || ( function_exists( 'is_shop' ) && is_shop() ) ) {
		$parts['title'] = __( 'Shop Premium Research Peptides', 'azure-synthetics' );
	}

	return $parts;
}
add_filter( 'document_title_parts', 'azure_opt_document_title_parts', 50 );

function azure_opt_body_classes( $classes ) {
	$classes[] = 'opt-site';

	if ( is_front_page() ) {
		$classes[] = 'opt-home';
	}

	if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		$classes[] = 'opt-commerce';
	}

	return $classes;
}
add_filter( 'body_class', 'azure_opt_body_classes', 20 );

function azure_opt_meta( $product_id, $key, $default = '' ) {
	if ( function_exists( 'azure_synthetics_get_product_meta_value' ) ) {
		return azure_synthetics_get_product_meta_value( $product_id, $key, $default );
	}

	return $default;
}

function azure_opt_product_title( $product_id ) {
	if ( function_exists( 'azure_synthetics_get_product_display_title' ) ) {
		return azure_synthetics_get_product_display_title( $product_id );
	}

	return get_the_title( $product_id );
}

function azure_opt_product_image( $product, $context = 'card' ) {
	if ( function_exists( 'azure_synthetics_render_product_asset_image' ) ) {
		$image = azure_synthetics_render_product_asset_image( $product, $context );

		if ( $image ) {
			return $image;
		}
	}

	return $product instanceof WC_Product ? $product->get_image( 'large' ) : '';
}

function azure_opt_get_featured_products( $limit = 4 ) {
	if ( ! function_exists( 'wc_get_products' ) ) {
		return array();
	}

	return wc_get_products(
		array(
			'limit'    => $limit,
			'featured' => true,
			'status'   => 'publish',
			'orderby'  => 'menu_order',
			'order'    => 'ASC',
		)
	);
}

function azure_opt_get_primary_nav_items() {
	return array(
		array(
			'label' => __( 'Home', 'azure-synthetics' ),
			'url'   => home_url( '/' ),
		),
		array(
			'label' => __( 'Shop', 'azure-synthetics' ),
			'url'   => azure_synthetics_shop_url(),
		),
		array(
			'label' => __( 'FAQ', 'azure-synthetics' ),
			'url'   => home_url( '/faq/' ),
		),
		array(
			'label' => __( 'Calculator', 'azure-synthetics' ),
			'url'   => home_url( '/calculator/' ),
		),
		array(
			'label' => __( 'Contact', 'azure-synthetics' ),
			'url'   => home_url( '/contact/' ),
		),
	);
}

function azure_opt_get_contact_request_topics() {
	if ( function_exists( 'azure_synthetics_get_contact_request_topics' ) ) {
		return azure_synthetics_get_contact_request_topics();
	}

	return array(
		array(
			'title'       => __( 'Certificates', 'azure-synthetics' ),
			'description' => __( 'Request available COA, HPLC, storage, and identity documentation before or after ordering.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Wholesale', 'azure-synthetics' ),
			'description' => __( 'Discuss volume ordering, repeat-buyer workflows, fulfillment timing, and documentation routing.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Order Support', 'azure-synthetics' ),
			'description' => __( 'Get help with checkout, shipping availability, product selection, and batch-reference questions.', 'azure-synthetics' ),
		),
	);
}

function azure_opt_get_faq_guidance_cards() {
	return array(
		array(
			'title'       => __( 'Certificates', 'azure-synthetics' ),
			'description' => __( 'Request batch-linked paperwork through support when documentation is needed for a specific order or compound.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Storage', 'azure-synthetics' ),
			'description' => __( 'Product records list form, vial amount, and storage notes. Confirm product-specific handling when the order arrives.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Calculator', 'azure-synthetics' ),
			'description' => __( 'The calculator returns concentration, volume, and syringe-unit arithmetic. It does not create protocols.', 'azure-synthetics' ),
		),
	);
}

function azure_opt_get_default_faqs() {
	return array(
		array(
			'question' => __( 'Are Azure products for human use?', 'azure-synthetics' ),
			'answer'   => azure_opt_research_boundary_text(),
		),
		array(
			'question' => __( 'How do I request certificates?', 'azure-synthetics' ),
			'answer'   => __( 'Use the contact page with the product name, order number, or batch reference when available. Support can route available batch-linked paperwork.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'What does the purity cue mean?', 'azure-synthetics' ),
			'answer'   => __( 'The catalog lists the current purity range or support status available for that product record. Ask support for batch-linked paperwork when needed.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'Does the calculator provide dosing?', 'azure-synthetics' ),
			'answer'   => __( 'No. It performs arithmetic from the values entered: vial amount, fluid volume, target amount, and syringe type.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'How should products be stored?', 'azure-synthetics' ),
			'answer'   => __( 'Follow the product label and storage note. Most lyophilized peptide listings call for sealed, cold, dry storage and protection from heat swings.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'Do product pages make outcome claims?', 'azure-synthetics' ),
			'answer'   => __( 'No. Listings show compound class, literature lane, form, amount, purity cue, storage, and support access without personal-use claims.', 'azure-synthetics' ),
		),
	);
}

function azure_opt_get_science_research_dossiers() {
	if ( function_exists( 'azure_synthetics_get_science_research_dossiers' ) ) {
		return azure_synthetics_get_science_research_dossiers();
	}

	return array(
		array(
			'tier'     => __( 'Tier A', 'azure-synthetics' ),
			'title'    => __( 'Retatrutide', 'azure-synthetics' ),
			'category' => __( 'Metabolic / incretin research', 'azure-synthetics' ),
			'summary'  => __( 'Retatrutide has the strongest human-trial signal in the catalog, with phase 2 obesity literature and late-stage study activity. Azure frames the compound by identity, evidence maturity, storage, and documentation cues rather than outcome promises.', 'azure-synthetics' ),
			'boundary' => __( 'Discuss trial maturity and receptor-class context; do not provide preparation, treatment, or human-use guidance.', 'azure-synthetics' ),
			'sources'  => array(
				array(
					'label' => __( 'PubMed: phase 2 trial', 'azure-synthetics' ),
					'url'   => 'https://pubmed.ncbi.nlm.nih.gov/37366315/',
				),
				array(
					'label' => __( 'ClinicalTrials.gov: TRIUMPH-1', 'azure-synthetics' ),
					'url'   => 'https://clinicaltrials.gov/study/NCT05929066',
				),
			),
		),
		array(
			'tier'     => __( 'Tier B', 'azure-synthetics' ),
			'title'    => __( 'CJC-1295 / Ipamorelin', 'azure-synthetics' ),
			'category' => __( 'GH secretagogue / endocrine research', 'azure-synthetics' ),
			'summary'  => __( 'CJC-1295 and Ipamorelin sit in a focused endocrine-signaling lane. The useful buyer context is compound identity, secretagogue class, format, storage, and certificate path.', 'azure-synthetics' ),
			'boundary' => __( 'Endocrine research context only. No anti-aging, performance, or body-composition instruction.', 'azure-synthetics' ),
			'sources'  => array(
				array(
					'label' => __( 'PubMed: CJC-1295 pharmacology', 'azure-synthetics' ),
					'url'   => 'https://pubmed.ncbi.nlm.nih.gov/16352683/',
				),
				array(
					'label' => __( 'PubMed: Ipamorelin pharmacology', 'azure-synthetics' ),
					'url'   => 'https://pubmed.ncbi.nlm.nih.gov/9849822/',
				),
			),
		),
		array(
			'tier'     => __( 'Tier C', 'azure-synthetics' ),
			'title'    => __( 'MOTS-c', 'azure-synthetics' ),
			'category' => __( 'Mitochondrial-derived peptide research', 'azure-synthetics' ),
			'summary'  => __( 'MOTS-c is usually compared through mitochondrial signaling, metabolic stress, and cellular-resilience research. The literature is active, but clinical translation remains developing.', 'azure-synthetics' ),
			'boundary' => __( 'Mechanism-led research context only. No energy, longevity, or metabolic outcome promise.', 'azure-synthetics' ),
			'sources'  => array(
				array(
					'label' => __( 'PubMed: MOTS-c review', 'azure-synthetics' ),
					'url'   => 'https://pubmed.ncbi.nlm.nih.gov/36761202/',
				),
			),
		),
		array(
			'tier'     => __( 'Tier C', 'azure-synthetics' ),
			'title'    => __( 'BPC-157', 'azure-synthetics' ),
			'category' => __( 'Recovery / repair research', 'azure-synthetics' ),
			'summary'  => __( 'BPC-157 has strong market demand and a broad preclinical footprint around tissue-stress and repair-pathway models. Human evidence remains limited.', 'azure-synthetics' ),
			'boundary' => __( 'Repair-category research context only. No healing, injury-treatment, or clinical-benefit claims.', 'azure-synthetics' ),
			'sources'  => array(
				array(
					'label' => __( 'PubMed: literature review', 'azure-synthetics' ),
					'url'   => 'https://pubmed.ncbi.nlm.nih.gov/40005999/',
				),
			),
		),
	);
}

function azure_opt_get_science_evidence_tiers() {
	if ( function_exists( 'azure_synthetics_get_science_evidence_tiers' ) ) {
		return azure_synthetics_get_science_evidence_tiers();
	}

	return array(
		array(
			'label'       => __( 'Tier A', 'azure-synthetics' ),
			'title'       => __( 'Human trial signal', 'azure-synthetics' ),
			'description' => __( 'Contemporary human literature allows clearer evidence context while still avoiding personal-use guidance.', 'azure-synthetics' ),
		),
		array(
			'label'       => __( 'Tier B', 'azure-synthetics' ),
			'title'       => __( 'Focused pharmacology', 'azure-synthetics' ),
			'description' => __( 'Mechanism and endocrine-context language can be useful, but outcome claims stay off the page.', 'azure-synthetics' ),
		),
		array(
			'label'       => __( 'Tier C', 'azure-synthetics' ),
			'title'       => __( 'Preclinical-heavy', 'azure-synthetics' ),
			'description' => __( 'These compounds need conservative summaries, proof-status clarity, and documentation support.', 'azure-synthetics' ),
		),
		array(
			'label'       => __( 'Tier D', 'azure-synthetics' ),
			'title'       => __( 'Emerging interest', 'azure-synthetics' ),
			'description' => __( 'Commercial demand may arrive before evidence maturity. These entries stay short and conservative.', 'azure-synthetics' ),
		),
	);
}

function azure_opt_get_science_source_cards() {
	if ( function_exists( 'azure_synthetics_get_science_source_cards' ) ) {
		return azure_synthetics_get_science_source_cards();
	}

	return array(
		array(
			'title'       => __( 'Alias Clarity', 'azure-synthetics' ),
			'description' => __( 'Search-friendly names still point back to the canonical compound, category, amount, and form.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Research Context', 'azure-synthetics' ),
			'description' => __( 'Every compound gets a maturity signal so buyers can separate human literature from preclinical interest.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Proof Status', 'azure-synthetics' ),
			'description' => __( 'Certificate path, product data, and request-based documentation are listed separately.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Storage Readiness', 'azure-synthetics' ),
			'description' => __( 'Handling and support notes stay close to the buying path so repeat orders feel organized.', 'azure-synthetics' ),
		),
	);
}

function azure_opt_get_compliance_principles() {
	if ( function_exists( 'azure_synthetics_get_compliance_principles' ) ) {
		return azure_synthetics_get_compliance_principles();
	}

	return array(
		array(
			'title'       => __( 'Use policy', 'azure-synthetics' ),
			'description' => azure_opt_research_boundary_text(),
		),
		array(
			'title'       => __( 'Documentation clarity', 'azure-synthetics' ),
			'description' => __( 'Available product details, request-based support, and unavailable documents are labeled separately.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Cold-chain ready', 'azure-synthetics' ),
			'description' => __( 'Storage, inspection, and support details sit directly beside checkout.', 'azure-synthetics' ),
		),
	);
}

function azure_opt_get_category_nav_items() {
	return array(
		array(
			'label' => __( 'Peptides', 'azure-synthetics' ),
			'url'   => home_url( '/product-category/peptides/' ),
		),
		array(
			'label' => __( 'Blends', 'azure-synthetics' ),
			'url'   => home_url( '/product-category/blends/' ),
		),
		array(
			'label' => __( 'Longevity', 'azure-synthetics' ),
			'url'   => home_url( '/product-category/longevity/' ),
		),
		array(
			'label' => __( 'Nootropics', 'azure-synthetics' ),
			'url'   => home_url( '/product-category/nootropics/' ),
		),
		array(
			'label' => __( 'Supplies', 'azure-synthetics' ),
			'url'   => home_url( '/product-category/supplies/' ),
		),
	);
}

function azure_opt_get_static_page_template( $template ) {
	global $wp, $wp_query;

	$request = isset( $wp->request ) ? trim( (string) $wp->request, '/' ) : '';
	$routes  = array(
		'calculator'           => 'page-templates/template-calculator.php',
		'policy'               => 'page-templates/template-compliance.php',
		'research-use-policy'  => 'page-templates/template-compliance.php',
	);

	if ( ! isset( $routes[ $request ] ) ) {
		return $template;
	}

	if ( $wp_query ) {
		$wp_query->is_404  = false;
		$wp_query->is_page = true;
	}

	status_header( 200 );

	return get_stylesheet_directory() . '/' . $routes[ $request ];
}
add_filter( 'template_include', 'azure_opt_get_static_page_template', 99 );

function azure_opt_get_catalog_categories() {
	return array(
		'peptides'   => array(
			'name'        => __( 'Peptides', 'azure-synthetics' ),
			'description' => __( 'Core research peptides for recovery, metabolic, aesthetic, immune, and performance-adjacent literature review.', 'azure-synthetics' ),
		),
		'blends'     => array(
			'name'        => __( 'Blends', 'azure-synthetics' ),
			'description' => __( 'Multi-compound research formats for buyers comparing stack architecture and category fit.', 'azure-synthetics' ),
		),
		'longevity'  => array(
			'name'        => __( 'Longevity', 'azure-synthetics' ),
			'description' => __( 'Mitochondrial, redox, cellular-aging, and resilience research for evidence-literate self-improvement buyers.', 'azure-synthetics' ),
		),
		'nootropics' => array(
			'name'        => __( 'Nootropics', 'azure-synthetics' ),
			'description' => __( 'Focus, sleep, stress, and neuro-signaling research categories with clear proof and handling cues.', 'azure-synthetics' ),
		),
		'supplies'   => array(
			'name'        => __( 'Supplies', 'azure-synthetics' ),
			'description' => __( 'Support items for organized research workflows and clean catalog pairing.', 'azure-synthetics' ),
		),
		'recovery'   => array(
			'name'        => __( 'Recovery', 'azure-synthetics' ),
			'description' => __( 'Repair-pathway, connective-tissue, dermal, and training-stress research compounds.', 'azure-synthetics' ),
		),
		'metabolic'  => array(
			'name'        => __( 'Metabolic', 'azure-synthetics' ),
			'description' => __( 'Body-composition, incretin, energy-use, and metabolic-signaling research lanes.', 'azure-synthetics' ),
		),
		'aesthetic'  => array(
			'name'        => __( 'Aesthetic', 'azure-synthetics' ),
			'description' => __( 'Skin, pigment, matrix, and appearance-adjacent research with cautious claim boundaries.', 'azure-synthetics' ),
		),
		'gh-axis'    => array(
			'name'        => __( 'GH Axis', 'azure-synthetics' ),
			'description' => __( 'GHRH, GHS-R, IGF, and endocrine-signaling research for system-minded buyers.', 'azure-synthetics' ),
		),
		'immune'     => array(
			'name'        => __( 'Immune', 'azure-synthetics' ),
			'description' => __( 'Immune-modulation, epithelial, and inflammation-pathway research categories.', 'azure-synthetics' ),
		),
	);
}

function azure_opt_get_catalog_lanes() {
	return array(
		'metabolic'  => array(
			'descriptor' => __( 'Metabolic research', 'azure-synthetics' ),
			'subtitle'  => __( 'Lyophilized metabolic research compound for body-composition literature review', 'azure-synthetics' ),
			'badge'     => __( 'Metabolic signal', 'azure-synthetics' ),
			'summary'   => __( 'metabolic signaling, incretin, AMPK, adipose, and energy-balance research', 'azure-synthetics' ),
			'mechanism' => __( 'Metabolic entries center on receptor signaling, AMPK activity, adipose vasculature, GH-fragment biology, or energy-use markers depending on compound.', 'azure-synthetics' ),
			'evidence'  => __( 'Tier A/B', 'azure-synthetics' ),
		),
		'recovery'   => array(
			'descriptor' => __( 'Recovery research', 'azure-synthetics' ),
			'subtitle'  => __( 'Lyophilized recovery-category research peptide for repair-pathway review', 'azure-synthetics' ),
			'badge'     => __( 'Recovery interest', 'azure-synthetics' ),
			'summary'   => __( 'repair-pathway, collagen matrix, epithelial, connective-tissue, and tissue-stress research', 'azure-synthetics' ),
			'mechanism' => __( 'Recovery entries are organized around collagen-matrix signaling, angiogenesis, epithelial integrity, tissue-stress response, or host-defense literature.', 'azure-synthetics' ),
			'evidence'  => __( 'Tier B/C', 'azure-synthetics' ),
		),
		'gh-axis'    => array(
			'descriptor' => __( 'GH-axis research', 'azure-synthetics' ),
			'subtitle'  => __( 'Lyophilized endocrine-signaling research peptide for systems review', 'azure-synthetics' ),
			'badge'     => __( 'Axis research', 'azure-synthetics' ),
			'summary'   => __( 'GHRH, GHS-R, gonadotropin, IGF, and endocrine-axis research', 'azure-synthetics' ),
			'mechanism' => __( 'GH-axis entries focus on endocrine signaling, receptor selectivity, release-pattern research, and axis feedback context.', 'azure-synthetics' ),
			'evidence'  => __( 'Tier B/C', 'azure-synthetics' ),
		),
		'longevity'  => array(
			'descriptor' => __( 'Longevity research', 'azure-synthetics' ),
			'subtitle'  => __( 'Lyophilized cellular-performance research compound for longevity review', 'azure-synthetics' ),
			'badge'     => __( 'Longevity signal', 'azure-synthetics' ),
			'summary'   => __( 'mitochondrial, redox, telomere, senescence, and cellular-resilience research', 'azure-synthetics' ),
			'mechanism' => __( 'Longevity entries focus on mitochondrial signaling, redox balance, cellular stress response, senescence markers, or telomere-adjacent literature.', 'azure-synthetics' ),
			'evidence'  => __( 'Tier B/C', 'azure-synthetics' ),
		),
		'nootropics' => array(
			'descriptor' => __( 'Nootropic research', 'azure-synthetics' ),
			'subtitle'  => __( 'Lyophilized focus and sleep research peptide for neuro-signaling review', 'azure-synthetics' ),
			'badge'     => __( 'Neuro signal', 'azure-synthetics' ),
			'summary'   => __( 'focus, stress, sleep, neurotrophic, and neuroimmune research', 'azure-synthetics' ),
			'mechanism' => __( 'Nootropic entries focus on neurotrophic signaling, stress-response pathways, sleep architecture, neurotransmission, or neuroimmune literature.', 'azure-synthetics' ),
			'evidence'  => __( 'Tier B/C', 'azure-synthetics' ),
		),
		'aesthetic'  => array(
			'descriptor' => __( 'Aesthetic research', 'azure-synthetics' ),
			'subtitle'  => __( 'Lyophilized aesthetic-signaling research peptide for appearance-category review', 'azure-synthetics' ),
			'badge'     => __( 'Aesthetic signal', 'azure-synthetics' ),
			'summary'   => __( 'skin, pigment, melanocortin, copper peptide, and dermal-matrix research', 'azure-synthetics' ),
			'mechanism' => __( 'Aesthetic entries center on melanocortin receptors, copper peptide signaling, collagen, dermal matrix, and pigment-adjacent literature.', 'azure-synthetics' ),
			'evidence'  => __( 'Tier B/C', 'azure-synthetics' ),
		),
		'immune'     => array(
			'descriptor' => __( 'Immune research', 'azure-synthetics' ),
			'subtitle'  => __( 'Lyophilized immune-signaling research peptide for pathway review', 'azure-synthetics' ),
			'badge'     => __( 'Immune signal', 'azure-synthetics' ),
			'summary'   => __( 'immune, epithelial, cytokine, host-defense, and inflammatory-pathway research', 'azure-synthetics' ),
			'mechanism' => __( 'Immune entries center on T-cell signaling, epithelial integrity, cytokine networks, host-defense peptides, and inflammatory-pathway literature.', 'azure-synthetics' ),
			'evidence'  => __( 'Tier B/C', 'azure-synthetics' ),
		),
		'blends'     => array(
			'descriptor' => __( 'Blend research', 'azure-synthetics' ),
			'subtitle'  => __( 'Lyophilized multi-compound research blend for stack-architecture review', 'azure-synthetics' ),
			'badge'     => __( 'Stack format', 'azure-synthetics' ),
			'summary'   => __( 'multi-compound architecture, pathway overlap, and paired research formats', 'azure-synthetics' ),
			'mechanism' => __( 'Blend entries list component roles, category fit, pathway overlap, and format architecture.', 'azure-synthetics' ),
			'evidence'  => __( 'Tier B/C', 'azure-synthetics' ),
		),
		'supplies'   => array(
			'descriptor' => __( 'Research supply', 'azure-synthetics' ),
			'subtitle'  => __( 'Support item for organized research workflows', 'azure-synthetics' ),
			'badge'     => __( 'Support item', 'azure-synthetics' ),
			'summary'   => __( 'catalog pairing, label clarity, and research math support items', 'azure-synthetics' ),
			'mechanism' => __( 'Supply entries support catalog pairing, concentration math, storage organization, and order workflow clarity.', 'azure-synthetics' ),
			'evidence'  => __( 'Support', 'azure-synthetics' ),
		),
	);
}

function azure_opt_get_product_evidence_tier( $product ) {
	$product_id = $product instanceof WC_Product ? $product->get_id() : absint( $product );
	$slug       = $product instanceof WC_Product ? $product->get_slug() : get_post_field( 'post_name', $product_id );
	$tier       = trim( (string) azure_opt_meta( $product_id, 'evidence_tier', '' ) );

	if ( $tier && false === stripos( $tier, 'pending' ) ) {
		return $tier;
	}

	$specific = array(
		'retatrutide'   => __( 'Tier A', 'azure-synthetics' ),
		'tirzepatide'  => __( 'Tier A', 'azure-synthetics' ),
		'mazdutide'    => __( 'Tier A/B', 'azure-synthetics' ),
		'tesamorelin'  => __( 'Tier A/B', 'azure-synthetics' ),
		'aod-9604'     => __( 'Tier B/C', 'azure-synthetics' ),
		'adipotide'    => __( 'Tier B/C', 'azure-synthetics' ),
		'aicar'        => __( 'Tier B/C', 'azure-synthetics' ),
		'bpc-157'      => __( 'Tier C', 'azure-synthetics' ),
		'tb-500'       => __( 'Tier C', 'azure-synthetics' ),
		'mots-c'       => __( 'Tier C', 'azure-synthetics' ),
		'ss-31-elamipretide' => __( 'Tier C', 'azure-synthetics' ),
		'bacteriostatic-water' => __( 'Support', 'azure-synthetics' ),
	);

	if ( isset( $specific[ $slug ] ) ) {
		return $specific[ $slug ];
	}

	$seed_products = azure_opt_get_catalog_seed_products();
	$lanes         = azure_opt_get_catalog_lanes();

	foreach ( $seed_products as $item ) {
		if ( isset( $item['slug'], $item['lane'] ) && $slug === $item['slug'] && isset( $lanes[ $item['lane'] ]['evidence'] ) ) {
			return $lanes[ $item['lane'] ]['evidence'];
		}
	}

	$category_map = array(
		'metabolic'  => __( 'Tier A/B', 'azure-synthetics' ),
		'recovery'   => __( 'Tier B/C', 'azure-synthetics' ),
		'gh-axis'    => __( 'Tier B/C', 'azure-synthetics' ),
		'longevity'  => __( 'Tier B/C', 'azure-synthetics' ),
		'nootropics' => __( 'Tier B/C', 'azure-synthetics' ),
		'aesthetic'  => __( 'Tier B/C', 'azure-synthetics' ),
		'immune'     => __( 'Tier B/C', 'azure-synthetics' ),
		'blends'     => __( 'Tier B/C', 'azure-synthetics' ),
		'supplies'   => __( 'Support', 'azure-synthetics' ),
	);

	foreach ( $category_map as $category_slug => $category_tier ) {
		if ( has_term( $category_slug, 'product_cat', $product_id ) ) {
			return $category_tier;
		}
	}

	return __( 'Tier B/C', 'azure-synthetics' );
}

function azure_opt_get_catalog_seed_products() {
	return array(
		array( 'slug' => 'retatrutide', 'name' => 'Retatrutide', 'lane' => 'metabolic', 'amount' => '15 mg', 'price' => '130', 'purity' => '98.5%-99.2%', 'alias' => 'GIP / GLP-1 / glucagon tri-agonist series', 'featured' => true ),
		array( 'slug' => 'tirzepatide', 'name' => 'Tirzepatide', 'lane' => 'metabolic', 'amount' => '30 mg', 'price' => '155', 'purity' => '98.8%-99.5%', 'alias' => 'GIP / GLP-1 dual-agonist research peptide', 'featured' => true ),
		array( 'slug' => 'mazdutide', 'name' => 'Mazdutide', 'lane' => 'metabolic', 'amount' => '10 mg', 'price' => '118', 'purity' => '98.6%-99.4%', 'alias' => 'GLP-1 / glucagon dual-agonist research peptide' ),
		array( 'slug' => 'aod-9604', 'name' => 'AOD-9604', 'lane' => 'metabolic', 'amount' => '5 mg', 'price' => '74', 'purity' => '98.7%-99.3%', 'alias' => 'GH fragment 176-191 research peptide' ),
		array( 'slug' => 'adipotide', 'name' => 'Adipotide', 'lane' => 'metabolic', 'amount' => '10 mg', 'price' => '112', 'purity' => '98.3%-99.1%', 'alias' => 'Prohibitin-targeting metabolic research peptide' ),
		array( 'slug' => 'aicar', 'name' => 'AICAR', 'lane' => 'metabolic', 'amount' => '50 mg', 'price' => '86', 'purity' => '98.9%-99.6%', 'alias' => 'AMPK-pathway research compound' ),
		array( 'slug' => 'tesamorelin', 'name' => 'Tesamorelin', 'lane' => 'metabolic', 'amount' => '10 mg', 'price' => '98', 'purity' => '98.8%-99.4%', 'alias' => 'Stabilized GHRH analog research peptide' ),
		array( 'slug' => 'slu-pp-332', 'name' => 'SLU-PP-332', 'lane' => 'metabolic', 'amount' => '10 mg', 'price' => '92', 'purity' => '98.2%-99.0%', 'alias' => 'ERR pathway metabolic research compound' ),
		array( 'slug' => 'bpc-157', 'name' => 'BPC-157', 'lane' => 'recovery', 'amount' => '10 mg', 'price' => '69', 'purity' => '99.1%-99.6%', 'alias' => 'Body Protection Compound 157', 'featured' => true ),
		array( 'slug' => 'tb-500', 'name' => 'TB-500', 'lane' => 'recovery', 'amount' => '10 mg', 'price' => '68', 'purity' => '99.0%-99.4%', 'alias' => 'Thymosin beta-4 fragment research peptide' ),
		array( 'slug' => 'bpc-157-tb-500-blend', 'name' => 'BPC-157 + TB-500 Blend', 'lane' => 'blends', 'amount' => '10 mg + 10 mg', 'price' => '118', 'purity' => '98.9%-99.3%', 'alias' => 'Recovery research blend', 'featured' => true ),
		array( 'slug' => 'ghk-cu', 'name' => 'GHK-Cu', 'lane' => 'aesthetic', 'amount' => '100 mg', 'price' => '79', 'purity' => '99.0%-99.6%', 'alias' => 'Copper tripeptide research compound', 'featured' => true ),
		array( 'slug' => 'kpv', 'name' => 'KPV', 'lane' => 'immune', 'amount' => '10 mg', 'price' => '62', 'purity' => '98.8%-99.4%', 'alias' => 'Alpha-MSH fragment research peptide' ),
		array( 'slug' => 'll-37', 'name' => 'LL-37', 'lane' => 'immune', 'amount' => '5 mg', 'price' => '82', 'purity' => '98.4%-99.1%', 'alias' => 'Cathelicidin antimicrobial research peptide' ),
		array( 'slug' => 'peg-mgf', 'name' => 'PEG-MGF', 'lane' => 'recovery', 'amount' => '2 mg', 'price' => '72', 'purity' => '98.5%-99.2%', 'alias' => 'PEGylated mechano growth factor research peptide' ),
		array( 'slug' => 'cjc-1295-ipamorelin', 'name' => 'CJC-1295 / Ipamorelin', 'lane' => 'gh-axis', 'amount' => '5 mg / 5 mg', 'price' => '92', 'purity' => '97.9%-99.1%', 'alias' => 'GH secretagogue research stack', 'featured' => true ),
		array( 'slug' => 'cjc-1295-no-dac', 'name' => 'CJC-1295 No DAC', 'lane' => 'gh-axis', 'amount' => '5 mg', 'price' => '58', 'purity' => '98.7%-99.4%', 'alias' => 'Short-pulse GHRH analog research peptide' ),
		array( 'slug' => 'cjc-1295-with-dac', 'name' => 'CJC-1295 with DAC', 'lane' => 'gh-axis', 'amount' => '5 mg', 'price' => '68', 'purity' => '98.6%-99.2%', 'alias' => 'Extended GHRH analog research peptide' ),
		array( 'slug' => 'ipamorelin', 'name' => 'Ipamorelin', 'lane' => 'gh-axis', 'amount' => '5 mg', 'price' => '54', 'purity' => '98.8%-99.4%', 'alias' => 'Selective GHS-R research peptide' ),
		array( 'slug' => 'sermorelin', 'name' => 'Sermorelin', 'lane' => 'gh-axis', 'amount' => '5 mg', 'price' => '56', 'purity' => '98.7%-99.3%', 'alias' => 'GHRH analog research peptide' ),
		array( 'slug' => 'ghrp-2', 'name' => 'GHRP-2', 'lane' => 'gh-axis', 'amount' => '5 mg', 'price' => '49', 'purity' => '98.6%-99.2%', 'alias' => 'Growth hormone releasing peptide-2' ),
		array( 'slug' => 'ghrp-6', 'name' => 'GHRP-6', 'lane' => 'gh-axis', 'amount' => '5 mg', 'price' => '49', 'purity' => '98.6%-99.2%', 'alias' => 'Growth hormone releasing peptide-6' ),
		array( 'slug' => 'hexarelin', 'name' => 'Hexarelin', 'lane' => 'gh-axis', 'amount' => '5 mg', 'price' => '58', 'purity' => '98.5%-99.1%', 'alias' => 'GHS-R research peptide' ),
		array( 'slug' => 'igf-1-lr3', 'name' => 'IGF-1 LR3', 'lane' => 'gh-axis', 'amount' => '1 mg', 'price' => '92', 'purity' => '98.4%-99.0%', 'alias' => 'Long R3 IGF-1 research peptide' ),
		array( 'slug' => 'gonadorelin', 'name' => 'Gonadorelin', 'lane' => 'gh-axis', 'amount' => '2 mg', 'price' => '64', 'purity' => '98.9%-99.4%', 'alias' => 'GnRH decapeptide research compound' ),
		array( 'slug' => 'kisspeptin-10', 'name' => 'Kisspeptin-10', 'lane' => 'gh-axis', 'amount' => '5 mg', 'price' => '58', 'purity' => '98.7%-99.3%', 'alias' => 'KISS1R / GPR54 research peptide' ),
		array( 'slug' => 'mots-c', 'name' => 'MOTS-c', 'lane' => 'longevity', 'amount' => '10 mg', 'price' => '78', 'purity' => '98.8%-99.4%', 'alias' => 'Mitochondrial-derived peptide MOTS-c', 'featured' => true ),
		array( 'slug' => 'ss-31-elamipretide', 'name' => 'SS-31 / Elamipretide', 'lane' => 'longevity', 'amount' => '10 mg', 'price' => '88', 'purity' => '99.0%-99.5%', 'alias' => 'Cardiolipin-targeting mitochondrial research peptide' ),
		array( 'slug' => 'epitalon', 'name' => 'Epitalon', 'lane' => 'longevity', 'amount' => '10 mg', 'price' => '64', 'purity' => '99.0%-99.5%', 'alias' => 'Pineal tetrapeptide research compound' ),
		array( 'slug' => 'foxo4-dri', 'name' => 'FOXO4-DRI', 'lane' => 'longevity', 'amount' => '5 mg', 'price' => '124', 'purity' => '98.1%-98.9%', 'alias' => 'Senescence-pathway research peptide' ),
		array( 'slug' => 'nad', 'name' => 'NAD+', 'lane' => 'longevity', 'amount' => '500 mg', 'price' => '108', 'purity' => '99.0%-99.6%', 'alias' => 'Cellular coenzyme research compound' ),
		array( 'slug' => 'glutathione', 'name' => 'Glutathione', 'lane' => 'longevity', 'amount' => '600 mg', 'price' => '86', 'purity' => '99.0%-99.5%', 'alias' => 'Redox research compound' ),
		array( 'slug' => 'semax', 'name' => 'Semax', 'lane' => 'nootropics', 'amount' => '5 mg', 'price' => '58', 'purity' => '98.9%-99.4%', 'alias' => 'ACTH fragment neuro-signaling research peptide' ),
		array( 'slug' => 'selank', 'name' => 'Selank', 'lane' => 'nootropics', 'amount' => '5 mg', 'price' => '58', 'purity' => '98.8%-99.3%', 'alias' => 'Tuftsin analog neuroimmune research peptide' ),
		array( 'slug' => 'dsip', 'name' => 'DSIP', 'lane' => 'nootropics', 'amount' => '5 mg', 'price' => '54', 'purity' => '98.6%-99.2%', 'alias' => 'Delta sleep-inducing peptide' ),
		array( 'slug' => 'melanotan-1', 'name' => 'Melanotan I', 'lane' => 'aesthetic', 'amount' => '10 mg', 'price' => '64', 'purity' => '98.8%-99.3%', 'alias' => 'Afamelanotide / alpha-MSH analog research peptide' ),
		array( 'slug' => 'melanotan-2', 'name' => 'Melanotan II', 'lane' => 'aesthetic', 'amount' => '10 mg', 'price' => '62', 'purity' => '98.7%-99.2%', 'alias' => 'Melanocortin receptor research peptide' ),
		array( 'slug' => 'pt-141', 'name' => 'PT-141', 'lane' => 'aesthetic', 'amount' => '10 mg', 'price' => '68', 'purity' => '98.7%-99.3%', 'alias' => 'Bremelanotide melanocortin research peptide' ),
		array( 'slug' => 'snap-8', 'name' => 'SNAP-8', 'lane' => 'aesthetic', 'amount' => '10 mg', 'price' => '56', 'purity' => '98.6%-99.1%', 'alias' => 'Acetyl octapeptide-3 dermal research peptide' ),
		array( 'slug' => 'thymosin-alpha-1', 'name' => 'Thymosin Alpha-1', 'lane' => 'immune', 'amount' => '10 mg', 'price' => '96', 'purity' => '98.9%-99.4%', 'alias' => 'T-cell signaling research peptide' ),
		array( 'slug' => 'vip-vasoactive-intestinal-peptide', 'name' => 'VIP / Vasoactive Intestinal Peptide', 'lane' => 'immune', 'amount' => '5 mg', 'price' => '98', 'purity' => '98.4%-99.0%', 'alias' => 'Neuroimmune signaling research peptide' ),
		array( 'slug' => 'klow-blend', 'name' => 'KLOW Blend', 'lane' => 'blends', 'amount' => 'Multi-compound kit', 'price' => '128', 'purity' => '98%+ component range', 'alias' => 'Self-improvement research blend' ),
		array( 'slug' => 'bacteriostatic-water', 'name' => 'Bacteriostatic Water', 'lane' => 'supplies', 'amount' => '30 mL', 'price' => '18', 'purity' => 'Sterile support item', 'alias' => '0.9% benzyl alcohol research supply' ),
	);
}

function azure_opt_get_catalog_term_id( $slug, array $definition ) {
	$existing = term_exists( $slug, 'product_cat' );

	if ( is_array( $existing ) && ! empty( $existing['term_id'] ) ) {
		wp_update_term(
			(int) $existing['term_id'],
			'product_cat',
			array(
				'name'        => $definition['name'],
				'description' => $definition['description'],
			)
		);

		return (int) $existing['term_id'];
	}

	$created = wp_insert_term(
		$definition['name'],
		'product_cat',
		array(
			'slug'        => $slug,
			'description' => $definition['description'],
		)
	);

	return is_wp_error( $created ) ? 0 : (int) $created['term_id'];
}

function azure_opt_get_catalog_primary_terms( $lane ) {
	$terms = array(
		'peptides',
		$lane,
	);

	if ( in_array( $lane, array( 'blends', 'supplies' ), true ) ) {
		$terms = array( $lane );
	}

	if ( 'aesthetic' === $lane ) {
		$terms[] = 'recovery';
	}

	return array_values( array_unique( $terms ) );
}

function azure_opt_get_compound_literature_copy( $slug, $name, array $lane ) {
	$copy = array(
		'summary'   => sprintf(
			/* translators: 1: product name, 2: lane summary. */
			__( '%1$s is a premium research catalog item in %2$s. Amount, form, purity cue, storage, and certificate support are listed before checkout.', 'azure-synthetics' ),
			$name,
			$lane['summary']
		),
		'mechanism' => sprintf(
			/* translators: 1: product name, 2: lane mechanism. */
			__( '%1$s is grouped by compound class and current literature lane. %2$s', 'azure-synthetics' ),
			$name,
			$lane['mechanism']
		),
		'fit'       => __( 'For buyers comparing compounds by category, vial amount, purity cue, storage requirements, and certificate access.', 'azure-synthetics' ),
		'caution'   => __( 'Research material only. No personal-use, clinical, veterinary, preparation, or outcome guidance is provided.', 'azure-synthetics' ),
	);

	$exact = array(
		'retatrutide' => array(
			'summary'   => __( 'Retatrutide is a metabolic research peptide studied as a triple agonist at GIP, GLP-1, and glucagon receptors. It carries one of the strongest human-trial evidence profiles in the current metabolic peptide category.', 'azure-synthetics' ),
			'mechanism' => __( 'Published retatrutide literature focuses on incretin receptor signaling, glucagon-pathway activity, body-weight endpoints, metabolic markers, and dose-ranging study design.', 'azure-synthetics' ),
			'fit'       => __( 'Best for buyers comparing high-interest metabolic peptides with human trial context, certificate support, and strict research-use boundaries.', 'azure-synthetics' ),
		),
		'tirzepatide' => array(
			'summary'   => __( 'Tirzepatide is a dual GIP / GLP-1 receptor agonist reference point in metabolic research. It anchors comparisons across incretin signaling, glycemic markers, and body-composition literature.', 'azure-synthetics' ),
			'mechanism' => __( 'The literature centers on dual incretin receptor activity, metabolic endpoints, appetite biology, and long-running clinical development data.', 'azure-synthetics' ),
		),
		'mazdutide' => array(
			'summary'   => __( 'Mazdutide sits in the GLP-1 / glucagon dual-agonist research lane, where interest centers on incretin signaling, energy expenditure, and metabolic markers.', 'azure-synthetics' ),
			'mechanism' => __( 'Mazdutide literature is read through GLP-1 and glucagon receptor activity, body-weight endpoints, lipid markers, and glucose regulation research.', 'azure-synthetics' ),
		),
		'aod-9604' => array(
			'summary'   => __( 'AOD-9604 is a modified fragment of human growth hormone 176-191 studied around fat-metabolism signaling. Its market interest is high, while evidence discussions stay narrower than current incretin compounds.', 'azure-synthetics' ),
			'mechanism' => __( 'AOD-9604 literature centers on GH-fragment biology, lipolysis and lipid-metabolism models, and the gap between early mechanistic interest and broad consumer claims.', 'azure-synthetics' ),
		),
		'adipotide' => array(
			'summary'   => __( 'Adipotide is a prohibitin-targeting peptidomimetic studied for adipose vasculature signaling in metabolic research, including preclinical and primate obesity literature.', 'azure-synthetics' ),
			'mechanism' => __( 'Adipotide research focuses on prohibitin binding in white-fat vasculature, targeted pro-apoptotic peptide design, adipose tissue changes, renal safety observations, and body-weight markers in animal models.', 'azure-synthetics' ),
		),
		'aicar' => array(
			'summary'   => __( 'AICAR is an AMPK-pathway research compound used as a reference in cellular energy-sensing, glucose uptake, lipid metabolism, and exercise-mimetic literature.', 'azure-synthetics' ),
			'mechanism' => __( 'AICAR literature centers on AMP-activated protein kinase activation, mitochondrial biogenesis markers, fatty-acid oxidation, glucose transport, and endurance-adaptation models.', 'azure-synthetics' ),
		),
		'tesamorelin' => array(
			'summary'   => __( 'Tesamorelin is a stabilized GHRH analog with clinical literature around GH-axis signaling and visceral adipose tissue endpoints in HIV-associated lipodystrophy research.', 'azure-synthetics' ),
			'mechanism' => __( 'Tesamorelin research focuses on GHRH receptor activity, pulsatile GH-axis signaling, IGF-1 markers, and visceral fat endpoints in controlled studies.', 'azure-synthetics' ),
		),
		'slu-pp-332' => array(
			'summary'   => __( 'SLU-PP-332 is an ERR-pathway research compound studied in exercise-mimetic and metabolic adaptation literature.', 'azure-synthetics' ),
			'mechanism' => __( 'SLU-PP-332 literature centers on estrogen-related receptor signaling, oxidative metabolism, skeletal muscle adaptation, and endurance-model markers.', 'azure-synthetics' ),
		),
		'bpc-157' => array(
			'summary'   => __( 'BPC-157 is a recovery-category research peptide with heavy interest around tissue-stress, tendon, gut, and wound-model literature. Human evidence remains limited compared with market demand.', 'azure-synthetics' ),
			'mechanism' => __( 'BPC-157 literature centers on angiogenesis, nitric-oxide signaling, fibroblast activity, gastrointestinal models, tendon and ligament injury models, and preclinical repair pathways.', 'azure-synthetics' ),
			'fit'       => __( 'For buyers comparing recovery-category compounds with the human-evidence gap stated plainly.', 'azure-synthetics' ),
		),
		'tb-500' => array(
			'summary'   => __( 'TB-500 is a thymosin beta-4 fragment research peptide connected to actin regulation, cell migration, tissue-stress, and wound-model literature.', 'azure-synthetics' ),
			'mechanism' => __( 'TB-500 literature is commonly read through thymosin beta-4 biology, actin sequestration, angiogenesis models, cell motility, and repair-pathway research.', 'azure-synthetics' ),
		),
		'bpc-157-tb-500-blend' => array(
			'summary'   => __( 'BPC-157 + TB-500 Blend pairs two recovery-category research peptides often compared across repair-pathway, angiogenesis, matrix, and cell-migration literature.', 'azure-synthetics' ),
			'mechanism' => __( 'The blend is organized around complementary BPC-157 and thymosin beta-4 fragment research lanes, not around guaranteed recovery outcomes.', 'azure-synthetics' ),
		),
		'ghk-cu' => array(
			'summary'   => __( 'GHK-Cu is a copper tripeptide research compound connected to dermal matrix, collagen, wound-model, and skin-aging literature.', 'azure-synthetics' ),
			'mechanism' => __( 'GHK-Cu literature centers on copper peptide signaling, collagen and elastin markers, extracellular matrix remodeling, and tissue-repair models.', 'azure-synthetics' ),
		),
		'kpv' => array(
			'summary'   => __( 'KPV is an alpha-MSH fragment research peptide studied around epithelial integrity, immune signaling, and inflammatory-pathway models.', 'azure-synthetics' ),
			'mechanism' => __( 'KPV literature centers on melanocortin-derived peptide activity, cytokine modulation, gut and skin epithelial models, and inflammatory signaling.', 'azure-synthetics' ),
		),
		'll-37' => array(
			'summary'   => __( 'LL-37 is a cathelicidin antimicrobial peptide used in host-defense, epithelial barrier, immune, and inflammation research.', 'azure-synthetics' ),
			'mechanism' => __( 'LL-37 literature focuses on antimicrobial peptide biology, innate immune signaling, epithelial response, biofilm interaction, and inflammation models.', 'azure-synthetics' ),
		),
		'cjc-1295-ipamorelin' => array(
			'summary'   => __( 'CJC-1295 / Ipamorelin combines a GHRH analog research peptide with a selective ghrelin receptor secretagogue reference, creating a GH-axis research stack.', 'azure-synthetics' ),
			'mechanism' => __( 'The literature centers on GHRH signaling, GHS-R activity, pulsatile GH release models, IGF-1 markers, and secretagogue selectivity.', 'azure-synthetics' ),
			'fit'       => __( 'For buyers comparing GH-axis compounds by receptor class, format, certificate path, and storage requirements.', 'azure-synthetics' ),
		),
		'mots-c' => array(
			'summary'   => __( 'MOTS-c is a mitochondrial-derived peptide studied in metabolic stress, AMPK-adjacent signaling, glucose metabolism, and cellular adaptation literature.', 'azure-synthetics' ),
			'mechanism' => __( 'MOTS-c literature centers on mitochondrial-nuclear signaling, AMPK pathway interaction, metabolic flexibility, cellular stress response, and aging-marker models.', 'azure-synthetics' ),
			'fit'       => __( 'For buyers comparing longevity and cellular-performance compounds with mechanism-led evidence context.', 'azure-synthetics' ),
		),
		'ss-31-elamipretide' => array(
			'summary'   => __( 'SS-31 / Elamipretide is a mitochondria-targeting peptide studied around cardiolipin interaction, mitochondrial membrane function, and oxidative-stress models.', 'azure-synthetics' ),
			'mechanism' => __( 'SS-31 literature focuses on inner mitochondrial membrane biology, cardiolipin stabilization, reactive oxygen species markers, and mitochondrial function studies.', 'azure-synthetics' ),
		),
		'epitalon' => array(
			'summary'   => __( 'Epitalon is a pineal tetrapeptide research compound often discussed in telomere, circadian, and cellular-aging literature.', 'azure-synthetics' ),
			'mechanism' => __( 'Epitalon literature is read through telomerase activity models, pineal peptide signaling, circadian markers, and aging-related cellular endpoints.', 'azure-synthetics' ),
		),
		'nad' => array(
			'summary'   => __( 'NAD+ is a cellular coenzyme research compound central to redox biology, mitochondrial metabolism, sirtuin activity, and energy-transfer literature.', 'azure-synthetics' ),
			'mechanism' => __( 'NAD+ literature centers on nicotinamide adenine dinucleotide biology, redox balance, DNA repair pathways, mitochondrial function, and aging-marker research.', 'azure-synthetics' ),
		),
		'glutathione' => array(
			'summary'   => __( 'Glutathione is a redox research compound tied to oxidative-stress, detoxification, cellular defense, and antioxidant-system literature.', 'azure-synthetics' ),
			'mechanism' => __( 'Glutathione literature centers on GSH/GSSG balance, oxidative-stress markers, enzymatic antioxidant systems, and cellular protection models.', 'azure-synthetics' ),
		),
		'semax' => array(
			'summary'   => __( 'Semax is an ACTH fragment research peptide discussed in neurotrophic, stress-response, cognition, and neuroprotection literature.', 'azure-synthetics' ),
			'mechanism' => __( 'Semax literature centers on ACTH-derived peptide signaling, BDNF and neurotrophic markers, stress adaptation, and central nervous system research models.', 'azure-synthetics' ),
		),
		'selank' => array(
			'summary'   => __( 'Selank is a tuftsin analog research peptide discussed in anxiety-model, immune-neuroendocrine, stress-response, and neurotransmission literature.', 'azure-synthetics' ),
			'mechanism' => __( 'Selank literature centers on tuftsin-derived peptide biology, GABAergic signaling hypotheses, immune modulation, and stress-behavior models.', 'azure-synthetics' ),
		),
		'dsip' => array(
			'summary'   => __( 'DSIP is a sleep-adjacent research peptide associated with delta sleep, stress physiology, and neuroendocrine literature.', 'azure-synthetics' ),
			'mechanism' => __( 'DSIP literature focuses on sleep architecture hypotheses, stress-response markers, endocrine interaction, and neuropeptide signaling models.', 'azure-synthetics' ),
		),
		'melanotan-1' => array(
			'summary'   => __( 'Melanotan I / afamelanotide is an alpha-MSH analog research peptide tied to melanocortin receptor and pigment biology literature.', 'azure-synthetics' ),
			'mechanism' => __( 'Melanotan I literature centers on MC1R activity, melanogenesis, photoprotection research, and pigment-pathway models.', 'azure-synthetics' ),
		),
		'melanotan-2' => array(
			'summary'   => __( 'Melanotan II is a melanocortin receptor research peptide connected to pigment, appetite, and central melanocortin-pathway literature.', 'azure-synthetics' ),
			'mechanism' => __( 'Melanotan II literature is read through MC1R, MC3R, MC4R, melanogenesis, and melanocortin receptor signaling models.', 'azure-synthetics' ),
		),
		'pt-141' => array(
			'summary'   => __( 'PT-141 / bremelanotide is a melanocortin receptor research peptide studied around central melanocortin signaling.', 'azure-synthetics' ),
			'mechanism' => __( 'PT-141 literature centers on melanocortin receptor pathways, central nervous system signaling, and receptor-selective peptide pharmacology.', 'azure-synthetics' ),
		),
		'bacteriostatic-water' => array(
			'summary'   => __( 'Bacteriostatic Water is a support item for research math and catalog pairing, labeled for sterile workflow organization.', 'azure-synthetics' ),
			'mechanism' => __( 'This supply listing supports concentration calculations and storage planning. It is not a peptide and does not create protocol guidance.', 'azure-synthetics' ),
			'fit'       => __( 'For buyers organizing research calculator inputs and supply pairing.', 'azure-synthetics' ),
		),
	);

	return isset( $exact[ $slug ] ) ? array_merge( $copy, $exact[ $slug ] ) : $copy;
}

function azure_opt_get_catalog_product_text( array $item, array $lane ) {
	$name      = $item['name'];
	$amount    = $item['amount'];
	$literature = azure_opt_get_compound_literature_copy( $item['slug'], $name, $lane );
	$summary   = $literature['summary'];
	$mechanism = $literature['mechanism'];

	$short = sprintf(
		/* translators: 1: product name, 2: amount, 3: badge. */
		__( '%1$s. %2$s. %3$s.', 'azure-synthetics' ),
		$name,
		$amount,
		$lane['badge']
	);

	$long = sprintf(
		'<p>%s</p><p>%s</p><p>%s</p>',
		esc_html( $summary ),
		esc_html( $mechanism ),
		esc_html__( 'Product details include amount, form, purity cue, storage note, and certificate support before checkout.', 'azure-synthetics' )
	);

	return array(
		'summary'   => $summary,
		'short'     => $short,
		'long'      => $long,
		'mechanism' => $mechanism,
	);
}

function azure_opt_save_catalog_meta( $product_id, array $item, array $lane, array $text ) {
	$faqs = array(
		array(
			'question' => sprintf(
				/* translators: %s: product name. */
				__( 'What is %s?', 'azure-synthetics' ),
				$item['name']
			),
			'answer'   => sprintf(
				/* translators: 1: product name, 2: lane summary. */
				__( '%1$s is listed for %2$s with amount, form, purity cue, storage, and support access before ordering.', 'azure-synthetics' ),
				$item['name'],
				$lane['summary']
			),
		),
		array(
			'question' => __( 'What certificate support is available?', 'azure-synthetics' ),
			'answer'   => __( 'Batch-linked paperwork can be requested through support. Listings show category, purity cue, form, amount, and storage note first.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'Does Azure provide protocols?', 'azure-synthetics' ),
			'answer'   => __( 'No. The catalog is research-use-only and does not provide personal health, performance, treatment, or outcome guidance.', 'azure-synthetics' ),
		),
	);

	$meta = array(
		'_azure_compound_alias'          => $item['alias'],
		'_azure_subtitle'                => $lane['subtitle'],
		'_azure_lab_descriptor'          => $lane['descriptor'],
		'_azure_research_summary'        => $text['summary'],
		'_azure_evidence_tier'           => $lane['evidence'],
		'_azure_mechanism_summary'       => $text['mechanism'],
		'_azure_documentation_status'    => __( 'Certificates by support', 'azure-synthetics' ),
		'_azure_proof_surface_label'     => __( 'Purity cue, category context, storage note, and batch-linked certificate support before checkout.', 'azure-synthetics' ),
		'_azure_purity_percent'          => $item['purity'],
		'_azure_form_factor'             => 'supplies' === $item['lane'] ? __( 'Sterile solution', 'azure-synthetics' ) : __( 'Lyophilized powder', 'azure-synthetics' ),
		'_azure_vial_amount'             => $item['amount'],
		'_azure_storage_instructions'    => 'supplies' === $item['lane'] ? __( 'Store according to label. Keep sealed until use in an organized research workflow.', 'azure-synthetics' ) : __( 'Keep sealed, cold, dry, and protected from heat swings. Confirm product-specific storage on arrival.', 'azure-synthetics' ),
		'_azure_shipping_warning'        => __( 'Packed for transit stability with order support available for warm-weather routes.', 'azure-synthetics' ),
		'_azure_batch_reference'         => __( 'Batch-linked certificate support is available through the documentation desk.', 'azure-synthetics' ),
		'_azure_reconstitution_guidance' => __( 'Calculator support covers concentration, fluid volume, and syringe units as arithmetic only.', 'azure-synthetics' ),
		'_azure_research_disclaimer'     => azure_opt_research_boundary_text(),
		'_azure_seo_focus_keyphrase'     => sprintf(
			/* translators: %s: product name. */
			__( '%s research peptide', 'azure-synthetics' ),
			$item['name']
		),
		'_azure_meta_description'        => sprintf(
			/* translators: %s: product name. */
			__( 'Shop %s with amount, form, purity cue, storage note, certificate support, and concise research catalog context.', 'azure-synthetics' ),
			$item['name']
		),
		'_azure_product_faqs'            => wp_json_encode( $faqs ),
	);

	foreach ( $meta as $key => $value ) {
		update_post_meta( $product_id, $key, $value );
	}
}

function azure_opt_upsert_catalog_product( array $item, array $lanes, array $term_ids ) {
	$slug = sanitize_title( $item['slug'] );
	$post = get_page_by_path( $slug, OBJECT, 'product' );

	if ( $post ) {
		$product = wc_get_product( $post->ID );
	} else {
		$product = new WC_Product_Simple();
	}

	if ( ! $product instanceof WC_Product ) {
		return 0;
	}

	$lane = isset( $lanes[ $item['lane'] ] ) ? $lanes[ $item['lane'] ] : $lanes['peptides'];
	$text = azure_opt_get_catalog_product_text( $item, $lane );
	$sku  = 'AZ-' . strtoupper( preg_replace( '/[^A-Z0-9]+/', '-', $slug ) );

	$product->set_name( $item['name'] );
	$product->set_slug( $slug );
	$product->set_status( 'publish' );
	$product->set_catalog_visibility( 'visible' );
	$product->set_featured( ! empty( $item['featured'] ) );
	$product->set_short_description( $text['short'] );
	$product->set_description( $text['long'] );
	$product->set_manage_stock( false );
	$product->set_stock_status( 'instock' );

	$existing_sku_id = wc_get_product_id_by_sku( $sku );
	if ( ! $existing_sku_id || (int) $existing_sku_id === (int) $product->get_id() ) {
		$product->set_sku( $sku );
	}

	if ( $product instanceof WC_Product_Simple ) {
		$product->set_regular_price( $item['price'] );
		$product->set_price( $item['price'] );

		$amount_attribute = new WC_Product_Attribute();
		$amount_attribute->set_name( __( 'Amount', 'azure-synthetics' ) );
		$amount_attribute->set_options( array( $item['amount'] ) );
		$amount_attribute->set_position( 0 );
		$amount_attribute->set_visible( true );
		$amount_attribute->set_variation( false );

		$form_attribute = new WC_Product_Attribute();
		$form_attribute->set_name( __( 'Form', 'azure-synthetics' ) );
		$form_attribute->set_options( array( 'supplies' === $item['lane'] ? __( 'Sterile solution', 'azure-synthetics' ) : __( 'Lyophilized powder', 'azure-synthetics' ) ) );
		$form_attribute->set_position( 1 );
		$form_attribute->set_visible( true );
		$form_attribute->set_variation( false );

		$product->set_attributes( array( $amount_attribute, $form_attribute ) );
	}

	$category_ids = array();
	foreach ( azure_opt_get_catalog_primary_terms( $item['lane'] ) as $term_slug ) {
		if ( ! empty( $term_ids[ $term_slug ] ) ) {
			$category_ids[] = $term_ids[ $term_slug ];
		}
	}

	$product->set_category_ids( array_values( array_unique( $category_ids ) ) );
	$product_id = $product->save();

	if ( $product_id ) {
		azure_opt_save_catalog_meta( $product_id, $item, $lane, $text );
	}

	return $product_id;
}

function azure_opt_seed_catalog_once() {
	if ( ! class_exists( 'WC_Product_Simple' ) || ! function_exists( 'wc_get_product_id_by_sku' ) ) {
		return;
	}

	$version       = '2026-05-03-direct-copy-literature';
	$current_count = wp_count_posts( 'product' );
	$published     = isset( $current_count->publish ) ? (int) $current_count->publish : 0;

	update_option( 'woocommerce_coming_soon', 'no', false );
	update_option( 'woocommerce_store_pages_only', 'no', false );

	if ( $version === get_option( 'azure_opt_catalog_seed_version' ) && $published >= 43 ) {
		return;
	}

	$categories = azure_opt_get_catalog_categories();
	$term_ids   = array();

	foreach ( $categories as $slug => $definition ) {
		$term_ids[ $slug ] = azure_opt_get_catalog_term_id( $slug, $definition );
	}

	$lanes = azure_opt_get_catalog_lanes();

	foreach ( azure_opt_get_catalog_seed_products() as $item ) {
		azure_opt_upsert_catalog_product( $item, $lanes, $term_ids );
	}

	update_option( 'azure_opt_catalog_seed_version', $version, false );
}
add_action( 'init', 'azure_opt_seed_catalog_once', 25 );

function azure_opt_get_product_sources( $slug ) {
	$sources = array(
		'retatrutide' => array(
			array(
				'label' => __( 'NEJM phase 2 trial', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/37366315/',
			),
			array(
				'label' => __( 'TRIUMPH design paper', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/41090431/',
			),
		),
		'cjc-1295-ipamorelin' => array(
			array(
				'label' => __( 'CJC-1295 human pharmacology', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/16352683/',
			),
			array(
				'label' => __( 'Ipamorelin PK/PD model', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/10496658/',
			),
		),
		'mots-c' => array(
			array(
				'label' => __( 'MDP systematic review', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/39160573/',
			),
			array(
				'label' => __( 'MOTS-c review context', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/36677050/',
			),
		),
		'bpc-157' => array(
			array(
				'label' => __( 'BPC-157 narrative review', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/40789979/',
			),
			array(
				'label' => __( 'FDA peptide risk note', 'azure-synthetics' ),
				'url'   => 'https://www.fda.gov/drugs/human-drug-compounding/certain-bulk-drug-substances-use-compounding-may-present-significant-safety-risks',
			),
		),
		'adipotide' => array(
			array(
				'label' => __( 'Adipotide primate study', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/22072637/',
			),
			array(
				'label' => __( 'Prohibitin targeting context', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/22733798/',
			),
		),
		'aicar' => array(
			array(
				'label' => __( 'AMPK exercise-mimetic study', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/17786544/',
			),
			array(
				'label' => __( 'AICAR metabolic signaling review', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/18003746/',
			),
		),
		'tesamorelin' => array(
			array(
				'label' => __( 'Tesamorelin visceral adipose study', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/20164421/',
			),
			array(
				'label' => __( 'Tesamorelin clinical review', 'azure-synthetics' ),
				'url'   => 'https://pubmed.ncbi.nlm.nih.gov/21830493/',
			),
		),
	);

	return $sources[ $slug ] ?? array();
}

function azure_opt_get_product_copy( $product ) {
	$product_id = $product instanceof WC_Product ? $product->get_id() : absint( $product );
	$slug       = $product instanceof WC_Product ? $product->get_slug() : get_post_field( 'post_name', $product_id );
	$title      = azure_opt_product_title( $product_id );
	$purity     = azure_opt_meta( $product_id, 'purity_percent', '' );
	$form       = azure_opt_meta( $product_id, 'form_factor', '' );
	$amount     = azure_opt_meta( $product_id, 'vial_amount', '' );
	$lane       = array(
		'summary'   => __( 'research peptide comparison', 'azure-synthetics' ),
		'mechanism' => __( 'The product record lists compound class, category, amount, storage, and certificate support.', 'azure-synthetics' ),
	);
	$seed       = azure_opt_get_catalog_seed_products();

	foreach ( $seed as $item ) {
		if ( isset( $item['slug'] ) && $slug === $item['slug'] ) {
			$lanes = azure_opt_get_catalog_lanes();
			$lane  = isset( $lanes[ $item['lane'] ] ) ? $lanes[ $item['lane'] ] : $lane;
			break;
		}
	}

	$literature = azure_opt_get_compound_literature_copy( $slug, $title, $lane );

	$copy = array(
		'badge'       => __( 'Research peptide', 'azure-synthetics' ),
		'category'    => __( 'Premium catalog', 'azure-synthetics' ),
		'summary'     => azure_opt_meta( $product_id, 'research_summary', $literature['summary'] ),
		'research'    => azure_opt_meta( $product_id, 'mechanism_summary', $literature['mechanism'] ),
		'fit'         => $literature['fit'],
		'caution'     => $literature['caution'],
		'verification' => $purity
			? sprintf(
				/* translators: %s: purity range. */
				__( 'Purity cue: %s. Certificate support is available for batch-linked documentation.', 'azure-synthetics' ),
				$purity
			)
			: __( 'Certificate support is available for batch-linked documentation.', 'azure-synthetics' ),
		'specs'       => array_filter( array( $form, $amount ) ),
	);

	$exact = array(
		'retatrutide' => array(
			'badge'    => __( 'Metabolic flagship', 'azure-synthetics' ),
			'category' => __( 'Body-composition research', 'azure-synthetics' ),
			'summary'  => $literature['summary'],
			'research' => $literature['mechanism'],
		),
		'bpc-157' => array(
			'badge'    => __( 'Recovery interest', 'azure-synthetics' ),
			'category' => __( 'Training-stress research', 'azure-synthetics' ),
			'summary'  => $literature['summary'],
			'research' => $literature['mechanism'],
		),
		'mots-c' => array(
			'badge'    => __( 'Mitochondrial signal', 'azure-synthetics' ),
			'category' => __( 'Longevity + energy research', 'azure-synthetics' ),
			'summary'  => $literature['summary'],
			'research' => $literature['mechanism'],
		),
		'cjc-1295-ipamorelin' => array(
			'badge'    => __( 'GH-axis research', 'azure-synthetics' ),
			'category' => __( 'Recovery architecture', 'azure-synthetics' ),
			'summary'  => $literature['summary'],
			'research' => $literature['mechanism'],
		),
	);

	if ( isset( $exact[ $slug ] ) ) {
		return array_merge( $copy, $exact[ $slug ] );
	}

	if ( preg_match( '/retatrutide|tirzepatide|semaglutide|mazdutide|aod|adipotide|aicar|tesamorelin/', $slug ) ) {
		$copy['badge']    = __( 'Metabolic research', 'azure-synthetics' );
		$copy['category'] = __( 'Body-composition research', 'azure-synthetics' );
	} elseif ( preg_match( '/bpc|tb-500|kpv|ll-37|ghk/', $slug ) ) {
		$copy['badge']    = __( 'Recovery research', 'azure-synthetics' );
		$copy['category'] = __( 'Repair-pathway interest', 'azure-synthetics' );
	} elseif ( preg_match( '/cjc|ipamorelin|ghrp|sermorelin|hexarelin|hgh|igf|gonadorelin|kisspeptin/', $slug ) ) {
		$copy['badge']    = __( 'Axis research', 'azure-synthetics' );
		$copy['category'] = __( 'Endocrine signaling research', 'azure-synthetics' );
	} elseif ( preg_match( '/mots|ss-31|epitalon|nad|glutathione|foxo4/', $slug ) ) {
		$copy['badge']    = __( 'Longevity research', 'azure-synthetics' );
		$copy['category'] = __( 'Mitochondrial + redox research', 'azure-synthetics' );
	} elseif ( preg_match( '/semax|selank|dsip/', $slug ) ) {
		$copy['badge']    = __( 'Nootropic research', 'azure-synthetics' );
		$copy['category'] = __( 'Focus + sleep research', 'azure-synthetics' );
	} elseif ( preg_match( '/melanotan|pt-141|snap/', $slug ) ) {
		$copy['badge']    = __( 'Aesthetic research', 'azure-synthetics' );
		$copy['category'] = __( 'Skin + aesthetic signaling', 'azure-synthetics' );
	} elseif ( preg_match( '/water|supply|supplies/', $slug ) ) {
		$copy['badge']    = __( 'Supply item', 'azure-synthetics' );
		$copy['category'] = __( 'Research support', 'azure-synthetics' );
	}

	return $copy;
}

function azure_opt_render_arrow_icon() {
	?>
	<svg class="opt-arrow" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
		<line x1="7" y1="17" x2="17" y2="7" />
		<polyline points="7 7 17 7 17 17" />
	</svg>
	<?php
}

function azure_opt_render_syringe_icon() {
	?>
	<svg class="opt-syringe-icon" viewBox="0 0 120 36" aria-hidden="true" focusable="false">
		<rect x="2" y="12" width="6" height="12" rx="1" />
		<line x1="5" y1="12" x2="5" y2="7" />
		<line x1="5" y1="24" x2="5" y2="29" />
		<rect x="8" y="10" width="78" height="16" rx="2" />
		<line x1="15.8" y1="22" x2="15.8" y2="26" />
		<line x1="23.6" y1="20" x2="23.6" y2="26" />
		<line x1="31.4" y1="22" x2="31.4" y2="26" />
		<line x1="39.2" y1="20" x2="39.2" y2="26" />
		<line x1="47" y1="22" x2="47" y2="26" />
		<line x1="54.8" y1="20" x2="54.8" y2="26" />
		<line x1="62.6" y1="22" x2="62.6" y2="26" />
		<line x1="70.4" y1="20" x2="70.4" y2="26" />
		<line x1="78.2" y1="22" x2="78.2" y2="26" />
		<path d="M86 13 L96 15 L96 21 L86 23 Z" />
		<line x1="96" y1="18" x2="118" y2="18" />
	</svg>
	<?php
}

function azure_opt_render_molecule( $class = 'opt-molecule' ) {
	?>
	<svg class="<?php echo esc_attr( $class ); ?>" viewBox="-220 -220 440 440" aria-hidden="true" focusable="false">
		<g class="opt-molecule__bonds">
			<line x1="-150" y1="0" x2="-90" y2="-60" />
			<line x1="-90" y1="-60" x2="-30" y2="-30" />
			<line x1="-30" y1="-30" x2="30" y2="-90" />
			<line x1="30" y1="-90" x2="90" y2="-60" />
			<line x1="90" y1="-60" x2="150" y2="0" />
			<line x1="150" y1="0" x2="120" y2="80" />
			<line x1="120" y1="80" x2="40" y2="100" />
			<line x1="40" y1="100" x2="-40" y2="80" />
			<line x1="-40" y1="80" x2="-90" y2="40" />
			<line x1="-90" y1="40" x2="-150" y2="0" />
			<line x1="-150" y1="0" x2="-200" y2="-40" />
			<line x1="30" y1="-90" x2="40" y2="-160" />
			<line x1="150" y1="0" x2="200" y2="-50" />
			<line x1="40" y1="100" x2="80" y2="170" />
			<line x1="-90" y1="40" x2="-160" y2="80" />
		</g>
		<g class="opt-molecule__atoms">
			<circle cx="-150" cy="0" r="8" />
			<circle cx="-90" cy="-60" r="6" />
			<circle cx="-30" cy="-30" r="9" />
			<circle cx="30" cy="-90" r="6" />
			<circle cx="90" cy="-60" r="7" />
			<circle cx="150" cy="0" r="8" />
			<circle cx="120" cy="80" r="6" />
			<circle cx="40" cy="100" r="9" />
			<circle cx="-40" cy="80" r="6" />
			<circle cx="-90" cy="40" r="7" />
			<circle cx="-200" cy="-40" r="4" />
			<circle cx="40" cy="-160" r="5" />
			<circle cx="200" cy="-50" r="4" />
			<circle cx="80" cy="170" r="4" />
			<circle cx="-160" cy="80" r="4" />
		</g>
	</svg>
	<?php
}

function azure_opt_render_research_notice( $class = 'opt-research-notice' ) {
	$notice = azure_opt_research_boundary_text();
	?>
	<div class="<?php echo esc_attr( $class ); ?>">
		<strong><?php esc_html_e( 'Use policy', 'azure-synthetics' ); ?></strong>
		<p><?php echo esc_html( $notice ); ?></p>
	</div>
	<?php
}
