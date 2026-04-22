<?php
/**
 * Plugin Name: Azure Synthetics Pantheon Runtime
 * Description: Keeps migrated database URLs aligned with the current Pantheon host.
 *
 * @package AzureSynthetics
 */

function azure_synthetics_pantheon_runtime_origin() {
	if ( empty( $_SERVER['HTTP_HOST'] ) ) {
		return '';
	}

	$host = strtolower( sanitize_text_field( wp_unslash( $_SERVER['HTTP_HOST'] ) ) );

	if ( ! preg_match( '/(^|\\.)pantheonsite\\.io$/', $host ) && ! in_array( $host, array( 'azuresynthetics.com', 'www.azuresynthetics.com' ), true ) ) {
		return '';
	}

	return 'https://' . $host;
}

function azure_synthetics_pantheon_runtime_url_option( $value ) {
	$origin = azure_synthetics_pantheon_runtime_origin();

	return $origin ?: $value;
}

add_filter( 'pre_option_home', 'azure_synthetics_pantheon_runtime_url_option' );
add_filter( 'pre_option_siteurl', 'azure_synthetics_pantheon_runtime_url_option' );

function azure_synthetics_pantheon_live_store_option( $value ) {
	return azure_synthetics_pantheon_runtime_origin() ? 'no' : $value;
}

add_filter( 'pre_option_woocommerce_coming_soon', 'azure_synthetics_pantheon_live_store_option' );

function azure_synthetics_pantheon_page_content( $heading, array $sections ) {
	$content = "<!-- wp:paragraph -->\n<p>" . esc_html( $heading ) . "</p>\n<!-- /wp:paragraph -->\n";

	foreach ( $sections as $title => $body ) {
		$content .= "\n<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">" . esc_html( $title ) . "</h2>\n<!-- /wp:heading -->\n";
		$content .= "\n<!-- wp:paragraph -->\n<p>" . esc_html( $body ) . "</p>\n<!-- /wp:paragraph -->\n";
	}

	return $content;
}

function azure_synthetics_pantheon_upsert_page( $slug, $title, $content, $legacy_slug = '' ) {
	$page = get_page_by_path( $slug );

	if ( ! $page && $legacy_slug ) {
		$page = get_page_by_path( $legacy_slug );
	}

	$post_data = array(
		'post_title'   => $title,
		'post_name'    => $slug,
		'post_content' => wp_slash( $content ),
		'post_status'  => 'publish',
		'post_type'    => 'page',
	);

	if ( $page ) {
		$post_data['ID'] = $page->ID;
		return wp_update_post( $post_data );
	}

	return wp_insert_post( $post_data );
}

function azure_synthetics_pantheon_hide_default_content() {
	$sample_page = get_page_by_path( 'sample-page' );

	if ( $sample_page && 'publish' === $sample_page->post_status ) {
		wp_update_post(
			array(
				'ID'          => $sample_page->ID,
				'post_status' => 'draft',
			)
		);
	}

	$hello_world = get_page_by_path( 'hello-world', OBJECT, 'post' );

	if ( $hello_world && 'publish' === $hello_world->post_status ) {
		wp_update_post(
			array(
				'ID'          => $hello_world->ID,
				'post_status' => 'draft',
			)
		);
	}
}

function azure_synthetics_pantheon_repair_navigation_urls() {
	$origin = azure_synthetics_pantheon_runtime_origin();

	if ( ! $origin ) {
		return;
	}

	$menu_items = get_posts(
		array(
			'post_type'      => 'nav_menu_item',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'meta_query'     => array(
				array(
					'key'     => '_menu_item_url',
					'value'   => '(localhost|127\\.0\\.0\\.1|azure-synthetics\\.loca\\.lt|loca\\.lt)',
					'compare' => 'REGEXP',
				),
			),
		)
	);

	foreach ( $menu_items as $menu_item ) {
		$url = get_post_meta( $menu_item->ID, '_menu_item_url', true );

		if ( ! is_string( $url ) || '' === $url ) {
			continue;
		}

		$parts = wp_parse_url( $url );

		if ( empty( $parts['host'] ) ) {
			continue;
		}

		$host = strtolower( $parts['host'] );

		if ( ! in_array( $host, array( 'localhost', '127.0.0.1', 'azure-synthetics.loca.lt' ), true ) && ! preg_match( '/(^|\\.)loca\\.lt$/', $host ) ) {
			continue;
		}

		update_post_meta( $menu_item->ID, '_menu_item_url', $origin . ( $parts['path'] ?? '/' ) );
	}
}

function azure_synthetics_pantheon_repair_product_copy() {
	$products = array(
		'bpc-157' => array(
			'description' => 'Recovery and repair research support with lot continuity, storage notes, and COA context.',
			'faqs'        => array(
				array(
					'question' => 'How is lot verification surfaced?',
					'answer'   => 'Each shipment references a lot ID and a supporting COA workflow.',
				),
				array(
					'question' => 'Is the vial pre-mixed?',
					'answer'   => 'No. The default catalog presentation is lyophilized powder unless noted otherwise.',
				),
			),
		),
		'mots-c'  => array(
			'description' => 'Longevity and metabolic support research material with traceable release context.',
			'faqs'        => array(
				array(
					'question' => 'What documentation accompanies the product?',
					'answer'   => 'Orders include traceability references and supporting assay documentation.',
				),
			),
		),
		'cjc-ipa' => array(
			'description' => 'Dual-vial research kit with selectable pack sizes and paired COA references.',
			'faqs'        => array(
				array(
					'question' => 'Can I purchase multiple kits in one line item?',
					'answer'   => 'Yes. Select the pack size before adding the kit to cart.',
				),
			),
		),
		'glp-3'   => array(
			'description' => 'Body composition research peptide with purity range, storage notes, and batch context.',
			'faqs'        => array(
				array(
					'question' => 'Is this positioned as a consumer wellness product?',
					'answer'   => 'No. Catalog language is restricted to research and laboratory contexts.',
				),
			),
		),
	);

	foreach ( $products as $slug => $data ) {
		$product = get_page_by_path( $slug, OBJECT, 'product' );

		if ( ! $product ) {
			continue;
		}

		wp_update_post(
			array(
				'ID'           => $product->ID,
				'post_content' => wp_slash( $data['description'] ),
			)
		);

		update_post_meta( $product->ID, '_azure_product_faqs', wp_json_encode( $data['faqs'] ) );
	}
}

function azure_synthetics_pantheon_clear_cached_pages() {
	if ( function_exists( 'wp_cache_flush' ) ) {
		wp_cache_flush();
	}

	if ( function_exists( 'pantheon_clear_edge_all' ) ) {
		pantheon_clear_edge_all();
	}

	if ( function_exists( 'pantheon_wp_clear_edge_all' ) ) {
		pantheon_wp_clear_edge_all();
	}
}

function azure_synthetics_pantheon_ensure_launch_pages() {
	if ( ! azure_synthetics_pantheon_runtime_origin() ) {
		return;
	}

	$content_version = '2026-04-22.4';

	if ( get_option( 'azure_synthetics_pantheon_content_version' ) === $content_version ) {
		return;
	}

	$privacy_id = azure_synthetics_pantheon_upsert_page(
		'privacy-policy',
		'Privacy Policy',
		azure_synthetics_pantheon_page_content(
			'Azure Synthetics handles account, order, support, and fulfillment information for a research-use storefront.',
			array(
				'Information we collect' => 'We collect information needed to process accounts, orders, support requests, fraud prevention, and compliance acknowledgments.',
				'How information is used' => 'Store data is used for order fulfillment, customer support, operational record keeping, site security, and required platform services.',
				'Retention and requests' => 'Customers may contact the support desk to request access, correction, or deletion where applicable and where retention is not required for legitimate business records.',
			)
		)
	);

	$terms_id = azure_synthetics_pantheon_upsert_page(
			'terms-and-conditions',
			'Terms and Conditions',
			azure_synthetics_pantheon_page_content(
				'Azure Synthetics operates as a research-use catalog for laboratory and analytical contexts.',
				array(
					'Research-use restriction' => 'Products are offered for laboratory, analytical, and investigational contexts only and are not positioned for diagnosis, treatment, mitigation, cure, or human consumption.',
					'Orders and accounts'     => 'Azure Synthetics may review, refuse, or cancel orders that appear inconsistent with research-use restrictions, payment controls, or fulfillment requirements.',
				'Product information'     => 'Product pages summarize form factor, storage, shipping, and lot context; buyers remain responsible for verifying suitability for their own internal protocols.',
			)
		)
	);

	$shipping_id = azure_synthetics_pantheon_upsert_page(
		'shipping-returns',
		'Shipping and Returns',
		azure_synthetics_pantheon_page_content(
			'Shipping and returns are handled around temperature-aware fulfillment, inspection timing, and research-use compliance.',
			array(
				'Shipping handling' => 'Cold-chain or stabilizing packaging may be used when product handling notes call for it. Inspect shipments promptly after delivery.',
				'Returns'           => 'Because research-use materials can be temperature-sensitive, return eligibility depends on order status, handling history, and support review.',
				'Support'           => 'Contact the support desk with order numbers, lot references, and delivery photos when requesting fulfillment help.',
			)
		),
		'refund_returns'
	);

	$bulk_id = azure_synthetics_pantheon_upsert_page(
		'bulk-orders',
			'Bulk Orders',
			azure_synthetics_pantheon_page_content(
				'Bulk and repeat-order conversations are routed through the support desk so documentation, lot context, and fulfillment expectations stay clear.',
				array(
					'Preferred pricing' => 'Start a conversation about recurring demand, pack sizes, and documentation needs.',
					'What to include'   => 'Send product names, expected order cadence, destination region, and any lot or COA requirements.',
					'Next step'         => 'Email hello@azuresynthetics.com and include Bulk Order Request in the subject line.',
			)
		)
	);

	if ( $privacy_id && ! is_wp_error( $privacy_id ) ) {
		update_option( 'wp_page_for_privacy_policy', (int) $privacy_id );
	}

	if ( $terms_id && ! is_wp_error( $terms_id ) ) {
		update_option( 'woocommerce_terms_page_id', (int) $terms_id );
	}

	azure_synthetics_pantheon_hide_default_content();
	azure_synthetics_pantheon_repair_navigation_urls();
	azure_synthetics_pantheon_repair_product_copy();

	update_option(
		'azure_synthetics_pantheon_launch_page_ids',
		array_filter(
			array_map(
				'intval',
				array(
					'privacy_policy'       => $privacy_id,
					'terms_and_conditions' => $terms_id,
					'shipping_returns'     => $shipping_id,
					'bulk_orders'          => $bulk_id,
				)
			)
		),
		false
	);
	update_option( 'azure_synthetics_pantheon_content_version', $content_version, false );
	azure_synthetics_pantheon_clear_cached_pages();
}

add_action( 'init', 'azure_synthetics_pantheon_ensure_launch_pages', 20 );
