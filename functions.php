<?php
/**
 * The theme's functions file that loads on EVERY page, used for uniform functionality.
 *
 * @since   0.1.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Make sure PHP version is correct
if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
	wp_die( 'ERROR in StCatherine theme: PHP version 5.3 or greater is required.' );
}

// Make sure no theme constants are already defined (realistically, there should be no conflicts)
if ( defined( 'THEME_VERSION' ) || defined( 'THEME_ID' ) || isset( $theme_fonts ) ) {
	wp_die( 'ERROR in StCatherine theme: There is a conflicting constant. Please either find the conflict or rename the constant.' );
}

/**
 * The theme's current version (make sure to keep this up to date!)
 */
define( 'THEME_VERSION', '1.1.3' );

/**
 * The theme's ID (used in handlers).
 */
define( 'THEME_ID', 'stcath' );

/**
 * Fonts for the theme. Must be hosted font (Google fonts for example).
 */
$theme_fonts = array(
	'Roboto' => 'http://fonts.googleapis.com/css?family=Roboto:400italic,700italic,700,400',
	'Volkhov' => 'http://fonts.googleapis.com/css?family=Volkhov:400italic',
	'Dancing Script' => 'http://fonts.googleapis.com/css?family=Dancing+Script',
);

/**
 * Setup theme properties and stuff.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function() {

	// Add theme support
	require_once __DIR__ . '/includes/theme-support.php';

	// Allow shortcodes in text widget
	add_filter('widget_text', 'do_shortcode');

	// Image sizes
	add_image_size( 'medium-square', 500, 500, true );
});

/**
 * Modifies the default excerpt length (default 55).
 *
 * @since 0.1.0
 */
add_filter( 'excerpt_length', function ( $length ) {
	return 20;
}, 999 );

/**
 * Register theme files.
 *
 * @since 0.1.0
 */
add_action( 'init', function () {

	global $theme_fonts;

	// Theme styles
	wp_register_style(
		THEME_ID,
		get_template_directory_uri() . '/style.css',
		null,
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
	);

	// Theme script
	wp_register_script(
		THEME_ID,
		get_template_directory_uri() . '/script.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

	// Admin script
	wp_register_script(
		THEME_ID . '-admin',
		get_template_directory_uri() . '/admin.js',
		array( 'jquery' ),
		defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
		true
	);

	// Theme fonts
	if ( ! empty( $theme_fonts ) ) {
		foreach ( $theme_fonts as $ID => $link ) {
			wp_register_style(
				THEME_ID . "-font-$ID",
				$link
			);
		}
	}
} );

/**
 * Enqueue theme files.
 *
 * @since 0.1.0
 */
add_action( 'wp_enqueue_scripts', function () {

	global $theme_fonts;

	// Theme styles
	wp_enqueue_style( THEME_ID );

	// Theme script
	wp_enqueue_script( THEME_ID );

	// Theme fonts
	if ( ! empty( $theme_fonts ) ) {
		foreach ( $theme_fonts as $ID => $link ) {
			wp_enqueue_style( THEME_ID . "-font-$ID" );
		}
	}
} );

add_action( 'admin_enqueue_scripts', function () {

	wp_enqueue_script( THEME_ID . '-admin' );
});

/**
 * Register nav menus.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function () {

	register_nav_menu( 'primary', 'Primary Menu' );
	register_nav_menu( 'secondary', 'Secondary Menu' );
	register_nav_menu( 'footer', 'Footer Menu' );
	register_nav_menu( 'error-404', '404 Error Menu' );
} );

/**
 * Register sidebars.
 *
 * @since 0.1.0
 */
add_action( 'widgets_init', function () {

	// Footer
	register_sidebar( array(
		'name' => 'Footer',
		'id' => 'footer',
		'description' => 'Displays on all pages in the footer.',
		'before_widget'  => '<div id="%1$s" class="footer-widget %2$s columns '. stcath_count_widgets( 'footer' ) .'">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	// Home About Us
	register_sidebar( array(
		'name' => 'Home About Us',
		'id' => 'home-about-us',
		'description' => 'Displays on the home page.',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '',
		'after_widget' => '',
	));

	// Home Newsletter Signup
	register_sidebar( array(
		'name' => 'Home Newsletter Signup',
		'id' => 'home-newsletter',
		'description' => 'Displays on the home page.',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'before_widget' => '',
		'after_widget' => '',
	));
} );

require_once __DIR__ . '/includes/theme-functions.php';

// Include other static files
require_once __DIR__ . '/admin/admin.php';

// Widgets
require_once __DIR__ . '/includes/widgets/text-icon.php';
require_once __DIR__ . '/includes/widgets/image.php';

// Shortcodes
require_once __DIR__ . '/includes/shortcodes/social.php';
require_once __DIR__ . '/includes/shortcodes/button.php';
require_once __DIR__ . '/includes/shortcodes/contact.php';

// Template Overrides
require_once __DIR__ . '/the-events-calendar/default-template.php';