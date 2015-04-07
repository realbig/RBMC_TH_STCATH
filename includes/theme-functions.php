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

function stcath_page_header( $image, $html = false ) {

	global $stcath_page_header_image, $stcath_page_header_html;
	$stcath_page_header_image = $image;
	$stcath_page_header_html = $html;

	include_once get_template_directory() . '/partials/page-header.php';
}