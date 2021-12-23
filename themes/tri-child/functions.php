<?php
/**
 * Tri child theme functions file.
 * The following is a handful of commonly used functions in Tri.
 * Uncomment and modify each line you need for the theme.
 * With great power, comes great responsibility - Use wisely =)
*/
// Add Tri parent theme tweaks
include_once( 'inc/tri-modifications.php' );

/*******************************************************************************
	Enqueue Custom Scripts
*******************************************************************************/
function tri_custom_script() {

	// Dequeue Gutenberg frontend styles if not using Gutenberg
	// wp_dequeue_style( 'wp-block-library' );

	// Get child theme info as a cache buster
	$tri_theme = wp_get_theme();

	// Register new child js file
	wp_register_script('tri-custom', get_stylesheet_directory_uri() . '/assets/js/tri-custom.js', array('jquery'), $tri_theme->get( 'Version' ), true);
	// wp_enqueue_script('tri-custom');

}
add_action( 'wp_enqueue_scripts', 'tri_custom_script' );


/*******************************************************************************
	Add content to action - https://tri.web3.com.au/docs/#function-actions
********************************************************************************/
function tri_add_footer_cta() {
	get_template_part( 'template-parts/footer-call-to-action' );
}
add_action( 'tri_footer_before', 'tri_add_footer_cta' );



/*******************************************************************************
	Add content to end of each post
*******************************************************************************/
/*
function tri_email_signup() {
	if ( is_singular( 'post' ) ) :
		echo "";
	endif;
}
add_action( 'tri_end_of_post', 'tri_email_signup' );
*/


/*******************************************************************************
	Adds support for editor color palette.
*******************************************************************************/
function tri_child_setup() {
	// Add custom font sizes to Gutenberg
	/*add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'Small', 'tri' ),
			'shortName' => __( 'S', 'tri' ),
			'size'      => 12,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'Normal', 'tri' ),
			'shortName' => __( 'M', 'tri' ),
			'size'      => 16,
			'slug'      => 'normal'
		),
		array(
			'name'      => __( 'Large', 'tri' ),
			'shortName' => __( 'L', 'tri' ),
			'size'      => 60,
			'slug'      => 'large'
		),
	) );*/

	// Add brand colors here
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Blue', 'tri' ),
			'slug'  => 'primary',
			'color'	=> '#0065F2',
		),
		array(
			'name'  => __( 'Green', 'tri' ),
			'slug'  => 'secondary',
			'color'	=> '#2DCB48',
		),
		array(
			'name'  => __( 'Yellow', 'tri' ),
			'slug'  => 'tertiary',
			'color'	=> '#FFCC00',
		),
		array(
			'name'  => __( 'White', 'tri' ),
			'slug'  => 'white',
			'color'	=> '#fff',
		),
		array(
			'name'  => __( 'Black', 'tri' ),
			'slug'  => 'black',
			'color'	=> '#000',
		),
	) );
}
add_action( 'init', 'tri_child_setup' );


function mytheme_setup() {
  add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'mytheme_setup' );




function new_theme_scripts() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );
 
  wp_enqueue_style( 'mobileview', get_stylesheet_directory_uri() . '/assets/css/mobile-view.css', array(), '1.1', 'all');
  
  wp_enqueue_script( 'jquerymin', get_template_directory_uri() . '/assets/js/jquery-3.6.0.min.js', array ( 'jquery' ) , true);
  
  wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', array ( 'jquery' ) , true);
 
   
}
add_action( 'wp_enqueue_scripts', 'new_theme_scripts', 99);