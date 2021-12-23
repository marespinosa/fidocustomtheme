<?php
// Tweaks to the tri parent theme

/*******************************************************************************
	wp_enqueue_scripts action hook to add parent theme and any other scripts
*******************************************************************************/
function tri_custom_scripts_and_styles() {

	// Get child theme info to use version as cache buster
	$tri_theme = wp_get_theme();

	// Remove the parent theme and enqueue the child theme instead
	wp_dequeue_style( 'base' );
	wp_enqueue_style( 'base', get_stylesheet_uri(), array(), $tri_theme->get( 'Version' ) );

	// Disable Emoji code by default
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action( 'wp_enqueue_scripts', 'tri_custom_scripts_and_styles', 11 );


/*******************************************************************************
	Clean up the WP <head>
*******************************************************************************/
function tri_remove_head_links() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'tri_remove_head_links' );


/*******************************************************************************
	Yoast SEO Filter posts with noindex set from main query
*******************************************************************************/
if ( !function_exists( 'tri_noindex_search_filter' ) ) :
function tri_noindex_search_filter( $query ) {
	if ( $query->is_search() && defined( 'WPSEO_VERSION' ) ) {
		$query->set( 'meta_key', '_yoast_wpseo_meta-robots-noindex' );
		$query->set( 'meta_value', '' );
		$query->set( 'meta_compare', 'NOT EXISTS' );
	}
	return $query;
}
endif;
add_filter( 'pre_get_posts','tri_noindex_search_filter' );


/*******************************************************************************
	Add custom tri addons page
*******************************************************************************/
// Plugins
include_once( 'plugins/tri-plugins.php' );

// Enqueue Tri Plugins scripts
function tri_addons_scripts( $hook ) {
	if ( 'appearance_page_tri-addons' == $hook ) {
		wp_register_style( 'tri-admin', get_stylesheet_directory_uri() . '/inc/plugins/tri-plugins.css', array(), '1.0' );
		wp_enqueue_style( 'tri-admin' );
	}
}
add_action( 'admin_enqueue_scripts', 'tri_addons_scripts' );


/*******************************************************************************
	Tweak Gravity forms
*******************************************************************************/
if ( class_exists( 'GFForms' ) ) {

	/**
	 * Make gravity forms field label visibility a toggle
	 */
	add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

	/**
	 * Enforce anti-spam honeypot on all Gravity forms.
	 */
	add_filter( 'gform_form_post_get_meta', function ( $form ) {
		$form['enableHoneypot'] = true;
		return $form;
	} );
}

