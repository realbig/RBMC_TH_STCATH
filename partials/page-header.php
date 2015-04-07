<?php
/**
 * Page header.
 *
 * @since   0.1.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

global $stcath_page_header_image, $stcath_page_header_html;
?>

<section id="page-header" style="background-image: url('<?php echo $stcath_page_header_image; ?>')">

	<?php if ( $stcath_page_header_html ) :

		echo $stcath_page_header_html;

	else: ?>

		<h1 class="page-title">
			<?php the_title(); ?>
		</h1>

	<?php endif; ?>

	<?php if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) : ?>
		<div class="page-breadcrumbs">

			<div class="row">
				<?php yoast_breadcrumb( '<div class="columns small-12">', '</div>' ); ?>
			</div>
		</div>
	<?php endif; ?>

</section>