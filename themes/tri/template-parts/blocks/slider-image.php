<!-- Slider Image -->
<?php

/**
 * Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'slider-' . $block['id'];
$id = ( !empty( $block['anchor'] ) ) ? $block['anchor'] : $id;

// Create class attribute allowing for custom "class" value.
$class = 'slider mb-5 mt-4';
$class .= ( !empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$class .= ( !empty($block['align'] ) ? ' align' . $block['align'] : '' );
$class .= ( $is_preview ? ' is-admin' : '' );

// Add animations
$animation = get_field('animate');
if ( $animation ) {
	$class .= ' animate show-on-scroll ' . $animation;
} ?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
    <?php if( have_rows('slides') ): ?>
		<div class="tri-slider owl-carousel owl-theme">
			<?php while( have_rows('slides') ): the_row();
				$image = get_sub_field('image');
				echo wp_get_attachment_image( $image['id'], 'full' );
			endwhile; ?>
		</div>
	<?php elseif( $is_preview ): ?>
		<p>Add slides on the right.</p>
	<?php endif; ?>
</div>
<!-- End Slider Image -->