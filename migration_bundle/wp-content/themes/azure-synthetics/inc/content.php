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
			'copy'  => __( 'Flagship lots are merchandised with assay-first technical detail.', 'azure-synthetics' ),
		),
		array(
			'value' => 'Cold-chain',
			'label' => __( 'Handling language', 'azure-synthetics' ),
			'copy'  => __( 'Storage and shipping notes appear before checkout, not after purchase.', 'azure-synthetics' ),
		),
		array(
			'value' => 'Repeat-ready',
			'label' => __( 'Retention design', 'azure-synthetics' ),
			'copy'  => __( 'Protocol buyers can reorder quickly without losing compliance context.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_story_cards() {
	return array(
		array(
			'title'       => __( 'Protocol-first education', 'azure-synthetics' ),
			'description' => __( 'Explainers, timing references, and product pairings reduce support friction while increasing buyer confidence.', 'azure-synthetics' ),
			'tone'        => 'light',
		),
		array(
			'title'       => __( 'Visible lot integrity', 'azure-synthetics' ),
			'description' => __( 'Lot-linked COAs, cold-chain metadata, and purity ranges appear as first-class purchase information.', 'azure-synthetics' ),
			'tone'        => 'light',
		),
		array(
			'title'       => __( 'Retention by design', 'azure-synthetics' ),
			'description' => __( 'Subscribers get protocol refreshes, assay updates, and reorder logic that feels like product infrastructure.', 'azure-synthetics' ),
			'tone'        => 'dark',
		),
	);
}

function azure_synthetics_get_science_cards() {
	return array(
		'main'  => array(
			'title'       => __( 'Release discipline from batch to reorder', 'azure-synthetics' ),
			'description' => __( 'Every flagship drop is staged around identity testing, purity range visibility, temperature-aware fulfillment, and reorder context that stays research-use only.', 'azure-synthetics' ),
		),
		'cards' => array(
			array(
				'title'       => __( 'What gets documented', 'azure-synthetics' ),
				'description' => __( 'Lot identifiers, assay references, purity bands, storage notes, and form-factor details are kept close to the buying path.', 'azure-synthetics' ),
				'tone'        => 'dark',
			),
			array(
				'title'       => __( 'How handling is framed', 'azure-synthetics' ),
				'description' => __( 'Cold-pack cues, inspection guidance, and storage language are written as operational notes, not health or outcome claims.', 'azure-synthetics' ),
				'tone'        => 'light',
			),
		),
	);
}

function azure_synthetics_get_science_explainers() {
	return array(
		array(
			'title'       => __( 'Identity and purity', 'azure-synthetics' ),
			'description' => __( 'Product pages reserve space for compound identity, target purity range, assay context, and lot reference details so research teams can evaluate a release without hunting through support copy.', 'azure-synthetics' ),
			'detail'      => __( 'Use this area for HPLC or MS references, COA links, batch IDs, and any release-specific acceptance criteria your operation publishes.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Form factor and preparation', 'azure-synthetics' ),
			'description' => __( 'Catalog language separates lyophilized powder, dual-vial kits, pack sizes, and handling prompts from any prohibited use language.', 'azure-synthetics' ),
			'detail'      => __( 'Variable products stay WooCommerce-native, while research notes clarify what the buyer should verify before adding an item to a protocol inventory.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Storage and transit stability', 'azure-synthetics' ),
			'description' => __( 'Temperature-sensitive items can carry clear shipping warnings and storage instructions before checkout, where the information is useful.', 'azure-synthetics' ),
			'detail'      => __( 'The theme supports default shipping notes plus product-specific overrides for cold-chain, inspection, and long-term storage guidance.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_science_process_steps() {
	return array(
		array(
			'label' => __( '01', 'azure-synthetics' ),
			'title' => __( 'Release screen', 'azure-synthetics' ),
			'copy'  => __( 'Publish the batch only after identity, purity, and form-factor data are ready to appear beside the product.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '02', 'azure-synthetics' ),
			'title' => __( 'Package for handling', 'azure-synthetics' ),
			'copy'  => __( 'Pair fulfillment notes with storage expectations so buyers see the handling burden before checkout.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '03', 'azure-synthetics' ),
			'title' => __( 'Keep the lot traceable', 'azure-synthetics' ),
			'copy'  => __( 'Expose batch references, COA context, and reorder notes in the same visual system across product, cart, and support pages.', 'azure-synthetics' ),
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
			'description' => __( 'Use the product FAQ, batch reference fields, and support desk for assay or lot documentation requests.', 'azure-synthetics' ),
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
			'answer'   => __( 'Each flagship product template reserves space for batch references, purity ranges, and lot-linked COA context.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'Can clinics set up preferred pricing or bulk reorder flows?', 'azure-synthetics' ),
			'answer'   => __( 'The storefront foundation is built to remain compatible with future preferred pricing, wholesale, and gateway extensions.', 'azure-synthetics' ),
		),
	);
}
