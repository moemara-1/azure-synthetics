<?php
/**
 * Template Name: Contact
 *
 * @package AzureSyntheticsOptimization
 */

get_header();

$contact        = azure_synthetics_get_contact_details();
$contact_status = isset( $_GET['contact_status'] ) ? sanitize_key( wp_unslash( $_GET['contact_status'] ) ) : '';
?>
<main class="opt-main opt-page-shell opt-contact-page">
	<section class="opt-page-hero">
		<div class="opt-container opt-page-hero__grid">
			<div>
				<p class="opt-section-kicker"><?php esc_html_e( 'Contact', 'azure-synthetics' ); ?></p>
				<h1 class="opt-display"><?php esc_html_e( 'Contact Azure', 'azure-synthetics' ); ?></h1>
				<p><?php esc_html_e( 'Certificate requests, wholesale setup, storage questions, order support, and repeat-buyer help.', 'azure-synthetics' ); ?></p>
			</div>
			<div class="opt-specimen-panel">
				<div class="opt-panel-head">
					<span class="opt-label"><?php esc_html_e( 'Desk status', 'azure-synthetics' ); ?></span>
					<span class="opt-live"><i></i><?php esc_html_e( 'Open', 'azure-synthetics' ); ?></span>
				</div>
				<dl class="opt-specimen-table">
					<div><dt><?php esc_html_e( 'Email', 'azure-synthetics' ); ?></dt><dd><?php echo esc_html( $contact['email'] ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Phone', 'azure-synthetics' ); ?></dt><dd><?php echo esc_html( $contact['phone'] ); ?></dd></div>
					<div><dt><?php esc_html_e( 'Hours', 'azure-synthetics' ); ?></dt><dd><?php echo esc_html( $contact['hours'] ); ?></dd></div>
				</dl>
			</div>
		</div>
	</section>
	<section class="opt-section">
		<div class="opt-container opt-contact-grid">
			<div class="opt-card-grid opt-reveal-stagger">
				<?php foreach ( azure_opt_get_contact_request_topics() as $topic ) : ?>
					<article class="opt-glass-card">
						<h2><?php echo esc_html( $topic['title'] ); ?></h2>
						<p><?php echo esc_html( $topic['description'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
			<div class="opt-form-card opt-reveal">
				<p class="opt-section-kicker"><?php esc_html_e( 'Support request', 'azure-synthetics' ); ?></p>
				<h2><?php esc_html_e( 'Send the details once', 'azure-synthetics' ); ?></h2>
				<?php if ( 'sent' === $contact_status ) : ?>
					<div class="opt-form-notice opt-form-notice--success" role="status"><?php esc_html_e( 'Request sent. The support desk will reply by email.', 'azure-synthetics' ); ?></div>
				<?php elseif ( 'missing' === $contact_status ) : ?>
					<div class="opt-form-notice opt-form-notice--error" role="alert"><?php esc_html_e( 'Complete the required fields and confirm the research-use acknowledgment.', 'azure-synthetics' ); ?></div>
				<?php elseif ( 'error' === $contact_status ) : ?>
					<div class="opt-form-notice opt-form-notice--error" role="alert"><?php esc_html_e( 'The message could not be sent. Email the desk directly and include your request details.', 'azure-synthetics' ); ?></div>
				<?php endif; ?>
				<form class="opt-contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
					<input type="hidden" name="action" value="azure_synthetics_contact">
					<?php wp_nonce_field( 'azure_synthetics_contact', 'azure_contact_nonce' ); ?>
					<label class="opt-honeypot">
						<span><?php esc_html_e( 'Website', 'azure-synthetics' ); ?></span>
						<input type="text" name="website" tabindex="-1" autocomplete="off">
					</label>
					<div class="opt-form-grid">
						<label><span><?php esc_html_e( 'Name', 'azure-synthetics' ); ?></span><input type="text" name="contact_name" autocomplete="name" required></label>
						<label><span><?php esc_html_e( 'Email', 'azure-synthetics' ); ?></span><input type="email" name="contact_email" autocomplete="email" spellcheck="false" required></label>
					</div>
					<div class="opt-form-grid">
						<label><span><?php esc_html_e( 'Organization', 'azure-synthetics' ); ?></span><input type="text" name="organization" autocomplete="organization"></label>
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
					<label><span><?php esc_html_e( 'Order or batch reference', 'azure-synthetics' ); ?></span><input type="text" name="order_reference" autocomplete="off"></label>
					<label><span><?php esc_html_e( 'Message', 'azure-synthetics' ); ?></span><textarea name="message" rows="6" required></textarea></label>
					<label class="opt-checkbox-row"><input type="checkbox" name="research_acknowledgment" value="1" required><span><?php esc_html_e( 'I understand Azure Synthetics products are research-use-only materials and that support does not provide personal-use, preparation, treatment, or outcome guidance.', 'azure-synthetics' ); ?></span></label>
					<button class="opt-button opt-button--primary" type="submit"><?php esc_html_e( 'Send Request', 'azure-synthetics' ); ?><?php azure_opt_render_arrow_icon(); ?></button>
				</form>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
