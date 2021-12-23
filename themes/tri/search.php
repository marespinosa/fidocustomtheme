<?php
/**
 * The search page that displays the search results
 *
 * @package Tri Theme
 * @version Tri 1.0
 */

get_header(); ?>
<div id="primary" class="container content-area">
	<div class="row no-gutters">

	<main id="main" class="col-12 <?php tri_layout('main_column_size'); ?>">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'search' );
			endwhile;

			the_posts_pagination( array(
				'prev_text' => '<i title="' . __( 'Previous page', 'tri' ) . '" class="tricon">' . tri_get_svg('arrow_back') . '</i><span class="sr-only">' . __( 'Previous page', 'tri' ) . '</span>',
				'next_text' => '<span class="sr-only">' . __( 'Next page', 'tri' ) . '</span><i title="' . __( 'Next page', 'tri' ) . '" class="tricon">' . tri_get_svg('arrow_forward') . '</i>',
				'before_page_number' => '<span class="meta-nav sr-only">' . __( 'Page', 'tri' ) . ' </span>',
			) );

		else :
			get_template_part( 'template-parts/content', 'none' );
		endif; ?>
	</main>

	<?php get_sidebar(); // If right sidebar, display it ?>

	</div>
</div>
<?php get_footer(); ?>