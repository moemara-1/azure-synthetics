<?php
/**
 * Static content helpers derived from the provided design system.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_get_contact_details() {
	return array(
		'email'   => 'hello@azuresynthetics.com',
		'phone'   => '+49 30 5555 9090',
		'hours'   => 'Mon–Fri 09:00–18:00',
		'address' => 'Berlin research support desk',
	);
}

function azure_synthetics_get_home_metrics() {
	return array(
		array(
				'value' => '99%+',
				'label' => __( 'Purity target visibility', 'azure-synthetics' ),
				'copy'  => __( 'Published assay references stay close to each flagship lot.', 'azure-synthetics' ),
			),
			array(
				'value' => 'Cold-chain',
				'label' => __( 'Handling clarity', 'azure-synthetics' ),
				'copy'  => __( 'Storage and shipping expectations are visible before checkout.', 'azure-synthetics' ),
			),
			array(
				'value' => 'Repeat-ready',
				'label' => __( 'Lot continuity', 'azure-synthetics' ),
				'copy'  => __( 'Repeat buyers keep consistent lot and handling context.', 'azure-synthetics' ),
			),
	);
}

function azure_synthetics_get_story_cards() {
	return array(
			array(
				'title'       => __( 'Protocol-first education', 'azure-synthetics' ),
				'description' => __( 'Clear release notes and product pairings help research teams buy with confidence.', 'azure-synthetics' ),
				'tone'        => 'light',
			),
			array(
				'title'       => __( 'Visible lot integrity', 'azure-synthetics' ),
				'description' => __( 'COA references, purity ranges, and storage notes stay close to each product.', 'azure-synthetics' ),
				'tone'        => 'light',
			),
			array(
				'title'       => __( 'Retention by design', 'azure-synthetics' ),
				'description' => __( 'Reorders keep the same product, lot, and handling context.', 'azure-synthetics' ),
				'tone'        => 'dark',
			),
	);
}

function azure_synthetics_get_science_cards() {
	return array(
			'main'  => array(
				'title'       => __( 'Release discipline from batch to reorder', 'azure-synthetics' ),
				'description' => __( 'Identity testing, purity ranges, handling notes, and lot context are presented together for research-use purchasing.', 'azure-synthetics' ),
			),
		'cards' => array(
				array(
					'title'       => __( 'What gets documented', 'azure-synthetics' ),
					'description' => __( 'Lot identifiers, assay references, purity bands, storage notes, and form-factor details.', 'azure-synthetics' ),
					'tone'        => 'dark',
				),
				array(
					'title'       => __( 'How handling is framed', 'azure-synthetics' ),
					'description' => __( 'Cold-pack cues, inspection guidance, and storage notes stay operational.', 'azure-synthetics' ),
					'tone'        => 'light',
				),
		),
	);
}

function azure_synthetics_get_science_explainers() {
	return array(
			array(
				'title'       => __( 'Identity and purity', 'azure-synthetics' ),
				'description' => __( 'Compound identity, target purity range, assay context, and lot references are surfaced before purchase.', 'azure-synthetics' ),
				'detail'      => '',
			),
			array(
				'title'       => __( 'Format and handling', 'azure-synthetics' ),
				'description' => __( 'Powder, dual-vial kits, pack sizes, and handling notes stay separate from prohibited-use language.', 'azure-synthetics' ),
				'detail'      => '',
			),
			array(
				'title'       => __( 'Storage and transit', 'azure-synthetics' ),
				'description' => __( 'Temperature, inspection, and storage notes are visible before checkout.', 'azure-synthetics' ),
				'detail'      => '',
			),
	);
}

function azure_synthetics_get_science_process_steps() {
	return array(
		array(
				'label' => __( '01', 'azure-synthetics' ),
				'title' => __( 'Release screen', 'azure-synthetics' ),
				'copy'  => __( 'Batch data is reviewed before a product is released.', 'azure-synthetics' ),
			),
		array(
				'label' => __( '02', 'azure-synthetics' ),
				'title' => __( 'Package for handling', 'azure-synthetics' ),
				'copy'  => __( 'Packaging and storage notes travel with the order.', 'azure-synthetics' ),
			),
		array(
				'label' => __( '03', 'azure-synthetics' ),
				'title' => __( 'Keep the lot traceable', 'azure-synthetics' ),
				'copy'  => __( 'Lot references and COA context remain easy to find.', 'azure-synthetics' ),
			),
	);
}

function azure_synthetics_get_faq_guidance_cards() {
	return array(
		array(
			'title'       => __( 'Before ordering', 'azure-synthetics' ),
			'description' => __( 'Confirm the form factor, vial amount, storage expectations, and whether the product page lists a current lot reference.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'After delivery', 'azure-synthetics' ),
			'description' => __( 'Inspect temperature-sensitive shipments promptly and keep published storage guidance attached to the receiving record.', 'azure-synthetics' ),
		),
			array(
				'title'       => __( 'Need documentation?', 'azure-synthetics' ),
				'description' => __( 'Product FAQs, batch references, and the support desk cover assay or lot documentation requests.', 'azure-synthetics' ),
			),
	);
}

function azure_synthetics_get_collection_cards() {
	return array(
		array(
			'title'       => __( 'Recovery + Repair', 'azure-synthetics' ),
			'description' => __( 'BPC-157, TB-500, and tissue-supporting stacks for comeback protocols.', 'azure-synthetics' ),
			'slug'        => 'recovery-repair',
		),
		array(
			'title'       => __( 'Body Composition', 'azure-synthetics' ),
			'description' => __( 'GLP and metabolic formulations framed for disciplined, repeat purchasing.', 'azure-synthetics' ),
			'slug'        => 'body-composition',
		),
		array(
			'title'       => __( 'Longevity + Energy', 'azure-synthetics' ),
			'description' => __( 'MOTS-C and mitochondrial support compounds presented with modern clinical clarity.', 'azure-synthetics' ),
			'slug'        => 'longevity-energy',
		),
	);
}

function azure_synthetics_get_default_faqs() {
	return array(
		array(
			'question' => __( 'Are the peptides sold in powder form or pre-filled?', 'azure-synthetics' ),
			'answer'   => __( 'Catalog defaults are framed as research-use, lyophilized inventory unless a product explicitly states another form factor.', 'azure-synthetics' ),
		),
		array(
				'question' => __( 'How do you present assay reports and lot verification?', 'azure-synthetics' ),
				'answer'   => __( 'Each flagship product includes batch references, purity ranges, and lot-linked COA context.', 'azure-synthetics' ),
			),
			array(
				'question' => __( 'Can clinics set up preferred pricing or bulk reorder flows?', 'azure-synthetics' ),
				'answer'   => __( 'Yes. Contact support for recurring demand, preferred pricing, and documentation needs.', 'azure-synthetics' ),
			),
	);
}
