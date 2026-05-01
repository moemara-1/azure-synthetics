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
		'hours'   => 'Mon-Fri 09:00-18:00',
		'address' => 'Berlin research support desk',
	);
}

function azure_synthetics_get_home_metrics() {
	return array(
		array(
				'value' => '99%+',
				'label' => __( 'Purity data up front', 'azure-synthetics' ),
				'copy'  => __( 'HPLC/MS context and lot references are easy to review before purchase.', 'azure-synthetics' ),
			),
			array(
				'value' => 'Cold-chain',
				'label' => __( 'Handling before checkout', 'azure-synthetics' ),
				'copy'  => __( 'Transit and storage expectations are stated where buying decisions happen.', 'azure-synthetics' ),
			),
			array(
				'value' => 'Repeat-ready',
				'label' => __( 'Cleaner repeat purchasing', 'azure-synthetics' ),
				'copy'  => __( 'Repeat buyers can match vial format, lot notes, and documentation requests without starting over.', 'azure-synthetics' ),
			),
	);
}

function azure_synthetics_get_story_cards() {
	return array(
			array(
				'title'       => __( 'Documentation near the decision', 'azure-synthetics' ),
				'description' => __( 'CoA references, purity ranges, and storage notes sit beside the product instead of hiding in support threads.', 'azure-synthetics' ),
				'tone'        => 'light',
			),
			array(
				'title'       => __( 'Format confidence', 'azure-synthetics' ),
				'description' => __( 'Vial amount, lyophilized form, and kit structure stay visible across catalog and product pages.', 'azure-synthetics' ),
				'tone'        => 'light',
			),
			array(
				'title'       => __( 'Bulk support without friction', 'azure-synthetics' ),
				'description' => __( 'Recurring orders can be handled with documentation and fulfillment notes intact.', 'azure-synthetics' ),
				'tone'        => 'dark',
			),
	);
}

function azure_synthetics_get_science_cards() {
	return array(
			'main'  => array(
				'title'       => __( 'Release discipline from batch review to reorder.', 'azure-synthetics' ),
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
				'description' => __( 'Powder, dual-vial kits, pack sizes, and handling notes are presented as lab inventory details.', 'azure-synthetics' ),
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
				'copy'  => __( 'Batch data is reviewed before a product is published for research-use purchase.', 'azure-synthetics' ),
			),
		array(
				'label' => __( '02', 'azure-synthetics' ),
				'title' => __( 'Package for handling', 'azure-synthetics' ),
				'copy'  => __( 'Cold-chain and storage notes travel with the order record.', 'azure-synthetics' ),
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
			'description' => __( 'Confirm the form factor, vial amount, storage expectations, and whether the product page lists current lot documentation.', 'azure-synthetics' ),
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
	$categories = azure_synthetics_get_catalog_categories();
	$featured   = array( 'glp-1-metabolic', 'recovery-repair', 'growth-hormone-axis', 'longevity-anti-aging', 'cognitive-nootropic', 'body-composition', 'peptide-support' );
	$cards      = array();

	foreach ( $featured as $slug ) {
		if ( empty( $categories[ $slug ] ) ) {
			continue;
		}

		$cards[] = array(
			'title'       => azure_synthetics_localized_catalog_category_field( $categories[ $slug ], 'name' ),
			'description' => azure_synthetics_localized_catalog_category_field( $categories[ $slug ], 'description' ),
			'slug'        => $slug,
		);
	}

	return $cards;
}

function azure_synthetics_get_default_faqs() {
	return array(
		array(
			'question' => __( 'Are these products for human or animal use?', 'azure-synthetics' ),
			'answer'   => __( 'No. Azure Synthetics products are sold for lawful laboratory, analytical, and investigational use only. They are not for human or veterinary use, injection, diagnosis, treatment, or consumption.', 'azure-synthetics' ),
		),
		array(
				'question' => __( 'How do you present assay reports and lot verification?', 'azure-synthetics' ),
				'answer'   => __( 'Flagship products surface purity ranges, batch references, and lot-linked CoA context close to the purchase decision.', 'azure-synthetics' ),
			),
			array(
				'question' => __( 'Can qualified teams set up preferred pricing or bulk reorders?', 'azure-synthetics' ),
				'answer'   => __( 'Yes. Contact support for recurring demand, preferred pricing, and documentation needs for qualified research-use buyers.', 'azure-synthetics' ),
			),
	);
}
