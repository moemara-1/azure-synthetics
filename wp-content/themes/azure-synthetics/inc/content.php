<?php
/**
 * Static content helpers for the Azure Synthetics storefront.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_get_contact_details() {
	return array(
		'email'         => 'support@azuresynthetics.com',
		'phone'         => '+49 30 5555 9090',
		'hours'         => 'Mon-Fri 09:00-18:00 CET',
		'address'       => 'Berlin research support desk',
		'response_time' => 'Documentation and order questions are usually answered within one business day.',
	);
}

function azure_synthetics_get_home_metrics() {
	return array(
		array(
			'value' => __( 'Clear evidence tiers', 'azure-synthetics' ),
			'label' => __( 'Compare faster', 'azure-synthetics' ),
			'copy'  => __( 'See which peptides have the strongest research signal before opening every product page.', 'azure-synthetics' ),
		),
		array(
			'value' => __( 'Documentation path', 'azure-synthetics' ),
			'label' => __( 'Request support', 'azure-synthetics' ),
			'copy'  => __( 'Know whether paperwork is visible now or handled through the support desk before you order.', 'azure-synthetics' ),
		),
		array(
			'value' => __( 'Cold-chain details', 'azure-synthetics' ),
			'label' => __( 'Handling clarity', 'azure-synthetics' ),
			'copy'  => __( 'Check storage, packaging, and delivery expectations before checkout.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_story_cards() {
	return array(
		array(
			'title'       => __( 'Find the right compound faster', 'azure-synthetics' ),
			'description' => __( 'Shop by metabolic, recovery, and longevity families, then compare aliases, vial size, and evidence tier without opening ten tabs.', 'azure-synthetics' ),
			'tone'        => 'light',
		),
		array(
			'title'       => __( 'Know what documentation is available', 'azure-synthetics' ),
			'description' => __( 'Flagship product pages show what is visible now, what can be requested, and which handling details matter before checkout.', 'azure-synthetics' ),
			'tone'        => 'light',
		),
		array(
			'title'       => __( 'Reorder without guessing', 'azure-synthetics' ),
			'description' => __( 'Aliases, research family, storage notes, and support paths stay consistent so returning buyers can move from search to cart with fewer unknowns.', 'azure-synthetics' ),
			'tone'        => 'dark',
		),
	);
}

function azure_synthetics_get_science_cards() {
	return array(
		'main'  => array(
			'title'       => __( 'Know what you are comparing before you order.', 'azure-synthetics' ),
			'description' => __( 'Azure Synthetics organizes research peptides by compound identity, evidence tier, documentation availability, and handling requirements so buyers can evaluate fit quickly.', 'azure-synthetics' ),
		),
		'cards' => array(
			array(
				'title'       => __( 'Evidence tiers', 'azure-synthetics' ),
				'description' => __( 'Retatrutide, CJC-1295 / Ipamorelin, MOTS-c, and BPC-157 are labeled by literature maturity so shoppers can compare research context at a glance.', 'azure-synthetics' ),
				'tone'        => 'dark',
			),
			array(
				'title'       => __( 'Documentation availability', 'azure-synthetics' ),
				'description' => __( 'Product pages distinguish between information shown now, support-desk requests, and assets that are not currently public.', 'azure-synthetics' ),
				'tone'        => 'light',
			),
		),
	);
}

function azure_synthetics_get_science_explainers() {
	return array(
		array(
			'title'       => __( 'Compound names and aliases', 'azure-synthetics' ),
			'description' => __( 'Search by the name buyers actually use, then confirm the canonical compound identity before adding a peptide to cart.', 'azure-synthetics' ),
			'detail'      => __( 'Alias clarity helps buyers compare Retatrutide, BPC-157, MOTS-c, and CJC-1295 / Ipamorelin without confusing similar naming conventions.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Evidence tier and mechanism summary', 'azure-synthetics' ),
			'description' => __( 'Evidence tiers show whether a product has current human clinical signal, narrower human literature, or a mostly preclinical research base.', 'azure-synthetics' ),
			'detail'      => __( 'Mechanism summaries give scientific context while keeping the page focused on research use, not human outcomes or dosing claims.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Documentation path', 'azure-synthetics' ),
			'description' => __( 'Before checkout, buyers can see whether documentation is visible now, available through the support desk, or not publicly shown.', 'azure-synthetics' ),
			'detail'      => __( 'That distinction keeps quality questions practical instead of forcing buyers to infer what proof exists.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Handling and logistics', 'azure-synthetics' ),
			'description' => __( 'Storage, shipping, and inspection notes stay close to the product and cart path so operational questions are visible before checkout.', 'azure-synthetics' ),
			'detail'      => __( 'Cold-chain language, packaging cues, and product-format notes help serious buyers plan reorders with fewer surprises.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_science_process_steps() {
	return array(
		array(
			'label' => __( '01', 'azure-synthetics' ),
			'title' => __( 'Search by compound family', 'azure-synthetics' ),
			'copy'  => __( 'Start with metabolic, recovery, or longevity categories, then narrow by compound name and alias.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '02', 'azure-synthetics' ),
			'title' => __( 'Compare the evidence tier', 'azure-synthetics' ),
			'copy'  => __( 'Use the tier label and mechanism summary to understand how mature the research context is for each product.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '03', 'azure-synthetics' ),
			'title' => __( 'Check documentation availability', 'azure-synthetics' ),
			'copy'  => __( 'Look for what is visible now and use the support desk when batch paperwork or additional documentation is needed.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '04', 'azure-synthetics' ),
			'title' => __( 'Review storage and route', 'azure-synthetics' ),
			'copy'  => __( 'Confirm cold-chain, storage, and inspection notes before moving a research peptide into a repeat-order workflow.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_faq_guidance_cards() {
	return array(
		array(
			'title'       => __( 'Before ordering', 'azure-synthetics' ),
			'description' => __( 'Check the evidence tier, documentation status, form factor, and handling note before treating a product page as reorder-ready.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Documentation questions', 'azure-synthetics' ),
			'description' => __( 'Use the contact desk for batch paperwork, research summaries, or documentation that is available by request.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Finding the right category', 'azure-synthetics' ),
			'description' => __( 'Browse by research family if you know the use case, or search by compound alias when you already know the peptide name.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_collection_profiles() {
	return array(
		'recovery-repair' => array(
			'title'        => __( 'Recovery + Repair', 'azure-synthetics' ),
			'description'  => __( 'BPC-157 and repair-focused research peptides for buyers who want alias clarity, handling notes, and a conservative evidence view before ordering.', 'azure-synthetics' ),
			'trust_copy'   => __( 'Recovery peptides attract heavy buyer interest, but much of the literature remains preclinical or translational. Azure keeps the page useful without stretching into unsupported outcomes.', 'azure-synthetics' ),
			'image'        => 'recovery-stack.png',
			'proof_status' => __( 'Available on request', 'azure-synthetics' ),
			'bullets'      => array(
				__( 'Useful for BPC-157 and repair-focused research searches', 'azure-synthetics' ),
				__( 'Storage and documentation questions are easy to check before checkout', 'azure-synthetics' ),
				__( 'Biological claims stay narrow because the evidence base is still developing', 'azure-synthetics' ),
			),
			'faqs'         => array(
				array(
					'question' => __( 'Why is the tone more conservative in this collection?', 'azure-synthetics' ),
					'answer'   => __( 'Because market demand is strong while the human evidence base is still limited. Buyers get clear research context without aggressive outcome claims.', 'azure-synthetics' ),
				),
				array(
					'question' => __( 'What proof cues matter most here?', 'azure-synthetics' ),
					'answer'   => __( 'Batch-linked context, handling notes, and clear documentation availability matter more than dramatic promises.', 'azure-synthetics' ),
				),
			),
		),
		'body-composition' => array(
			'title'        => __( 'Body Composition', 'azure-synthetics' ),
			'description'  => __( 'Retatrutide-led metabolic research peptides for buyers comparing incretin-adjacent compounds, documentation availability, and refrigerated handling.', 'azure-synthetics' ),
			'trust_copy'   => __( 'Metabolic research peptides draw the strongest search demand and the highest scrutiny. Azure keeps the research context current, direct, and clearly marked for RUO purchase decisions.', 'azure-synthetics' ),
			'image'        => 'metabolic-retatrutide.png',
			'proof_status' => __( 'Documented now', 'azure-synthetics' ),
			'bullets'      => array(
				__( 'Strongest current literature signal in the catalog', 'azure-synthetics' ),
				__( 'Clear fit for buyers comparing Retatrutide and related metabolic peptides', 'azure-synthetics' ),
				__( 'Public claims stay research-use-only because scrutiny is highest here', 'azure-synthetics' ),
			),
			'faqs'         => array(
				array(
					'question' => __( 'Why is documentation posture emphasized so heavily in metabolic SKUs?', 'azure-synthetics' ),
					'answer'   => __( 'Because this category draws the strongest search demand and the highest scrutiny. Buyers need clear evidence tiers, handling notes, and documentation access before ordering.', 'azure-synthetics' ),
				),
				array(
					'question' => __( 'How should buyers read a flagship metabolic page?', 'azure-synthetics' ),
					'answer'   => __( 'Start with the evidence tier, then review the mechanism summary, handling notes, and documentation availability before deciding whether to request more paperwork.', 'azure-synthetics' ),
				),
			),
		),
		'longevity-energy' => array(
			'title'        => __( 'Longevity + Energy', 'azure-synthetics' ),
			'description'  => __( 'MOTS-c and mitochondrial research peptides for buyers comparing longevity-oriented compounds with careful mechanism summaries and RUO boundaries.', 'azure-synthetics' ),
			'trust_copy'   => __( 'Buyer interest in this family is often concept-driven, so Azure separates useful research context from speculative longevity claims.', 'azure-synthetics' ),
			'image'        => 'longevity-motsc.png',
			'proof_status' => __( 'Available on request', 'azure-synthetics' ),
			'bullets'      => array(
				__( 'High-curiosity category with mixed evidence maturity', 'azure-synthetics' ),
				__( 'Mechanism summaries help more than aggressive benefit language', 'azure-synthetics' ),
				__( 'Premium confidence comes from clarity, handling detail, and restrained claims', 'azure-synthetics' ),
			),
			'faqs'         => array(
				array(
					'question' => __( 'What makes longevity-category product guidance credible?', 'azure-synthetics' ),
					'answer'   => __( 'Clear evidence-tier labeling, precise aliases, and an explicit research-use-only posture keep the page useful without sounding speculative.', 'azure-synthetics' ),
				),
				array(
					'question' => __( 'Why is mechanism language useful here?', 'azure-synthetics' ),
					'answer'   => __( 'Because it gives sophisticated buyers research context while avoiding direct promises about human outcomes.', 'azure-synthetics' ),
				),
			),
		),
	);
}

function azure_synthetics_get_collection_profile( $slug = '' ) {
	$profiles = azure_synthetics_get_collection_profiles();

	if ( ! $slug ) {
		return array();
	}

	return $profiles[ $slug ] ?? array();
}

function azure_synthetics_get_collection_cards() {
	$profiles = azure_synthetics_get_collection_profiles();

	return array(
		array(
			'title'       => $profiles['recovery-repair']['title'],
			'description' => __( 'BPC-157 and repair-focused research peptides with conservative evidence notes and clear handling expectations.', 'azure-synthetics' ),
			'slug'        => 'recovery-repair',
		),
		array(
			'title'       => $profiles['body-composition']['title'],
			'description' => __( 'Retatrutide-led metabolic research peptides with clear evidence tiers, refrigerated-handling cues, and documentation options.', 'azure-synthetics' ),
			'slug'        => 'body-composition',
		),
		array(
			'title'       => $profiles['longevity-energy']['title'],
			'description' => __( 'MOTS-c and mitochondrial research compounds with mechanism summaries and restrained longevity language.', 'azure-synthetics' ),
			'slug'        => 'longevity-energy',
		),
	);
}

function azure_synthetics_get_default_faqs() {
	return array(
		array(
			'question' => __( 'How should I compare research evidence on product pages?', 'azure-synthetics' ),
			'answer'   => __( 'Start with the evidence tier, then read the mechanism summary and documentation availability. That gives you a practical view of the research context before ordering.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'What does the documentation status actually mean?', 'azure-synthetics' ),
			'answer'   => __( 'Documented now means supporting information is visible on the product experience. Available on request means the support desk can help directly. Not publicly shown means the asset is not currently available on the site.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'Are these products for human use?', 'azure-synthetics' ),
			'answer'   => __( 'No. Azure Synthetics sells research-use-only peptides. Product pages do not provide therapeutic, dosing, or human-administration instructions.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'Why do some product families read more cautiously than others?', 'azure-synthetics' ),
			'answer'   => __( 'Because the current literature is uneven across peptide categories. Retatrutide has a stronger current human research signal than many repair or longevity compounds, so those pages stay more conservative.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_shop_highlights() {
	return array(
		array(
			'title'       => __( 'Shop by research family', 'azure-synthetics' ),
			'description' => __( 'Browse metabolic, recovery, and longevity peptides with evidence context close to the product cards.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Documentation availability', 'azure-synthetics' ),
			'description' => __( 'See whether support information is shown now, available by request, or not publicly listed.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Handling-aware checkout path', 'azure-synthetics' ),
			'description' => __( 'Cold-chain notes, storage expectations, and product format stay close to the add-to-cart path.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_science_evidence_tiers() {
	return array(
		array(
			'label'       => __( 'Tier A', 'azure-synthetics' ),
			'title'       => __( 'Current human clinical signal', 'azure-synthetics' ),
			'description' => __( 'Used for compounds with contemporary and commercially relevant human evidence. Product pages can be more direct while staying RUO-first and non-therapeutic.', 'azure-synthetics' ),
		),
		array(
			'label'       => __( 'Tier B', 'azure-synthetics' ),
			'title'       => __( 'Human signal with narrower scope', 'azure-synthetics' ),
			'description' => __( 'Useful for endocrine or translational compounds where human literature exists, but not at the strength or freshness of modern obesity-trial leaders.', 'azure-synthetics' ),
		),
		array(
			'label'       => __( 'Tier C', 'azure-synthetics' ),
			'title'       => __( 'Preclinical-heavy with limited human data', 'azure-synthetics' ),
			'description' => __( 'These pages lean on mechanism summaries, handling discipline, and investigational context instead of benefits language.', 'azure-synthetics' ),
		),
		array(
			'label'       => __( 'Tier D', 'azure-synthetics' ),
			'title'       => __( 'Emerging or fragmented', 'azure-synthetics' ),
			'description' => __( 'Commercial interest may exist, but product language stays tightly bounded until the evidence base matures.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_contact_request_topics() {
	return array(
		array(
			'title'       => __( 'Documentation requests', 'azure-synthetics' ),
			'description' => __( 'Use the desk for batch paperwork questions, documentation requests, or clarification on what is shown versus available on request.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Order and handling support', 'azure-synthetics' ),
			'description' => __( 'Contact the team for shipping, inspection, storage, or format-selection questions before or after a purchase.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Wholesale or repeat-buyer setup', 'azure-synthetics' ),
			'description' => __( 'Use the desk if your volume, reorder cadence, or documentation workflow needs extra support.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_compliance_principles() {
	return array(
		array(
			'title'       => __( 'Research-use-only posture', 'azure-synthetics' ),
			'description' => __( 'Product pages never imply diagnosis, treatment, cure, dosing, or human-administration instructions. Azure Synthetics is research-use-only.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Documentation clarity', 'azure-synthetics' ),
			'description' => __( 'If documentation is not public, the page says so. Trust is stronger when buyers can distinguish visible information from request-based support.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Handling before persuasion', 'azure-synthetics' ),
			'description' => __( 'Storage, cold-chain, and inspection notes are part of the buying experience because they influence whether a serious buyer can reorder confidently.', 'azure-synthetics' ),
		),
	);
}
