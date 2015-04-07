<?php
/**
 * Slide post type.
 *
 * @since   1.0.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'slide', 'Slide', 'Slides', array(
		'menu_icon' => 'dashicons-images-alt2',
		'supports'  => array( 'title', 'editor', 'thumbnail' ),
	) );
} );