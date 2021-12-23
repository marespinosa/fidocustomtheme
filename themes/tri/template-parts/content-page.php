<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Tri Theme
 * @version Tri 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry-content'); ?>>
	<?php the_content();

	wp_link_pages( array(
		'before'	=> '<div class="page-links">' . esc_html__( 'Pages:', 'tri' ),
		'after'		=> '</div>',
	) );

	// Optionally add content at end of each page
	do_action( 'tri_end_of_page' ); ?>
</article>