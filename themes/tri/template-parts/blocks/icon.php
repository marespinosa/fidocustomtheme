<!-- Icon -->
<?php

/**
 * Icon Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" value.
$class = '';
$class .= ( !empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$class .= ( get_field('size') ? ' ' . get_field('size') : '' );
$class .= ( $is_preview ? ' is-admin' : '' );

// Add animations
$animation = get_field('animate');
if ( $animation ) {
	$class .= ' animate show-on-scroll ' . $animation;
}

// Display icon
if ( get_field('icon') ) {
	tri_icon( get_field('icon'), $class );
} elseif( $is_preview ) { ?>
	<a href="https://tri.web3.com.au/docs/icons/" target="_blank">Choose an icon</a> and add the name into the icon field
<?php } ?>
<!-- End: Icon -->