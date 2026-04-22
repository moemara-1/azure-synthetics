<?php
/**
 * Site footer template.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact = azure_synthetics_get_contact_details();
?>
<footer class="azure-site-footer">
	<div class="azure-shell azure-site-footer__grid">
		<div class="azure-site-footer__brand">
			<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/azure-logo-transparent.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>">
			<div>
				<h2><?php bloginfo( 'name' ); ?></h2>
				<p><?php bloginfo( 'description' ); ?></p>
			</div>
		</div>
		<div class="azure-site-footer__nav">
			<h3><?php esc_html_e( 'Navigate', 'azure-synthetics' ); ?></h3>
			<?php
			azure_synthetics_render_navigation( 'footer', 'azure-footer-menu' );
			?>
		</div>
		<div class="azure-site-footer__contact">
			<h3><?php esc_html_e( 'Support desk', 'azure-synthetics' ); ?></h3>
			<p><?php echo esc_html( $contact['hours'] ); ?></p>
			<p><a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a></p>
			<p><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $contact['phone'] ) ); ?>"><?php echo esc_html( $contact['phone'] ); ?></a></p>
		</div>
	</div>
	<div class="azure-shell azure-site-footer__base">
		<p><?php echo esc_html( azure_synthetics_get_footer_disclaimer() ); ?></p>
		<p><?php esc_html_e( 'Designed for protocol-driven buyers and laboratory inventory teams.', 'azure-synthetics' ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
