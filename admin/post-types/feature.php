<?php
/**
 * Feature post type.
 *
 * @since   1.0.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'feature', 'Feature', 'Features', array(
		'menu_icon' => 'dashicons-star-filled',
		'supports'  => array( 'title', 'editor', 'thumbnail' ),
	) );
} );