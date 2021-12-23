<?php
/**
 * A widget that shows your social media links.
 * You can add additional icons by following each step with the new icon. Feel free to suggest additions to us.
 *
 * @version 2.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !function_exists( 'tri_register_social_widget' ) ) {
	class Tri_Social_Widget extends WP_Widget {

		function __construct() {

			// Widget Options
			$opts = array(
				'classname'		=> 'tri-social-widget',
				'description'	=> __( 'Display your social connections as social icons', 'tri' )
			);
			parent::__construct( 'Tri_Social_Widget', __( 'Tri - Social Icons', 'tri' ), $opts );
		}


		// 1. HTML SECTION - This is where the order of the icons are set for the actual front-end of the website
		function widget( $args, $instance ) {
			extract( $args );

			echo $before_widget;
			if ( isset( $instance['title'] ) && !empty( $instance['title'] ) ) {
				echo $before_title . apply_filters( 'widget_title', $instance['title'] ) . $after_title;
			}

			echo'<ul class="widget-social list-inline list-unstyled ' . ( isset( $instance['background'] ) && !empty( $instance['background'] ) ? 'has-bg' : '' ) . '">';

			$social_profiles = get_tri_social_profiles();

			$i = 0;
			// Echo each social profile icon
			foreach ( $social_profiles as $key => $profile ) {

				if ( !empty( $instance[$key] ) ){

					$key = esc_attr( $key );
					$profile = esc_attr( $profile );
					$url = esc_url( $instance[$key] );

					// If is email, try to protect it from spam bots
					if ( 'email' == $key ) {
						$url = antispambot( $url );
					}

					// Add classes
					$class = 'tricon-bg rounded ' . $key;
					$class .= ( isset( $instance['background'] ) && !empty( $instance['background'] ) ? ' bg-' . $key : '' );
					$class .= ( $i > 0 ? ' ml-3 ml-sm-3' : '' );

					echo '<li><a href="' . $url . '" target="_blank" rel="noopener" title="Go to ' . $profile . '" class="' . $class . '"><i aria-hidden="true" class="tricon tricon-sm">' . tri_get_svg( $key, 'social-icons/' ) . '</i><span class="screen-reader-text">' . $profile . '</span></a></li>';
				}
				$i++;
			}

			echo '</ul>' . $after_widget;
		}

		// 2. This is where we're creating safe new instances for each social-link to be used on the backend.
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['background'] = strip_tags( $new_instance['background'] );

			$social_profiles = get_tri_social_profiles();

			// Go through each profile and make it safe
			foreach ( $social_profiles as $key => $profile ) {
				$key = esc_attr( $key );
				$instance[$key] = strip_tags( $new_instance[$key] );
			}
			return $instance;
		}


		// 3. This builds the form for the actual widget menu in the backend.
		function form( $instance ) { ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Heading:', 'tri' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php if ( isset( $instance['title'] ) ){ echo esc_attr( $instance['title'] ); } ?>" />
			</p>
			<p>
				<input class="checkbox" id="<?php echo $this->get_field_id( 'background' ); ?>" name="<?php echo $this->get_field_name( 'background' ); ?>" type="checkbox" value="<?php if ( isset( $instance['background'] ) ){ echo '1'; } ?>" <?php checked( $instance['background'], 1, 1 ); ?> />
				<label for="<?php echo $this->get_field_id( 'background' ); ?>"><?php _e( 'Add background to icons', 'tri' ); ?></label>
			</p>
			<p>
				<small><?php _e( 'Add your social links below. Only social icons with links assigned will be displayed.','tri' ); ?></small>
			</p>

			<?php $social_profiles = get_tri_social_profiles();

			foreach ( $social_profiles as $key => $profile ) {
				$key = esc_attr( $key );
				$profile = esc_attr( $profile ); ?>
				<p>
					<label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $profile; ?></label>
					<input class="widefat" placeholder="<?php echo $profile; ?>" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php if ( isset( $instance[$key] ) ){ echo esc_attr( $instance[$key] ); } ?>" />
				</p>

			<?php }
		}
	}
	function tri_register_social_widget() {
		register_widget( 'Tri_Social_Widget' );
	}
}
add_action( 'widgets_init', 'tri_register_social_widget' );