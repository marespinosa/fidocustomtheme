<!-- Accordion -->
<?php

/**
 * accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion-' . $block['id'];

// Create class attribute allowing for custom "className" value.
$class = '';
$class .= ( !empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$expanded = ( get_field('expanded') ? 'is-active' : '' );

// Add animations
$animation = get_field('animate');
if ( $animation ) {
	$class .= ' animate show-on-scroll ' . $animation;
} ?>

<div id="<?php echo esc_attr( $id ); ?>" class="tri-accord mb-3<?php echo esc_attr( $class ); ?>">
	<div class="accord-title font-weight-bold <?php echo $expanded; ?>">
		<?php tri_icon( 'add_circle_outline', 'sm mr-2 mr-sm-2' ); echo esc_html( get_field('title') ); ?>
	</div>
	<div class="accord-body <?php echo $expanded; ?>">
		<?php echo esc_html( get_field('content', false, false) ); ?>
	</div>
</div>
<!-- End: Accordion -->