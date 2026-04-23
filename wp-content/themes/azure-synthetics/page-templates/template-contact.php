<?php
/**
 * Template Name: Contact
 *
 * @package AzureSynthetics
 */

get_header();
$contact = azure_synthetics_get_contact_details();
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
			</div>
			<div class="azure-contact-card azure-prose">
				<?php
				while ( have_posts() ) :
					the_post();
					$content = trim( get_the_content() );

					if ( $content ) {
						the_content();
					} else {
						?>
						<p class="azure-kicker"><?php esc_html_e( 'What the desk handles', 'azure-synthetics' ); ?></p>
						<h2><?php esc_html_e( 'A real support path matters more than a placeholder form.', 'azure-synthetics' ); ?></h2>
						<p><?php esc_html_e( 'Use the support desk for documentation requests, handling questions, order follow-up, or conversations about repeat-buyer needs. The goal is a reliable response path, not a decorative contact page.', 'azure-synthetics' ); ?></p>
						<div class="azure-faq-guidance__cards">
							<?php foreach ( azure_synthetics_get_contact_request_topics() as $topic ) : ?>
								<article class="azure-card">
									<h3><?php echo esc_html( $topic['title'] ); ?></h3>
									<p><?php echo esc_html( $topic['description'] ); ?></p>
								</article>
							<?php endforeach; ?>
						</div>
						<?php
					}
				endwhile;
				?>
			</div>
		</div>
	</section>
</main>
<?php
get_footer();
