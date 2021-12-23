<?php
/**
 * The main template file.
 *
 * The most generic template file in the theme.
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Tri Theme
 * @version Tri 1.0
 */

get_header(); ?>
<div id="primary" class="container content-area mt-4 mb-4">
	<div class="row center no-gutters">

		<main id="main" class="col-12 <?php tri_layout('main_column_size'); ?>">

			<?php if ( is_home() ) { ?>
				<header class="entry-header">
					<h1 class="page-title" itemprop="headline"><?php single_post_title(); ?></h1>

					<?php // Add Breadcrumbs if installed by Yoast plugin and not disabled by page
					if ( function_exists( 'yoast_breadcrumb' ) ) {
						yoast_breadcrumb( '<div id="tri-breadcrumbs" class="mb-2">','</div>' );
					} ?>
				</header>
			<?php }

			if ( have_posts() ) :
				while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', get_post_format() );
				endwhile; ?>

				<?php the_posts_pagination( array(
					'prev_text' => '<i title="' . __( 'Previous page', 'tri' ) . '" class="tricon">' . tri_get_svg('arrow_back') . '</i><span class="screen-reader-text">' . __( 'Previous page', 'tri' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'tri' ) . '</span><i title="' . __( 'Next page', 'tri' ) . '" class="tricon">' . tri_get_svg('arrow_forward') . '</i>',
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'tri' ) . ' </span>',
				) );

			else :
				get_template_part( 'template-parts/content', 'none' );
			endif; ?>
		</main>

		<?php get_sidebar(); // If right sidebar, display it ?>

	</div>
</div>
<?php get_footer(); ?>