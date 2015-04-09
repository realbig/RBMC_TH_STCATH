<?php
/**
 * The theme's page file use for displaying pages.
 *
 * @since   0.1.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

the_post();

stcath_page_header();
?>

	<article id="page-<?php the_id(); ?>" <?php post_class( array( 'page-content', 'row' ) ); ?>>

		<div class="columns small-12">

			<div class="page-copy">
				<?php the_content(); ?>
			</div>

		</div>

	</article>

<?php
get_footer();