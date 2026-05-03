<?php
/**
 * Optimization footer.
 *
 * @package AzureSyntheticsOptimization
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact = azure_synthetics_get_contact_details();
$catalog = azure_opt_get_category_nav_items();
?>
<footer class="opt-footer">
	<div class="opt-container opt-footer__grid">
		<div>
			<a class="opt-brand opt-brand--footer" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( azure_synthetics_asset_url( 'images/azure-logo-transparent.png' ) ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				<span>
					<strong><?php bloginfo( 'name' ); ?></strong>
					<em><?php esc_html_e( 'Premium research peptides', 'azure-synthetics' ); ?></em>
				</span>
			</a>
			<p class="opt-footer__tag"><?php esc_html_e( 'Premium research peptides', 'azure-synthetics' ); ?></p>
		</div>
		<div class="opt-footer__col">
			<h2><?php esc_html_e( 'Catalog', 'azure-synthetics' ); ?></h2>
			<?php foreach ( $catalog as $item ) : ?>
				<a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a>
			<?php endforeach; ?>
		</div>
		<div class="opt-footer__col">
			<h2><?php esc_html_e( 'Tools', 'azure-synthetics' ); ?></h2>
			<a href="<?php echo esc_url( home_url( '/calculator/' ) ); ?>"><?php esc_html_e( 'Reconstitution', 'azure-synthetics' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><?php esc_html_e( 'FAQ', 'azure-synthetics' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'azure-synthetics' ); ?></a>
			<a href="<?php echo esc_url( azure_synthetics_shop_url() ); ?>"><?php esc_html_e( 'Full catalog', 'azure-synthetics' ); ?></a>
		</div>
		<div class="opt-footer__col">
			<h2><?php esc_html_e( 'Contact', 'azure-synthetics' ); ?></h2>
			<a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>" data-optimization-copy="<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a>
			<a href="<?php echo esc_url( home_url( '/bulk-orders/' ) ); ?>"><?php esc_html_e( 'Wholesale', 'azure-synthetics' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Certificates', 'azure-synthetics' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/research-use-policy/' ) ); ?>"><?php esc_html_e( 'Policy', 'azure-synthetics' ); ?></a>
		</div>
	</div>
	<div class="opt-container opt-footer__base">
		<p><?php esc_html_e( 'Premium catalog.', 'azure-synthetics' ); ?></p>
		<p><?php esc_html_e( 'Certificate support available.', 'azure-synthetics' ); ?></p>
	</div>
	<div class="opt-footer__mark" aria-hidden="true">AZURE</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
