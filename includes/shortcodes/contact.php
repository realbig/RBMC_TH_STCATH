<?php
/**
 * Shortcodes: Phone, Email, Address.
 *
 * Displays company phone number.
 *
 * @since   1.0.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
add_action( 'init', function () {

	add_shortcode( 'phone', '_stcath_sc_phone' );
	add_shortcode( 'email', '_stcath_sc_email' );
	add_shortcode( 'address', '_stcath_sc_address' );
} );

function _stcath_sc_phone() {

	$phone = get_option( '_stcath_phone', '' );
	return wp_is_mobile() ? "<a href=\"tel:$phone\">$phone</a>" : $phone;
}

function _stcath_sc_email() {

	$email = get_option( '_stcath_email', '' );
	return "<a href=\"mailto:$email\">$email</a>";
}

function _stcath_sc_address() {

	$address = get_option( '_stcath_address', '' );
	return wpautop( do_shortcode( $address ) );
}