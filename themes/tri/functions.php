<?php
/**
 * Tri functions and definitions
 *
 * You can override certain functions (those wrapped in a function_exists() call)
 * by defining them in the child theme's functions.php file.
 *
 * @package Tri Theme
 * @version Tri 1.0
 */

/*******************************************************************************
	Initial theme setup
*******************************************************************************/
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tri_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on tri, use a find and replace
	 * to change 'tri' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'tri' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a hard-coded
	 * <title> tag in the document head, and expect WordPress to provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1550, 9999 );

	// This theme uses wp_nav_menu() in the header and footer (subfooter) location.
	register_nav_menus( array(
		'main_nav' => __( 'Main Menu', 'tri' ),
		'footer_nav' => __( 'Footer Menu', 'tri' )
	) );

	/*
	 * Output valid HTML5 markup for search form, comment form, and comments.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'script',
		'style'
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 200,
		'height'      => 60,
		'flex-height'  => true,
		'flex-width'  => true
	) );

	// Add Gutenberg customizations
	// add_theme_support( 'align-wide' );
	add_theme_support( 'editor-color-palette' );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'disable-custom-gradients' );
	add_theme_support( 'disable-custom-font-sizes' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'style-editor.css' );

	/* This theme styles the visual editor to resemble the theme style. */
	// add_editor_style( array( 'css/editor-style.css' ) );
}
add_action( 'after_setup_theme', 'tri_setup' );


function tri_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tri_content_width', 740 );
}
add_action( 'after_setup_theme', 'tri_content_width', 0 );


/*******************************************************************************
	Add Search box to main menu in header
*******************************************************************************/
function tri_add_search_to_wp_menu ( $items, $args ) {
	if ( 'main_nav' === $args->theme_location && !get_theme_mod( 'header_search' ) ) {
		$items .= '<li class="menu-item menu-item-search d-none">
			<a id="menu-search" href="#menu-search-form" title="' . esc_attr__('Search', 'tri') . '" class="pr-0 pl-0">
				<i class="menu-search-icon d-block">' . tri_get_svg( 'search' ) . '</i>
				<span class="sr-only">' . esc_attr__('Search', 'tri') . '</span>
			</a>
			<div id="menu-search-form" class="d-none">' . get_search_form( false ) . '</div>
		</li>';
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'tri_add_search_to_wp_menu', 10, 2 );


/*******************************************************************************
	load admin backend styles and scripts
*******************************************************************************/
function tri_admin_scripts( $hook ) {
	// Enqueue admin scripts for posts and widgets pages
	if ( 'post.php' == $hook || 'widgets.php' == $hook ) {

		// Enqueue Styles
		wp_register_style( 'tri-admin', get_template_directory_uri() . '/assets/css/tri-admin.css', array(), '1.0' );
		wp_enqueue_style( 'tri-admin' );

	}

	if( 'widgets.php' == $hook ) {
		// Enqueue Scripts
		wp_register_script( 'tri-admin', get_template_directory_uri() . '/assets/js/tri-admin.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'tri-admin' );
	}

}
add_action( 'admin_enqueue_scripts', 'tri_admin_scripts', 99 );




function typed_init() {
    echo '<script>  
	$(document).ready(function() {   
		 $(".logo-carousel-images .blocks-gallery-grid").slick({
        slidesToShow: 7,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
	
    });   
	</script>';
}


add_action('wp_footer', 'typed_init');

function init_slider_testimonial() {
    echo '<script>  
	$(document).ready(function() {   
	$(".testimonial-list-wrapper").slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 6000,
        arrows: true,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 668,
            settings: {
                slidesToShow: 1
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 1
            }
        }]
    });
		
    });   
	</script>';
}


add_action('wp_footer', 'init_slider_testimonial');




/*******************************************************************************
	load frontend styles and scripts
*******************************************************************************/
function tri_scripts() {

	// Get theme info as a cache buster
	$tri_theme = wp_get_theme();

	// Enqueue themes style.css
	wp_enqueue_style( 'base', get_stylesheet_uri(), array(), $tri_theme->get( 'Version' ) );

	wp_register_script( 'magnificpopup', get_template_directory_uri() . '/assets/js/jquery.magnificpopup.1.1.0.min.js', array( 'jquery' ), '1.1.0', true );

	// Owl Carousel
	wp_register_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
	wp_register_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '2.3.4' );
	wp_register_style( 'owl-carousel-theme', get_template_directory_uri() .'/assets/css/owl.theme.default.min.css', array(), '2.3.4' );

	// Blocks - Enqueue on a single page
	if( is_singular() ){
		$id = get_the_ID();

		// Tabs
		if( has_block( 'acf/tab', $id ) ){
			wp_enqueue_script( 'tri-tabs', get_template_directory_uri() . '/assets/js/blocks/tri-tabs.js', array( 'jquery' ), $tri_theme->get( 'Version' ), true );
			wp_enqueue_style( 'tri-tabs', get_template_directory_uri() . '/assets/css/blocks/tri-tabs.css', array(), $tri_theme->get( 'Version' ) );
		}
		// Pricing
		if( has_block( 'acf/pricing', $id ) ){
			wp_enqueue_style( 'tri-pricing-table', get_template_directory_uri() . '/assets/css/blocks/tri-pricing-table.css', array(), $tri_theme->get( 'Version' ) );
		}
		// Accordions
		if( has_block( 'acf/accordion', $id ) ){
			wp_enqueue_script( 'tri-accordion', get_template_directory_uri() . '/assets/js/blocks/tri-accordion.js', array( 'jquery' ), $tri_theme->get( 'Version' ), true );
			wp_enqueue_style( 'tri-accordion', get_template_directory_uri() . '/assets/css/blocks/tri-accordion.css', array(), $tri_theme->get( 'Version' ) );
		}

		// Enqueue Owl Slider
		if( has_block( 'acf/testimonial', $id ) || has_block( 'acf/slider', $id ) ){
			wp_enqueue_style( 'owl-carousel' );
			wp_enqueue_style( 'owl-carousel-theme' );
			wp_enqueue_script( 'owl-carousel' );
		}
		// Testimonial
		if( has_block( 'acf/testimonial', $id ) ){
			wp_enqueue_script( 'tri-testimonials', get_template_directory_uri() . '/assets/js/blocks/slider-testimonial.js', array( 'owl-carousel' ), $tri_theme->get( 'Version' ), true );
		}
		// Slider
		if( has_block( 'acf/slider', $id ) ){
			wp_enqueue_script( 'tri-slider', get_template_directory_uri() . '/assets/js/blocks/slider-images.js', array( 'owl-carousel' ), $tri_theme->get( 'Version' ), true );
		}
		// Count Up
		if( has_block( 'acf/count-up', $id ) ){
			wp_enqueue_script( 'tri-count-up', get_template_directory_uri() . '/assets/js/blocks/tri-count-up.js', array( 'jquery' ), $tri_theme->get( 'Version' ), true );
		}
		// Google Map
		if ( has_block( 'acf/map', $id ) && get_theme_mod('tri_map') ) {
			wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=' . trim( get_theme_mod('tri_map') ), '', '');
		}
	}

	// Isotope filterable post_grid
	wp_register_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );

	wp_enqueue_script( 'tri', get_template_directory_uri() . '/assets/js/tri.min.js', array( 'jquery', 'magnificpopup' ), $tri_theme->get( 'Version' ), true );

	// If is singular, add comment reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Add gap if user is logged in to accomodate floating header
	if ( is_admin_bar_showing() && get_theme_mod('header_float') ) {
		$custom_css = "@media only screen and (min-width: 601px){
			.admin-bar.header-fixed #tri-header{top: 32px;}
		}
		@media only screen and (min-width: 601px) and (max-width: 782px){
			.admin-bar.header-fixed #tri-header{top: 46px;}
		}";
		wp_add_inline_style( 'base', $custom_css );
	}

	// Dequeue block library
	// wp_dequeue_style( 'wp-block-library' );

}
add_action( 'wp_enqueue_scripts', 'tri_scripts' );


/*******************************************************************************
	Register Widgets
*******************************************************************************/
function tri_widgets_init() {
	register_sidebar( array(
		'name'			=> __( 'Primary', 'tri' ),
		'id'			=> 'primary',
		'description'	=> __( 'Add widgets here to appear in the sidebar.', 'tri' ),
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h2 class="h5 widget-title">',
		'after_title'	=> '</h2>'
	) );

	// Footer
	$footer_widgets = get_tri_footer_widgets();
	if ( $footer_widgets ) {
		if( '1' == $footer_widgets ) {
			$name = __( 'Footer widget area 1', 'tri' );
		} else {
			/* translators: %d: the footer widget number */
			$name = __( 'Footer widget area %d', 'tri' );
		}
		register_sidebars( $footer_widgets, array(
			'name'			=> $name,
			'id'			=> 'footer-widget',
			'before_title'	=> '<h4>',
			'after_title'	=> '</h4>',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'description'	=> __( 'One of the footer widget areas', 'tri' )
		) );
	}

	// Header
	$header_layout = get_theme_mod( 'menu_position' );
	if ( 'under' == $header_layout ) {
		register_sidebar( array(
			'name'			=> __( 'Header', 'tri' ),
			'id'			=> 'header-widget',
			'description'	=> __( 'Add widgets here to appear in the header.', 'tri' ),
			'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h2 class="h4 widget-title">',
			'after_title'	=> '</h2>'
		) );
	}

	// Above Header
	register_sidebar( array(
		'name'			=> __( 'Top Header Bar Left', 'tri' ),
		'id'			=> 'header-left-sidebar',
		'description'	=> __( 'Add widgets here to make bar appear above header on left.', 'tri' ),
		'before_widget'	=> '',
		'after_widget'	=> '',
		'before_title'	=> '<h3 class="h4 widget-title">',
		'after_title'	=> '</h3>'
	) );
	
	register_sidebar( array(
		'name'			=> __( 'Top Header Bar Right', 'tri' ),
		'id'			=> 'header-right-sidebar',
		'description'	=> __( 'Add widgets here to make bar appear above header on right.', 'tri' ),
		'before_widget'	=> '',
		'after_widget'	=> '',
		'before_title'	=> '<h3 class="h4 widget-title">',
		'after_title'	=> '</h3>'
	) );
	
	register_sidebar( array(
		'name'			=> __( 'Footer Pop Up Box', 'tri' ),
		'id'			=> 'footer-box-popup',
		'description'	=> __( 'Add widgets for pop up form on mobile view.', 'tri' ),
		'before_widget'	=> '',
		'after_widget'	=> '',
		'before_title'	=> '<h3 class="h4 widget-title">',
		'after_title'	=> '</h3>'
	) );
}
add_action( 'widgets_init', 'tri_widgets_init' );


/*******************************************************************************
	Add footer Tri credit
*******************************************************************************/
function tri_footer_attribution() {
	echo '<span id="tri-attribution">' . __('Website by', 'tri');
		printf( ' <a href="%s?utm_source=tri&utm_medium=footer&utm_content=%s" target="_blank">%s</a>',
			esc_attr( wp_get_theme( 'tri' )->get( 'AuthorURI' ) ),
			urlencode( get_bloginfo( 'name' ) ),
			esc_html( wp_get_theme( 'tri' )->get( 'Author' ) )
		);
	echo '</span>';
}
add_action( 'tri_subfooter_right', 'tri_footer_attribution', 5 );


/*******************************************************************************
	Filters wp_title to print a neat <title> tag based on what is being viewed.
*******************************************************************************/
function tri_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	global $page, $paged;
	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}
	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		/* translators: %s: page number */
		$title .= " $sep " . sprintf( __( 'Page %s', 'tri' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'tri_wp_title', 10, 2 );


/*******************************************************************************
	Post excerpt filters
*******************************************************************************/
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 *
 * @since Tri 4.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
if ( ! function_exists( 'tri_excerpt_more' ) ) :
	function tri_excerpt_more( $more ) {
		if ( is_admin() ) {
			return;
		}
		return ' &hellip;';
	}
endif;
add_filter( 'excerpt_more', 'tri_excerpt_more' );


// Excerpt length
if ( ! function_exists( 'tri_excerpt_length' ) ) :
	function tri_excerpt_length( $length ) {
		if ( is_front_page() ) {
			return 11;
		} else {
			return 41;
		}
	}
endif;
add_filter( 'excerpt_length', 'tri_excerpt_length', 999 );


/*******************************************************************************
	Tri Default Comment Form
*******************************************************************************/
// Remove the after text about allowed tags
function tri_comment_form( $defaults ) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}
add_filter( 'comment_form_defaults', 'tri_comment_form' );


/*******************************************************************************
	Add classes to body
*******************************************************************************/
function tri_add_body_classes( $classes ) {

	// fixed/floating or static/default header behavior
	$classes[] = ( get_theme_mod( 'header_float' ) ) ? 'header-fixed' : 'header-static';

	// full-width header
	$classes[] = ( get_theme_mod( 'header_full_width' ) ) ? 'header-full-width' : '';

	// Header on top of content? - get value from post meta
	$header_on_top = get_post_meta( get_the_ID(), '_tri_layout_header', true );
	$classes[] = ( isset( $header_on_top ) && 'overlay' == $header_on_top ) ? 'header-on-top' : '';

	// Add sidebar class if sidebar is active
	$has_sidebar = get_post_meta( get_the_ID(), '_tri_layout_sidebar', true );
	$classes[] = ( isset( $has_sidebar ) && 'none' != $has_sidebar && !empty( $has_sidebar ) ) ? 'has-sidebar' : '';

	return $classes;
}
add_filter( 'body_class', 'tri_add_body_classes' );


/*******************************************************************************
	Get layout and sidebar options
*******************************************************************************/
function get_tri_layout( $option = null ) {
	if ( is_admin() ) {
		return;
	}

	// Defaults
	$default = apply_filters( 'tri_layout_custom', array(
		'sidebar_position' => 'none',
		'sidebar' => '',
		'main_column_size' => 'col-lg-8',
		'layout_header' => '',
		'featured_image' => null,
		'hide_footer' => false,
		'header_display' => 'tri_head_label'
	) );

	// If is woocommerce index page
	if ( class_exists( 'woocommerce' ) && is_woocommerce() && !is_product() ) {
		// Sidebar position and size
		if ( 'sidebar_position' == $option ) {
			return tri_sidebar_position( get_theme_mod( 'woocommerce_index_sidebar_position' ) );
		}

		// Main content column size
		if ( 'main_column_size' == $option ) {
			return tri_main_content_size( get_theme_mod( 'woocommerce_index_sidebar_position' ) );
		}

		// Chosen sidebar
		if ( 'sidebar' == $option && get_theme_mod( 'woocommerce_index_sidebar' ) ) {
			return get_theme_mod( 'woocommerce_index_sidebar' );
		}

	// If is woocommerce single product page
	} elseif ( class_exists( 'woocommerce' ) && is_woocommerce() && is_product() ) {
		// Sidebar position and size
		if ( 'sidebar_position' == $option ) {
			return tri_sidebar_position( get_theme_mod( 'woocommerce_single_sidebar_position' ) );
		}

		// Main content column size
		if ( 'main_column_size' == $option ) {
			return tri_main_content_size( get_theme_mod( 'woocommerce_single_sidebar_position' ) );
		}

		// Chosen sidebar
		if ( 'sidebar' == $option && get_theme_mod( 'woocommerce_single_sidebar' ) ) {
			return get_theme_mod( 'woocommerce_single_sidebar' );
		}

	// If is blog index or archive page
	} elseif ( is_home() || is_archive() || is_search() ) {

		// Chosen sidebar
		if ( 'sidebar' == $option && get_theme_mod( 'blog_sidebar' ) ) {
			return get_theme_mod( 'blog_sidebar' );
		}

		// Sidebar position and size
		if ( 'sidebar_position' == $option ) {
			return tri_sidebar_position( get_theme_mod( 'blog_sidebar_position' ) );
		}

		// Main content column size
		if ( 'main_column_size' == $option ) {
			return tri_main_content_size( get_theme_mod( 'blog_sidebar_position' ) );
		}

	// Everything Else
	} elseif ( !is_404() ){
		$meta = get_post_custom();

		// Header
		if ( 'layout_header' == $option && isset( $meta['_tri_layout_header'][0] ) ) {
			return $meta['_tri_layout_header'][0];
		}

		// Display/hide the single post image at the top of the post
		if ( 'featured_image' == $option && isset( $meta['_tri_featured_image'] ) ) {
			return true;
		}

		// Sidebar position and size
		if ( 'sidebar_position' == $option ) {
			// None or none + main column centered
			if( isset( $meta['_tri_sidebar'][0] ) && ( "0" == $meta['_tri_sidebar'][0] || "1" == $meta['_tri_sidebar'][0] ) ){
				return 'none';
			}
			return tri_sidebar_position( get_theme_mod( 'blog_single_sidebar_position' ) );
		}

		// Chosen sidebar
		if( 'sidebar' == $option ) {
			if ( isset( $meta['_tri_sidebar'][0] ) && "0" != $meta['_tri_sidebar'][0] && !empty( $meta['_tri_sidebar'][0] ) ){
				return $meta['_tri_sidebar'][0];
			}
			return get_theme_mod( 'blog_single_sidebar' );
		}
		// Main content column size
		if ( 'main_column_size' == $option ) {
			if( isset( $meta['_tri_sidebar'][0] ) && "0" == $meta['_tri_sidebar'][0] ) {
				// No Sidebar
				return tri_main_content_size( '0' );
			} elseif( isset( $meta['_tri_sidebar'][0] ) && "1" == $meta['_tri_sidebar'][0] ) {
				// No Sidebar - Centered Page
				return tri_main_content_size( 1 );
			}
			// Theme Default
			return tri_main_content_size( get_theme_mod( 'blog_single_sidebar_position' ) );
		}

		// Hide footer
		if ( 'hide_footer' == $option && isset( $meta['_tri_display_footer'][0] ) ) {
			return true;
		}
	}


	// return default options;
	if ( in_array( $option, $default ) && $option ) {
		return $default[$option];
	}
	return false;
}

// Helper function to echo the returned layout option
function tri_layout( $option = '' ) {
	echo esc_attr( get_tri_layout( $option ) );
}

// Sidebar Position helper
function tri_sidebar_position( $position ) {
	if( "none" == $position || "center" == $position ){
		// No Sidebar
		return 'none';
	} elseif ( 'left' == $position ) {
		// Left Column
		return 'col-md-first';
	}
	elseif ( 'right' == $position ) {
		// Right Column
		return 'offset-lg-1';
	}
	return $position;
}
// Main Content Site helper
function tri_main_content_size( $size ) {
	if( "none" == $size || "center" == $size || '0' == $size ){
		// No Sidebar
		return;
	} elseif( '1' == $size ) {
		// No Sidebar + Center Page
		return 'col-md-10 col-lg-9';
	} elseif ( 'left' == $size ) {
		// Left Column
		return 'col-lg-8 offset-md-1';
	}
	// Right Column
	return 'col-lg-8';
}

/*******************************************************************************
	Get the logo (normal and retina)
*******************************************************************************/
if ( !function_exists( 'tri_brand_logo' ) ) :
function tri_brand_logo() {

	if ( has_custom_logo() ) {
		the_custom_logo();
	}
}
endif;


/*******************************************************************************
	Get footer widget layout options
*******************************************************************************/
function get_tri_footer_widgets() {
	// Get number of widgets
	$count = get_theme_mod( 'footer_widgets', 3 );

	if ( $count ) {
		return $count;
	}
	return false;
}


/*******************************************************************************
	Get footer copyright attributions
*******************************************************************************/
function tri_copyright_text() {
	$copyright_text = get_theme_mod( 'subfooter_text' );

	// add date and blog name to string
	if ( !$copyright_text ) {
		$copyright_text = sprintf(
			/* translators: %u: date %s: Blog name */
			__( 'Copyright &copy; %u %s', 'tri' ),
			date( "Y" ),
			get_bloginfo( 'name' )
		);
	}
	return $copyright_text;
}


/*******************************************************************************
	Return a list of Social profiles to include in the social icons widget
*******************************************************************************/
function get_tri_social_profiles() {
	$social_profiles = array(
		'facebook'	=> 'Facebook',
		'twitter'	=> 'Twitter',
		'pinterest'	=> 'Pinterest',
		'linkedin'	=> 'LinkedIn',
		'instagram'	=> 'Instagram',
		'youtube'	=> 'Youtube',
		'email'		=> 'Email'
	);

	if( has_filter( 'tri_add_social_profiles' ) ) {
		$social_profiles = apply_filters( 'tri_add_social_profiles', $social_profiles );
	}

	return $social_profiles;
}


function custom_admin_css() {
	echo '<style type="text/css">
	/* Main column width */
	.wp-block {
		max-width: 1110px;
	}

	/* Width of "wide" blocks */
		 .wp-block[data-align="wide"] {
		 max-width: 1080px;
	}

	/* Width of "full-wide" blocks */
	.wp-block[data-align="full"] {
		max-width: none;
	}
	</style>';
}
add_action('admin_head', 'custom_admin_css');

/*******************************************************************************
	Includes
*******************************************************************************/

// Custom template tags for this theme.
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/template-functions.php';

// Custom metabox for pages and posts
require_once get_template_directory() . '/inc/metabox/meta-box.php';
require_once get_template_directory() . '/inc/metabox/page-layout.php';

// Tri theme options
require_once get_template_directory() . '/inc/theme-options.php';
require_once get_template_directory() . '/inc/theme-options.php';

// Gutenberg Blocks
require_once get_template_directory() . '/inc/gutenberg-blocks.php';

// Shortcodes
require_once get_template_directory() . '/inc/shortcodes.php';

// Widgets
require_once get_template_directory() . '/inc/widgets/contact-info-widget.php';
require_once get_template_directory() . '/inc/widgets/recent-posts-widget.php';
require_once get_template_directory() . '/inc/widgets/social-icon-widget.php';
require_once get_template_directory() . '/inc/sidebars.php';
require_once get_template_directory() . '/inc/sidebars.php';

// Load WooCommerce compatibility file.
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}




function hero_slider_custom() {

	$labels = array(
		'name'               => __( 'Hero Slider' ),
		'singular_name'      => __( 'Hero Slider' ),
		'add_new'            => __( 'Add New' ),
		'add_new_item'       => __( 'Add New Slide' ),
		'edit_item'          => __( 'Edit Slide' ),
		'new_item'           => __( 'Add New Slide' ),
		'view_item'          => __( 'View Slide' ),
		'search_items'       => __( 'Search Slide' ),
		'not_found'          => __( 'No Slide found' ),
		'not_found_in_trash' => __( 'No Slide' )
	);

	$supports = array(
		'title',
		'editor',
		'thumbnail',
		'custom-fields',
	);
	

	$args = array(
		'labels'               => $labels,
		'supports'             => $supports,
		'taxonomies'   		   => array('category'),
		'public'               => true,
		'capability_type'      => 'post',
		'rewrite'              => array( 'slug' => 'hero-slider' ),
		'has_archive'          => true,
		'menu_position'        => 30,
		'menu_icon'            => 'dashicons-format-aside',
	);

	register_post_type( 'hero_slider_carousel', $args );

}

add_action( 'init', 'hero_slider_custom' );










function new_widget_footer() {
    register_sidebar( array(
        'name'          => __( 'Additional Top Footer', 'textdomain' ),
        'id'            => 'top-footer',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
    ) ); 
	
	register_sidebar( array(
        'name'          => __( 'Copy Rights', 'textdomain' ),
        'id'            => 'copyrights',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
    ) );
}
add_action( 'widgets_init', 'new_widget_footer' );



function load_my_scripts() {
    if (!is_admin()) {
        wp_register_script('jqueryui', '//code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'), '1.12.1', true);
        wp_enqueue_script('jqueryui');
    }
}
add_action('init', 'load_my_scripts');


 
function register_acf_block_types() {
 
    acf_register_block(array(
        'name'              => 'nested-accordion',
        'title'             => __('Nested Accordion'),
        'description'       => __('A Nested accordion block.'),
        'category'          => 'formatting',
        'icon'              => 'arrow-down-alt2',
        'keywords'          => array( 'accordion-nested' ),
        'render_template'   => 'template-parts/blocks/accordion-nested.php',
    ));
  
}
 
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}