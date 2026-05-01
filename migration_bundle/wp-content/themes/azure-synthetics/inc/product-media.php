<?php
/**
 * Product media fallbacks.
 *
 * @package AzureSynthetics
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return known product image fallbacks bundled with the theme.
 *
 * The migration imports WooCommerce attachment records, but Pantheon file uploads
 * can be empty until the uploads directory is migrated separately. These records
 * map the imported attachment filenames back to the theme product artwork.
 *
 * @return array<string,string>
 */
function azure_synthetics_product_image_fallbacks() {
	$fallbacks = array(
		'card-bpc157' => 'images/card-bpc157.png',
		'card-cjcipa' => 'images/card-cjcipa.png',
		'card-glp3'   => 'images/card-glp3.png',
		'card-motsc'  => 'images/card-motsc.png',
	);

	if ( function_exists( 'azure_synthetics_get_catalog_products' ) && function_exists( 'azure_synthetics_catalog_slug' ) && function_exists( 'azure_synthetics_catalog_image_filename' ) ) {
		foreach ( azure_synthetics_get_catalog_products() as $product ) {
			$fallbacks[ azure_synthetics_catalog_slug( $product['name'] ) ] = 'images/' . azure_synthetics_catalog_image_filename( $product );
		}
	}

	return $fallbacks;
}

/**
 * Normalize attachment filenames/post names to map keys.
 *
 * @param string $value Candidate filename, URL, or post slug.
 * @return string
 */
function azure_synthetics_normalize_media_key( $value ) {
	$value = strtolower( (string) $value );
	$value = basename( strtok( $value, '?' ) ?: $value );
	$value = preg_replace( '/\.[a-z0-9]+$/', '', $value );

	return is_string( $value ) ? $value : '';
}

/**
 * Resolve a fallback theme image for an imported WooCommerce attachment.
 *
 * @param int $attachment_id Attachment ID.
 * @return array{url:string,path:string,width:int,height:int}|null
 */
function azure_synthetics_get_product_image_fallback( $attachment_id ) {
	$attachment_id = absint( $attachment_id );

	if ( ! $attachment_id ) {
		return null;
	}

	$attachment = get_post( $attachment_id );

	if ( ! $attachment || 'attachment' !== $attachment->post_type ) {
		return null;
	}

	$candidates = array_filter(
		array(
			$attachment->post_name,
			get_post_meta( $attachment_id, '_wp_attached_file', true ),
			$attachment->guid,
		)
	);

	$fallbacks = azure_synthetics_product_image_fallbacks();

	foreach ( $candidates as $candidate ) {
		$key = azure_synthetics_normalize_media_key( $candidate );

		if ( ! isset( $fallbacks[ $key ] ) ) {
			continue;
		}

		$asset_path = $fallbacks[ $key ];
		$file_path  = AZURE_SYNTHETICS_THEME_DIR . '/assets/' . $asset_path;
		$width      = 1024;
		$height     = 1024;

		if ( file_exists( $file_path ) ) {
			$dimensions = function_exists( 'wp_getimagesize' ) ? wp_getimagesize( $file_path ) : getimagesize( $file_path );

			if ( is_array( $dimensions ) && ! empty( $dimensions[0] ) && ! empty( $dimensions[1] ) ) {
				$width  = (int) $dimensions[0];
				$height = (int) $dimensions[1];
			}
		}

		return array(
			'url'    => AZURE_SYNTHETICS_THEME_URI . '/assets/' . $asset_path,
			'path'   => $file_path,
			'width'  => $width,
			'height' => $height,
		);
	}

	return null;
}

function azure_synthetics_get_product_image_srcset( array $fallback ) {
	$source_key     = azure_synthetics_normalize_media_key( $fallback['path'] ?? $fallback['url'] ?? '' );
	$responsive_dir = AZURE_SYNTHETICS_THEME_DIR . '/assets/images/products/responsive/';
	$responsive_url = AZURE_SYNTHETICS_THEME_URI . '/assets/images/products/responsive/';
	$candidates     = array();

	foreach ( array( 480, 768 ) as $width ) {
		$file = $responsive_dir . $source_key . '-' . $width . '.jpg';

		if ( file_exists( $file ) ) {
			$candidates[] = esc_url_raw( $responsive_url . $source_key . '-' . $width . '.jpg' ) . ' ' . $width . 'w';
		}
	}

	if ( ! empty( $fallback['url'] ) && ! empty( $fallback['width'] ) ) {
		$candidates[] = esc_url_raw( $fallback['url'] ) . ' ' . absint( $fallback['width'] ) . 'w';
	}

	return implode( ', ', array_unique( $candidates ) );
}

/**
 * Use theme assets when imported attachment URLs point to missing uploads.
 *
 * @param string|false $url Attachment URL.
 * @param int          $attachment_id Attachment ID.
 * @return string|false
 */
function azure_synthetics_filter_product_attachment_url( $url, $attachment_id ) {
	$fallback = azure_synthetics_get_product_image_fallback( $attachment_id );

	return $fallback ? $fallback['url'] : $url;
}
add_filter( 'wp_get_attachment_url', 'azure_synthetics_filter_product_attachment_url', 10, 2 );

/**
 * Feed WooCommerce image helpers dimensions for theme fallback images.
 *
 * @param bool|array $downsize Existing downsize data.
 * @param int        $attachment_id Attachment ID.
 * @param string|int[] $size Requested size.
 * @return bool|array
 */
function azure_synthetics_filter_product_image_downsize( $downsize, $attachment_id, $size ) {
	$fallback = azure_synthetics_get_product_image_fallback( $attachment_id );

	if ( ! $fallback ) {
		return $downsize;
	}

	return array(
		$fallback['url'],
		$fallback['width'],
		$fallback['height'],
		false,
	);
}
add_filter( 'image_downsize', 'azure_synthetics_filter_product_image_downsize', 10, 3 );

/**
 * Prevent stale upload srcsets from leaking into product fallback images.
 *
 * @param array   $attr Attachment image attributes.
 * @param WP_Post $attachment Attachment post.
 * @return array
 */
function azure_synthetics_filter_product_image_attributes( $attr, $attachment ) {
	if ( ! $attachment instanceof WP_Post ) {
		return $attr;
	}

	$fallback = azure_synthetics_get_product_image_fallback( $attachment->ID );

	if ( ! $fallback ) {
		return $attr;
	}

	$attr['src']      = $fallback['url'];
	$attr['width']    = (string) $fallback['width'];
	$attr['height']   = (string) $fallback['height'];
	$attr['decoding'] = $attr['decoding'] ?? 'async';
	$attr['loading']  = $attr['loading'] ?? 'lazy';

	$srcset = azure_synthetics_get_product_image_srcset( $fallback );

	if ( $srcset ) {
		$attr['srcset'] = $srcset;
		$attr['sizes']  = '(max-width: 700px) 92vw, (max-width: 1100px) 45vw, 33vw';
	} else {
		unset( $attr['srcset'], $attr['sizes'] );
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'azure_synthetics_filter_product_image_attributes', 10, 2 );
