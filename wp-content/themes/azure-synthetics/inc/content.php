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
		'email'   => 'orders@azuresynthetics.com',
		'phone'   => '',
		'hours'   => 'Mon-Fri 09:00-18:00',
		'address' => 'Azure Synthetics research support desk',
	);
}

function azure_synthetics_get_home_metrics() {
	return array(
		array(
			'value' => '99%+',
			'label' => __( 'Purity signal', 'azure-synthetics' ),
			'copy'  => __( 'Target purity and COA path appear before format decisions.', 'azure-synthetics' ),
		),
		array(
			'value' => 'COA',
			'label' => __( 'Lot proof', 'azure-synthetics' ),
			'copy'  => __( 'Batch references, assay notes, and support requests stay with the order.', 'azure-synthetics' ),
		),
		array(
			'value' => 'Bulk',
			'label' => __( 'Box value', 'azure-synthetics' ),
			'copy'  => __( 'Single-vial and 5-vial pricing are visible without a quote chase.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_story_cards() {
	return array(
		array(
			'title'       => __( 'Proof next to price', 'azure-synthetics' ),
			'description' => __( 'Purity target, COA workflow, and lot context sit directly beside buying choices.', 'azure-synthetics' ),
			'tone'        => 'light',
		),
		array(
			'title'       => __( 'Faster catalog reads', 'azure-synthetics' ),
			'description' => __( 'Amount, pack size, format, and storage notes are kept short and scannable.', 'azure-synthetics' ),
			'tone'        => 'light',
		),
		array(
			'title'       => __( 'Bulk without drag', 'azure-synthetics' ),
			'description' => __( 'Repeat and box orders can be reviewed for price, destination, documents, and payment route before fulfillment.', 'azure-synthetics' ),
			'tone'        => 'dark',
		),
	);
}

function azure_synthetics_get_science_cards() {
	return array(
		'main'  => array(
			'title'       => __( 'Proof that moves at catalog speed.', 'azure-synthetics' ),
			'description' => __( 'Purity target, COA path, lot handoff, storage profile, and reorder support stay visible from first scan to checkout.', 'azure-synthetics' ),
		),
		'cards' => array(
			array(
				'title'       => __( 'Compare faster', 'azure-synthetics' ),
				'description' => __( 'Amount, price, purity target, COA path, storage, and fulfillment review in one pass.', 'azure-synthetics' ),
				'tone'        => 'dark',
			),
			array(
				'title'       => __( 'Order with context', 'azure-synthetics' ),
				'description' => __( 'Destination, payment route, temperature handling, and documentation needs are reviewed before fulfillment.', 'azure-synthetics' ),
				'tone'        => 'light',
			),
		),
	);
}

function azure_synthetics_get_science_quality_metrics() {
	return array(
		array(
			'value' => '99%+',
			'label' => __( 'Target purity', 'azure-synthetics' ),
			'copy'  => __( 'Released lots are positioned around a clear HPLC purity target.', 'azure-synthetics' ),
		),
		array(
			'value' => 'COA',
			'label' => __( 'Lot-linked documents', 'azure-synthetics' ),
			'copy'  => __( 'COA, assay context, and lot reference stay tied to the order record.', 'azure-synthetics' ),
		),
		array(
			'value' => '5x',
			'label' => __( 'Box pricing view', 'azure-synthetics' ),
			'copy'  => __( 'Single-vial and five-vial options are compared before checkout.', 'azure-synthetics' ),
		),
		array(
			'value' => '1:1',
			'label' => __( 'Support handoff', 'azure-synthetics' ),
			'copy'  => __( 'Bulk, shipping, payment, and document questions route to a human review path.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_science_assay_bars() {
	return array(
		array(
			'label'   => __( 'HPLC target band', 'azure-synthetics' ),
			'value'   => __( '99%+', 'azure-synthetics' ),
			'percent' => 99,
			'note'    => __( 'Target purity shown before format selection.', 'azure-synthetics' ),
		),
		array(
			'label'   => __( 'Identity review', 'azure-synthetics' ),
			'value'   => __( 'MS path', 'azure-synthetics' ),
			'percent' => 88,
			'note'    => __( 'Mass-confirmation context belongs with the lot record.', 'azure-synthetics' ),
		),
		array(
			'label'   => __( 'COA handoff', 'azure-synthetics' ),
			'value'   => __( 'Lot linked', 'azure-synthetics' ),
			'percent' => 94,
			'note'    => __( 'Documents are tracked against the order, not buried after purchase.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_science_document_matrix() {
	return array(
		array(
			'label' => __( 'COA', 'azure-synthetics' ),
			'copy'  => __( 'Certificate path tied to each batch release.', 'azure-synthetics' ),
		),
		array(
			'label' => __( 'HPLC chromatogram', 'azure-synthetics' ),
			'copy'  => __( 'Purity profile kept close to the product record.', 'azure-synthetics' ),
		),
		array(
			'label' => __( 'Mass confirmation', 'azure-synthetics' ),
			'copy'  => __( 'Identity check context for the listed compound.', 'azure-synthetics' ),
		),
		array(
			'label' => __( 'Lot record', 'azure-synthetics' ),
			'copy'  => __( 'Batch reference matched to fulfillment notes.', 'azure-synthetics' ),
		),
		array(
			'label' => __( 'Storage profile', 'azure-synthetics' ),
			'copy'  => __( 'Temperature and retest notes stay visible.', 'azure-synthetics' ),
		),
		array(
			'label' => __( 'Support trail', 'azure-synthetics' ),
			'copy'  => __( 'Bulk, shipping, and payment questions are handled before final invoice.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_science_release_timeline() {
	return array(
		array(
			'label' => __( '01', 'azure-synthetics' ),
			'title' => __( 'Set release spec', 'azure-synthetics' ),
			'copy'  => __( 'Amount, format, target purity, storage profile, and document path are defined before a lot reaches the catalog.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '02', 'azure-synthetics' ),
			'title' => __( 'Match lot to proof', 'azure-synthetics' ),
			'copy'  => __( 'COA, HPLC, MS, and lot references stay attached to the product record buyers review.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '03', 'azure-synthetics' ),
			'title' => __( 'Review order route', 'azure-synthetics' ),
			'copy'  => __( 'Shipping, temperature handling, destination, and payment options are checked before fulfillment.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '04', 'azure-synthetics' ),
			'title' => __( 'Keep reorder memory', 'azure-synthetics' ),
			'copy'  => __( 'Lot references, pack size, and support notes make repeat orders easier to compare.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_science_storage_bands() {
	return array(
		array(
			'label' => __( 'Storage', 'azure-synthetics' ),
			'value' => __( 'Lot CoA/SDS', 'azure-synthetics' ),
			'copy'  => __( 'Storage guidance follows the published lot documentation.', 'azure-synthetics' ),
		),
		array(
			'label' => __( 'Transit', 'azure-synthetics' ),
			'value' => __( 'Reviewed', 'azure-synthetics' ),
			'copy'  => __( 'Temperature handling is confirmed during order review.', 'azure-synthetics' ),
		),
		array(
			'label' => __( 'Retest', 'azure-synthetics' ),
			'value' => __( 'Tracked', 'azure-synthetics' ),
			'copy'  => __( 'Retest windows and lot notes stay part of the release record.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_science_find_catalog_product( $name ) {
	foreach ( azure_synthetics_get_catalog_products() as $product ) {
		if ( $name === $product['name'] ) {
			return $product;
		}
	}

	return array();
}

function azure_synthetics_science_price_range( array $product, $field ) {
	$values = array();

	foreach ( $product['amounts'] ?? array() as $amount ) {
		if ( isset( $amount[ $field ] ) ) {
			$values[] = (float) $amount[ $field ];
		}
	}

	if ( empty( $values ) ) {
		return '';
	}

	$min = min( $values );
	$max = max( $values );

	$format_price = static function ( $price ) {
		$symbol = function_exists( 'get_woocommerce_currency_symbol' ) ? get_woocommerce_currency_symbol() : '$';
		$symbol = html_entity_decode( $symbol, ENT_QUOTES, get_bloginfo( 'charset' ) ?: 'UTF-8' );

		return $symbol . number_format_i18n( $price, 2 );
	};

	return $min === $max
		? $format_price( $min )
		: sprintf( '%s-%s', $format_price( $min ), $format_price( $max ) );
}

function azure_synthetics_science_product_url( array $product ) {
	$slug = azure_synthetics_catalog_slug( $product['name'] ?? '' );
	$post = $slug ? get_page_by_path( $slug, OBJECT, 'product' ) : null;
	$url  = $post ? get_permalink( $post ) : home_url( '/product/' . $slug . '/' );

	return function_exists( 'azure_synthetics_preserve_language_url' ) ? azure_synthetics_preserve_language_url( $url ) : $url;
}

function azure_synthetics_science_localized_focus( array $product ) {
	if ( function_exists( 'azure_synthetics_current_language' ) && 'ar' === azure_synthetics_current_language() && ! empty( $product['focus_ar'] ) ) {
		return $product['focus_ar'];
	}

	return $product['focus'] ?? '';
}

function azure_synthetics_get_science_compound_profiles() {
	$profile_specs = array(
		array(
			'name'     => 'Tirzepatide',
			'eyebrow'  => __( 'GLP-1 comparison', 'azure-synthetics' ),
			'assay'    => __( 'HPLC + MS identity path', 'azure-synthetics' ),
			'doc'      => __( 'COA and lot handoff before fulfillment', 'azure-synthetics' ),
			'storage'  => __( 'Frozen storage by lot CoA/SDS', 'azure-synthetics' ),
			'copy'     => __( 'A high-comparison profile for buyers checking amount ladder, vial cost, box value, and document path fast.', 'azure-synthetics' ),
			'bars'     => array( 99, 96, 92 ),
			'bar_copy' => array(
				__( 'Three amount options make price comparison clearer.', 'azure-synthetics' ),
				__( 'COA path and lot handoff stay attached to the order.', 'azure-synthetics' ),
				__( 'Shipping and payment route are reviewed before release.', 'azure-synthetics' ),
			),
		),
		array(
			'name'     => 'Retatrutide',
			'eyebrow'  => __( 'Multi-agonist shelf', 'azure-synthetics' ),
			'assay'    => __( 'Release screen with mass confirmation', 'azure-synthetics' ),
			'doc'      => __( 'COA, lot, and support notes linked to order', 'azure-synthetics' ),
			'storage'  => __( 'Temperature handling reviewed by route', 'azure-synthetics' ),
			'copy'     => __( 'Built for buyers comparing higher-value formats where box economics and documentation confidence matter.', 'azure-synthetics' ),
			'bars'     => array( 99, 95, 90 ),
			'bar_copy' => array(
				__( 'Large-format ladder keeps vial and box decisions together.', 'azure-synthetics' ),
				__( 'Release proof is framed around assay and lot continuity.', 'azure-synthetics' ),
				__( 'Support review catches destination and payment questions early.', 'azure-synthetics' ),
			),
		),
		array(
			'name'     => 'BPC-157',
			'eyebrow'  => __( 'Repair-pathway profile', 'azure-synthetics' ),
			'assay'    => __( 'HPLC purity target with lot reference', 'azure-synthetics' ),
			'doc'      => __( 'COA workflow plus batch reference', 'azure-synthetics' ),
			'storage'  => __( 'Frozen, dry, light-protected storage profile', 'azure-synthetics' ),
			'copy'     => __( 'A fast-read profile for buyers comparing low-friction reorder value, familiar format sizes, and proof access.', 'azure-synthetics' ),
			'bars'     => array( 99, 94, 97 ),
			'bar_copy' => array(
				__( 'Two common amount options keep the decision simple.', 'azure-synthetics' ),
				__( 'Batch reference and COA workflow are visible buying cues.', 'azure-synthetics' ),
				__( 'Box value supports repeat-order planning.', 'azure-synthetics' ),
			),
		),
		array(
			'name'     => 'CJC-1295 (No DAC)',
			'eyebrow'  => __( 'GHRH analog profile', 'azure-synthetics' ),
			'assay'    => __( 'Identity and purity screen by lot', 'azure-synthetics' ),
			'doc'      => __( 'COA route with paired support context', 'azure-synthetics' ),
			'storage'  => __( 'Frozen storage with minimized temperature cycling', 'azure-synthetics' ),
			'copy'     => __( 'A profile for buyers who compare format, companion inventory, and repeat kit logic before checkout.', 'azure-synthetics' ),
			'bars'     => array( 99, 91, 93 ),
			'bar_copy' => array(
				__( 'Format range supports single-vial or repeat-order planning.', 'azure-synthetics' ),
				__( 'Identity and purity checks stay attached to the lot.', 'azure-synthetics' ),
				__( 'Support can review companion-product questions before invoice.', 'azure-synthetics' ),
			),
		),
		array(
			'name'     => 'GHK-Cu',
			'eyebrow'  => __( 'Copper peptide profile', 'azure-synthetics' ),
			'assay'    => __( 'Purity target plus form-factor review', 'azure-synthetics' ),
			'doc'      => __( 'COA path and storage record tracked together', 'azure-synthetics' ),
			'storage'  => __( 'Moisture-aware frozen storage profile', 'azure-synthetics' ),
			'copy'     => __( 'A profile for shoppers comparing larger vial amounts, box savings, and storage expectations in one pass.', 'azure-synthetics' ),
			'bars'     => array( 99, 93, 96 ),
			'bar_copy' => array(
				__( 'Higher amount formats make unit economics easy to scan.', 'azure-synthetics' ),
				__( 'Storage profile is treated as release data, not fine print.', 'azure-synthetics' ),
				__( 'Box pricing keeps repeat inventory planning visible.', 'azure-synthetics' ),
			),
		),
		array(
			'name'     => 'MOTS-C',
			'eyebrow'  => __( 'Mitochondrial profile', 'azure-synthetics' ),
			'assay'    => __( 'HPLC target with identity confirmation path', 'azure-synthetics' ),
			'doc'      => __( 'Lot record, COA path, and reorder notes', 'azure-synthetics' ),
			'storage'  => __( 'Frozen storage and transit review', 'azure-synthetics' ),
			'copy'     => __( 'A proof-heavy profile for buyers comparing specialty pricing, amount spread, and lot continuity.', 'azure-synthetics' ),
			'bars'     => array( 99, 92, 94 ),
			'bar_copy' => array(
				__( 'Specialty amount spread makes the catalog feel less generic.', 'azure-synthetics' ),
				__( 'Lot continuity matters for repeat research inventory.', 'azure-synthetics' ),
				__( 'Transit review keeps temperature handling in the buying path.', 'azure-synthetics' ),
			),
		),
	);

	$profiles = array();

	foreach ( $profile_specs as $spec ) {
		$product = azure_synthetics_science_find_catalog_product( $spec['name'] );

		if ( empty( $product ) ) {
			continue;
		}

		$profiles[] = array(
			'name'     => $product['name'],
			'eyebrow'  => $spec['eyebrow'],
			'focus'    => azure_synthetics_science_localized_focus( $product ),
			'copy'     => $spec['copy'],
			'assay'    => $spec['assay'],
			'doc'      => $spec['doc'],
			'storage'  => $spec['storage'],
			'amounts'  => azure_synthetics_catalog_amount_summary( $product ),
			'vial'     => azure_synthetics_science_price_range( $product, 'vial' ),
			'box'      => azure_synthetics_science_price_range( $product, 'box' ),
			'url'      => azure_synthetics_science_product_url( $product ),
			'bars'     => array(
				array(
					'label'   => __( 'Price ladder', 'azure-synthetics' ),
					'value'   => azure_synthetics_catalog_amount_summary( $product ),
					'percent' => $spec['bars'][0],
					'note'    => $spec['bar_copy'][0],
				),
				array(
					'label'   => __( 'Proof fit', 'azure-synthetics' ),
					'value'   => __( '99%+ target', 'azure-synthetics' ),
					'percent' => $spec['bars'][1],
					'note'    => $spec['bar_copy'][1],
				),
				array(
					'label'   => __( 'Reorder fit', 'azure-synthetics' ),
					'value'   => __( 'Box value', 'azure-synthetics' ),
					'percent' => $spec['bars'][2],
					'note'    => $spec['bar_copy'][2],
				),
			),
		);
	}

	return $profiles;
}

function azure_synthetics_get_science_explainers() {
	return array(
		array(
			'title'       => __( 'Purity proof', 'azure-synthetics' ),
			'description' => __( 'Target purity, HPLC context, and lot references are visible before purchase.', 'azure-synthetics' ),
			'detail'      => __( 'No digging through policy pages.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Price logic', 'azure-synthetics' ),
			'description' => __( 'Vial amounts and 5-vial box options are presented as buying details, not quote bait.', 'azure-synthetics' ),
			'detail'      => __( 'Compare cost before checkout.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Fulfillment confidence', 'azure-synthetics' ),
			'description' => __( 'Destination, temperature handling, document needs, and payment route are reviewed before fulfillment.', 'azure-synthetics' ),
			'detail'      => __( 'Support stays close to the order.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_science_process_steps() {
	return array(
		array(
			'label' => __( '01', 'azure-synthetics' ),
			'title' => __( 'Compare', 'azure-synthetics' ),
			'copy'  => __( 'Scan price, amount, purity target, COA path, and box value in one pass.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '02', 'azure-synthetics' ),
			'title' => __( 'Verify', 'azure-synthetics' ),
			'copy'  => __( 'Confirm document needs, destination, temperature handling, and payment route before the invoice is finalized.', 'azure-synthetics' ),
		),
		array(
			'label' => __( '03', 'azure-synthetics' ),
			'title' => __( 'Reorder', 'azure-synthetics' ),
			'copy'  => __( 'Keep tracking, lot reference, pack size, and support notes tied to the order record.', 'azure-synthetics' ),
		),
	);
}

function azure_synthetics_get_faq_guidance_cards() {
	return array(
		array(
			'title'       => __( 'Before ordering', 'azure-synthetics' ),
			'description' => __( 'Check amount, pack size, price, target purity, COA path, and box value.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Before fulfillment', 'azure-synthetics' ),
			'description' => __( 'Confirm shipping review, temperature handling, payment route, and document needs.', 'azure-synthetics' ),
		),
		array(
			'title'       => __( 'Need order help?', 'azure-synthetics' ),
			'description' => __( 'Ask about COA availability, bulk pricing, destination review, or repeat-order support.', 'azure-synthetics' ),
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
			'question' => __( 'What should I compare first?', 'azure-synthetics' ),
			'answer'   => __( 'Start with amount, price, target purity, COA path, storage profile, and whether single vials or 5-vial boxes fit the order.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'How are COA and lot details handled?', 'azure-synthetics' ),
			'answer'   => __( 'Product pages keep the COA path and lot-reference handoff close to the purchase decision.', 'azure-synthetics' ),
		),
		array(
			'question' => __( 'Can I ask about bulk, shipping, or payment before checkout?', 'azure-synthetics' ),
			'answer'   => __( 'Yes. Contact support for box pricing, destination review, documentation requests, and available payment routes.', 'azure-synthetics' ),
		),
	);
}
