<?php
/**
 * StCatherine Settings page HTML.
 *
 * @since   1.0.0
 * @package StCatherine
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

<div class="wrap">

	<h2>StCatherine Settings</h2>

	<form method="post" action="options.php">

		<?php settings_fields( 'stcath-settings' ); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="_stcath_phone">
						Phone
					</label>
				</th>
				<td>
					<input type="text" name="_stcath_phone" id="_stcath_phone"
					       value="<?php echo esc_attr( get_option('_stcath_phone') ); ?>" />

					<p class="description">
						<strong>Preferred Format:</strong> 555.555.5555
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_stcath_fax">
						Fax
					</label>
				</th>
				<td>
					<input type="text" name="_stcath_fax" id="_stcath_fax"
					       value="<?php echo esc_attr( get_option('_stcath_fax') ); ?>" />

					<p class="description">
						<strong>Preferred Format:</strong> 555.555.5555
					</p>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_stcath_email">
						Email
					</label>
				</th>
				<td>
					<input type="text" name="_stcath_email" id="_stcath_email"
					       value="<?php echo esc_attr( get_option('_stcath_email') ); ?>" />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_stcath_hours_condensed">
						Hours (condensed)
					</label>
				</th>
				<td>
					<input type="text" name="_stcath_hours_condensed" id="_stcath_hours_condensed"
					       style="max-width: 100%; width: 500px;"
					       value="<?php echo get_option('_stcath_hours_condensed'); ?>" />
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_stcath_hours_office">
						Office Hours
					</label>
				</th>
				<td>
					<div style="max-width: 100%; width:400px;">
						<?php
						wp_editor( get_option('_stcath_hours_office'), '_stcath_hours_office', array(
							'teeny' => true,
							'media_buttons' => false,
							'textarea_rows' => 6,
							'textarea_name' => '_stcath_hours_office',
						));
						?>
					</div>
				</td>
			</tr>

			<tr valign="top">
				<th scope="row">
					<label for="_stcath_address">
						Address
					</label>
				</th>
				<td>
					<div style="max-width: 100%; width:400px;">
						<?php
						wp_editor( get_option('_stcath_address'), '_stcath_address', array(
							'teeny' => true,
							'media_buttons' => false,
							'textarea_rows' => 6,
							'textarea_name' => '_stcath_address',
						));
						?>
					</div>
				</td>
			</tr>

		</table>

		<?php submit_button(); ?>

	</form>

</div>