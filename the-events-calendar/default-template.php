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

// Add event signup
add_action( 'tribe_events_single_event_after_the_meta', 'stcath_eventtemplate_single_signup' );

// Page closing
add_filter( 'tribe_events_after_html', '_stcath_eventtemplate_single_after' );

// Remove featured image from page content
add_filter( 'tribe_event_featured_image', '__return_false' );

function _stcath_eventtemplate_single_before( $html ) {

	global $post;

	if ( ( get_post_type() == 'tribe_events' && tribe_is_upcoming() ) || tribe_is_month() || tribe_is_by_date() ) {
		$header_html = '<h1 class="page-title">Events</h1>';
	} else {
		$header_html = '<h1 class="page-title">' . get_the_title( $post->ID ) . '</h1>';
		$header_html .= tribe_events_event_schedule_details( $post->ID, '<div class="event-details">', '</div>' );
	}


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

function stcath_eventtemplate_single_signup() {

	if ( ! ( $form_ID = get_post_meta( get_the_ID(), 'stcath_event_signup_form', true ) ) ) {
		return;
	}
	?>
	<div class="tribe-events-single-section tribe-events-event-meta primary tribe-clearfix">
		<div class="tribe-events-meta-group" style="width: 100%;">
			<h3 class="tribe-events-single-section-title">Event Signup</h3>

			<?php
			add_filter( 'gform_field_content', 'stcath_eventtemplate_signup_form_hide_fields', 10, 2 );

			gravity_form( $form_ID, false, false, false, array(
				'event_id' => get_the_title(),
			) );

			remove_filter( 'gform_field_content', 'stcath_eventtemplate_signup_form_hide_fields', 10 );
			?>
		</div>
	</div>
	<?php
}

function _stcath_eventtemplate_single_after( $html ) {
	?>
	</div> <!-- .columns.small-12 -->
	</article> <!-- #event-{id}.page-content.row {etc} -->
	<?php

	return $html;
}

function stcath_eventtemplate_signup_form_hide_fields( $content, $field ) {

	$form_fields = get_post_meta( get_the_ID(), 'stcath_event_signup_form_fields', true );

	if ( $field->type == 'hidden' || in_array( $field->id, $form_fields ) ) {
		return $content;
	}
}