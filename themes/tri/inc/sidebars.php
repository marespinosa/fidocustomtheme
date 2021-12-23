<?php
/*******************************************************************************
	Custom Page Sidebars
*******************************************************************************/
/**
 * Function for adding sidebar (AJAX action)
 */
if ( !function_exists( 'tri_add_sidebar' ) ) {
	function tri_add_sidebar(){
		if ( !wp_verify_nonce( $_GET['_wpnonce_tri_widgets'], 'tri-add-sidebar-widgets') ) { die( 'Security check' ); }
		if ( '' == $_GET['tri_sidebar_name'] ){ die( 'Empty Name' ); }
		$option_name = 'tri_custom_sidebars';
		if ( !get_option($option_name) || '' == get_option( $option_name ) ) { delete_option( $option_name ); }

		$new_sidebar = esc_html( $_GET['tri_sidebar_name'] );

		if ( get_option( $option_name ) ) {
			$tri_custom_sidebars = get_tri_stored_sidebar();
			$tri_custom_sidebars[] = trim( $new_sidebar );
			$result = update_option( $option_name, $tri_custom_sidebars );
		} else {
			$tri_custom_sidebars[] = $new_sidebar;
			$result2 = add_option( $option_name, $tri_custom_sidebars );
		}
		if ( $result ){ die( 'Updated' ); }
		elseif ( $result2 ){ die( 'added' ); }
		else { die('error' ); }
	}
}
add_action( 'wp_ajax_tri_add_sidebar', 'tri_add_sidebar' );

/**
 * Function for deleting sidebar (AJAX action)
 */
if ( !function_exists( 'tri_delete_sidebar' ) ) {
	function tri_delete_sidebar(){
		$option_name = 'tri_custom_sidebars';
		$del_sidebar = trim( $_GET['tri_sidebar_name'] );

		if ( get_option( $option_name ) ) {
			$tri_custom_sidebars = get_tri_stored_sidebar();

			foreach( $tri_custom_sidebars as $key => $value ){
				if ( $value == $del_sidebar ){
					unset( $tri_custom_sidebars[$key] );
				}
			}
			$result = update_option( $option_name, $tri_custom_sidebars );
		}

		if ( $result ) { die( 'Deleted' ); }
		else { die( 'error' ); }
	}
}
add_action( 'wp_ajax_tri_delete_sidebar', 'tri_delete_sidebar' );

/**
 * Function for registering previously stored sidebars
 */
if ( !function_exists( 'tri_register_stored_sidebar' ) ) {
	function tri_register_stored_sidebar(){
		$tri_custom_sidebars = get_tri_stored_sidebar();
		if ( is_array( $tri_custom_sidebars ) ) {
			foreach( $tri_custom_sidebars as $name ){
				register_sidebar( array(
					'name' => $name,
					'id' => $name,
					'class' => 'tri_custom_sidebar',
					'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
				) );
			}
		}
	}
}
add_action( 'widgets_init', 'tri_register_stored_sidebar' );

/**
 * Function gets stored sidebar array
 */
if ( !function_exists( 'get_tri_stored_sidebar' ) ) {
	function get_tri_stored_sidebar(){
		$option_name = 'tri_custom_sidebars';
		$custom_sidebars = get_option( $option_name, false );
		$sidebars = array();
		if ($custom_sidebars) {
			foreach ($custom_sidebars as $sidebar) {
				$sidebars[$sidebar] = strtolower( $sidebar );
			}
		}
		return $sidebars;
	}
}

/**
 * Add form after all widgets
 */
if ( !function_exists( 'tri_sidebar_form' ) ) {
	function tri_sidebar_form(){ ?>
		<form action="<?php echo admin_url( 'widgets.php' ); ?>" method="post" id="tri_add_sidebar_form">
			<h2>Create Custom Sidebar</h2>
			<?php wp_nonce_field( 'tri-add-sidebar-widgets', '_wpnonce_tri_widgets', false ); ?>
			<input type="text" class="regular-text" placeholder="Name the sidebar" name="tri_sidebar_name" id="tri_sidebar_name" />
			<button type="submit" class="button-primary" value="add-sidebar">Add Sidebar</button>
		</form>
		<?php
	}
}
add_action( 'sidebar_admin_page', 'tri_sidebar_form', 30 );