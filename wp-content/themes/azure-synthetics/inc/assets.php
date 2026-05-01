<?php
/**
 * Asset registration and enqueueing.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_fonts_url() {
	return add_query_arg(
		array(
			'family'  => 'Geist:wght@400;500;600;700;800|Geist Mono:wght@400;500;600;700|Funnel Sans:wght@400;500;600;700;800|Noto Sans Arabic:wght@400;500;600;700;800',
			'display' => 'swap',
		),
		'https://fonts.googleapis.com/css'
	);
}

function azure_synthetics_output_favicons() {
	$favicon_url = azure_synthetics_asset_url( 'images/azure-logo-transparent.png' );

	if ( ! $favicon_url ) {
		return;
	}
	?>
	<link rel="icon" type="image/png" href="<?php echo esc_url( $favicon_url ); ?>">
	<link rel="apple-touch-icon" href="<?php echo esc_url( $favicon_url ); ?>">
	<?php
}
add_action( 'wp_head', 'azure_synthetics_output_favicons', 5 );

function azure_synthetics_enqueue_assets() {
	wp_enqueue_style( 'azure-synthetics-fonts', azure_synthetics_fonts_url(), array(), null );

	$styles = array(
		'tokens',
		'base',
		'layout',
		'components',
		'woocommerce',
		'woocommerce-blocks',
		'pages',
	);

	foreach ( $styles as $style ) {
		$path = AZURE_SYNTHETICS_THEME_DIR . '/assets/css/' . $style . '.css';
		wp_enqueue_style(
			'azure-synthetics-' . $style,
			AZURE_SYNTHETICS_THEME_URI . '/assets/css/' . $style . '.css',
			array(),
			file_exists( $path ) ? filemtime( $path ) : AZURE_SYNTHETICS_THEME_VERSION
		);
	}

	$scripts = array( 'navigation', 'faq', 'filters', 'compliance' );

	foreach ( $scripts as $script ) {
		$path = AZURE_SYNTHETICS_THEME_DIR . '/assets/js/' . $script . '.js';
		wp_enqueue_script(
			'azure-synthetics-' . $script,
			AZURE_SYNTHETICS_THEME_URI . '/assets/js/' . $script . '.js',
			array(),
			file_exists( $path ) ? filemtime( $path ) : AZURE_SYNTHETICS_THEME_VERSION,
			true
		);
	}

	wp_localize_script(
		'azure-synthetics-compliance',
		'azureSyntheticsCompliance',
		array(
			'catalogGateEnabled' => function_exists( 'azure_synthetics_get_option' ) ? (bool) azure_synthetics_get_option( 'catalog_gate_enabled', false ) : false,
			'disclaimer'         => function_exists( 'azure_synthetics_get_option' ) ? azure_synthetics_get_option( 'default_product_disclaimer', '' ) : '',
		)
	);
}
add_action( 'wp_enqueue_scripts', 'azure_synthetics_enqueue_assets' );
