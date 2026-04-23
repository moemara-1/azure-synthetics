<?php
/**
 * Structured data output.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_get_schema_breadcrumbs() {
	$items = array(
		array(
			'name' => get_bloginfo( 'name' ),
			'url'  => home_url( '/' ),
		),
	);

	if ( is_front_page() ) {
		return $items;
	}

	if ( function_exists( 'is_shop' ) && is_shop() ) {
		$items[] = array(
			'name' => __( 'Shop', 'azure-synthetics' ),
			'url'  => azure_synthetics_shop_url(),
		);
		return $items;
	}

	if ( is_tax( 'product_cat' ) ) {
		$term = get_queried_object();

		$items[] = array(
			'name' => __( 'Shop', 'azure-synthetics' ),
			'url'  => azure_synthetics_shop_url(),
		);

		if ( $term ) {
			$items[] = array(
				'name' => $term->name,
				'url'  => get_term_link( $term ),
			);
		}

		return $items;
	}

	if ( is_singular( 'product' ) ) {
		$items[] = array(
			'name' => __( 'Shop', 'azure-synthetics' ),
			'url'  => azure_synthetics_shop_url(),
		);

		$terms = get_the_terms( get_queried_object_id(), 'product_cat' );

		if ( $terms && ! is_wp_error( $terms ) ) {
			$primary_term = array_shift( $terms );
			$items[]      = array(
				'name' => $primary_term->name,
				'url'  => get_term_link( $primary_term ),
			);
		}

		$items[] = array(
			'name' => function_exists( 'azure_synthetics_get_product_display_title' ) ? azure_synthetics_get_product_display_title( get_queried_object_id() ) : get_the_title(),
			'url'  => get_permalink(),
		);

		return $items;
	}

	if ( is_page() ) {
		$items[] = array(
			'name' => get_the_title(),
			'url'  => get_permalink(),
		);
	}

	return $items;
}

function azure_synthetics_output_schema() {
	$contact = azure_synthetics_get_contact_details();

	$organization = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'Organization',
		'name'        => get_bloginfo( 'name' ),
		'description' => get_bloginfo( 'description' ),
		'url'         => home_url( '/' ),
		'email'       => $contact['email'],
		'telephone'   => $contact['phone'],
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $organization ) . '</script>';

	echo '<script type="application/ld+json">' . wp_json_encode(
		array(
			'@context'        => 'https://schema.org',
			'@type'           => 'WebSite',
			'name'            => get_bloginfo( 'name' ),
			'url'             => home_url( '/' ),
			'potentialAction' => array(
				'@type'       => 'SearchAction',
				'target'      => home_url( '/?s={search_term_string}' ),
				'query-input' => 'required name=search_term_string',
			),
		)
	) . '</script>';

	$breadcrumbs = azure_synthetics_get_schema_breadcrumbs();

	if ( count( $breadcrumbs ) > 1 ) {
		$list = array();

		foreach ( $breadcrumbs as $index => $item ) {
			$list[] = array(
				'@type'    => 'ListItem',
				'position' => $index + 1,
				'name'     => $item['name'],
				'item'     => $item['url'],
			);
		}

		echo '<script type="application/ld+json">' . wp_json_encode(
			array(
				'@context'        => 'https://schema.org',
				'@type'           => 'BreadcrumbList',
				'itemListElement' => $list,
			)
		) . '</script>';
	}

	if ( is_page_template( 'page-templates/template-faq.php' ) ) {
		$entities = array();

		foreach ( azure_synthetics_get_default_faqs() as $faq ) {
			$entities[] = array(
				'@type'          => 'Question',
				'name'           => $faq['question'],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $faq['answer'],
				),
			);
		}

		echo '<script type="application/ld+json">' . wp_json_encode(
			array(
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => $entities,
			)
		) . '</script>';
	}

	if ( is_singular( 'product' ) && function_exists( 'wc_get_product' ) ) {
		$product = wc_get_product( get_queried_object_id() );

		if ( ! $product ) {
			return;
		}

		$properties = array();
		$property_keys = array(
			'compound_alias'       => __( 'Compound alias', 'azure-synthetics' ),
			'evidence_tier'        => __( 'Evidence tier', 'azure-synthetics' ),
			'documentation_status' => __( 'Documentation status', 'azure-synthetics' ),
			'proof_surface_label'  => __( 'Proof surface', 'azure-synthetics' ),
			'form_factor'          => __( 'Form factor', 'azure-synthetics' ),
			'vial_amount'          => __( 'Vial amount', 'azure-synthetics' ),
		);

		foreach ( $property_keys as $key => $label ) {
			$value = function_exists( 'azure_synthetics_get_product_meta_value' ) ? azure_synthetics_get_product_meta_value( $product->get_id(), $key, '' ) : '';

			if ( '' === $value ) {
				continue;
			}

			$properties[] = array(
				'@type' => 'PropertyValue',
				'name'  => $label,
				'value' => $value,
			);
		}

		$product_schema = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Product',
			'name'        => function_exists( 'azure_synthetics_get_product_display_title' ) ? azure_synthetics_get_product_display_title( $product->get_id() ) : $product->get_name(),
			'description' => wp_strip_all_tags( azure_synthetics_get_seo_description() ),
			'sku'         => $product->get_sku(),
			'brand'       => array(
				'@type' => 'Brand',
				'name'  => get_bloginfo( 'name' ),
			),
			'image'       => array_filter(
				array(
					$product->get_image_id() ? wp_get_attachment_image_url( $product->get_image_id(), 'full' ) : '',
				)
			),
			'offers'      => array(
				'@type'         => 'Offer',
				'priceCurrency' => get_woocommerce_currency(),
				'price'         => $product->get_price(),
				'availability'  => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
				'url'           => get_permalink(),
			),
		);

		if ( $properties ) {
			$product_schema['additionalProperty'] = $properties;
		}

		echo '<script type="application/ld+json">' . wp_json_encode( $product_schema ) . '</script>';
	}
}
add_action( 'wp_head', 'azure_synthetics_output_schema', 30 );
