<?php
/**
 * Contact form handling.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_contact_redirect( $status ) {
	$referer = wp_get_referer();
	$url     = $referer ? $referer : home_url( '/contact/' );

	wp_safe_redirect( add_query_arg( 'contact_status', rawurlencode( $status ), $url ) );
	exit;
}

function azure_synthetics_handle_contact_form() {
	if ( empty( $_POST['azure_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['azure_contact_nonce'] ) ), 'azure_synthetics_contact' ) ) {
		wp_die(
			esc_html__( 'The contact form expired. Go back and try again.', 'azure-synthetics' ),
			esc_html__( 'Contact form expired', 'azure-synthetics' ),
			array( 'response' => 400 )
		);
	}

	$honeypot = isset( $_POST['website'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['website'] ) ) ) : '';

	if ( $honeypot ) {
		azure_synthetics_contact_redirect( 'sent' );
	}

	$name         = isset( $_POST['contact_name'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) ) : '';
	$email        = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
	$organization = isset( $_POST['organization'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['organization'] ) ) ) : '';
	$topic        = isset( $_POST['topic'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['topic'] ) ) ) : '';
	$order        = isset( $_POST['order_reference'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['order_reference'] ) ) ) : '';
	$message      = isset( $_POST['message'] ) ? trim( sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) ) : '';
	$acknowledged = ! empty( $_POST['research_acknowledgment'] );

	if ( ! $name || ! is_email( $email ) || ! $topic || ! $message || ! $acknowledged ) {
		azure_synthetics_contact_redirect( 'missing' );
	}

	$contact = function_exists( 'azure_synthetics_get_contact_details' ) ? azure_synthetics_get_contact_details() : array();
	$to      = ! empty( $contact['email'] ) ? $contact['email'] : get_option( 'admin_email' );
	$subject = sprintf( '[Azure Synthetics] %s request from %s', $topic, $name );
	$body    = implode(
		"\n\n",
		array_filter(
			array(
				'Name: ' . $name,
				'Email: ' . $email,
				$organization ? 'Organization: ' . $organization : '',
				$order ? 'Order/reference: ' . $order : '',
				'Topic: ' . $topic,
				'Research-use acknowledgment: yes',
				"Message:\n" . $message,
			)
		)
	);
	$headers = array( 'Reply-To: ' . sanitize_text_field( $name ) . ' <' . $email . '>' );

	$sent = wp_mail( $to, $subject, $body, $headers );

	azure_synthetics_contact_redirect( $sent ? 'sent' : 'error' );
}

add_action( 'admin_post_azure_synthetics_contact', 'azure_synthetics_handle_contact_form' );
add_action( 'admin_post_nopriv_azure_synthetics_contact', 'azure_synthetics_handle_contact_form' );
