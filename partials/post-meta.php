<?php
/**
 * Post meta.
 *
 * @since   0.1.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<p class="post-meta">
	by <?php echo get_the_author(); ?> on <?php the_date(); ?> in <?php the_category( ', ' ); ?>
</p>