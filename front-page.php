<?php
/**
 * The theme's front-page file use for displaying the home page.
 *
 * @since   0.1.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

get_header();

// Construct slides
$slides = get_posts( array(
	'post_type'   => 'slide',
	'numberposts' => - 1,
) );

if ( ! empty( $posts ) ) {

	$slides_html = '<div class="home-slides">';
	$slides_html .= '<ul class="slides">';

	$i = 0;
	foreach ( $slides as $slide ) {
		$i ++;

		$image      = wp_get_attachment_image_src( get_post_thumbnail_id( $slide->ID ), 'full' );
		$title      = get_the_title( $slide );
		$content    = wpautop( $slide->post_content );
		$visibility = $i !== 1 ? 'hidden' : '';

		$slides_html .= "<li class=\"slide $visibility\" style=\"background-image: url('$image[0]');\">";

		$slides_html .= '<div class="slide-content row">';
		$slides_html .= '<div class="slide-content-container columns small-12 medium-6 medium-push-6">';
		$slides_html .= "<h1 class=\"slide-title\">$title</h1>";
		$slides_html .= "<div class=\"slide-copy\">$content</div>";
		$slides_html .= '</div>'; // .slide-content-container
		$slides_html .= '</div>'; // .slide-content

		$slides_html .= '</li>';
	}

	$slides_html .= '</ul>';
	$slides_html .= '</div>'; // .home-slides
}

stcath_page_header( '', $slides_html );

$features = get_posts( array(
	'post_type'   => 'feature',
	'numberposts' => 3,
) );

if ( ! empty( $features ) ) : ?>

	<section class="home-features">

		<div class="home-features-container row">
			<div class="columns small-12">

				<ul class="features small-block-grid-3">

					<?php foreach ( $features as $event ) : ?>

						<li class="feature">
							<h2 class="feature-title">
								<?php echo get_the_title( $event->ID ); ?>
							</h2>

							<?php echo get_the_post_thumbnail( $event->ID, 'large' ); ?>

							<div class="feature-copy">
								<?php echo apply_filters( 'the_content', $event->post_content ); ?>
							</div>
						</li>

					<?php endforeach; ?>

				</ul>

			</div>
		</div>

	</section>

<?php endif;

$events = get_posts( array(
	'post_type'   => 'tribe_events',
	'numberposts' => 3,
) );

if ( ! empty( $events ) ) : ?>

	<section class="home-events row">

		<div class="columns small-12 medium-4">

		</div>

		<div class="columns small-12 medium-8">

			<h2>Upcoming Events</h2>

			<ul class="events small-block-grid-3">

				<?php
				foreach ( $events as $event ) :
					$start_date = strtotime( tribe_get_event_meta( $event->ID, '_EventStartDate', true ) );
					$end_date   = strtotime( tribe_get_event_meta( $event->ID, '_EventEndDate', true ) );
					?>

					<li class="event row">
						<div class="event-date columns small-2">
							<?php echo date( 'd', $start_date ); ?>
							<?php echo date( 'M, y', $start_date ); ?>
						</div>

						<div class="event-content columns small-8">
							<h3 class="event-date">
								<?php echo get_the_title( $event->ID ); ?>
							</h3>

							<p class="event-time">
								<?php echo date( 'l, g:i a', $start_date ); ?>
								-
								<?php echo date( 'g:i a', $end_date ); ?>
							</p>

							<div class="event-location">
								<?php echo tribe_get_address( $event->ID ); ?>,
								<?php echo tribe_get_city( $event->ID ); ?>,
								<?php echo tribe_get_state( $event->ID ); ?>
							</div>
						</div>

						<div class="event-actions columns small-12">
							<a href="#" class="button">
								Register
							</a>
						</div>
					</li>

				<?php endforeach; ?>

			</ul>

		</div>

	</section>

<?php endif;

get_footer();