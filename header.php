<?php
/**
 * The theme's header file that appears on EVERY page.
 *
 * @since   0.1.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/vendor/js/html5.js"></script>
    <![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

    <header id="site-header">

        <div class="row">

            <div class="site-title columns small-12 medium-3">
                <a href="<?php bloginfo( 'url' ); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/header-logo.jpg"/>
                    <span class="site-title-text">
						<?php bloginfo( 'title' ); ?>
					</span>
                </a>
            </div>

            <nav class="site-nav columns small-12 medium-9">

                <div class="site-nav-toggle">
                    <span class="open icon-menu"></span>
                    <span class="close icon-cross"></span>
                </div>

                <div class="site-nav-container <?php echo has_nav_menu( 'secondary' ) ? 'has-secondary-menu' : ''; ?>">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'secondary',
						'container'      => false,
						'fallback_cb'    => false,
					) );
					?>

					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
					) );
					?>
                </div>
            </nav>

        </div>

    </header>