<!-- Count Up -->
<?php

/**
 * Count Up Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'count-up-' . $block['id'];

// Create class attribute allowing for custom "className" value.
$class = 'tri-count-up display-4 text-center text-uppercase';
$class .= ( !empty( $block['className'] ) ? ' ' . $block['className'] : '' );

// Add animations
$animation = get_field('animate');
if ( $animation ) {
	$class .= ' animate show-on-scroll ' . $animation;
}

$prefix = esc_html( get_field( 'count_prefix' ) );
$suffix = esc_html( get_field( 'count_suffix' ) );
$number = esc_attr( get_field( 'count_number' ) );
$duration = esc_attr( get_field( 'count_duration' ) );
?>

<div class="<?php echo esc_attr( $class ); ?>">
	<?php echo ( $prefix ) ? '<span class="count-prefix">' . $prefix . '</span>' : '';
	?><span class="count-number show-on-scroll" data-number="<?php echo $number; ?>" data-duration="<?php echo $duration; ?>">
		<span class="invisible">0</span>
	</span><?php
	echo ( $suffix ) ? '<span class="count-suffix">' . $suffix . '</span>' : ''; ?>
</div>
<!-- End: Count Up -->