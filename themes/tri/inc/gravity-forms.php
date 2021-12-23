<?php
/**
 * Enforce anti-spam honeypot on all Gravity forms.
 *
 * @param array $form
 *
 * @return array $form
 */
add_filter( 'gform_form_post_get_meta', function ( $form ) {

	$form['enableHoneypot'] = true;
	return $form;
} );