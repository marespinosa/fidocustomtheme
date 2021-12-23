<?php
/**
 * The metabox panel generator this is used by all the separate metabox files to render each metabox
 *
 * @version 2.1
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// The Callback
function tri_meta_box_callback( $fields, $page ) {
	global $post;
	// Use nonce for verification
	echo '<input type="hidden" name="'. $page .'_meta_box_nonce" value="' . wp_create_nonce( basename(__FILE__) ) . '" />';

	// Begin the field table and loop
	echo '<table class="form-table tri-metabox">';
	foreach ( $fields as $field ) {
		// Set default fields
		$default = $placeholder = $desc = $class = '';

		// get value of this field if it exists for this post
		if ( isset( $field['label'] ) ) { $label = $field['label']; }
		if ( isset( $field['desc'] ) ) { $desc = '<span class="description tri-description">' . esc_html( $field['desc'] ) . '</span>'; }
		if ( isset( $field['id'] ) ) { $id = $field['id']; }
		if ( isset( $field['type'] ) ) { $type = $field['type']; }
		if ( isset( $field['value'] ) ) { $value = $field['value']; }
		if ( isset( $field['options'] ) ) { $options = $field['options']; }
		if ( isset( $field['placeholder'] ) ) { $placeholder = ' placeholder="' . esc_attr( $field['placeholder'] ) . '"'; }
		if ( isset( $field['class'] ) ) { $class = ' class="' . $field['class'] . '"'; }
		if ( isset( $field['default'] ) ) { $default = $field['default']; }
		$meta = get_post_meta( $post->ID, $id, true );
		// begin a table row with
		echo '<tr' . $class . '><th><label for="' . $id . '">' . $label . '</label></th><td>';
		switch( $field['type'] ) {

			// text
			case 'text':
				echo '<input type="text" style="width:100%;max-width:500px;" name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '" value="' . esc_attr( $meta ) . '" class="regular-text" size="30" /><br />' . $desc;
			break;

			// checkbox
			case 'checkbox':
			if ( empty( $meta ) && !empty( $field['default'] ) ) { $meta = $default; }
				echo '<input type="checkbox" name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '" ' . checked( $meta, true, false ) . ' value="1" /> <label for="' . esc_attr( $id ) . '">' . $desc . '</label>';
			break;

			// radio
			case 'radio':
				foreach ( $options as $option ) {
					echo '<input type="radio" name="' . esc_attr( $id ) . '" id="' . $option['value'] . '" value="' . $option['value'] . '" ' . checked( $meta, $option['value'], false ) . ' />
							<label for="' . $option['value'] . '">' . $option['label'] . '</label><br />';
				}
				echo $desc;
			break;

			// select
			case 'select':
				echo '<select name="' . esc_attr( $id ) . '" id="' . esc_attr( $id ) . '">';
					foreach ( $options as $option )
						echo '<option' . selected( $meta, $option['value'], false ) . ' value="' . $option['value'] . '">' . $option['label'] . '</option>';
					echo '</select><br />' . $desc;
			break;

		} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}

/**
 * outputs properly sanitized data
 *
 * @param	string	$string		the string to run through a validation function
 * @param	string	$function	the validation function
 *
 * @return						a validated string
 */
function tri_meta_box_sanitize( $string, $function = 'sanitize_text_field' ) {
	switch ( $function ) {
		case 'intval':
			return intval( $string );
		case 'absint':
			return absint( $string );
		case 'wp_kses_post':
			return wp_kses_post( $string );
		case 'wp_kses_data':
			return wp_kses_data( $string );
		case 'esc_url_raw':
			return esc_url_raw( $string );
		case 'is_email':
			return is_email( $string );
		case 'sanitize_title':
			return sanitize_title( $string );
		case 'santitize_boolean':
			return santitize_boolean( $string );
		case 'sanitize_text_field':
		default:
			return sanitize_text_field( $string );
	}
}


// Save the Data
function tri_save_meta( $post_id, $fields, $page ) {
	// verify nonce
	if ( !isset( $_POST[$page . '_meta_box_nonce'] ) || !wp_verify_nonce( $_POST[$page . '_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( ! current_user_can( 'edit_page', $post_id ) ){
		return $post_id;
	}

	// loop through fields and save the data
	foreach ( $fields as $field ) {
		$name = $field['id'];
		$old = get_post_meta( $post_id, $field['id'], true );
		$new = isset( $_POST[$name] ) ? $_POST[$name] : '';

		if ( isset( $new ) && $new != $old ) {
			update_post_meta( $post_id, $field['id'], $new );
		} elseif ('' == $new && $old) {
			delete_post_meta( $post_id, $field['id'], $old );
		}



		// save the rest
		$new = false;
		$old = get_post_meta( $post_id, $field['id'], true );
		if ( isset( $_POST[$field['id']] ) ) {
			$new = $_POST[$field['id']];
		}
		if ( isset( $new ) && '' == $new && $old ) {
			delete_post_meta( $post_id, $field['id'], $old );
		} elseif ( isset( $new ) && $new != $old ) {
			$sanitizer = isset( $field['sanitizer'] ) ? $field['sanitizer'] : 'sanitize_text_field';
			if ( is_array( $new ) )
				$new = meta_box_array_map_r( 'tri_meta_box_sanitize', $new, $sanitizer );
			else
				$new = tri_meta_box_sanitize( $new, $sanitizer );
			update_post_meta( $post_id, $field['id'], $new );
		}
	} // end foreach
}