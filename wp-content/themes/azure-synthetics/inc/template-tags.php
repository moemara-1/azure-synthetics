<?php
/**
 * Template helpers.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_asset_url( $path ) {
	return AZURE_SYNTHETICS_THEME_URI . '/assets/' . ltrim( $path, '/' );
}

function azure_synthetics_get_option_value( $key, $default = '' ) {
	if ( function_exists( 'azure_synthetics_get_option' ) ) {
		return azure_synthetics_get_option( $key, $default );
	}

	return $default;
}

function azure_synthetics_get_footer_disclaimer() {
	return azure_synthetics_get_option_value( 'footer_disclaimer', __( 'For research use only. Not for human consumption.', 'azure-synthetics' ) );
}

/**
 * Safe shop URL helper.
 *
 * @return string
 */
function azure_synthetics_shop_url() {
	return function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
}

/**
 * Safe account URL helper.
 *
 * @return string
 */
function azure_synthetics_account_url() {
	return function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : wp_login_url();
}

/**
 * Safe cart URL helper.
 *
 * @return string
 */
function azure_synthetics_cart_url() {
	return function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' );
}

/**
 * Safe cart count helper.
 *
 * @return int
 */
function azure_synthetics_cart_count() {
	return function_exists( 'WC' ) && WC()->cart ? (int) WC()->cart->get_cart_contents_count() : 0;
}

function azure_synthetics_page_url( $slug, $fallback ) {
	$page = get_page_by_path( $slug );

	return $page ? get_permalink( $page ) : home_url( $fallback );
}

function azure_synthetics_get_navigation_items( $location = 'primary' ) {
	$items = array(
		'home'    => array(
			'label' => __( 'Home', 'azure-synthetics' ),
			'url'   => home_url( '/' ),
		),
		'shop'    => array(
			'label' => __( 'Shop', 'azure-synthetics' ),
			'url'   => azure_synthetics_shop_url(),
		),
		'science' => array(
			'label' => __( 'Science', 'azure-synthetics' ),
			'url'   => azure_synthetics_page_url( 'science', '/science/' ),
		),
		'faq'     => array(
			'label' => __( 'FAQ', 'azure-synthetics' ),
			'url'   => azure_synthetics_page_url( 'faq', '/faq/' ),
		),
		'contact' => array(
			'label' => __( 'Contact', 'azure-synthetics' ),
			'url'   => azure_synthetics_page_url( 'contact', '/contact/' ),
		),
	);

	if ( 'footer' === $location ) {
		$items['bulk-orders'] = array(
			'label' => __( 'Bulk Orders', 'azure-synthetics' ),
			'url'   => azure_synthetics_page_url( 'bulk-orders', '/bulk-orders/' ),
		);
		$items['shipping-returns'] = array(
			'label' => __( 'Shipping and Returns', 'azure-synthetics' ),
			'url'   => azure_synthetics_page_url( 'shipping-returns', '/shipping-returns/' ),
		);
		$items['privacy-policy'] = array(
			'label' => __( 'Privacy Policy', 'azure-synthetics' ),
			'url'   => azure_synthetics_page_url( 'privacy-policy', '/privacy-policy/' ),
		);
		$items['terms-and-conditions'] = array(
			'label' => __( 'Terms and Conditions', 'azure-synthetics' ),
			'url'   => azure_synthetics_page_url( 'terms-and-conditions', '/terms-and-conditions/' ),
		);
		$items['research-use-policy'] = array(
			'label' => __( 'Research Use Policy', 'azure-synthetics' ),
			'url'   => azure_synthetics_page_url( 'research-use-policy', '/research-use-policy/' ),
		);
	}

	return $items;
}

function azure_synthetics_is_navigation_item_current( $key ) {
	if ( 'home' === $key ) {
		return is_front_page();
	}

	if ( 'shop' === $key ) {
		return function_exists( 'is_shop' ) && ( is_shop() || is_product_taxonomy() || is_singular( 'product' ) );
	}

	if ( 'research-use-policy' === $key ) {
		return is_page( 'research-use-policy' );
	}

	return is_page( $key );
}

function azure_synthetics_render_navigation( $location = 'primary', $class_name = 'azure-menu' ) {
	$items = azure_synthetics_get_navigation_items( $location );

	if ( ! $items ) {
		return;
	}
	?>
	<ul class="<?php echo esc_attr( $class_name ); ?>">
		<?php foreach ( $items as $key => $item ) : ?>
			<?php $is_current = azure_synthetics_is_navigation_item_current( $key ); ?>
			<li class="<?php echo esc_attr( $is_current ? 'current-menu-item' : '' ); ?>">
				<a href="<?php echo esc_url( $item['url'] ); ?>"<?php echo $is_current ? ' aria-current="page"' : ''; ?>>
					<?php echo esc_html( $item['label'] ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
}

function azure_synthetics_get_page_intro() {
	if ( is_search() ) {
		return array(
			'eyebrow'     => __( 'Search', 'azure-synthetics' ),
			'title'       => sprintf( __( 'Results for “%s”', 'azure-synthetics' ), get_search_query() ),
			'description' => __( 'Find products, compliance resources, and supporting research guidance across the storefront.', 'azure-synthetics' ),
		);
	}

	if ( is_404() ) {
		return array(
			'eyebrow'     => __( 'Lost in the catalog', 'azure-synthetics' ),
			'title'       => __( 'This route does not exist.', 'azure-synthetics' ),
			'description' => __( 'Use the catalog, FAQ, or compliance pages to get back on track.', 'azure-synthetics' ),
		);
	}

		if ( is_page_template( 'page-templates/template-faq.php' ) ) {
			return array(
				'eyebrow'     => __( 'Need a clearer path?', 'azure-synthetics' ),
				'title'       => __( 'Frequently asked questions', 'azure-synthetics' ),
				'description' => __( 'Documentation, handling, and account answers in one place.', 'azure-synthetics' ),
			);
		}

	if ( is_page_template( 'page-templates/template-science.php' ) ) {
			return array(
				'eyebrow'     => __( 'Science and documentation', 'azure-synthetics' ),
				'title'       => __( 'A research-use catalog needs proof before persuasion.', 'azure-synthetics' ),
				'description' => __( 'Lot integrity, release data, form factors, and handling notes for research-use purchasing.', 'azure-synthetics' ),
			);
		}

	if ( is_page_template( 'page-templates/template-contact.php' ) ) {
			return array(
				'eyebrow'     => __( 'Contact', 'azure-synthetics' ),
				'title'       => __( 'Talk to the support desk', 'azure-synthetics' ),
				'description' => __( 'Account help, documentation requests, shipping questions, and catalog assistance.', 'azure-synthetics' ),
			);
		}

	if ( is_page_template( 'page-templates/template-compliance.php' ) ) {
			return array(
				'eyebrow'     => __( 'Research use policy', 'azure-synthetics' ),
				'title'       => __( 'Compliance and handling', 'azure-synthetics' ),
				'description' => __( 'Research-use terms, storage notes, and product-positioning language in one place.', 'azure-synthetics' ),
			);
		}

	if ( is_singular( 'product' ) ) {
		global $product;

		return array(
			'eyebrow'     => __( 'Research catalog', 'azure-synthetics' ),
			'title'       => $product ? $product->get_name() : get_the_title(),
			'description' => function_exists( 'azure_synthetics_get_product_meta_value' ) && $product ? azure_synthetics_get_product_meta_value( $product->get_id(), 'subtitle', '' ) : '',
		);
	}

	return array(
		'eyebrow'     => __( 'Azure Synthetics', 'azure-synthetics' ),
		'title'       => get_the_title(),
		'description' => get_the_excerpt(),
	);
}

function azure_synthetics_render_section_heading( array $args ) {
	get_template_part( 'template-parts/components/section-heading', null, $args );
}
