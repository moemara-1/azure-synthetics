<?php
/**
 * Contact form submissions.
 *
 * @package AzureSyntheticsCore
 */

namespace AzureSynthetics\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Contact {
	const POST_TYPE = 'azure_contact';

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'admin_post_azure_contact_submit', array( $this, 'handle_submission' ) );
		add_action( 'admin_post_nopriv_azure_contact_submit', array( $this, 'handle_submission' ) );
		add_filter( 'manage_' . self::POST_TYPE . '_posts_columns', array( $this, 'columns' ) );
		add_action( 'manage_' . self::POST_TYPE . '_posts_custom_column', array( $this, 'column_content' ), 10, 2 );
	}

	/**
	 * Register the private submissions post type.
	 *
	 * @return void
	 */
	public function register_post_type() {
		register_post_type(
			self::POST_TYPE,
			array(
				'labels'              => array(
					'name'          => __( 'Contact submissions', 'azure-synthetics-core' ),
					'singular_name' => __( 'Contact submission', 'azure-synthetics-core' ),
					'menu_name'     => __( 'Contact submissions', 'azure-synthetics-core' ),
				),
				'public'              => false,
				'publicly_queryable'  => false,
				'exclude_from_search' => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_rest'        => false,
				'capability_type'     => 'post',
				'menu_icon'           => 'dashicons-email-alt2',
				'supports'            => array( 'title', 'editor' ),
			)
		);
	}

	/**
	 * Return allowed form topics.
	 *
	 * @return array<string, string>
	 */
	public static function topics() {
		return array(
			'order'    => __( 'Order support', 'azure-synthetics-core' ),
			'product'  => __( 'Product question', 'azure-synthetics-core' ),
			'coa'      => __( 'COA or lot documents', 'azure-synthetics-core' ),
			'bulk'     => __( 'Bulk or reorder pricing', 'azure-synthetics-core' ),
			'shipping' => __( 'Shipping review', 'azure-synthetics-core' ),
			'payment'  => __( 'Payment route', 'azure-synthetics-core' ),
			'other'    => __( 'Other', 'azure-synthetics-core' ),
		);
	}

	/**
	 * Handle a frontend contact submission.
	 *
	 * @return void
	 */
	public function handle_submission() {
		$redirect = isset( $_POST['azure_contact_redirect'] ) ? esc_url_raw( wp_unslash( $_POST['azure_contact_redirect'] ) ) : wp_get_referer();
		$redirect = $redirect ? $redirect : home_url( '/contact/' );
		$redirect = remove_query_arg( array( 'azure_contact_status', 'azure_contact_error' ), $redirect );

		if ( empty( $_POST['azure_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['azure_contact_nonce'] ) ), 'azure_contact_form' ) ) {
			$this->redirect( $redirect, 'error', 'security' );
		}

		$honeypot = isset( $_POST['azure_contact_company'] ) ? trim( (string) wp_unslash( $_POST['azure_contact_company'] ) ) : '';
		if ( '' !== $honeypot ) {
			$this->redirect( $redirect, 'sent', '' );
		}

		$name      = isset( $_POST['azure_contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['azure_contact_name'] ) ) : '';
		$email     = isset( $_POST['azure_contact_email'] ) ? sanitize_email( wp_unslash( $_POST['azure_contact_email'] ) ) : '';
		$topic     = isset( $_POST['azure_contact_topic'] ) ? sanitize_key( wp_unslash( $_POST['azure_contact_topic'] ) ) : '';
		$reference = isset( $_POST['azure_contact_reference'] ) ? sanitize_text_field( wp_unslash( $_POST['azure_contact_reference'] ) ) : '';
		$message   = isset( $_POST['azure_contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['azure_contact_message'] ) ) : '';
		$topics    = self::topics();

		if ( '' === $name || ! is_email( $email ) || '' === $message || ! isset( $topics[ $topic ] ) ) {
			$this->redirect( $redirect, 'error', 'fields' );
		}

		if ( $this->is_rate_limited( $email ) ) {
			$this->redirect( $redirect, 'error', 'rate' );
		}

		$submission_id = wp_insert_post(
			array(
				'post_type'    => self::POST_TYPE,
				'post_status'  => 'publish',
				'post_title'   => sprintf(
					/* translators: 1: contact name, 2: topic label. */
					__( '%1$s - %2$s', 'azure-synthetics-core' ),
					$name,
					wp_strip_all_tags( $topics[ $topic ] )
				),
				'post_content' => $message,
			),
			true
		);

		if ( is_wp_error( $submission_id ) ) {
			$this->redirect( $redirect, 'error', 'store' );
		}

		$meta = array(
			'_azure_contact_name'       => $name,
			'_azure_contact_email'      => $email,
			'_azure_contact_topic'      => $topic,
			'_azure_contact_reference'  => $reference,
			'_azure_contact_ip'         => $this->request_ip(),
			'_azure_contact_user_agent' => isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '',
		);

		foreach ( $meta as $key => $value ) {
			update_post_meta( (int) $submission_id, $key, $value );
		}

		$this->send_notification( (int) $submission_id, $name, $email, wp_strip_all_tags( $topics[ $topic ] ), $reference, $message );
		$this->mark_rate_limited( $email );
		$this->redirect( $redirect, 'sent', '' );
	}

	/**
	 * Return admin list columns.
	 *
	 * @param array<string, string> $columns Columns.
	 * @return array<string, string>
	 */
	public function columns( $columns ) {
		return array(
			'cb'        => $columns['cb'] ?? '',
			'title'     => __( 'Submission', 'azure-synthetics-core' ),
			'topic'     => __( 'Topic', 'azure-synthetics-core' ),
			'email'     => __( 'Email', 'azure-synthetics-core' ),
			'reference' => __( 'Reference', 'azure-synthetics-core' ),
			'date'      => $columns['date'] ?? __( 'Date', 'azure-synthetics-core' ),
		);
	}

	/**
	 * Render custom admin column content.
	 *
	 * @param string $column  Column name.
	 * @param int    $post_id Post ID.
	 * @return void
	 */
	public function column_content( $column, $post_id ) {
		if ( 'email' === $column ) {
			$email = get_post_meta( $post_id, '_azure_contact_email', true );
			echo $email ? '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>' : '&mdash;';
			return;
		}

		if ( 'reference' === $column ) {
			echo esc_html( get_post_meta( $post_id, '_azure_contact_reference', true ) ?: '—' );
			return;
		}

		if ( 'topic' === $column ) {
			$topic  = get_post_meta( $post_id, '_azure_contact_topic', true );
			$topics = self::topics();
			echo esc_html( $topics[ $topic ] ?? $topic ?: '—' );
		}
	}

	/**
	 * Send a notification email. The saved post remains the source of truth.
	 *
	 * @param int    $submission_id Submission post ID.
	 * @param string $name          Contact name.
	 * @param string $email         Contact email.
	 * @param string $topic         Topic label.
	 * @param string $reference     Optional reference.
	 * @param string $message       Message.
	 * @return void
	 */
	private function send_notification( $submission_id, $name, $email, $topic, $reference, $message ) {
		$recipient = apply_filters( 'azure_synthetics_contact_recipient', 'orders@azuresynthetics.com' );
		$subject   = sprintf( __( 'Azure contact form: %s', 'azure-synthetics-core' ), $topic );
		$body      = implode(
			"\n\n",
			array_filter(
				array(
					"Name: {$name}",
					"Email: {$email}",
					"Topic: {$topic}",
					$reference ? "Reference: {$reference}" : '',
					"Submission ID: {$submission_id}",
					"Message:\n{$message}",
				)
			)
		);
		$headers   = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

		wp_mail( $recipient, $subject, $body, $headers );
	}

	/**
	 * Redirect to the form with a short status code.
	 *
	 * @param string $redirect Base redirect URL.
	 * @param string $status   Status.
	 * @param string $error    Optional error.
	 * @return void
	 */
	private function redirect( $redirect, $status, $error ) {
		$args = array( 'azure_contact_status' => $status );

		if ( $error ) {
			$args['azure_contact_error'] = $error;
		}

		wp_safe_redirect( add_query_arg( $args, $redirect ) );
		exit;
	}

	/**
	 * Check if this visitor has submitted too recently.
	 *
	 * @param string $email Email.
	 * @return bool
	 */
	private function is_rate_limited( $email ) {
		return (bool) get_transient( $this->rate_key( $email ) );
	}

	/**
	 * Mark this visitor as recently submitted.
	 *
	 * @param string $email Email.
	 * @return void
	 */
	private function mark_rate_limited( $email ) {
		set_transient( $this->rate_key( $email ), 1, 2 * MINUTE_IN_SECONDS );
	}

	/**
	 * Build the rate-limit transient key.
	 *
	 * @param string $email Email.
	 * @return string
	 */
	private function rate_key( $email ) {
		return 'azure_contact_' . md5( strtolower( $email ) . '|' . $this->request_ip() );
	}

	/**
	 * Return a best-effort request IP.
	 *
	 * @return string
	 */
	private function request_ip() {
		foreach ( array( 'HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR' ) as $key ) {
			if ( empty( $_SERVER[ $key ] ) ) {
				continue;
			}

			$value = trim( explode( ',', sanitize_text_field( wp_unslash( $_SERVER[ $key ] ) ) )[0] );

			if ( filter_var( $value, FILTER_VALIDATE_IP ) ) {
				return $value;
			}
		}

		return '';
	}
}
