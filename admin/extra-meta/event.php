<?php
/**
 * Event extra meta.
 *
 * @since   1.0.0
 * @package DZoo
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'add_meta_boxes', 'stcath_add_metaboxes_event' );
add_action( 'save_post', 'stcath_save_metaboxes_event' );
add_action( 'wp_ajax_stcath_get_form_fields', 'stcath_ajax_get_form_fields' );

function stcath_add_metaboxes_event() {

	global $post;

	if ( get_post_type( $post ) !== 'tribe_events' ) {
		return;
	}

	add_meta_box(
		'stcath-event-signup',
		'Event Signup',
		'stcath_mb_event_signup',
		'tribe_events',
		'side'
	);
}

function stcath_mb_event_signup() {

	wp_nonce_field( 'stcath_event_mb_save', 'stcath_event_mb' );

	$forms = GFAPI::get_forms();

	if ( ! $forms ) : ?>
		<p class="description">
			No Gravity Forms created yet.
		</p>
		<?php return;
	endif;

	$signup_form        = get_post_meta( get_the_ID(), 'stcath_event_signup_form', true );
	$signup_form_fields = get_post_meta( get_the_ID(), 'stcath_event_signup_form_fields', true );

	if ( $signup_form ) {
		$form_IDs          = wp_list_pluck( $forms, 'id' );
		$signup_form_index = array_search( $signup_form, $form_IDs );
	}
	?>
	<p>
		<label for="stcath_event_signup_form"><strong>Form</strong></label><br/>
		<select name="stcath_event_signup_form" id="stcath_event_signup_form">
			<option value="0">- No Signup Form -</option>
			<?php foreach ( $forms as $form ) : ?>
				<option value="<?php echo $form['id']; ?>" <?php selected( $form['id'], $signup_form ); ?>>
					<?php echo $form['title']; ?>
				</option>
			<?php endforeach; ?>
		</select>
	</p>

	<div id="stcath_event_signup_form_fields">
		<strong>Fields</strong>

		<div class="stcath_event_signup_form_fields_field dummy" style="display: none;">
			<input type="checkbox" name="stcath_event_signup_form_fields[]"/>
			<label></label><br/>
		</div>
		<?php if ( $signup_form &&
		           isset( $signup_form_index ) &&
		           isset( $forms[ $signup_form_index ] ) &&
		           isset( $forms[ $signup_form_index ]['fields'] )
		) : ?>
			<?php foreach ( $forms[ $signup_form_index ]['fields'] as $field ) : ?>
				<?php
				if ( $field->type == 'hidden' ) {
					continue;
				}
				?>
				<div class="stcath_event_signup_form_fields_field">
					<input type="checkbox" name="stcath_event_signup_form_fields[]"
					       id="stcath_event_signup_form_fields_<?php echo $field->id; ?>"
					       value="<?php echo $field->id; ?>"
						<?php echo in_array( $field->id, $signup_form_fields ) ? 'checked' : ''; ?> />
					<label for="stcath_event_signup_form_fields_<?php echo $field->id; ?>">
						<?php echo $field->label; ?>
					</label><br/>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<?php
}

function stcath_save_metaboxes_event( $post_ID ) {

	if ( ! isset( $_POST['stcath_event_mb'] ) ||
	     ! wp_verify_nonce( $_POST['stcath_event_mb'], 'stcath_event_mb_save' ) ||
	     ! current_user_can( 'edit_posts' )
	) {
		return;
	}

	foreach (
		array(
			'stcath_event_signup_form',
			'stcath_event_signup_form_fields',
		) as $field
	) {

		if ( ! isset( $_POST[ $field ] ) ) {
			delete_post_meta( $post_ID, $field );
		} else {
			update_post_meta( $post_ID, $field, $_POST[ $field ] );
		}
	}
}

function stcath_ajax_get_form_fields() {

	$form_ID = isset( $_POST['form_id'] ) ? $_POST['form_id'] : false;

	if ( ! $form_ID ) {
		wp_send_json_error( array(
			'error' => 'Cannot get form ID',
		) );
	}

	if ( ! ( $form = GFAPI::get_Form( $form_ID ) ) ) {
		wp_send_json_error( array(
			'error' => 'Cannot get form',
		) );
	}

	$fields = array();
	foreach ( $form['fields'] as $field ) {

		if ( $field->type == 'hidden' ) {
			continue;
		}

		$fields[ $field->id ] = $field->label;
	}

	wp_send_json_success( array(
		'fields' => $fields,
	) );
}