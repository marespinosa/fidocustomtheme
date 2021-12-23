<?php
/**
 * The template part for displaying results in search pages
 *
 * @package Tri Theme
 * @version Tri 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php tri_post_thumbnail();

		// Post Title
		the_title( sprintf( '<h2 class="entry-title h3 mb-3 mb-sm-2"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>

	<div class="entry-content"><?php the_excerpt(); ?></div>

	<?php tri_entry_footer(); ?>
</article>