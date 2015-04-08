<?php
/**
 * Provides an options page for the theme.
 *
 * @since   1.0.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'admin_menu', function() {
	add_options_page(
		'StCatherine Settings',
		'StCatherine Settings',
		'manage_options',
		'stcath-settings',
		'_stcath_page_stcath_settings_output'
	);
});

function _stcath_page_stcath_settings_output() {

	// Include template
	include_once __DIR__ . '/views/html-stcath-settings.php';
}

// Register settings
add_action( 'admin_init', function() {

	register_setting( 'stcath-settings', '_stcath_phone' );
	register_setting( 'stcath-settings', '_stcath_fax' );
	register_setting( 'stcath-settings', '_stcath_email' );
	register_setting( 'stcath-settings', '_stcath_hours_office' );
	register_setting( 'stcath-settings', '_stcath_hours_condensed' );
	register_setting( 'stcath-settings', '_stcath_address' );
});