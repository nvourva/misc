<?php
/**
 * Add srcset and sizes attributes to attachments.
 *
 * @param int $attachment_id The attachment's id.
 * @return array The attachment's srcset and sizes attributes.
 */
function nv_add_slider_srcset_sizes( $attachment_id ) {
	$attr = [];
// You can either use all the intermediate sizes https://developer.wordpress.org/reference/functions/get_intermediate_image_sizes/
// or create an array with the image sizes you want WordPress to pull from.
//	$available_sizes = get_intermediate_image_sizes();
	$available_sizes = array(
		'post-thumbnail',
	);

	$sizes     = '(min-width: 1200px) 1010px, (min-width: 992px) 940px, (min-width: 768px) 720px, (min-width: 480px) 737px, 100vw';

	// Output can be filtered based on usage case.
	// $fullwidth = get_theme_mod( 'home_slider_fullwidth', 0 );
	// $carousel  = get_theme_mod( 'home_slider_fullwidth_carousel', 0 );

	// if ( $carousel ) {
	// 	$sizes = '(min-width: 1280px) 620px, (min-width: 992px) 1280px, (min-width: 768px) 720px, (min-width: 480px) 737px, 100vw';
	// } elseif ( $fullwidth ) {
	// 	$sizes = '100vw';
	// }

	$srcset = '';
	foreach ( $available_sizes as $size ) {
		$image   = wp_get_attachment_image_src( $attachment_id, $size );
		$srcset .= $image[0] . ' ' . $image[1] . 'w,';
	}

	$attr['srcset'] = $srcset;
	$attr['sizes']  = $sizes;
	return $attr;
}
