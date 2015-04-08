<?php
/**
 * Feature post type.
 *
 * @since   1.0.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'init', function () {
	easy_register_post_type( 'feature', 'Feature', 'Features', array(
		'menu_icon' => 'dashicons-star-filled',
		'supports'  => array( 'title', 'editor', 'thumbnail' ),
	) );
} );

add_action( 'add_meta_boxes', function () {

	add_meta_box(
		'stcath-feature-link',
		'Page Link',
		'_stcath_metabox_feature_link',
		'feature'
	);
} );

/**
 * The form callback for the feature page link.
 *
 * @since  1.0.0
 * @access Private.
 *
 * @param object $post The current post object.
 */
function _stcath_metabox_feature_link( $post ) {

	wp_nonce_field( __FILE__, 'feature_link_nonce' );

	$product_link = (int) get_post_meta( $post->ID, '_feature_link', true );
	?>
	<label>
		Select a page <br/>
		<?php wp_dropdown_pages( array(
			'selected' => $product_link ? $product_link : 0,
			'name' => '_feature_link',
		));
		?>
	</label>
<?php
}

add_action( 'save_post', function ( $post_ID ) {

	if ( ! isset( $_POST['feature_link_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['feature_link_nonce'], __FILE__ ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_page', $post_ID ) ) {
		return;
	}

	$options = array(
		'_feature_link',
	);

	foreach ( $options as $option ) {

		if ( ! isset( $_POST[ $option ] ) || empty( $_POST[ $option ] ) ) {
			delete_post_meta( $post_ID, $option );
		}

		update_post_meta( $post_ID, $option, $_POST[ $option ] );
	}
} );