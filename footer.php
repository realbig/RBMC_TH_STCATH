<?php
/**
 * The theme's footer file that appears on EVERY page.
 *
 * @since 0.1.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<footer id="site-footer">

	<div class="footer-widgets row text-center">
		<?php dynamic_sidebar( 'footer' ); ?>
	</div>

	<div class="footer-copyright row small-only-text-center">
		<div class="columns small-12 medium-6">
			&copy <?php echo date( 'Y' ); ?> St. Catherine Laboure Parish / <a href="/about-this-site/">About This Site</a>
		</div>

		<div class="columns small-12 medium-6 medium-text-right">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container' => false,
			));
			?>
		</div>
	</div>

</footer>

<?php // #wrapper ?>
</div>

<?php wp_footer(); ?>

</body>
</html>