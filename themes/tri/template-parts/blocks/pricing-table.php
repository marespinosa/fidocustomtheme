<!-- Pricing Table -->
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

// Display Pricing Table ?>
<div class="text-center pricing-table mt-3 mb-3 <?php echo $class; ?>">
	<div class="box-shadow-hover position-relative">
		<div class="pricing-details pt-3 pb-3">
			<p class="h5"><?php the_field('title'); ?></p>
			<small>from</small>
			<p class="h1">$<?php the_field('price'); ?>*</p>
			<small>per month</small>
		</div>
		<div class="pricing-features pt-3 pb-3">
			<p class="font-weight-bold">Top Features</p>
			<?php if ( have_rows( 'features' ) ):
				while ( have_rows( 'features' ) ): the_row(); ?>
					<p class="mb-2"><?php tri_icon( 'check', 'sm mr-2' ); ?> <?php the_sub_field('feature'); ?></p>
				<?php endwhile;
			endif;

			$link = get_field('link');
			if( $link ):
			    $link_target = $link['target'] ? $link['target'] : '_self'; ?>
				<a class="btn btn-outline text-uppercase mt-3 stretched-link" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
			<?php endif; ?>
			<p class="mt-2">*exc GST</p>
		</div>
	</div>
</div>
<!-- End: Pricing Table -->