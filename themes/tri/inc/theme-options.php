<?php
// Get the sidebars created
function tri_get_sidebar_choices() {
	// Get sidebars
	$sidebar = array('primary' => 'Primary');
	if ( function_exists( 'get_tri_stored_sidebar' ) ) :
		if ( get_tri_stored_sidebar() ) {
			$sidebars = get_tri_stored_sidebar();
			$sidebar = array_merge($sidebar, $sidebars);
		}
	endif;
	return $sidebar;
}

/**
 * Checkbox sanitization callback.
 */
function tri_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}


//select sanitization function
function tri_sanitize_select( $input, $setting ){

	//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
	$input = sanitize_key($input);

	//get the list of possible select options
	$choices = $setting->manager->get_control( $setting->id )->choices;

	//return input if valid or return default option
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


/**
 * Customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Tri 3.0
 */
function tri_register_theme_customizer ( $wp_customize ) {

	if ( ! isset( $wp_customize ) ) {
		return;
	}

	// Header Options
	$wp_customize->add_section( 'header',
		array(
			'title'       => __( 'Header', 'tri' ),
			'priority'    => 20,
			'capability'  => 'edit_theme_options',
			'description' => __('Customize the Tri header', 'tri'),
		)
	);

	$wp_customize->add_setting( 'header_float', array(
		'default' => '',
		'sanitize_callback' => 'tri_sanitize_checkbox'
	) );
	$wp_customize->add_control(
		'header_float',
		array(
			'label'    => __( 'Float Header', 'tri' ),
			'section'  => 'header',
			'settings' => 'header_float',
			'type'     => 'checkbox',
			'description' => __( 'Make header stay at the top of the window when scrolling down the page.', 'tri' )
		)
	);
	$wp_customize->add_setting( 'header_full_width', array(
		'default' => '',
		'sanitize_callback' => 'tri_sanitize_checkbox'
	) );
	$wp_customize->add_control(
		'header_full_width',
		array(
			'label'    => __( 'Full-width Header', 'tri' ),
			'section'  => 'header',
			'settings' => 'header_full_width',
			'type'     => 'checkbox',
			'description' => __( 'Make header go full width for desktops - out of its container.', 'tri' )
		)
	);
	$wp_customize->add_setting( 'header_search', array(
		'default' => true,
		'sanitize_callback' => 'tri_sanitize_checkbox'
	) );
	$wp_customize->add_control(
		'header_search',
		array(
			'label'    => __( 'Hide Header Search Box', 'tri' ),
			'section'  => 'header',
			'settings' => 'header_search',
			'type'     => 'checkbox',
			'description' => __( 'Hide the searchbox in the header menu.', 'tri' )
		)
	);
	$wp_customize->add_setting( 'menu_position', array(
		'default' => 'adjacent',
		'sanitize_callback' => 'tri_sanitize_select'
	) );
	$wp_customize->add_control(
		'menu_position',
		array(
			'label'    => __( 'Menu Position', 'tri' ),
			'section'  => 'header',
			'settings' => 'menu_position',
			'type'     => 'select',
			'description' => __( 'Position the menu with the logo.', 'tri' ),
			'choices'  => array(
				'adjacent'  => __( 'Adjacent to logo', 'tri' ),
				'under' => __( 'Under Logo', 'tri' ),
			),
		)
	);
	$wp_customize->add_setting( 'mobile_phone', array(
		'default' => '',
		'sanitize_callback' => 'wp_filter_nohtml_kses'
	) );
	$wp_customize->add_control(
		'mobile_phone',
		array(
			'label'    => __( 'Mobile Tap to call number', 'tri' ),
			'section'  => 'header',
			'settings' => 'mobile_phone',
			'type'     => 'text',
			'description' => __( 'Enter phone number to display tap to phone click link in mobile header.', 'tri' ),
			'input_attrs' => array('placeholder' => __( '0123456789', 'tri' ) )
		)
	);

	// Blog Options
	$wp_customize->add_section( 'blog',
		array(
			'title'       => __( 'Blog', 'tri' ),
			'priority'    => 100,
			'capability'  => 'edit_theme_options',
			'description' => __('Customize the Tri blog.', 'tri'),
		)
	);
	$wp_customize->add_setting( 'blog_sidebar_position', array(
		'default' => 'right',
		'sanitize_callback' => 'tri_sanitize_select'
	) );
	$wp_customize->add_control(
		'blog_sidebar_position',
		array(
			'label'    => __( 'Blog Index Sidebar', 'tri' ),
			'section'  => 'blog',
			'settings' => 'blog_sidebar_position',
			'type'     => 'select',
			'description' => __( 'Include a sidebar on the blog index page.', 'tri' ),
			'choices'  => array(
				'none'  => __( 'No sidebar', 'tri' ),
				'left' => __( 'Left sidebar', 'tri' ),
				'right' => __( 'Right sidebar', 'tri' ),
			),
		)
	);
	$wp_customize->add_setting( 'blog_sidebar', array(
		'default' => 'default',
		'sanitize_callback' => 'tri_sanitize_select'
	) );
	$wp_customize->add_control(
		'blog_sidebar',
		array(
			'section'  => 'blog',
			'settings' => 'blog_sidebar',
			'type'     => 'select',
			'choices'  => tri_get_sidebar_choices(),
		)
	);

	// Blog Single
	$wp_customize->add_setting( 'blog_single_sidebar_position', array(
		'default' => 'right',
		'sanitize_callback' => 'tri_sanitize_select'
	) );
	$wp_customize->add_control(
		'blog_single_sidebar_position',
		array(
			'label'    => __( 'Blog Single Sidebar', 'tri' ),
			'section'  => 'blog',
			'settings' => 'blog_single_sidebar_position',
			'type'     => 'select',
			'description' => __( 'Include a sidebar on each blog post page.', 'tri' ),
			'choices'  => array(
				'none'  => __( 'No sidebar', 'tri' ),
				'left' => __( 'Left sidebar', 'tri' ),
				'right' => __( 'Right sidebar', 'tri' ),
			),
		)
	);
	$wp_customize->add_setting( 'blog_single_sidebar', array(
		'default' => 'default',
		'sanitize_callback' => 'tri_sanitize_select'
	) );
	$wp_customize->add_control(
		'blog_single_sidebar',
		array(
			'section'  => 'blog',
			'settings' => 'blog_single_sidebar',
			'type'     => 'select',
			'choices'  => tri_get_sidebar_choices(),
		)
	);
	$wp_customize->add_setting( 'blog_share_bar', array(
		'default' => false,
		'sanitize_callback' => 'tri_sanitize_checkbox'
	) );
	$wp_customize->add_control(
		'blog_share_bar',
		array(
			'label'    => __( 'Hide blog share bar', 'tri' ),
			'section'  => 'blog',
			'settings' => 'blog_share_bar',
			'type'     => 'checkbox',
			'description' => __( 'Hides the social share bar that floats on every blog post.', 'tri' )
		)
	);


	// Footer Options
	$wp_customize->add_section( 'footer',
		array(
			'title'       => __( 'Footer', 'tri' ),
			'priority'    => 100,
			'capability'  => 'edit_theme_options',
			'description' => __('Customize the Tri footer.', 'tri'),
		)
	);
	$wp_customize->add_setting( 'footer_widgets', array(
		'default' => 0,
		'sanitize_callback' => 'tri_sanitize_select'
	) );
	$wp_customize->add_control(
		'footer_widgets',
		array(
			'label'    => __( 'Footer Widgets', 'tri' ),
			'section'  => 'footer',
			'settings' => 'footer_widgets',
			'type'     => 'select',
			'description' => __( 'Number of footer widgets to create for the footer.', 'tri' ),
			'choices'  => array(
				0  => __( 'Disabled', 'tri' ),
				1 => __( 'One Widget Area', 'tri' ),
				2 => __( 'Two Widget Areas', 'tri' ),
				3 => __( 'Three Widget Areas', 'tri' ),
				4 => __( 'Four Widget Areas', 'tri' ),
				5 => __( 'Five Widget Areas', 'tri' ),
			),
		)
	);
	$wp_customize->add_setting( 'subfooter', array(
		'default' => false,
		'sanitize_callback' => 'tri_sanitize_checkbox'
	) );
	$wp_customize->add_control(
		'subfooter',
		array(
			'label'    => __( 'Hide sub-footer', 'tri' ),
			'section'  => 'footer',
			'settings' => 'subfooter',
			'type'     => 'checkbox'
		)
	);
	$wp_customize->add_setting( 'subfooter_text', array(
		'default' => '',
		'sanitize_callback' => 'wp_filter_nohtml_kses'
	) );
	$wp_customize->add_control(
		'subfooter_text',
		array(
			'label'    => __( 'Sub-footer text', 'tri' ),
			'section'  => 'footer',
			'settings' => 'subfooter_text',
			'type'     => 'text',
			'description' => __( 'Add the text to be used in the subfooter.', 'tri' ),
			'input_attrs' => array('placeholder' => __( 'Copyright', 'tri' ) . ' &copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) )
		)
	);

	// Add Tri Section
	$wp_customize->add_section('tri', array(
		'title' => __( 'Tri', 'tri' ),
		'priority' => 120,
	));

	// add a setting
	$wp_customize->add_setting('tri_map');

	// Add a control
	$wp_customize->add_control( 'tri_map_key', array(
		'label'    => __( 'Tri Map API Key', 'tri' ),
		'section'  => 'tri',
		'settings' => 'tri_map',
		'type'     => 'text',
		'description' => 'Add your <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key" target="_blank">Google Maps API key</a> here to make the Tri maps shortcode work.'
	) );


	// Woocommerce Options
	if ( class_exists( 'WooCommerce' ) ) {
		$wp_customize->add_setting( 'woocommerce_product_columns', array(
			'default' => 3,
			'sanitize_callback' => 'tri_sanitize_select'
		) );
		$wp_customize->add_control(
			'woocommerce_product_columns',
			array(
				'label'    => __( 'Product columns', 'tri' ),
				'section'  => 'woocommerce_product_catalog',
				'settings' => 'woocommerce_product_columns',
				'type'     => 'select',
				'description' => __( 'Number of columns to display products.', 'tri' ),
				'choices'  => array(
					0  => __( 'Disabled', 'tri' ),
					1 => __( 'One Column', 'tri' ),
					2 => __( 'Two Columns', 'tri' ),
					3 => __( 'Three Columns', 'tri' ),
					4 => __( 'Four Columns', 'tri' ),
				),
			)
		);
		$wp_customize->add_setting( 'woocommerce_related_products', array(
			'default' => 3,
			'sanitize_callback' => 'tri_sanitize_select'
		) );
		$wp_customize->add_control(
			'woocommerce_related_products',
			array(
				'label'    => __( 'Related Product columns', 'tri' ),
				'section'  => 'woocommerce_product_catalog',
				'settings' => 'woocommerce_related_products',
				'type'     => 'select',
				'description' => __( 'Number of columns to display related products.', 'tri' ),
				'choices'  => array(
					2 => __( 'Two Columns', 'tri' ),
					3 => __( 'Three Columns', 'tri' ),
				),
			)
		);
		$wp_customize->add_setting( 'woocommerce_index_sidebar_position', array(
			'default' => 'none',
			'sanitize_callback' => 'tri_sanitize_select'
		) );
		$wp_customize->add_control(
			'woocommerce_index_sidebar_position',
			array(
				'label'    => __( 'Shop page sidebar', 'tri' ),
				'section'  => 'woocommerce_product_catalog',
				'settings' => 'woocommerce_index_sidebar_position',
				'type'     => 'select',
				'description' => __( 'Include a sidebar on the shop index page.', 'tri' ),
				'choices'  => array(
					'none'  => __( 'No sidebar', 'tri' ),
					'left' => __( 'Left sidebar', 'tri' ),
					'right' => __( 'Right sidebar', 'tri' ),
				),
			)
		);
		$wp_customize->add_setting( 'woocommerce_index_sidebar', array(
			'default' => 'default',
			'sanitize_callback' => 'tri_sanitize_select'
		) );
		$wp_customize->add_control(
			'woocommerce_index_sidebar',
			array(
				'section'  => 'woocommerce_product_catalog',
				'settings' => 'woocommerce_index_sidebar',
				'type'     => 'select',
				'choices'  => tri_get_sidebar_choices(),
			)
		);
		$wp_customize->add_setting( 'woocommerce_single_sidebar_position', array(
			'default' => 'none',
			'sanitize_callback' => 'tri_sanitize_select'
		) );
		$wp_customize->add_control(
			'woocommerce_single_sidebar_position',
			array(
				'label'    => __( 'Product page sidebar', 'tri' ),
				'section'  => 'woocommerce_product_catalog',
				'settings' => 'woocommerce_single_sidebar_position',
				'type'     => 'select',
				'description' => __( 'Include a sidebar on individual product pages.', 'tri' ),
				'choices'  => array(
					'none'  => __( 'No sidebar', 'tri' ),
					'left' => __( 'Left sidebar', 'tri' ),
					'right' => __( 'Right sidebar', 'tri' ),
				),
			)
		);
		$wp_customize->add_setting( 'woocommerce_single_sidebar', array(
			'default' => 'default',
			'sanitize_callback' => 'tri_sanitize_select'
		) );
		$wp_customize->add_control(
			'woocommerce_single_sidebar',
			array(
				'section'  => 'woocommerce_product_catalog',
				'settings' => 'woocommerce_single_sidebar',
				'type'     => 'select',
				'choices'  => tri_get_sidebar_choices(),
			)
		);
	} // End if is Woocommerce
}
add_action( 'customize_register' , 'tri_register_theme_customizer' );
