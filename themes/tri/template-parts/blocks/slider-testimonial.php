<!-- Slider Testimonial -->
<?php
/**
 * testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'testimonial-' . $block['id'];
$id = ( !empty( $block['anchor'] ) ? $block['anchor'] : $id );

// Create class attribute allowing for custom "className" and "align" values.
$class = 'testimonial-slider';
$class .= ( !empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$class .= ( !empty( $block['align'] ) ? ' align' . $block['align'] : '' );
$class .= ( $is_preview ? ' is-admin' : '' );

// Add animations
$animation = get_field('animate');
if ( $animation ) {
	$class .= ' animate show-on-scroll ' . $animation;
}

// Get post objects
$post_objects = get_field('testimonial'); ?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?> row center">
	<?php if( $post_objects ): ?>
		<div class="col-12 col-md-8">
			<div class="testimonials owl-carousel owl-theme">
				<?php foreach( $post_objects as $post_object): ?>
					<div class="testimonial-item text-center text-sm-center">
						<div class="photo mb-3">
							<?php echo get_the_post_thumbnail( $post_object->ID, 'thumbnail', array( 'class' => 'rounded-circle w-auto aligncenter' ) ); ?>
						</div>
						<div class="content"><?php echo get_the_content( '', '', $post_object->ID ); ?></div>
						<strong><?php the_field('name', $post_object->ID); ?></strong>
						<p><?php the_field('company', $post_object->ID); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		</div>
	<?php elseif( $is_preview ): ?>
		<p>Please select which testimonials to show.</p>
	<?php endif; ?>
</div>
<!-- End: Slider Testimonial -->