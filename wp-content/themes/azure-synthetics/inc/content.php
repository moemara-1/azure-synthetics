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
		'address'       => 'Azure Synthetics support desk',
		'response_time' => 'Most documentation, storage, and order questions are answered within one business day.',
	);
}

function azure_synthetics_get_home_metrics() {
	return array(
		array(
			'value' => __( 'Identity first', 'azure-synthetics' ),
			'label' => __( 'Confirm the SKU', 'azure-synthetics' ),
			'copy'  => __( 'Match the product name, alias, amount, and format before comparing price or adding to cart.', 'azure-synthetics' ),
		),
		array(
			'value' => __( 'Proof status', 'azure-synthetics' ),
			'label' => __( 'Know what is visible', 'azure-synthetics' ),
			'copy'  => __( 'See whether documentation is shown on-page, available through support, or not publicly listed.', 'azure-synthetics' ),
		),
		array(
			'value' => __( 'Handling notes', 'azure-synthetics' ),
			'label' => __( 'Plan storage early', 'azure-synthetics' ),
			'copy'  => __( 'Review route, inspection, and storage expectations before checkout.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_story_cards() {
	return array(
		array(
			'title'       => __( 'Find the right compound faster', 'azure-synthetics' ),
			'description' => __( 'Browse by research family, then confirm alias, amount, format, and evidence tier without opening five disconnected pages.', 'azure-synthetics' ),
			'tone'        => 'light',
		),
		array(
			'title'       => __( 'Separate proof from promise', 'azure-synthetics' ),
			'description' => __( 'Each product shows whether documentation is visible, request-based, or not publicly listed, so quality language stays specific.', 'azure-synthetics' ),
			'tone'        => 'light',
		),
		array(
			'title'       => __( 'Ask support with context', 'azure-synthetics' ),
			'description' => __( 'The support path captures topic, order reference, and research-use acknowledgment so the team can answer the right question.', 'azure-synthetics' ),
			'tone'        => 'dark',
		),
	);
}

function azure_synthetics_get_science_cards() {
	return array(
		'main'  => array(
			'title'       => __( 'Know what the page can prove before you add to cart.', 'azure-synthetics' ),
			'description' => __( 'Azure Synthetics organizes research peptides by compound identity, alias, evidence tier, documentation availability, vial amount, and handling requirements so buyers can evaluate fit quickly.', 'azure-synthetics' ),
		),
		'cards' => array(
			array(
				'title'       => __( 'Evidence Tiers', 'azure-synthetics' ),
				'description' => __( 'Retatrutide, CJC-1295 / Ipamorelin, MOTS-c, and BPC-157 are labeled by literature maturity so shoppers can compare research context at a glance.', 'azure-synthetics' ),
				'tone'        => 'dark',
			),
			array(
				'title'       => __( 'Document Status', 'azure-synthetics' ),
				'description' => __( 'Product pages distinguish between information shown now, support-desk documentation, and assets that are not currently public.', 'azure-synthetics' ),
				'tone'        => 'light',
			),
		),
	);
}

function azure_synthetics_get_science_explainers() {
	return array(
		array(
			'title'       => __( 'Start With Identity', 'azure-synthetics' ),
			'description' => __( 'Search the name you know, then confirm the canonical identity, common aliases, vial format, and amount before adding a research peptide to cart.', 'azure-synthetics' ),
			'detail'      => __( 'Example: Retatrutide is presented under its compound name so the catalog does not depend on loose market nicknames.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Read Evidence Before Claims', 'azure-synthetics' ),
			'description' => __( 'Each flagship SKU is framed by literature maturity: later-stage evidence, focused pharmacology, or preclinical-heavy mechanism research.', 'azure-synthetics' ),
			'detail'      => __( 'That keeps Retatrutide, CJC-1295 / Ipamorelin, MOTS-c, and BPC-157 easy to compare without benefit promises.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Check Proof Status Early', 'azure-synthetics' ),
			'description' => __( 'Before checkout, the product path should make it clear whether documentation is shown now, available through support, or not publicly listed.', 'azure-synthetics' ),
			'detail'      => __( 'The site uses proof-status language instead of decorative badges or invented batch claims.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Confirm Handling Before Reorder', 'azure-synthetics' ),
			'description' => __( 'Storage, shipping, and inspection notes stay close to product selection so operational questions are answered before checkout.', 'azure-synthetics' ),
			'detail'      => __( 'Route and format notes help buyers plan orders without searching through hidden policy pages.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_science_process_steps() {
	return array(
		array(
			'label' => __( '01', 'azure-synthetics' ),
			'title' => __( 'Search by family or alias', 'azure-synthetics' ),
			'copy'  => __( 'Start with recovery, metabolic, or mitochondrial categories, then confirm the searched name against the canonical compound.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '02', 'azure-synthetics' ),
			'title' => __( 'Compare evidence maturity', 'azure-synthetics' ),
			'copy'  => __( 'Use the tier label and research summary to see whether the page is supported by later-stage literature, focused pharmacology, or mostly preclinical context.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '03', 'azure-synthetics' ),
			'title' => __( 'Match documents to the order path', 'azure-synthetics' ),
			'copy'  => __( 'Check whether supporting information is visible, available by request, or not public before treating a SKU as reorder-ready.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '04', 'azure-synthetics' ),
			'title' => __( 'Review storage and route', 'azure-synthetics' ),
			'copy'  => __( 'Confirm storage, route, and inspection notes while the product is still in view, not after the cart is already built.', 'azure-synthetics' ),
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
			'description'  => __( 'BPC-157 and repair-category research peptides for buyers who want alias clarity, lyophilized-format context, storage notes, and conservative evidence framing before ordering.', 'azure-synthetics' ),
			'trust_copy'   => __( 'Recovery-category peptides attract heavy buyer interest, but much of the literature remains preclinical or translational. Azure keeps the product language useful without stretching into unsupported outcomes.', 'azure-synthetics' ),
			'image'        => 'recovery-stack.png',
			'proof_status' => __( 'Available on request', 'azure-synthetics' ),
			'bullets'      => array(
				__( 'Useful for BPC-157 and repair-category research searches', 'azure-synthetics' ),
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
			'title'        => __( 'Metabolic Research', 'azure-synthetics' ),
			'description'  => __( 'Retatrutide-led metabolic research peptides for buyers comparing incretin-adjacent compounds, vial format, documentation availability, and refrigerated handling.', 'azure-synthetics' ),
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
			'title'        => __( 'Mitochondrial Research', 'azure-synthetics' ),
			'description'  => __( 'MOTS-c and mitochondrial research peptides for buyers comparing mechanism summaries, storage notes, documentation status, and RUO boundaries.', 'azure-synthetics' ),
			'trust_copy'   => __( 'Buyer interest in this family is often concept-driven, so Azure separates useful research context from speculative longevity or energy claims.', 'azure-synthetics' ),
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
			'description' => __( 'BPC-157 and repair-category research peptides with conservative evidence notes and clear handling expectations.', 'azure-synthetics' ),
			'slug'        => 'recovery-repair',
		),
		array(
			'title'       => $profiles['body-composition']['title'],
			'description' => __( 'Retatrutide-led metabolic research peptides with clear evidence tiers, refrigerated-handling cues, and documentation options.', 'azure-synthetics' ),
			'slug'        => 'body-composition',
		),
		array(
			'title'       => $profiles['longevity-energy']['title'],
			'description' => __( 'MOTS-c and mitochondrial research compounds with mechanism summaries, storage notes, and restrained claims.', 'azure-synthetics' ),
			'slug'        => 'longevity-energy',
		),
	);
}

function azure_synthetics_get_default_faqs() {
	return array(
		array(
			'question' => __( 'How should I compare research evidence on product pages?', 'azure-synthetics' ),
			'answer'   => __( 'Start with the evidence tier, then read the mechanism summary, vial amount, format, and documentation availability. That gives you a practical view of the research context before ordering.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'What does the documentation status actually mean?', 'azure-synthetics' ),
			'answer'   => __( 'Documented now means supporting information is visible on-page. Available on request means the support desk can help directly. Not publicly shown means the asset is not currently available on the site.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'Are these products for human use?', 'azure-synthetics' ),
			'answer'   => __( 'No. Azure Synthetics sells research-use-only peptides. Product pages do not provide therapeutic, dosing, or human-administration instructions.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'Why do some product families read more cautiously than others?', 'azure-synthetics' ),
			'answer'   => __( 'Because the current literature is uneven across peptide categories. Retatrutide has a later-stage evidence record than many repair or mitochondrial compounds, so the earlier-stage pages stay more conservative.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_shop_highlights() {
	return array(
		array(
			'title'       => __( 'Shop by research family', 'azure-synthetics' ),
			'description' => __( 'Browse metabolic, recovery, and mitochondrial peptides with evidence context close to the product cards.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Documents and proof status', 'azure-synthetics' ),
			'description' => __( 'See whether support information is shown now, available by request, or not publicly listed.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Handling-aware checkout path', 'azure-synthetics' ),
			'description' => __( 'Storage expectations, route notes, and product format stay close to the add-to-cart path.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_science_evidence_tiers() {
	return array(
		array(
			'label'       => __( 'Tier A', 'azure-synthetics' ),
			'title'       => __( 'Later-stage evidence record', 'azure-synthetics' ),
			'description' => __( 'Reserved for compounds with contemporary, commercially relevant research. Copy can be direct about evidence maturity while staying RUO-first and non-therapeutic.', 'azure-synthetics' ),
		),
		array(
			'label'       => __( 'Tier B', 'azure-synthetics' ),
			'title'       => __( 'Focused pharmacology record', 'azure-synthetics' ),
			'description' => __( 'Useful for endocrine or translational compounds where the public copy should stay narrower than modern metabolic trial leaders.', 'azure-synthetics' ),
		),
		array(
			'label'       => __( 'Tier C', 'azure-synthetics' ),
			'title'       => __( 'Preclinical-heavy context', 'azure-synthetics' ),
			'description' => __( 'These pages lean on mechanism summaries, handling discipline, and investigational context instead of direct outcome or benefit language.', 'azure-synthetics' ),
		),
		array(
			'label'       => __( 'Tier D', 'azure-synthetics' ),
			'title'       => __( 'Emerging or fragmented', 'azure-synthetics' ),
			'description' => __( 'Commercial interest may exist, but product language stays tightly bounded until the evidence base matures.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_science_research_dossiers() {
	return array(
		array(
			'tier'       => __( 'Tier A', 'azure-synthetics' ),
			'title'      => __( 'Retatrutide', 'azure-synthetics' ),
			'category'   => __( 'Metabolic / incretin research', 'azure-synthetics' ),
			'summary'    => __( 'Retatrutide has the strongest current evidence signal in this catalog: a published phase 2 human obesity trial and an active late-stage research program. Azure treats GLP-3 naming as Retatrutide so buyers can compare the actual compound, not a loose market nickname.', 'azure-synthetics' ),
			'boundary'   => __( 'Storefront copy can discuss trial maturity, receptor-class context, handling, and documentation status. It must not become dosing, therapeutic, or human-use guidance.', 'azure-synthetics' ),
			'sources'    => array(
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
			'tier'       => __( 'Tier B', 'azure-synthetics' ),
			'title'      => __( 'CJC-1295 / Ipamorelin', 'azure-synthetics' ),
			'category'   => __( 'GH secretagogue / endocrine research', 'azure-synthetics' ),
			'summary'    => __( 'CJC-1295 sits in a narrower endocrine-research lane with human pharmacology literature around growth-hormone axis signaling. Ipamorelin is best presented as a paired secretagogue research context, not as a broad body-composition promise.', 'azure-synthetics' ),
			'boundary'   => __( 'Use mechanism, alias, format, and documentation language. Avoid anti-aging, performance, or transformation claims.', 'azure-synthetics' ),
			'sources'    => array(
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
			'tier'       => __( 'Tier C', 'azure-synthetics' ),
			'title'      => __( 'MOTS-c', 'azure-synthetics' ),
			'category'   => __( 'Mitochondrial-derived peptide research', 'azure-synthetics' ),
			'summary'    => __( 'MOTS-c is usually searched through the lens of mitochondrial signaling, metabolism, and cellular stress adaptation. The literature is active, but product language should stay mechanism-led because clinical translation is still developing.', 'azure-synthetics' ),
			'boundary'   => __( 'Useful copy explains mitochondrial-derived peptide context, refrigerated handling, and RUO status. It should not promise longevity, energy, or metabolic outcomes.', 'azure-synthetics' ),
			'sources'    => array(
				array(
					'label' => __( 'PubMed: MOTS-c review', 'azure-synthetics' ),
					'url'   => 'https://pubmed.ncbi.nlm.nih.gov/36761202/',
				),
				array(
					'label' => __( 'PubMed: systematic review', 'azure-synthetics' ),
					'url'   => 'https://pubmed.ncbi.nlm.nih.gov/39160573/',
				),
			),
		),
		array(
			'tier'       => __( 'Tier C', 'azure-synthetics' ),
			'title'      => __( 'BPC-157', 'azure-synthetics' ),
			'category'   => __( 'Recovery / repair research', 'azure-synthetics' ),
			'summary'    => __( 'BPC-157 has strong market demand and a broad preclinical literature footprint, but recent reviews still describe the human evidence base as limited and investigational. That makes it a trust-and-documentation SKU, not a claim-heavy SKU.', 'azure-synthetics' ),
			'boundary'   => __( 'Public copy can mention repair-category research interest and conservative evidence context. It must not claim healing, injury treatment, or clinical benefit.', 'azure-synthetics' ),
			'sources'    => array(
				array(
					'label' => __( 'PubMed: literature review', 'azure-synthetics' ),
					'url'   => 'https://pubmed.ncbi.nlm.nih.gov/40005999/',
				),
				array(
					'label' => __( 'PubMed: narrative review', 'azure-synthetics' ),
					'url'   => 'https://pubmed.ncbi.nlm.nih.gov/40789979/',
				),
			),
		),
	);
}

function azure_synthetics_get_science_source_cards() {
	return array(
		array(
			'title'       => __( 'Alias Clarity', 'azure-synthetics' ),
			'description' => __( 'The catalog supports how buyers actually search while still returning to the canonical compound name, category, and format before checkout.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Research Context', 'azure-synthetics' ),
			'description' => __( 'Research summaries tell buyers what kind of literature exists and where the claim boundary sits, especially for preclinical-heavy peptides.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Proof Status', 'azure-synthetics' ),
			'description' => __( 'Documented now, available on request, and not publicly shown are clearer than generic quality badges that do not say what a buyer can inspect.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Storage Readiness', 'azure-synthetics' ),
			'description' => __( 'Handling notes stay close to the product path so serious buyers can plan storage, inspection, and repeat ordering with fewer surprises.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_contact_request_topics() {
	return array(
		array(
			'title'       => __( 'Documentation requests', 'azure-synthetics' ),
			'description' => __( 'Ask for batch paperwork, documentation status, or clarification on what is shown versus available by request.', 'azure-synthetics' ),
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
			'title'       => __( 'Handling before claims', 'azure-synthetics' ),
			'description' => __( 'Storage, route, and inspection notes are part of the buying experience because they influence whether a serious buyer can reorder confidently.', 'azure-synthetics' ),
		),
	);
}
