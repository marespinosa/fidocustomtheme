<!-- Team -->
<?php

/**
 * Team Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'team-' . $block['id'];
$id = ( !empty( $block['anchor'] ) ? $block['anchor'] : $id );

// Create class attribute allowing for custom "className" and "align" values.
$class = 'team';
$class .= ( !empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$class .= ( $is_preview ? ' is-admin' : '' );

// Add animations
$animation = get_field('animate');
if ( $animation ) {
	$class .= ' animate show-on-scroll ' . $animation;
} ?>

<div class="team-member text-center">
	<?php $image = get_field('image');
	if( $image ) { ?>
		<div class="photo">
	    	<?php echo wp_get_attachment_image( $image, 'medium_large', '', array( "class" => "rounded-circle" ) ); ?>
		</div>
	<?php }

	if( get_field('title') ) { ?>
		<p class="font-weight-bold mt-3 mb-0"><?php the_field('title'); ?></p>
	<?php }

	the_field('role'); ?>
</div>
<!-- End: Team -->