<?php
/**
 * Template Name: Contact
 *
 * @package AzureSynthetics
 */

get_header();
$contact        = azure_synthetics_get_contact_details();
$contact_status = isset( $_GET['azure_contact_status'] ) ? sanitize_key( wp_unslash( $_GET['azure_contact_status'] ) ) : '';
$contact_error  = isset( $_GET['azure_contact_error'] ) ? sanitize_key( wp_unslash( $_GET['azure_contact_error'] ) ) : '';
$topics         = function_exists( 'azure_synthetics_contact_topics' )
	? azure_synthetics_contact_topics()
	: array(
		'order'    => __( 'Order support', 'azure-synthetics' ),
		'product'  => __( 'Product question', 'azure-synthetics' ),
		'coa'      => __( 'COA or lot documents', 'azure-synthetics' ),
		'bulk'     => __( 'Bulk or reorder pricing', 'azure-synthetics' ),
		'shipping' => __( 'Shipping review', 'azure-synthetics' ),
		'payment'  => __( 'Payment route', 'azure-synthetics' ),
		'other'    => __( 'Other', 'azure-synthetics' ),
	);
$contact_redirect = function_exists( 'azure_synthetics_preserve_language_url' ) ? azure_synthetics_preserve_language_url( get_permalink() ) : get_permalink();
?>
<main class="azure-page-shell azure-contact-page">
	<section class="azure-page-hero">
		<div class="azure-shell">
			<?php azure_synthetics_render_section_heading( azure_synthetics_get_page_intro() ); ?>
		</div>
	</section>
	<section class="azure-page-section">
		<div class="azure-shell azure-contact-grid">
			<div class="azure-contact-card">
				<h2><?php esc_html_e( 'Reach the team', 'azure-synthetics' ); ?></h2>
				<ul class="azure-detail-list">
					<li><strong><?php esc_html_e( 'Email', 'azure-synthetics' ); ?></strong><span><?php echo esc_html( $contact['email'] ); ?></span></li>
					<?php if ( ! empty( $contact['phone'] ) ) : ?>
						<li><strong><?php esc_html_e( 'Phone', 'azure-synthetics' ); ?></strong><span><?php echo esc_html( $contact['phone'] ); ?></span></li>
					<?php endif; ?>
					<li><strong><?php esc_html_e( 'Hours', 'azure-synthetics' ); ?></strong><span><?php echo esc_html( azure_synthetics_translate_string( $contact['hours'] ) ); ?></span></li>
				</ul>
			</div>
			<div class="azure-contact-card azure-prose">
				<h2><?php esc_html_e( 'Send a message', 'azure-synthetics' ); ?></h2>
				<p><?php esc_html_e( 'Ask about COA availability, a product, bulk pricing, payment route, or shipping review. The message is saved first, then emailed to the support desk.', 'azure-synthetics' ); ?></p>
				<?php if ( 'sent' === $contact_status ) : ?>
					<div class="azure-form-message azure-form-message--success" role="status">
						<?php esc_html_e( 'Message received. The support desk has your request.', 'azure-synthetics' ); ?>
					</div>
				<?php elseif ( 'error' === $contact_status ) : ?>
					<div class="azure-form-message azure-form-message--error" role="alert">
						<?php
						if ( 'rate' === $contact_error ) {
							esc_html_e( 'Please wait a moment before sending another message.', 'azure-synthetics' );
						} elseif ( 'fields' === $contact_error ) {
							esc_html_e( 'Please complete the required fields with a valid email address.', 'azure-synthetics' );
						} else {
							esc_html_e( 'The message could not be sent. Please check the fields and try again.', 'azure-synthetics' );
						}
						?>
					</div>
				<?php endif; ?>
				<form class="azure-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
					<input type="hidden" name="action" value="azure_contact_submit">
					<input type="hidden" name="azure_contact_redirect" value="<?php echo esc_url( $contact_redirect ); ?>">
					<?php wp_nonce_field( 'azure_contact_form', 'azure_contact_nonce' ); ?>
					<label class="azure-contact-form__field">
						<span><?php esc_html_e( 'Name', 'azure-synthetics' ); ?></span>
						<input type="text" name="azure_contact_name" autocomplete="name" required>
					</label>
					<label class="azure-contact-form__field">
						<span><?php esc_html_e( 'Email', 'azure-synthetics' ); ?></span>
						<input type="email" name="azure_contact_email" autocomplete="email" required>
					</label>
					<label class="azure-contact-form__field">
						<span><?php esc_html_e( 'Topic', 'azure-synthetics' ); ?></span>
						<select name="azure_contact_topic" required>
							<?php foreach ( $topics as $topic_key => $topic_label ) : ?>
								<option value="<?php echo esc_attr( $topic_key ); ?>"><?php echo esc_html( $topic_label ); ?></option>
							<?php endforeach; ?>
						</select>
					</label>
					<label class="azure-contact-form__field">
						<span><?php esc_html_e( 'Order or product reference', 'azure-synthetics' ); ?></span>
						<input type="text" name="azure_contact_reference" autocomplete="off" placeholder="<?php esc_attr_e( 'Optional', 'azure-synthetics' ); ?>">
					</label>
					<label class="azure-contact-form__field azure-contact-form__field--full">
						<span><?php esc_html_e( 'Message', 'azure-synthetics' ); ?></span>
						<textarea name="azure_contact_message" rows="6" required></textarea>
					</label>
					<label class="azure-contact-form__trap" aria-hidden="true" tabindex="-1">
						<span><?php esc_html_e( 'Company', 'azure-synthetics' ); ?></span>
						<input type="text" name="azure_contact_company" autocomplete="off" tabindex="-1">
					</label>
					<button class="azure-button" type="submit"><?php esc_html_e( 'Send message', 'azure-synthetics' ); ?></button>
				</form>
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
