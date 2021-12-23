<?php
/**
 * A widget that allows you to show contact details using icons.
 *
 * @version 2.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Tri_Contact_Info_Widget extends WP_Widget {

	protected $widget_slug = 'tri-contact-info';

	public function __construct() {

		parent::__construct(
			$this->get_widget_slug(),
			__( 'Tri - Contact Information', 'tri' ),
			array(
				'classname'		=> $this->get_widget_slug() . '-class',
				'description'	=> __( 'List your contact information with icons next to each contact field', 'tri' )
			)
		);
	}

	/**
	 * Return the widget slug.
	 */
	public function get_widget_slug() {
		return $this->widget_slug;
	}

// To add additional links, you'll need to add 4 new lines of code in each numbered section below.
// Review the code below to see where to add each of the 4 new lines
	public function widget( $args, $instance ) {
		extract( $args );
	// 1. Call contact information instances for front-end.
		$title		= apply_filters( 'widget_title', $instance['title'] );
		$address	= apply_filters( 'widget_address', $instance['address'] );
		$phone		= apply_filters( 'widget_phone', $instance['phone'] );
		$mobile		= apply_filters( 'widget_mobile', $instance['mobile'] );
		$email		= apply_filters( 'widget_email', $instance['email'] );
		$name		= apply_filters( 'widget_name', $instance['name'] );

		echo $before_widget;
		if ( !empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		echo'<ul class="contact-icons pl-5 pl-sm-5 list-unstyled">';
	// 2. HTML SECTION - This is where the order of the information is set for the front-end of the website - cut/paste each line if you want to change the order.
		// Address
		if ( !empty( $address ) ){
			echo '<li class="address pl-4 pl-sm-4"><i class="tricon tricon-sm mr-2 mr-sm-2">' . tri_get_svg('place') . '</i>' . $address . '</li>';
		}
		// Phone Number
		if ( !empty( $phone ) ){
			$tel = preg_replace('/\D/', '', $phone); // Remove all characters except numbers
			echo '<li class="phone pl-4 pl-sm-4"><i class="tricon tricon-sm mr-2 mr-sm-2">' . tri_get_svg('phone') . '</i><a href="tel:' . $tel . '" title="Call Us">' . $phone . '</a></li>';
		}
		// Mobile Number
		if ( !empty( $mobile ) ){
			$tel = preg_replace('/\D/', '', $mobile); // Remove all characters except numbers
			echo '<li class="mobile pl-4 pl-sm-4"><i class="tricon tricon-sm mr-2 mr-sm-2">' . tri_get_svg('phone_iphone') . '</i><a href="tel:' . $tel . '" title="Call Us">' . $mobile . '</a></li>';
		}
		// Email address
		if ( !empty( $email ) ){
			echo '<li class="email pl-4 pl-sm-4"><i class="tricon tricon-sm mr-2 mr-sm-2">' . tri_get_svg('mail_outline') . '</i><a href="mailto:' . antispambot( $email ) . '" title="Email">' . antispambot( $email ) . '</a></li>';
		}
		// Name
		if ( !empty( $name ) ){
			echo '<li class="user pl-4 pl-sm-4"><i class="tricon tricon-sm mr-2 mr-sm-2">' . tri_get_svg('person_outline') . '</i>' . $name . '</li>';
		}
		echo '</ul>' . $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
	// 3. Create new instances for each item to be used in the backend.
		$instance['title']		= strip_tags( $new_instance['title'] );
		$instance['address']	= strip_tags( $new_instance['address'] );
		$instance['phone']		= strip_tags( $new_instance['phone'] );
		$instance['mobile']		= strip_tags( $new_instance['mobile'] );
		$instance['email']		= strip_tags( $new_instance['email'] );
		$instance['name']		= strip_tags( $new_instance['name'] );
		return $instance;
	}

	// 4. This builds the form for the admin widget menu.
	function form( $instance ) { ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Heading:', 'tri' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php if ( isset( $instance['title'] ) ){ echo esc_attr( $instance['title'] ); } ?>" />
		</p>
		<p>
			<small><?php _e( 'Enter your details into each field. Only fields with values assigned will be displayed.', 'tri' ); ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Location or Address:', 'tri' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php if ( isset( $instance['address'] ) ){ echo esc_attr( $instance['address'] ); } ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Phone Number:', 'tri' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php if ( isset( $instance['phone'] ) ){ echo esc_attr( $instance['phone'] ); } ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'mobile' ); ?>"><?php _e( 'Mobile Phone:', 'tri' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'mobile' ); ?>" name="<?php echo $this->get_field_name( 'mobile' ); ?>" type="text" value="<?php if ( isset( $instance['mobile'] ) ){ echo esc_attr( $instance['mobile'] ); } ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email:', 'tri' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php if ( isset( $instance['email'] ) ){ echo esc_attr( $instance['email'] ); } ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Name:', 'tri' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php if ( isset( $instance['name'] ) ){ echo esc_attr( $instance['name'] ); } ?>" />
		</p>
	<?php }
}

function tri_register_contact_info_widget() {
	register_widget( 'Tri_Contact_Info_Widget' );
}
add_action( 'widgets_init', 'tri_register_contact_info_widget' );