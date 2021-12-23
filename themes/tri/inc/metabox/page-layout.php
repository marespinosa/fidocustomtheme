<?php
/**
 * The metabox panel that lets you configure general page layout
 * Displays on the add new page page.
 *
 * @version 2.1
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function tri_page_layout_fields() {

	// Option to disable sidebar
	$sidebar[] = array(
		'label' => 'Default',
		'value' => ''
	);
	$sidebar[] = array(
		'label' => 'None',
		'value' => 0
	);
	$sidebar[] = array(
		'label' => 'None - Center Page',
		'value' => 1
	);
	// Include the default sidebar
	$sidebar[] = array(
		'label' => 'Primary',
		'value' => 'primary'
	);

	// Get all the other sidebars created
	if ( function_exists( 'get_tri_stored_sidebar' ) && get_tri_stored_sidebar() ) {
		foreach ( get_tri_stored_sidebar() as $side ) {
			$sidebar[] = array(
				'label' => $side,
				'value' => $side
			);
		}
	}

	// Find out what page the user is on to set defaults for that post type
	if ( function_exists( 'get_current_screen' ) ) {
		$screen = get_current_screen();
	}

	// Create a tri prefix for the database
	$prefix = '_tri_';

	// Create an array of the fields available
	$fields = array(
		array (
			'label'		=> __( 'Sidebar', 'tri' ),
			'id'		=> $prefix . 'sidebar',
			'type'		=> 'select',
			'options'	=> $sidebar,
			'default'	=> ''
		)
	);

	if ( isset( $screen ) && ( $screen->post_type != 'post' ) ) {

		$fields[] = array (
			'label'		=> __( 'Header', 'tri' ),
			'id'		=> $prefix . 'layout_header',
			'type'		=> 'select',
			'options'	=> array (
				array(
					'label' => __( 'Normal', 'tri' ),
					'value' => ''
				),
				array (
					'label' => __( 'Over top of content', 'tri' ),
					'value' => 'overlay'
				),
				array (
					'label' => __( 'Centered logo only', 'tri' ),
					'value' => 'simple'
				),
				array (
					'label' => __( 'Hidden', 'tri' ),
					'value' => 'none'
				)
			)
		);

		// Only display if breadcrumbs are installed using yoast SEO plugin
		if ( function_exists('yoast_breadcrumb') ){
			$yoast_breadcrumb = get_option( 'wpseo_internallinks' );
			if ( $yoast_breadcrumb['breadcrumbs-enable'] ) {
				$fields[] = array(
					'label'	=> __( 'Page Breadcrumbs', 'tri' ),
					'desc'	=> __( 'Disable breadcrumbs on this page', 'tri' ),
					'id'	=> $prefix . 'breadcrumb',
					'type'	=> 'checkbox',
					'class'	=> 'tri_display_header'
				);
			}
		}

	}
	if ( isset( $screen ) && $screen->post_type == 'post' ) {
		$fields[] = array (
			'label'	=> __( 'Featured Image', 'tri' ),
			'id'	=> $prefix . 'featured_image',
			'type'	=> 'checkbox',
			'desc'	=> __( 'Hide on single post', 'tri' )
		);
	}
	return $fields;
}
// Add meta box
add_action( 'add_meta_boxes', 'add_page_layout_meta_box' );
function add_page_layout_meta_box() {

	// Get post types registered
	$post_types = array(
		'post',
		'page',
	);
	if( has_filter('tri_add_layout_meta_field') ) {
		$post_types = apply_filters('tri_add_layout_meta_field', $post_types);
	}
	foreach( $post_types as $type ) {
		add_meta_box( 'page_layout', __( 'Layout and Display', 'tri' ), 'show_page_layout_meta_box', $type, 'side', 'low' );
	}
}
// Callback function to show fields in meta box
function show_page_layout_meta_box() {
	tri_meta_box_callback( tri_page_layout_fields(), 'page' );
}
// Save data from meta box
add_action( 'save_post', 'save_page_layout_data' );
function save_page_layout_data( $post_id ) {
	tri_save_meta( $post_id, tri_page_layout_fields(), 'page' );
}