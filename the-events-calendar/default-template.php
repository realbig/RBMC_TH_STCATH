<?php
/**
 * Modifies the default event view for The Events Calendar.
 *
 * @since   0.1.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// Page opening
add_filter( 'tribe_events_before_html', '_stcath_eventtemplate_single_before' );

// Page closing
add_filter( 'tribe_events_after_html', '_stcath_eventtemplate_single_after' );

// Remove featured image from page content
add_filter( 'tribe_event_featured_image', '__return_false' );

function _stcath_eventtemplate_single_before( $html ) {

	global $post;

	$header_html = '<h1 class="page-title">' . get_the_title( $post->ID ) . '</h1>';
	$header_html .= tribe_events_event_schedule_details( $post->ID, '<div class="event-details">', '</div>' );

	stcath_page_header( null, $header_html );
	?>

	<article id="event-<?php the_id(); ?>" <?php post_class( array( 'page-content', 'row' ) ); ?>>
		<div class="columns small-12">
	<?php

	// Disable the details from showing up again
	add_filter( 'tribe_events_event_schedule_details', '__return_false' );

	// Unset the title so it isn't used later on in the page by the events template
	$post->post_title = null;

	return $html;
}


function _stcath_eventtemplate_single_after( $html ) {
	?>
	</div> <!-- .columns.small-12 -->
	</article> <!-- #event-{id}.page-content.row {etc} -->
	<?php

	return $html;
}