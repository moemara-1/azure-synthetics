<?php
/**
 * Seed local development content for the Azure Synthetics demo store.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

function azure_seed_upsert_page( $title, $content = '', $template = '' ) {
	$page = get_page_by_title( $title, OBJECT, 'page' );

	if ( $page ) {
		$page_id = $page->ID;
		wp_update_post(
			array(
				'ID'           => $page_id,
				'post_content' => $content,
			)
		);
	} else {
		$page_id = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_content' => $content,
			)
		);
	}

	if ( $template ) {
		update_post_meta( $page_id, '_wp_page_template', $template );
	}

	return (int) $page_id;
}

function azure_seed_term_id( $name, $slug, $description = '' ) {
	$existing = get_term_by( 'slug', $slug, 'product_cat' );

	if ( $existing && ! is_wp_error( $existing ) ) {
		wp_update_term(
			(int) $existing->term_id,
			'product_cat',
			array(
				'name'        => $name,
				'description' => $description,
			)
		);
		return (int) $existing->term_id;
	}

	$created = wp_insert_term(
		$name,
		'product_cat',
			array(
				'slug'        => $slug,
				'description' => $description,
			)
	);

	if ( is_wp_error( $created ) ) {
		return 0;
	}

	return (int) $created['term_id'];
}

function azure_seed_import_image( $absolute_path, $parent_id = 0 ) {
	$upload_dir = wp_upload_dir();
	$filename   = wp_basename( $absolute_path );
	$target     = trailingslashit( $upload_dir['path'] ) . $filename;

	if ( ! file_exists( $absolute_path ) ) {
		return 0;
	}

	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => 1,
			'title'          => pathinfo( $filename, PATHINFO_FILENAME ),
		)
	);

	if ( $existing ) {
		$attach_id     = (int) $existing[0]->ID;
		$attached_file = get_attached_file( $attach_id );

		if ( $attached_file ) {
			wp_mkdir_p( dirname( $attached_file ) );
			copy( $absolute_path, $attached_file );
			$metadata = wp_generate_attachment_metadata( $attach_id, $attached_file );
			wp_update_attachment_metadata( $attach_id, $metadata );
		}

		return $attach_id;
	}

	wp_mkdir_p( $upload_dir['path'] );
	copy( $absolute_path, $target );

	$filetype   = wp_check_filetype( $filename, null );
	$attachment = array(
		'post_mime_type' => $filetype['type'],
		'post_title'     => pathinfo( $filename, PATHINFO_FILENAME ),
		'post_content'   => '',
		'post_status'    => 'inherit',
	);
	$attach_id  = wp_insert_attachment( $attachment, $target, $parent_id );

	$metadata = wp_generate_attachment_metadata( $attach_id, $target );
	wp_update_attachment_metadata( $attach_id, $metadata );

	return (int) $attach_id;
}

function azure_seed_product_by_sku( $sku ) {
	$product_id = wc_get_product_id_by_sku( $sku );

	if ( $product_id ) {
		$product = wc_get_product( $product_id );

		if ( $product ) {
			return $product;
		}
	}

	$product_ids = get_posts(
		array(
			'post_type'      => 'product',
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'meta_key'       => '_sku',
			'meta_value'     => $sku,
			'fields'         => 'ids',
		)
	);

	return $product_ids ? wc_get_product( (int) $product_ids[0] ) : null;
}

function azure_seed_delete_sku_conflicts( $sku, $keep_id = 0 ) {
	global $wpdb;

	$keep_id = absint( $keep_id );
	$post_ids = $wpdb->get_col(
		$wpdb->prepare(
			"SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_sku' AND meta_value = %s",
			$sku
		)
	);

	foreach ( $post_ids as $post_id ) {
		$post_id = absint( $post_id );

		if ( $post_id && $post_id !== $keep_id ) {
			wp_delete_post( $post_id, true );
		}
	}

	$lookup_table = $wpdb->prefix . 'wc_product_meta_lookup';

	if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $lookup_table ) ) === $lookup_table ) {
		if ( $keep_id ) {
			$wpdb->query(
				$wpdb->prepare(
					"DELETE FROM {$lookup_table} WHERE sku = %s AND product_id <> %d",
					$sku,
					$keep_id
				)
			);
		} else {
			$wpdb->delete( $lookup_table, array( 'sku' => $sku ), array( '%s' ) );
		}
	}

	if ( function_exists( 'wc_delete_product_transients' ) ) {
		wc_delete_product_transients();
	}
}

function azure_seed_product_attributes( WC_Product $product, array $attributes ) {
	$product_attributes = array();

	foreach ( $attributes as $name => $terms ) {
		$attribute = new WC_Product_Attribute();
		$attribute->set_name( $name );
		$attribute->set_options( $terms );
		$attribute->set_position( count( $product_attributes ) );
		$attribute->set_visible( true );
		$attribute->set_variation( true );
		$product_attributes[] = $attribute;
	}

	$product->set_attributes( $product_attributes );
}

function azure_seed_force_product_type( $product_id, $type ) {
	$product_id = absint( $product_id );

	if ( ! $product_id ) {
		return;
	}

	wp_set_object_terms( $product_id, $type, 'product_type', false );
	clean_object_term_cache( $product_id, 'product' );
	clean_post_cache( $product_id );

	if ( function_exists( 'wc_delete_product_transients' ) ) {
		wc_delete_product_transients( $product_id );
	}
}

function azure_seed_variable_product( array $definition ) {
	$existing = array();

	if ( ! empty( $definition['slug'] ) ) {
		$by_slug         = get_page_by_path( $definition['slug'], OBJECT, 'product' );
		$by_slug_product = $by_slug ? wc_get_product( $by_slug->ID ) : null;
		$existing        = $by_slug_product instanceof WC_Product ? array( $by_slug_product ) : array();
	}

	if ( ! $existing ) {
		$existing_product = azure_seed_product_by_sku( $definition['sku'] );
		$existing         = $existing_product ? array( $existing_product ) : array();
	}

	if ( ! $existing ) {
		$by_title         = get_page_by_title( $definition['name'], OBJECT, 'product' );
		$by_title_product = $by_title ? wc_get_product( $by_title->ID ) : null;
		$existing         = $by_title_product instanceof WC_Product ? array( $by_title_product ) : array();
	}

	if ( $existing && $existing[0] instanceof WC_Product ) {
		$product_id = $existing[0]->get_id();

		if ( ! $existing[0]->is_type( 'variable' ) ) {
			azure_seed_force_product_type( $product_id, 'variable' );
			delete_post_meta( $product_id, '_regular_price' );
			delete_post_meta( $product_id, '_sale_price' );
			delete_post_meta( $product_id, '_price' );
			$product = new WC_Product_Variable( $product_id );
		} else {
			$product = $existing[0];
		}
	} else {
		$product = new WC_Product_Variable();
	}
	$product->set_name( $definition['name'] );
	$product->set_status( 'publish' );
	$product->set_catalog_visibility( 'visible' );
	$product->set_featured( true );
	if ( ! empty( $definition['slug'] ) && method_exists( $product, 'set_slug' ) ) {
		$product->set_slug( $definition['slug'] );
	}
	azure_seed_delete_sku_conflicts( $definition['sku'], $product->get_id() );
	$product->set_sku( $definition['sku'] );
	$product->set_description( $definition['description'] );
	$product->set_short_description( $definition['short_description'] );
	$product->set_category_ids( $definition['category_ids'] );
	azure_seed_product_attributes( $product, $definition['attributes'] );
	$product->save();
	azure_seed_force_product_type( $product->get_id(), 'variable' );

	if ( ! empty( $definition['image_id'] ) ) {
		$product->set_image_id( $definition['image_id'] );
	}

	foreach ( $definition['meta'] as $meta_key => $meta_value ) {
		$product->update_meta_data( $meta_key, $meta_value );
	}

	$product->save();
	azure_seed_force_product_type( $product->get_id(), 'variable' );

	$children = $product->get_children();

	foreach ( $children as $child_id ) {
		wp_delete_post( $child_id, true );
	}

	foreach ( $definition['variations'] as $variation_definition ) {
		azure_seed_delete_sku_conflicts( $variation_definition['sku'] );

		$variation = new WC_Product_Variation();
		$variation->set_parent_id( $product->get_id() );
		$variation->set_regular_price( (string) $variation_definition['price'] );
		$variation->set_sku( $variation_definition['sku'] );
		$variation->set_attributes( $variation_definition['attributes'] );
		$variation->set_manage_stock( false );
		$variation->set_status( 'publish' );
		$variation->save();
	}

	WC_Product_Variable::sync( $product->get_id() );
	azure_seed_force_product_type( $product->get_id(), 'variable' );

	return $product->get_id();
}

function azure_seed_simple_product( array $definition ) {
	$existing = array();

	if ( ! empty( $definition['slug'] ) ) {
		$by_slug         = get_page_by_path( $definition['slug'], OBJECT, 'product' );
		$by_slug_product = $by_slug ? wc_get_product( $by_slug->ID ) : null;
		$existing        = $by_slug_product instanceof WC_Product ? array( $by_slug_product ) : array();
	}

	if ( ! $existing ) {
		$existing_product = azure_seed_product_by_sku( $definition['sku'] );
		$existing         = $existing_product ? array( $existing_product ) : array();
	}

	$product = ( $existing && $existing[0] instanceof WC_Product ) ? $existing[0] : new WC_Product_Simple();
	$product->set_name( $definition['name'] );
	$product->set_status( 'publish' );
	$product->set_catalog_visibility( 'visible' );
	$product->set_featured( true );
	if ( ! empty( $definition['slug'] ) && method_exists( $product, 'set_slug' ) ) {
		$product->set_slug( $definition['slug'] );
	}
	azure_seed_delete_sku_conflicts( $definition['sku'], $product->get_id() );
	$product->set_sku( $definition['sku'] );
	$product->set_regular_price( (string) $definition['price'] );
	$product->set_description( $definition['description'] );
	$product->set_short_description( $definition['short_description'] );
	$product->set_category_ids( $definition['category_ids'] );

	if ( ! empty( $definition['image_id'] ) ) {
		$product->set_image_id( $definition['image_id'] );
	}

	if ( ! empty( $definition['attributes'] ) ) {
		$product_attributes = array();

		foreach ( $definition['attributes'] as $name => $values ) {
			$attribute = new WC_Product_Attribute();
			$attribute->set_name( $name );
			$attribute->set_options( $values );
			$attribute->set_position( count( $product_attributes ) );
			$attribute->set_visible( true );
			$attribute->set_variation( false );
			$product_attributes[] = $attribute;
		}

		$product->set_attributes( $product_attributes );
	}

	foreach ( $definition['meta'] as $meta_key => $meta_value ) {
		$product->update_meta_data( $meta_key, $meta_value );
	}

	$product->save();

	return $product->get_id();
}

function azure_seed_catalog_candidate_ids( $catalog_slug, $catalog_sku ) {
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

	$slug_rows = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT ID, post_name FROM {$wpdb->posts} WHERE post_type = 'product' AND post_status <> 'trash' AND (post_name = %s OR post_name LIKE %s)",
			$catalog_slug,
			$wpdb->esc_like( $catalog_slug . '-' ) . '%'
		)
	);

	foreach ( $slug_rows as $slug_row ) {
		if ( preg_match( '/^' . preg_quote( $catalog_slug, '/' ) . '(-[0-9]+)?$/', $slug_row->post_name ) ) {
			$product_ids[] = absint( $slug_row->ID );
		}
	}

	return array_values( array_unique( array_filter( $product_ids ) ) );
}

function azure_seed_catalog_product_score( WC_Product $product, $catalog_slug, $catalog_sku ) {
	$post  = get_post( $product->get_id() );
	$score = 0;

	if ( $catalog_sku === $product->get_sku() ) {
		$score += 120;
	}

	if ( $catalog_slug === $product->get_meta( '_azure_catalog_slug' ) ) {
		$score += 80;
	}

	if ( $post && $catalog_slug === $post->post_name ) {
		$score += 60;
	}

	if ( $product->is_type( 'variable' ) ) {
		$score += 30;
	}

	if ( $post && 'publish' === $post->post_status ) {
		$score += 10;
	}

	return $score;
}

function azure_seed_archive_duplicate_product( WC_Product $product, $catalog_slug ) {
	$product_id = $product->get_id();

	$product->set_status( 'draft' );
	$product->set_catalog_visibility( 'hidden' );
	$product->save();

	wp_update_post(
		array(
			'ID'        => $product_id,
			'post_name' => $catalog_slug . '-archived-' . $product_id,
		)
	);
}

function azure_seed_force_product_slug( $product_id, $catalog_slug ) {
	global $wpdb;

	$product_id = absint( $product_id );

	if ( ! $product_id ) {
		return;
	}

	$conflict_ids = $wpdb->get_col(
		$wpdb->prepare(
			"SELECT ID FROM {$wpdb->posts} WHERE ID <> %d AND post_type = 'product' AND post_status <> 'trash' AND post_name = %s",
			$product_id,
			$catalog_slug
		)
	);

	foreach ( $conflict_ids as $conflict_id ) {
		$conflict_product = wc_get_product( absint( $conflict_id ) );

		if ( $conflict_product instanceof WC_Product ) {
			azure_seed_archive_duplicate_product( $conflict_product, $catalog_slug );
			continue;
		}

		wp_update_post(
			array(
				'ID'        => absint( $conflict_id ),
				'post_name' => $catalog_slug . '-archived-' . absint( $conflict_id ),
			)
		);
	}

	wp_update_post(
		array(
			'ID'        => $product_id,
			'post_name' => $catalog_slug,
		)
	);

	if ( $catalog_slug !== get_post_field( 'post_name', $product_id ) ) {
		$wpdb->update(
			$wpdb->posts,
			array( 'post_name' => $catalog_slug ),
			array( 'ID' => $product_id ),
			array( '%s' ),
			array( '%d' )
		);
		clean_post_cache( $product_id );
	}
}

function azure_seed_cleanup_catalog_products( array $catalog_products, array $catalog_skus ) {
	$catalog_by_slug = array();
	$kept_ids        = array();

	foreach ( $catalog_products as $catalog_product ) {
		$catalog_slug                     = azure_synthetics_catalog_slug( $catalog_product['name'] );
		$catalog_by_slug[ $catalog_slug ] = array(
			'name' => $catalog_product['name'],
			'sku'  => azure_synthetics_catalog_sku( $catalog_product['name'] ),
		);
	}

	foreach ( $catalog_by_slug as $catalog_slug => $catalog_definition ) {
		$candidate_ids = azure_seed_catalog_candidate_ids( $catalog_slug, $catalog_definition['sku'] );
		$candidates    = array();

		foreach ( $candidate_ids as $candidate_id ) {
			$product = wc_get_product( $candidate_id );

			if ( $product instanceof WC_Product ) {
				$candidates[] = $product;
			}
		}

		if ( ! $candidates ) {
			continue;
		}

		usort(
			$candidates,
			static function ( WC_Product $left, WC_Product $right ) use ( $catalog_slug, $catalog_definition ) {
				$left_score  = azure_seed_catalog_product_score( $left, $catalog_slug, $catalog_definition['sku'] );
				$right_score = azure_seed_catalog_product_score( $right, $catalog_slug, $catalog_definition['sku'] );

				if ( $left_score === $right_score ) {
					return $right->get_id() <=> $left->get_id();
				}

				return $right_score <=> $left_score;
			}
		);

		$canonical = array_shift( $candidates );

		foreach ( $candidates as $duplicate ) {
			azure_seed_archive_duplicate_product( $duplicate, $catalog_slug );
		}

		azure_seed_delete_sku_conflicts( $catalog_definition['sku'], $canonical->get_id() );

		$canonical->set_name( $catalog_definition['name'] );
		$canonical->set_status( 'publish' );
		$canonical->set_catalog_visibility( 'visible' );
		$canonical->set_sku( $catalog_definition['sku'] );
		$canonical->update_meta_data( '_azure_catalog_slug', $catalog_slug );
		$canonical->save();

		azure_seed_force_product_slug( $canonical->get_id(), $catalog_slug );

		$kept_ids[] = $canonical->get_id();
	}

	foreach ( wc_get_products( array( 'limit' => -1, 'status' => array( 'publish', 'draft' ), 'type' => array( 'simple', 'variable' ) ) ) as $product ) {
		$product_id    = $product->get_id();
		$product_slug  = get_post_field( 'post_name', $product_id );
		$catalog_slug  = $product->get_meta( '_azure_catalog_slug' );
		$is_catalog    = in_array( $product->get_sku(), $catalog_skus, true );
		$is_canonical  = in_array( $product_id, $kept_ids, true );
		$matches_slug  = $catalog_slug && isset( $catalog_by_slug[ $catalog_slug ] );
		$matches_route = isset( $catalog_by_slug[ $product_slug ] );

		if ( ! $is_canonical && ( ! $is_catalog || ! $matches_slug || ! $matches_route ) ) {
			$product->set_status( 'draft' );
			$product->set_catalog_visibility( 'hidden' );
			$product->save();
		}
	}

	if ( function_exists( 'wc_delete_product_transients' ) ) {
		wc_delete_product_transients();
	}
}

$home_page = azure_seed_upsert_page( 'Home' );
$shop_page = azure_seed_upsert_page( 'Shop', '<!-- wp:woocommerce/product-catalog /-->' );
$cart_page = azure_seed_upsert_page( 'Cart', '<!-- wp:woocommerce/cart /-->' );
$checkout  = azure_seed_upsert_page( 'Checkout', '<!-- wp:woocommerce/checkout /-->' );
$account   = azure_seed_upsert_page( 'My Account', '<!-- wp:woocommerce/my-account /-->' );
$science   = azure_seed_upsert_page( 'Science', '', 'page-templates/template-science.php' );
$faq_page  = azure_seed_upsert_page( 'FAQ', '', 'page-templates/template-faq.php' );
$contact   = azure_seed_upsert_page( 'Contact', '', 'page-templates/template-contact.php' );
$policy    = azure_seed_upsert_page(
	'Research Use Policy',
	'For research use only. Not for human consumption. Azure Synthetics products are sold exclusively for laboratory, analytical, and investigational environments. Do not market, position, or rely on this catalog for diagnosis, treatment, mitigation, or cure claims.',
	'page-templates/template-compliance.php'
);

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home_page );
update_option( 'woocommerce_shop_page_id', $shop_page );
update_option( 'woocommerce_cart_page_id', $cart_page );
update_option( 'woocommerce_checkout_page_id', $checkout );
update_option( 'woocommerce_myaccount_page_id', $account );
update_option( 'woocommerce_terms_page_id', $policy );
update_option( 'woocommerce_currency', 'EUR' );
update_option( 'woocommerce_price_decimal_sep', '.' );
update_option( 'woocommerce_price_thousand_sep', ',' );
update_option( 'azure_synthetics_footer_disclaimer', 'For research use only. Not for human consumption.' );
update_option( 'azure_synthetics_checkout_ack_label', 'I confirm this order is placed for lawful laboratory or research use only, and not for human consumption.' );
update_option( 'azure_synthetics_default_shipping_note', 'EU cold-chain shipping is included for catalog orders. Inspect temperature-sensitive inventory immediately upon delivery and reconcile the lot reference with the supplied CoA.' );
update_option( 'azure_synthetics_default_product_disclaimer', 'For research use only. Not for human or veterinary use. Not for diagnosis, treatment, injection, or consumption. Handle and store according to the published product guidance.' );

$category_ids = array();

foreach ( azure_synthetics_get_catalog_categories() as $slug => $category ) {
	$category_ids[ $slug ] = azure_seed_term_id( $category['name'], $slug, $category['description'] );
}

$theme_image_root = ABSPATH . 'wp-content/themes/azure-synthetics/assets/images/';
$azure_seed_all_catalog_products = azure_synthetics_get_catalog_products();
$catalog_skus                    = array_map( 'azure_synthetics_catalog_sku', wp_list_pluck( $azure_seed_all_catalog_products, 'name' ) );
$azure_seed_batch_mode           = defined( 'AZURE_SEED_BATCH_MODE' ) && AZURE_SEED_BATCH_MODE;

if ( $azure_seed_batch_mode ) {
	$azure_seed_batch_size = defined( 'AZURE_SEED_BATCH_SIZE' ) ? max( 1, (int) AZURE_SEED_BATCH_SIZE ) : 3;
	$azure_seed_offset     = defined( 'AZURE_SEED_BATCH_RESET' ) && AZURE_SEED_BATCH_RESET ? 0 : (int) get_option( 'azure_synthetics_seed_batch_offset', 0 );

	if ( defined( 'AZURE_SEED_BATCH_OFFSET' ) ) {
		$azure_seed_offset = max( 0, (int) AZURE_SEED_BATCH_OFFSET );
	}

	$azure_seed_catalog_products = array_slice( $azure_seed_all_catalog_products, $azure_seed_offset, $azure_seed_batch_size );
	$azure_seed_next_offset      = $azure_seed_offset + count( $azure_seed_catalog_products );
	$azure_seed_done             = $azure_seed_next_offset >= count( $azure_seed_all_catalog_products );

	update_option( 'azure_synthetics_seed_batch_offset', $azure_seed_next_offset, false );
	update_option( 'azure_synthetics_seed_batch_total', count( $azure_seed_all_catalog_products ), false );
	update_option( 'azure_synthetics_seed_batch_done', $azure_seed_done ? 'yes' : 'no', false );
} else {
	$azure_seed_catalog_products = $azure_seed_all_catalog_products;
	$azure_seed_done             = true;
}

foreach ( $azure_seed_catalog_products as $catalog_product ) {
	$amounts        = wp_list_pluck( $catalog_product['amounts'], 'amount' );
	$pack_sizes     = array( '1 vial', 'Box (5 vials)' );
	$variations     = array();
	$parent_sku     = azure_synthetics_catalog_sku( $catalog_product['name'] );

	foreach ( $catalog_product['amounts'] as $row ) {
		foreach ( array( 'vial' => '1 vial', 'box' => 'Box (5 vials)' ) as $price_key => $pack_size ) {
			$variations[] = array(
				'sku'        => $parent_sku . '-' . strtoupper( azure_synthetics_catalog_slug( $row['amount'] . '-' . $price_key ) ),
				'price'      => $row[ $price_key ],
				'attributes' => array(
					'Amount'    => $row['amount'],
					'Pack Size' => $pack_size,
				),
			);
		}
	}

	$product_id = azure_seed_variable_product(
		array(
			'name'              => $catalog_product['name'],
			'slug'              => azure_synthetics_catalog_slug( $catalog_product['name'] ),
			'sku'               => $parent_sku,
			'image_id'          => azure_seed_import_image( $theme_image_root . azure_synthetics_catalog_image_filename( $catalog_product ) ),
			'category_ids'      => array_filter( array( $category_ids[ $catalog_product['category'] ] ?? 0 ) ),
			'short_description' => azure_synthetics_catalog_product_copy( $catalog_product, 'short' ),
			'description'       => azure_synthetics_catalog_product_copy( $catalog_product, 'description' ),
			'attributes'        => array(
				'Amount'    => $amounts,
				'Pack Size' => $pack_sizes,
			),
			'variations'        => $variations,
			'meta'              => array(
				'_azure_catalog_slug'             => azure_synthetics_catalog_slug( $catalog_product['name'] ),
				'_azure_subtitle'                 => azure_synthetics_catalog_product_copy( $catalog_product, 'subtitle' ),
				'_azure_subtitle_ar'              => azure_synthetics_catalog_product_copy( $catalog_product, 'subtitle', 'ar' ),
				'_azure_lab_descriptor'           => azure_synthetics_catalog_product_copy( $catalog_product, 'descriptor' ),
				'_azure_lab_descriptor_ar'        => azure_synthetics_catalog_product_copy( $catalog_product, 'descriptor', 'ar' ),
				'_azure_short_description_ar'     => azure_synthetics_catalog_product_copy( $catalog_product, 'short', 'ar' ),
				'_azure_description_ar'           => azure_synthetics_catalog_product_copy( $catalog_product, 'description', 'ar' ),
				'_azure_purity_percent'           => '>=99%',
				'_azure_form_factor'              => 'Lyophilized research material',
				'_azure_vial_amount'              => azure_synthetics_catalog_amount_summary( $catalog_product ),
				'_azure_storage_instructions'     => 'Store unopened lyophilized material frozen at -20°C or according to the lot CoA/SDS. Protect from light and moisture and minimize temperature cycling.',
				'_azure_shipping_warning'         => 'EU cold-chain shipping included for catalog orders. Inspect promptly and reconcile lot/CoA references on receipt.',
				'_azure_batch_reference'          => 'CoA per batch; lot reference supplied on fulfillment.',
				'_azure_reconstitution_guidance'  => 'Reference validated laboratory SOPs only. Not for human or veterinary use, diagnosis, treatment, injection, or consumption.',
				'_azure_research_disclaimer'      => 'For research use only. Not for human or veterinary use. Not for diagnosis, treatment, injection, or consumption.',
				'_azure_product_faqs'             => wp_json_encode(
					array(
						array(
							'question' => 'What information should be checked before ordering?',
							'answer'   => 'Review the amount, pack size, lot documentation workflow, storage expectations, and research-use restriction before checkout.',
						),
						array(
							'question' => 'Does the product include batch documentation?',
							'answer'   => 'Catalog products are structured around a CoA-per-batch workflow with lot references supplied during fulfillment.',
						),
					)
				),
			),
		)
	);

	update_post_meta( $product_id, '_crosssell_ids', array() );
}

if ( $azure_seed_batch_mode && ! $azure_seed_done ) {
	return;
}

azure_seed_cleanup_catalog_products( $azure_seed_all_catalog_products, $catalog_skus );

function azure_seed_upsert_nav_item( $menu_id, $title, $url ) {
	$existing_item_id = 0;
	$items            = wp_get_nav_menu_items( $menu_id );

	if ( $items ) {
		foreach ( $items as $item ) {
			if ( $title === $item->title ) {
				$existing_item_id = (int) $item->ID;
				break;
			}
		}
	}

	wp_update_nav_menu_item(
		$menu_id,
		$existing_item_id,
		array(
			'menu-item-title'  => $title,
			'menu-item-url'    => $url,
			'menu-item-status' => 'publish',
		)
	);
}

$locations = get_theme_mod( 'nav_menu_locations', array() );
$menu_id   = ! empty( $locations['primary'] ) ? (int) $locations['primary'] : 0;

if ( ! $menu_id ) {
	$menu_id = wp_create_nav_menu( 'Primary Navigation' );
}

foreach (
	array(
		array(
			'title' => 'Home',
			'url'   => home_url( '/' ),
		),
		array(
			'title' => 'Shop',
			'url'   => get_permalink( $shop_page ),
		),
		array(
			'title' => 'Science',
			'url'   => get_permalink( $science ),
		),
		array(
			'title' => 'FAQ',
			'url'   => get_permalink( $faq_page ),
		),
		array(
			'title' => 'Contact',
			'url'   => get_permalink( $contact ),
		),
	) as $item
) {
	azure_seed_upsert_nav_item( $menu_id, $item['title'], $item['url'] );
}

$locations['primary'] = $menu_id;
$locations['footer']  = $menu_id;
set_theme_mod( 'nav_menu_locations', $locations );
