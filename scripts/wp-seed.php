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

function azure_seed_term_id( $name, $slug ) {
	$existing = get_term_by( 'slug', $slug, 'product_cat' );

	if ( $existing && ! is_wp_error( $existing ) ) {
		return (int) $existing->term_id;
	}

	$created = wp_insert_term(
		$name,
		'product_cat',
		array(
			'slug' => $slug,
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
		return (int) $existing[0]->ID;
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

function azure_seed_variable_product( array $definition ) {
	$existing = wc_get_products(
		array(
			'limit' => 1,
			'sku'   => $definition['sku'],
		)
	);

	$product = $existing ? $existing[0] : new WC_Product_Variable();
	$product->set_name( $definition['name'] );
	$product->set_status( 'publish' );
	$product->set_catalog_visibility( 'visible' );
	$product->set_featured( true );
	$product->set_sku( $definition['sku'] );
	$product->set_description( $definition['description'] );
	$product->set_short_description( $definition['short_description'] );
	$product->set_category_ids( $definition['category_ids'] );
	azure_seed_product_attributes( $product, $definition['attributes'] );
	$product->save();

	if ( ! empty( $definition['image_id'] ) ) {
		$product->set_image_id( $definition['image_id'] );
	}

	foreach ( $definition['meta'] as $meta_key => $meta_value ) {
		$product->update_meta_data( $meta_key, $meta_value );
	}

	$product->save();

	$children = $product->get_children();

	if ( empty( $children ) ) {
		foreach ( $definition['variations'] as $variation_definition ) {
			$variation = new WC_Product_Variation();
			$variation->set_parent_id( $product->get_id() );
			$variation->set_regular_price( (string) $variation_definition['price'] );
			$variation->set_sku( $variation_definition['sku'] );
			$variation->set_attributes( $variation_definition['attributes'] );
			$variation->set_manage_stock( false );
			$variation->save();
		}
	}

	return $product->get_id();
}

function azure_seed_simple_product( array $definition ) {
	$existing = wc_get_products(
		array(
			'limit' => 1,
			'sku'   => $definition['sku'],
		)
	);

	$product = $existing ? $existing[0] : new WC_Product_Simple();
	$product->set_name( $definition['name'] );
	$product->set_status( 'publish' );
	$product->set_catalog_visibility( 'visible' );
	$product->set_featured( true );
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
update_option( 'azure_synthetics_footer_disclaimer', 'For research use only. Not for human consumption.' );
update_option( 'azure_synthetics_checkout_ack_label', 'I confirm this order is placed for lawful laboratory or research use only, and not for human consumption.' );
update_option( 'azure_synthetics_default_shipping_note', 'Temperature-sensitive inventory is packed to reduce transit instability; inspect product immediately upon delivery.' );
update_option( 'azure_synthetics_default_product_disclaimer', 'For research use only. Not for human consumption. Handle and store according to the published product guidance.' );

$category_ids = array(
	'recovery'  => azure_seed_term_id( 'Recovery + Repair', 'recovery-repair' ),
	'bodycomp'  => azure_seed_term_id( 'Body Composition', 'body-composition' ),
	'longevity' => azure_seed_term_id( 'Longevity + Energy', 'longevity-energy' ),
);

$theme_image_root = ABSPATH . 'wp-content/themes/azure-synthetics/assets/images/';

$bpc_image    = azure_seed_import_image( $theme_image_root . 'card-bpc157.png' );
$motsc_image  = azure_seed_import_image( $theme_image_root . 'card-motsc.png' );
$cjcipa_image = azure_seed_import_image( $theme_image_root . 'card-cjcipa.png' );
$glp_image    = azure_seed_import_image( $theme_image_root . 'card-glp3.png' );

azure_seed_simple_product(
	array(
		'name'              => 'BPC-157',
		'sku'               => 'AZ-BPC157-10',
		'price'             => 95,
		'image_id'          => $bpc_image,
		'category_ids'      => array( $category_ids['recovery'] ),
		'short_description' => 'Lyophilized recovery peptide with traceable COA support.',
		'description'       => 'Built for recovery and repair-oriented research programs that prioritize documentation, packaging stability, and lot continuity over generic catalog merchandising.',
		'attributes'        => array(
			'Vial Size'   => array( '10 mg' ),
			'Form Factor' => array( 'Lyophilized powder' ),
		),
		'meta'              => array(
			'_azure_subtitle'                => 'Protocol-ready repair support',
			'_azure_lab_descriptor'          => 'Recovery / repair',
			'_azure_purity_percent'          => '99.1%–99.6%',
			'_azure_form_factor'             => 'Lyophilized powder',
			'_azure_vial_amount'             => '10 mg',
			'_azure_storage_instructions'    => 'Store frozen for long-term stability; refrigerate after reconstitution when applicable.',
			'_azure_shipping_warning'        => 'Cold-chain stabilizing pack included on every order.',
			'_azure_batch_reference'         => 'COA + lot QR linked on fulfillment.',
			'_azure_reconstitution_guidance' => 'Use only validated sterile lab diluent according to your internal protocol.',
			'_azure_research_disclaimer'     => 'For research use only. Not for human consumption.',
			'_azure_product_faqs'            => wp_json_encode(
				array(
					array(
						'question' => 'How is lot verification surfaced?',
						'answer'   => 'Each shipment references a lot ID and a supporting COA workflow.',
					),
					array(
						'question' => 'Is the vial pre-mixed?',
						'answer'   => 'No. The default catalog presentation is lyophilized powder unless noted otherwise.',
					),
				)
			),
		),
	)
);

azure_seed_simple_product(
	array(
		'name'              => 'MOTS-C',
		'sku'               => 'AZ-MOTSC-10',
		'price'             => 110,
		'image_id'          => $motsc_image,
		'category_ids'      => array( $category_ids['longevity'] ),
		'short_description' => 'Mitochondrial research compound with premium cold-chain presentation.',
		'description'       => 'Positioned for longevity and metabolic support research workflows that value legible technical metadata and repeat-order continuity.',
		'attributes'        => array(
			'Vial Size'   => array( '10 mg' ),
			'Form Factor' => array( 'Lyophilized powder' ),
		),
		'meta'              => array(
			'_azure_subtitle'                => 'Metabolic support',
			'_azure_lab_descriptor'          => 'Longevity + energy',
			'_azure_purity_percent'          => '98.8%–99.4%',
			'_azure_form_factor'             => 'Lyophilized powder',
			'_azure_vial_amount'             => '10 mg',
			'_azure_storage_instructions'    => 'Freeze unopened inventory and minimize repeated temperature cycling.',
			'_azure_shipping_warning'        => 'Insulated packaging used for transit stability.',
			'_azure_batch_reference'         => 'Lot-linked analytical release file.',
			'_azure_reconstitution_guidance' => 'Follow validated internal handling procedures only.',
			'_azure_research_disclaimer'     => 'For research use only. Not for human consumption.',
			'_azure_product_faqs'            => wp_json_encode(
				array(
					array(
						'question' => 'What documentation accompanies the product?',
						'answer'   => 'Orders include traceability references and supporting assay documentation.',
					),
				)
			),
		),
	)
);

$cjc_product_id = azure_seed_variable_product(
	array(
		'name'              => 'CJC / IPA',
		'sku'               => 'AZ-CJCIPA',
		'image_id'          => $cjcipa_image,
		'category_ids'      => array( $category_ids['recovery'] ),
		'short_description' => 'Variable format peptide stack presented with clean protocol metadata.',
		'description'       => 'A variable product scaffold for vial and kit purchasing, demonstrating WooCommerce-native pack options without custom checkout hacks.',
		'attributes'        => array(
			'Pack Size' => array( '1 kit', '2 kits' ),
			'Vial Size' => array( '5 mg / 5 mg' ),
		),
		'variations'        => array(
			array(
				'sku'        => 'AZ-CJCIPA-1KIT',
				'price'      => 105,
				'attributes' => array(
					'Pack Size' => '1 kit',
					'Vial Size' => '5 mg / 5 mg',
				),
			),
			array(
				'sku'        => 'AZ-CJCIPA-2KIT',
				'price'      => 198,
				'attributes' => array(
					'Pack Size' => '2 kits',
					'Vial Size' => '5 mg / 5 mg',
				),
			),
		),
		'meta'              => array(
			'_azure_subtitle'                => 'Sleep and recovery stack',
			'_azure_lab_descriptor'          => 'Recovery + repair',
			'_azure_purity_percent'          => '97.9%–99.1%',
			'_azure_form_factor'             => 'Dual-vial kit',
			'_azure_vial_amount'             => '5 mg / 5 mg',
			'_azure_storage_instructions'    => 'Store at frozen temperatures until validated use.',
			'_azure_shipping_warning'        => 'Ships in insulated kit packaging.',
			'_azure_batch_reference'         => 'Paired COA references per component.',
			'_azure_reconstitution_guidance' => 'Reference internal SOPs for multi-vial handling.',
			'_azure_research_disclaimer'     => 'For research use only. Not for human consumption.',
			'_azure_product_faqs'            => wp_json_encode(
				array(
					array(
						'question' => 'Can I purchase multiple kits in one line item?',
						'answer'   => 'Yes. Use the Pack Size selector to place a WooCommerce-native variation order.',
					),
				)
			),
		),
	)
);

azure_seed_simple_product(
	array(
		'name'              => 'GLP-3',
		'sku'               => 'AZ-GLP3-15',
		'price'             => 130,
		'image_id'          => $glp_image,
		'category_ids'      => array( $category_ids['bodycomp'] ),
		'short_description' => 'Body composition research peptide displayed with premium dark-surface merchandising.',
		'description'       => 'Uses the emphasized card styling from the reference design and demonstrates high-contrast product merchandising for flagship catalog entries.',
		'attributes'        => array(
			'Vial Size'   => array( '15 mg' ),
			'Form Factor' => array( 'Lyophilized powder' ),
		),
		'meta'              => array(
			'_azure_subtitle'                => 'Body composition protocols',
			'_azure_lab_descriptor'          => 'Body composition',
			'_azure_purity_percent'          => '98.5%–99.2%',
			'_azure_form_factor'             => 'Lyophilized powder',
			'_azure_vial_amount'             => '15 mg',
			'_azure_storage_instructions'    => 'Frozen storage recommended; avoid heat exposure during staging.',
			'_azure_shipping_warning'        => 'Priority handling recommended for warm-weather routes.',
			'_azure_batch_reference'         => 'Batch archive available on request.',
			'_azure_reconstitution_guidance' => 'Reference lab SOPs before handling.',
			'_azure_research_disclaimer'     => 'For research use only. Not for human consumption.',
			'_azure_product_faqs'            => wp_json_encode(
				array(
					array(
						'question' => 'Is this positioned as a consumer wellness product?',
						'answer'   => 'No. Catalog language is intentionally restricted to research and laboratory contexts.',
					),
				)
			),
		),
	)
);

update_post_meta( $cjc_product_id, '_crosssell_ids', array() );

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
	) as $item
) {
	azure_seed_upsert_nav_item( $menu_id, $item['title'], $item['url'] );
}

$locations['primary'] = $menu_id;
$locations['footer']  = $menu_id;
set_theme_mod( 'nav_menu_locations', $locations );
