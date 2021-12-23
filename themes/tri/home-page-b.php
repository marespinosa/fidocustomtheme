<?php
/**
*  Template Name: Homepage B
 * The template for displaying all pages.
 *
 * The template that displays all pages by default. Please note that this is
 * the WordPress construct of pages and that other 'pages' on your WordPress
 * site will use a different template.
 *
 * @package Tri Theme
 * @version Tri 1.0
 */
 
get_header(); ?>

<div id="primary" class="container content-area">
	<div class="row center no-gutters">

		<main id="main" class="col-12 <?php tri_layout('main_column_size'); ?>" id="homepage-b">
			<?php while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop. ?>
		</main>

		<?php get_sidebar(); // If right sidebar, display it ?>

	</div>
</div>

<?php get_footer(); ?>