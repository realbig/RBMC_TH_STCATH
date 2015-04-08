<?php
/**
 * Gallery post type.
 *
 * @since   1.0.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'gallery', 'Gallery Item', 'Gallery Items', array(
		'menu_icon' => 'dashicons-format-gallery',
		'supports'  => array( 'title', 'thumbnail' ),
	) );
} );