<!-- Popup -->
<?php
/**
 * Popup Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = ( get_field('id') ? get_field('id') : 'popup-' . $block['id'] );

// Create class attribute allowing for custom "className" value.
$class = '';
$class .= ( !empty( $block['className'] ) ? ' ' . $block['className'] : '' );

// Add animations
$animation = get_field('animate');
if ( $animation ) {
	$class .= ' animate show-on-scroll ' . $animation;
}

$title = get_field('title');

if( have_rows('content_type') ): ?>
	<?php while( have_rows('content_type') ): the_row(); ?>

		<?php if( get_row_layout() == 'video' ): ?>
			<a href="<?php the_sub_field('youtube'); ?>" id="<?php echo esc_attr( $id ); ?>" class="is-popup-media<?php echo $class; ?>"><?php echo esc_html( $title ); ?></a>

		<?php elseif( get_row_layout() == 'wysiwyg' ): ?>
			<a href="#<?php echo esc_attr( $id ); ?>" class="is-popup-link<?php echo $class; ?>"><?php echo esc_html( $title ); ?></a>
			<div id="<?php echo esc_attr( $id ); ?>" class="tri-popup mfp-hide"><?php echo the_sub_field('content'); ?></div>
		<?php endif; ?>

	<?php endwhile; ?>
<?php endif; ?>
<!-- End: Popup -->