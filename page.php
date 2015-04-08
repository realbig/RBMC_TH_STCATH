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

stcath_page_header(
	has_post_thumbnail() ? wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0] : get_template_directory_uri() . '/assets/images/temp-background.jpg'
);
?>

	<article id="page-<?php the_id(); ?>" <?php post_class( array( 'page-content', 'row' ) ); ?>>

		<div class="columns small-12">

			<div class="page-content">
				<?php the_content(); ?>
			</div>

		</div>

	</article>

<?php
get_footer();