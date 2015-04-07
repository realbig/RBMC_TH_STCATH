<?php
/**
 * The theme's page file use for displaying pages.
 *
 * @since 0.1.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();

stcath_page_header( get_template_directory_uri() . '/assets/images/temp-background.jpg' );
?>

<?php
get_footer();