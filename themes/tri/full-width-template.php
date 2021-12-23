<?php
/**
*  Template Name: Full width
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


<div class="regular-page-header">
	<div class="container"><h1><?php the_title(); ?></h1></div>
</div> 

<div id="primary" class="container content-area full-width">
	<div class="row center no-gutters">
			
		<main id="main" class="col-12">		
			<?php while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop. ?>
		</main>

	</div>
</div>

<?php get_footer(); ?>