<?php
/**
 * Lightweight schema output.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
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
}
add_action( 'wp_head', 'azure_synthetics_output_schema', 30 );
