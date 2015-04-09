<?php
/**
 * The theme's single file use for displaying single posts.
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

	<article id="post-<?php the_id(); ?>" <?php post_class( array( 'post-content', 'row' ) ); ?>>

		<div class="columns small-12">

			<div class="post-copy">
				<?php the_content(); ?>
			</div>

		</div>

	</article>

	<section class="post-comments row">
		<div class="columns small-12">
			<?php comments_template(); ?>
		</div>
	</section>

<?php
get_footer();