<?php
/**
*  Template Name: Landing Page
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

<div id="primary" class="container content-area ">
	<div class="row center no-gutters">

		<main id="main" class="col-12">
			<?php while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );
					

			endwhile; // End of the loop. ?>
			
			
		<div id="ex1" class="modal">
			<div class="modal-content"><?php echo do_shortcode( '[gravityform id="6" title="false" description="false" ajax="true"]' ); ?></div>
		</div>
			
			
			
		</main>

	</div>
</div>

<?php get_footer(); ?>