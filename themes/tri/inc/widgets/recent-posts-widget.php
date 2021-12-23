<?php
/**
 * A widget that is similar to the default recent posts widget but has more functionality such as post thumbnails.
 *
 * @version 2.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Tri_Recent_Posts_Widget extends WP_Widget {

	protected $widget_slug = 'tri-recent-posts';

	public function __construct() {

		parent::__construct(
			$this->get_widget_slug(),
			__( 'Tri - Recent Posts', 'tri' ),
			array(
				'classname'		=> $this->get_widget_slug() . '-class',
				'description'	=> __( 'Displays the title and thumbnail of the most recent posts', 'tri' )
			)
		);
	}

	/**
	 * Return the widget slug.
	 */
	public function get_widget_slug() {
		return $this->widget_slug;
	}


	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Posts', 'tri' ) : $instance['title'] );
		echo $before_widget . $before_title . $title . $after_title;

		// Get the recent posts
		$args = 'posts_per_page=' . $instance['numposts'];
		if ( !empty( $instance['cat'] ) ) $args .= '&cat=' . $instance['cat'];
		if ( !empty( $instance['tag'] ) ) $args .= '&tag=' . $instance['tag'];
		$the_query = new WP_Query( $args );

		// Run the loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post(); ?>
				<a href="<?php the_permalink(); ?>" class="row middle no-gutters mb-2 mb-sm-2" title="<?php the_title_attribute(); ?>">
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="col-4 col-lg-3 mr-3 mr-sm-2">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</div>
					<?php } ?>
					<div class="col small"><?php the_title(); ?></div>
				</a>
			<?php }
			echo $after_widget;
		}
		wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['numposts'] = $new_instance['numposts'];
		$instance['cat'] = $new_instance['cat'];
		$instance['tag'] = $new_instance['tag'];
		return $instance;
	}

	function form( $instance ) {
		// Widget defaults
		$instance = wp_parse_args( ( array ) $instance, array(
			'title' => 'Recent Posts',
			'numposts' => 3,
			'cat' => 0,
			'tag' => ''
		) ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tri' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'numposts' ); ?>"><?php _e( 'Number of posts to show:', 'tri' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'numposts' ); ?>" name="<?php echo $this->get_field_name( 'numposts' ); ?>" type="number" value="<?php echo $instance['numposts']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cpt' ); ?>"><?php _e( 'Choose post type: ', 'tri' );
				$post_types = get_post_types( array( 'public' => true, '_builtin' => false ) ); ?><br />
				<select name="cpt"><?php foreach ( $post_types  as $post_type ) {
					echo '<option value="post" ' . selected( $instance['cpt'], 'post' ) . '>Post</option>';
					echo '<option value="page" ' . selected( $instance['cpt'], 'page' ) . '>Page</option>';
					echo '<option value="' . $post_type . '" ' . selected( $instance['cpt'], $post_type ) . '>' . ucwords( $post_type ) . '</option>';
				} ?></select>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Limit to post category: ', 'tri' );
				wp_dropdown_categories( array(
					'name' => $this->get_field_name( 'cat'),
					'show_option_all' => __('None (all categories)', 'tri'),
					'hide_empty' => 0,
					'hierarchical' => 1,
					'selected' => $instance['cat']
				) ); ?>
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tag' ); ?>"><?php _e( 'Limit to post tags:', 'tri' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tag' ); ?>" name="<?php echo $this->get_field_name( 'tag' ); ?>" type="text" value="<?php echo $instance['tag']; ?>" />
			<br /><small><?php _e( 'Enter tags separated by commas (" tag 1,tag 2 ")', 'tri' ); ?></small>
		</p>
	<?php }
}

function tri_register_recent_posts_widget() {
	register_widget( 'Tri_Recent_Posts_Widget' );
}
add_action( 'widgets_init', 'tri_register_recent_posts_widget' );