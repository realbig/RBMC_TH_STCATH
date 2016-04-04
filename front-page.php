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

	<section class="home-features home-section">

		<div class="home-features-container row">
			<div class="columns small-12">

				<ul class="features small-block-grid-1 medium-block-grid-3">

					<?php foreach ( $features as $event ) : ?>

						<li class="feature">
							<h2 class="feature-title home-title">
								<?php echo get_the_title( $event->ID ); ?>
							</h2>

							<div class="feature-image">
								<?php
								if ( $page = get_post_meta( $event->ID, '_feature_link', true ) ) {
									echo '<a href="' . get_permalink( $page ) . '">';
								}

								echo get_the_post_thumbnail( $event->ID, 'large' );

								echo '<span class="feature-image-overlay"></span>';
								echo $page ? '</a>' : '';
								?>
							</div>

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

$events = tribe_get_events( array(
	'posts_per_page' => 4,
	'start_date' => current_time( 'Y-m-d' ),
) );

if ( ! empty( $events ) ) : ?>

	<section class="home-events home-section">

		<div class="row">
			<div class="columns small-12 medium-4">
				<div class="upcoming-event">

					<?php
					$event      = $events[0];
					$start_date = strtotime( tribe_get_event_meta( $event->ID, '_EventStartDate', true ) );
					$end_date   = strtotime( tribe_get_event_meta( $event->ID, '_EventEndDate', true ) );
					?>

					<div class="event-image">
						<a href="<?php echo get_permalink( $event->ID ); ?>">
							<?php echo wp_get_attachment_image( get_post_thumbnail_id( $event->ID ), 'full' ); ?>
							<div class="event-image-text">Next coming event</div>
							<div class="event-image-cover">
								<span class="icon-eye"></span>
							</div>
						</a>
					</div>

					<div class="event-countdown">
						<?php
						the_widget( 'TribeCountdownWidget', array(
							'title'        => '',
							'event_ID'     => $event->ID,
							'event_date'   => null,
							'show_seconds' => true,
							'complete'     => 'Happening Today',
						) );
						?>
					</div>

					<div class="event-meta">
						<h3 class="event-title">
							<?php echo get_the_title( $event->ID ); ?>
						</h3>

						<p class="event-time">
							<?php echo date( 'F jS, Y', $start_date ); ?> at <?php echo date( 'g:i a', $start_date ); ?>
						</p>

						<?php
						if ( tribe_get_address( $event->ID ) || tribe_get_city( $event->ID ) || tribe_get_state( $event->ID ) ) :
							?>
							<p class="event-location">
								<?php echo tribe_get_address( $event->ID ); ?>,
								<?php echo tribe_get_city( $event->ID ); ?>,
								<?php echo tribe_get_state( $event->ID ); ?>
							</p>
						<?php endif; ?>
					</div>

					<div class="event-actions">
						<a href="<?php echo get_permalink( $event->ID ); ?>" class="event-register button expand">
							View
						</a>
					</div>

				</div>
			</div>

			<div class="events-list columns small-12 medium-8">

				<h2 class="home-title">
					<a href="/events/">Upcoming Events</a>
					<a href="/events/" class="button tiny">View All</a>
				</h2>

				<ul class="events">

					<?php
					foreach ( $events as $event ) :

						// Skip first event because it's already highlighted in "next upcoming event"
						if ( $event === $events[0] ) {
							continue;
						}

						$start_date = strtotime( tribe_get_event_meta( $event->ID, '_EventStartDate', true ) );
						$end_date   = strtotime( tribe_get_event_meta( $event->ID, '_EventEndDate', true ) );
						?>

						<li class="event row expand">
							<div class="event-date columns small-3 medium-2">
							<span class="day">
								<?php echo date( 'd', $start_date ); ?>
							</span>

							<span class="month-year">
								<?php echo date( 'M, y', $start_date ); ?>
							</span>
							</div>

							<div class="event-content columns small-9 medium-7">
								<h3 class="event-title">
									<a href="<?php echo get_permalink( $event->ID ); ?>">
										<?php echo get_the_title( $event->ID ); ?>
									</a>
								</h3>

								<p class="event-time">
									<?php echo date( 'l, g:i a', $start_date ); ?>
									-
									<?php echo date( 'g:i a', $end_date ); ?>
								</p>

								<?php
								if ( tribe_get_address( $event->ID ) || tribe_get_city( $event->ID ) || tribe_get_state( $event->ID ) ) :
									?>
									<div class="event-location">
										<?php echo tribe_get_address( $event->ID ); ?>,
										<?php echo tribe_get_city( $event->ID ); ?>,
										<?php echo tribe_get_state( $event->ID ); ?>
									</div>
								<?php endif; ?>
							</div>

							<div class="event-actions columns small-12 medium-3">
								<a href="<?php echo get_permalink( $event->ID ); ?>" class="button show-for-medium-up">
									View
								</a>

								<a href="<?php echo get_permalink( $event->ID ); ?>" class="button expand hide-for-medium-up">
									View
								</a>
							</div>
						</li>

					<?php endforeach; ?>

				</ul>

			</div>
		</div>

	</section>

<?php
endif;

global $post;

$posts = get_posts( array(
	'numberposts' => 6,
) );

// Temporarily disabled
if ( FALSE && ! empty( $posts ) ) :
	?>
	<section class="home-blog home-section row">
		<div class="columns small-12">

			<h2 class="home-title">Community Information</h2>

			<div class="row expand">

				<?php
				$post = $posts[0];
				setup_postdata( $post );
				?>

				<article <?php post_class( array( 'from-the-pastor', 'columns', 'small-12', 'medium-4' ) ); ?>>

					<h3>From the Pastor</h3>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="post-thumbnail">
							<?php the_post_thumbnail( 'large' ); ?>
						</div>
					<?php endif; ?>

					<h4 class="post-title">
						<a href="<?php the_permalink(); ?>" class="color-invert">
							<?php the_title(); ?>
						</a>
					</h4>

					<?php stcath_post_meta(); ?>

					<div class="post-excerpt">
						<?php the_excerpt(); ?>
					</div>

					<a href="<?php the_permalink(); ?>">
						Continue reading
					</a>

				</article>

				<div class="columns small-12 medium-8">
					<ul class="small-block-grid-1 medium-block-grid-2">
						<?php
						$i = 0;
						foreach ( $posts as $post ) :
							$i ++;
							if ( $i === 1 ) {
								continue;
							}
							setup_postdata( $post );
							?>

							<li>
								<article <?php post_class(); ?>>

									<h4 class="post-title">
										<a href="<?php the_permalink(); ?>" class="color-invert">
											<?php the_title(); ?>
										</a>
									</h4>

									<?php stcath_post_meta(); ?>

									<div class="post-excerpt">
										<?php the_excerpt(); ?>
									</div>

									<a href="<?php the_permalink(); ?>">
										Continue reading
									</a>

								</article>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</section>
<?php
endif;

$gallery_items = get_posts( array(
	'post_type'   => 'gallery',
	'numberposts' => 5,
) );

if ( ! empty( $gallery_items ) ) :
	?>
	<section class="home-gallery home-section">
		<ul class="gallery-items small-block-grid-1 medium-block-grid-5">

			<?php
			foreach ( $gallery_items as $post ) :
				setup_postdata( $post );
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
				$image = $image[0];
				?>
				<li class="gallery-item">
					<a href="<?php echo $image; ?>" rel="lightbox">
						<?php the_post_thumbnail( 'medium-square' ); ?>
						<div class="gallery-item-cover"></div>
						<div class="gallery-item-icon icon-image"></div>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

		<div class="gallery-text">
			<span class="icon-images"></span><br/>
			Updates from our gallery
		</div>
	</section>
<?php
endif;
?>

	<section class="home-about home-section row">
		<div class="about-us columns small-12 medium-8">
			<?php dynamic_sidebar( 'home-about-us' ); ?>
		</div>

		<div class="newsletter-signup columns small-12 medium-4">
			<h3>
				News Subscription
			</h3>

			<?php dynamic_sidebar( 'home-newsletter' ); ?>

			<input type="text" placeholder="Enter your email"/>

			<input type="button" class="button" value="Subscribe"/>
		</div>
	</section>

<?php
get_footer();