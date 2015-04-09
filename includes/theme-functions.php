<?php
/**
 * Front-end theme functions.
 *
 * @since 0.1.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

function stcath_page_header( $image = null, $html = false ) {

	if ( $image === null ) {
		if ( has_post_thumbnail() ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
			$image = $image[0];
		} else {
			$image = get_template_directory_uri() . '/assets/images/temp-background.jpg';
		}
	}

	global $stcath_page_header_image, $stcath_page_header_html;
	$stcath_page_header_image = $image;
	$stcath_page_header_html = $html;

	include_once get_template_directory() . '/partials/page-header.php';
}

function stcath_post_meta() {
	include get_template_directory() . '/partials/post-meta.php';
}

function stcath_count_widgets( $sidebar_id ) {

	// If loading from front page, consult $_wp_sidebars_widgets rather than options
	// to see if wp_convert_widget_settings() has made manipulations in memory.
	global $_wp_sidebars_widgets;
	if ( empty( $_wp_sidebars_widgets ) ) {
		$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
	}

	$sidebars_widgets_count = $_wp_sidebars_widgets;

	if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) {
		return 'small-12 medium-' . ( 12 / count( $sidebars_widgets_count[ $sidebar_id ] ) );
	}
}