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

function azure_synthetics_pantheon_activate_storefront_stack() {
	if ( function_exists( 'wp_get_theme' ) && 'azure-synthetics' !== wp_get_theme()->get_stylesheet() ) {
		switch_theme( 'azure-synthetics' );
	}

	if ( ! function_exists( 'is_plugin_active' ) || ! function_exists( 'activate_plugin' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	foreach ( array( 'woocommerce/woocommerce.php', 'azure-synthetics-core/azure-synthetics-core.php' ) as $plugin ) {
		if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin ) && ! is_plugin_active( $plugin ) ) {
			activate_plugin( $plugin );
		}
	}
}

function azure_synthetics_pantheon_run_catalog_seed() {
	$seed_file = ABSPATH . 'scripts/wp-seed.php';

	if ( ! file_exists( $seed_file ) ) {
		return;
	}

	azure_synthetics_pantheon_activate_storefront_stack();

	if ( ! function_exists( 'wc_get_product_id_by_sku' ) || ! function_exists( 'azure_synthetics_get_catalog_products' ) ) {
		return;
	}

	azure_synthetics_pantheon_require_seed_file( $seed_file );
}

function azure_synthetics_pantheon_require_seed_file( $seed_file ) {
	if ( function_exists( 'opcache_invalidate' ) ) {
		opcache_invalidate( $seed_file, true );
	}

	require $seed_file;
}

function azure_synthetics_pantheon_lookup_table_name() {
	global $wpdb;

	return $wpdb->prefix . 'wc_product_meta_lookup';
}

function azure_synthetics_pantheon_lookup_table_exists() {
	global $wpdb;

	$lookup_table = azure_synthetics_pantheon_lookup_table_name();

	return $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $lookup_table ) ) === $lookup_table;
}

function azure_synthetics_pantheon_archive_catalog_duplicate( $product_id, $catalog_slug ) {
	global $wpdb;

	$product_id = absint( $product_id );

	if ( ! $product_id ) {
		return;
	}

	delete_post_meta( $product_id, '_sku' );
	update_post_meta( $product_id, '_azure_archived_duplicate', 'yes' );

	wp_update_post(
		array(
			'ID'          => $product_id,
			'post_status' => 'draft',
			'post_name'   => $catalog_slug . '-archived-' . $product_id,
		)
	);

	if ( azure_synthetics_pantheon_lookup_table_exists() ) {
		$wpdb->delete( azure_synthetics_pantheon_lookup_table_name(), array( 'product_id' => $product_id ), array( '%d' ) );
	}
}

function azure_synthetics_pantheon_catalog_duplicate_ids( $catalog_name, $catalog_slug, $catalog_sku ) {
	global $wpdb;

	$product_ids = array();

	foreach ( array( '_sku' => $catalog_sku, '_azure_catalog_slug' => $catalog_slug ) as $meta_key => $meta_value ) {
		$meta_ids = get_posts(
			array(
				'post_type'      => 'product',
				'post_status'    => 'any',
				'posts_per_page' => -1,
				'fields'         => 'ids',
				'meta_key'       => $meta_key,
				'meta_value'     => $meta_value,
			)
		);

		$product_ids = array_merge( $product_ids, array_map( 'absint', $meta_ids ) );
	}

	$rows = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT ID, post_name FROM {$wpdb->posts} WHERE post_type = 'product' AND post_status <> 'trash' AND (post_title = %s OR post_name = %s OR post_name LIKE %s)",
			$catalog_name,
			$catalog_slug,
			$wpdb->esc_like( $catalog_slug . '-' ) . '%'
		)
	);

	foreach ( $rows as $row ) {
		if ( $catalog_name === get_the_title( $row->ID ) || preg_match( '/^' . preg_quote( $catalog_slug, '/' ) . '(-[0-9]+)?$/', $row->post_name ) ) {
			$product_ids[] = absint( $row->ID );
		}
	}

	return array_values( array_unique( array_filter( $product_ids ) ) );
}

function azure_synthetics_pantheon_catalog_duplicate_score( $product_id, $catalog_slug, $catalog_sku ) {
	$product = wc_get_product( $product_id );
	$post    = get_post( $product_id );
	$score   = 0;

	if ( $catalog_slug === get_post_meta( $product_id, '_azure_catalog_slug', true ) ) {
		$score += 220;
	}

	if ( $catalog_sku === get_post_meta( $product_id, '_sku', true ) ) {
		$score += 180;
	}

	if ( $post && $catalog_slug === $post->post_name ) {
		$score += 160;
	}

	if ( $product instanceof WC_Product && $product->is_type( 'variable' ) ) {
		$score += 60;
	}

	if ( $post && 'publish' === $post->post_status ) {
		$score += 20;
	}

	return $score;
}

function azure_synthetics_pantheon_force_catalog_slug( $product_id, $catalog_slug ) {
	global $wpdb;

	$product_id = absint( $product_id );

	$conflicts = $wpdb->get_col(
		$wpdb->prepare(
			"SELECT ID FROM {$wpdb->posts} WHERE ID <> %d AND post_type = 'product' AND post_status <> 'trash' AND post_name = %s",
			$product_id,
			$catalog_slug
		)
	);

	foreach ( $conflicts as $conflict_id ) {
		azure_synthetics_pantheon_archive_catalog_duplicate( $conflict_id, $catalog_slug );
	}

	wp_update_post(
		array(
			'ID'          => $product_id,
			'post_status' => 'publish',
			'post_name'   => $catalog_slug,
		)
	);

	if ( $catalog_slug !== get_post_field( 'post_name', $product_id ) ) {
		$wpdb->update(
			$wpdb->posts,
			array(
				'post_status' => 'publish',
				'post_name'   => $catalog_slug,
			),
			array( 'ID' => $product_id ),
			array( '%s', '%s' ),
			array( '%d' )
		);
		clean_post_cache( $product_id );
	}
}

function azure_synthetics_pantheon_cleanup_catalog_duplicates() {
	if ( ! function_exists( 'wc_get_product' ) || ! function_exists( 'azure_synthetics_get_catalog_products' ) || ! function_exists( 'azure_synthetics_catalog_slug' ) || ! function_exists( 'azure_synthetics_catalog_sku' ) ) {
		return array(
			'archived' => array(),
			'kept'     => array(),
		);
	}

	$archived = array();
	$kept     = array();

	foreach ( azure_synthetics_get_catalog_products() as $catalog_product ) {
		$catalog_name = $catalog_product['name'];
		$catalog_slug = azure_synthetics_catalog_slug( $catalog_name );
		$catalog_sku  = azure_synthetics_catalog_sku( $catalog_name );
		$candidate_ids = azure_synthetics_pantheon_catalog_duplicate_ids( $catalog_name, $catalog_slug, $catalog_sku );

		if ( ! $candidate_ids ) {
			continue;
		}

		usort(
			$candidate_ids,
			static function ( $left, $right ) use ( $catalog_slug, $catalog_sku ) {
				$left_score  = azure_synthetics_pantheon_catalog_duplicate_score( $left, $catalog_slug, $catalog_sku );
				$right_score = azure_synthetics_pantheon_catalog_duplicate_score( $right, $catalog_slug, $catalog_sku );

				if ( $left_score === $right_score ) {
					return absint( $right ) <=> absint( $left );
				}

				return $right_score <=> $left_score;
			}
		);

		$canonical_id = absint( array_shift( $candidate_ids ) );

		foreach ( $candidate_ids as $duplicate_id ) {
			azure_synthetics_pantheon_archive_catalog_duplicate( $duplicate_id, $catalog_slug );
			$archived[] = absint( $duplicate_id );
		}

		update_post_meta( $canonical_id, '_sku', $catalog_sku );
		update_post_meta( $canonical_id, '_azure_catalog_slug', $catalog_slug );
		azure_synthetics_pantheon_force_catalog_slug( $canonical_id, $catalog_slug );
		$kept[ $catalog_slug ] = $canonical_id;
	}

	if ( function_exists( 'wc_delete_product_transients' ) ) {
		wc_delete_product_transients();
	}

	azure_synthetics_pantheon_clear_cached_pages();

	return array(
		'archived' => array_values( array_unique( $archived ) ),
		'kept'     => $kept,
	);
}

function azure_synthetics_pantheon_batch_seed_endpoint() {
	if ( ! azure_synthetics_pantheon_runtime_origin() || empty( $_GET['azure_seed_batch'] ) || 'az-20260424' !== sanitize_text_field( wp_unslash( $_GET['azure_seed_batch'] ) ) ) {
		return;
	}

	if ( ! headers_sent() ) {
		header( 'Content-Type: application/json; charset=utf-8' );
	}

	if ( ! empty( $_GET['reset'] ) ) {
		update_option( 'azure_synthetics_seed_batch_offset', 0, false );
		update_option( 'azure_synthetics_seed_batch_done', 'no', false );
	}

	$seed_file = ABSPATH . 'scripts/wp-seed.php';

	if ( ! file_exists( $seed_file ) ) {
		wp_send_json_error( array( 'message' => 'Seed file is not deployed.' ), 500 );
	}

	azure_synthetics_pantheon_activate_storefront_stack();

	if ( ! function_exists( 'wc_get_product_id_by_sku' ) || ! function_exists( 'azure_synthetics_get_catalog_products' ) ) {
		wp_send_json_error( array( 'message' => 'Storefront stack is not ready; retry after one request.' ), 503 );
	}

	if ( ! defined( 'AZURE_SEED_BATCH_MODE' ) ) {
		define( 'AZURE_SEED_BATCH_MODE', true );
	}

	if ( ! defined( 'AZURE_SEED_BATCH_SIZE' ) ) {
		define( 'AZURE_SEED_BATCH_SIZE', 3 );
	}

	if ( ! empty( $_GET['reset'] ) && ! defined( 'AZURE_SEED_BATCH_RESET' ) ) {
		define( 'AZURE_SEED_BATCH_RESET', true );
	}

	azure_synthetics_pantheon_require_seed_file( $seed_file );

	$done   = 'yes' === get_option( 'azure_synthetics_seed_batch_done' );
	$offset = (int) get_option( 'azure_synthetics_seed_batch_offset', 0 );
	$total  = (int) get_option( 'azure_synthetics_seed_batch_total', 0 );

	if ( $done ) {
		$cleanup = azure_synthetics_pantheon_cleanup_catalog_duplicates();
		update_option( 'azure_synthetics_pantheon_content_version', '2026-04-29.4', false );
		azure_synthetics_pantheon_clear_cached_pages();
	}

	wp_send_json_success(
		array(
			'done'   => $done,
			'offset' => $offset,
			'total'  => $total,
			'cleanup' => $done ? $cleanup : null,
		)
	);
}

add_action( 'init', 'azure_synthetics_pantheon_batch_seed_endpoint', 99 );

function azure_synthetics_pantheon_cleanup_catalog_endpoint() {
	if ( ! azure_synthetics_pantheon_runtime_origin() || empty( $_GET['azure_cleanup_catalog'] ) || 'az-20260429' !== sanitize_text_field( wp_unslash( $_GET['azure_cleanup_catalog'] ) ) ) {
		return;
	}

	azure_synthetics_pantheon_activate_storefront_stack();

	if ( ! headers_sent() ) {
		header( 'Content-Type: application/json; charset=utf-8' );
	}

	$result = azure_synthetics_pantheon_cleanup_catalog_duplicates();
	$count  = wp_count_posts( 'product' );

	wp_send_json_success(
		array(
			'published_products' => isset( $count->publish ) ? (int) $count->publish : 0,
			'cleanup'            => $result,
		)
	);
}

add_action( 'init', 'azure_synthetics_pantheon_cleanup_catalog_endpoint', 100 );

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

	$content_version = '2026-04-29.4';

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
	azure_synthetics_pantheon_cleanup_catalog_duplicates();

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
