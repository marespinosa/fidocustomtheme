<?php
/**
 * The page that will display the content on a sinlge page. ie. a blog post
 *
 * @package Tri Theme
 * @version Tri 1.0
 */
get_header(); ?>
<div id="primary" class="container content-area mt-4 mb-4">
	<div class="row center no-gutters">

	<main id="main" class="col-12 <?php tri_layout('main_column_size'); ?>">
		<?php while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_format() );

			// Previous/next post navigation.
			if ( is_singular( 'post' ) ) {
				the_post_navigation( array(
					'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="tricon">' . tri_get_svg( 'arrow_back' ) . '</i></span>' .
						'<span class="sr-only">' . __( 'Previous post:', 'tri' ) . '</span>' .
						'<span class="post-title">%title</span>',
					'next_text' => '<span class="sr-only">' . __( 'Next post:', 'tri' ) . '</span>' .
						'<span class="post-title">%title</span>' .
					'<span class="meta-nav" aria-hidden="true"><i class="tricon">' . tri_get_svg( 'arrow_forward' ) . '</i></span>'
				) );
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

		endwhile; ?>
	</main>

	<?php get_sidebar(); ?>

	</div>
</div>
<?php get_footer();