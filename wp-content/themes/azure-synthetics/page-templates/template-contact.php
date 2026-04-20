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
				</ul>
			</div>
			<div class="azure-contact-card azure-prose">
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
