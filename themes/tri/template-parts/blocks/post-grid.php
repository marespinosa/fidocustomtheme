<!-- Post Grid -->
<?php

/**
 * postgrid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'postgrid-' . $block['id'];

// Create class attribute allowing for custom "className" value.
$class = 'post-feed row';
$class .= ( !empty( $block['className'] ) ? ' ' . $block['className'] : '' );

$columns = ( 12 / get_field('columns') );

// Add animations
$animation = get_field('animate');
if ( $animation ) {
	$animation .= ' animate show-on-scroll';
}

// Query Args
$query = new WP_Query( array(
	'post_type' => get_field('post_type'),
	'post_status' => 'publish',
	'posts_per_page' => get_field('count')
) );

// Loop through Custom Post Type items
if ( $query->have_posts() ) : $i = 1; ?>
	<div class="<?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $id ); ?>">
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<div class="post-feed-item col-12 mb-4 mb-sm-4 col-md-<?php echo $columns . ' ' . $animation; ?> delay-<?php echo $i; ?>">
				<div class="card <?php the_field('shadow'); ?>">

					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('medium_large'); ?>
						</a>
					<?php endif; ?>

					<div class="card-body">
						<a href="<?php the_permalink(); ?>" class="card-title stretched-link">
							<?php the_title('<h3 class="h6">', '</h3>'); ?>
						</a>
						<div class="card-text"><?php the_excerpt(); ?></div>
					</div>

				</div>
			</div>
			<?php $i = ( $i >= get_field('columns') ? 1 : $i + 1 );
		endwhile; ?>
	</div>
<?php endif;
wp_reset_postdata(); ?>
<!-- End: Post Grid -->