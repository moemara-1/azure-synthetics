<?php
/**
 * Theme setup hooks.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function azure_synthetics_setup() {
	load_theme_textdomain( 'azure-synthetics', AZURE_SYNTHETICS_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width'         => 760,
			'single_image_width'            => 1100,
			'product_grid'                  => array(
				'default_rows'    => 8,
				'min_rows'        => 1,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 4,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'azure-synthetics' ),
			'footer'  => __( 'Footer Navigation', 'azure-synthetics' ),
		)
	);

	add_image_size( 'azure-product-card', 720, 720, true );
	add_image_size( 'azure-hero-visual', 840, 960, true );
}
add_action( 'after_setup_theme', 'azure_synthetics_setup' );

/**
 * Register widget areas.
 *
 * @return void
 */
function azure_synthetics_register_sidebars() {
	register_sidebar(
		array(
			'name'          => __( 'Shop Sidebar', 'azure-synthetics' ),
			'id'            => 'shop-sidebar',
			'description'   => __( 'Widgets for the product archive sidebar.', 'azure-synthetics' ),
			'before_widget' => '<section class="azure-sidebar-card widget %2$s" id="%1$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="azure-sidebar-card__title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'azure_synthetics_register_sidebars' );
