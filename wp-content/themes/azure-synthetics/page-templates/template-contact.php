<?php
/**
 * Template Name: Contact
 *
 * @package AzureSynthetics
 */

get_header();
$contact        = azure_synthetics_get_contact_details();
$contact_status = isset( $_GET['contact_status'] ) ? sanitize_key( wp_unslash( $_GET['contact_status'] ) ) : '';
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
					<li><strong><?php esc_html_e( 'Phone', 'azure-synthetics' ); ?></strong><span><?php echo esc_html( $contact['phone'] ); ?></span></li>
					<li><strong><?php esc_html_e( 'Hours', 'azure-synthetics' ); ?></strong><span><?php echo esc_html( $contact['hours'] ); ?></span></li>
					<li><strong><?php esc_html_e( 'Response time', 'azure-synthetics' ); ?></strong><span><?php echo esc_html( $contact['response_time'] ); ?></span></li>
				</ul>
				<p class="azure-meta-line"><?php esc_html_e( 'For order help, documentation requests, storage questions, or repeat-buyer support.', 'azure-synthetics' ); ?></p>
			</div>
			<div class="azure-contact-card azure-contact-form-card">
				<p class="azure-kicker"><?php esc_html_e( 'Support request', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Send the details once, and route the request correctly.', 'azure-synthetics' ); ?></h2>
				<?php if ( 'sent' === $contact_status ) : ?>
					<div class="azure-form-notice azure-form-notice--success" role="status"><?php esc_html_e( 'Request sent. The support desk will reply by email.', 'azure-synthetics' ); ?></div>
				<?php elseif ( 'missing' === $contact_status ) : ?>
					<div class="azure-form-notice azure-form-notice--error" role="alert"><?php esc_html_e( 'Complete the required fields and confirm the research-use acknowledgment.', 'azure-synthetics' ); ?></div>
				<?php elseif ( 'error' === $contact_status ) : ?>
					<div class="azure-form-notice azure-form-notice--error" role="alert"><?php esc_html_e( 'The message could not be sent. Email the desk directly and include your request details.', 'azure-synthetics' ); ?></div>
				<?php endif; ?>
				<form class="azure-contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="azure_synthetics_contact">
					<?php wp_nonce_field( 'azure_synthetics_contact', 'azure_contact_nonce' ); ?>
					<label class="azure-honeypot">
						<span><?php esc_html_e( 'Website', 'azure-synthetics' ); ?></span>
						<input type="text" name="website" tabindex="-1" autocomplete="off">
					</label>
					<div class="azure-form-grid">
						<label>
							<span><?php esc_html_e( 'Name', 'azure-synthetics' ); ?></span>
							<input type="text" name="contact_name" autocomplete="name" required>
						</label>
						<label>
							<span><?php esc_html_e( 'Email', 'azure-synthetics' ); ?></span>
							<input type="email" name="contact_email" autocomplete="email" spellcheck="false" required>
						</label>
					</div>
					<div class="azure-form-grid">
						<label>
							<span><?php esc_html_e( 'Organization', 'azure-synthetics' ); ?></span>
							<input type="text" name="organization" autocomplete="organization">
						</label>
						<label>
							<span><?php esc_html_e( 'Topic', 'azure-synthetics' ); ?></span>
							<select name="topic" required>
								<option value=""><?php esc_html_e( 'Select a topic', 'azure-synthetics' ); ?></option>
								<option value="Documentation"><?php esc_html_e( 'Documentation', 'azure-synthetics' ); ?></option>
								<option value="Order support"><?php esc_html_e( 'Order support', 'azure-synthetics' ); ?></option>
								<option value="Storage and handling"><?php esc_html_e( 'Storage and handling', 'azure-synthetics' ); ?></option>
								<option value="Repeat buyer setup"><?php esc_html_e( 'Repeat buyer setup', 'azure-synthetics' ); ?></option>
							</select>
						</label>
					</div>
					<label>
						<span><?php esc_html_e( 'Order or batch reference', 'azure-synthetics' ); ?></span>
						<input type="text" name="order_reference" autocomplete="off" placeholder="<?php esc_attr_e( 'Optional order number or lot reference', 'azure-synthetics' ); ?>">
					</label>
					<label>
						<span><?php esc_html_e( 'Message', 'azure-synthetics' ); ?></span>
						<textarea name="message" rows="6" required placeholder="<?php esc_attr_e( 'Tell us what you need checked, sent, or clarified', 'azure-synthetics' ); ?>"></textarea>
					</label>
					<label class="azure-checkbox-row">
						<input type="checkbox" name="research_acknowledgment" value="1" required>
						<span><?php esc_html_e( 'I understand Azure Synthetics products are for lawful laboratory research use only, not for human or veterinary use.', 'azure-synthetics' ); ?></span>
					</label>
					<button class="azure-button" type="submit"><?php esc_html_e( 'Send Request', 'azure-synthetics' ); ?></button>
				</form>
			</div>
		</div>
	</section>
	<section class="azure-page-section">
		<div class="azure-shell azure-faq-guidance__cards">
			<?php foreach ( azure_synthetics_get_contact_request_topics() as $topic ) : ?>
				<article class="azure-card">
					<h3><?php echo esc_html( $topic['title'] ); ?></h3>
					<p><?php echo esc_html( $topic['description'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</section>
</main>
<?php
get_footer();
