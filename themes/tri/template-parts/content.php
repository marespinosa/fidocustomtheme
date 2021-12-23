<?php
/**
 * Default template for displaying content. Used for single, index/archive/search
 *
 * @package Tri Theme
 * @version Tri 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-5 mb-sm-4' ); ?>>

	<header class="entry-header">
		<?php if ( is_single() ) {
			the_title('<h1 class="page-title" itemprop="headline">', '</h1>');

			// Add Breadcrumbs if installed by Yoast plugin and not disabled by page
			if ( function_exists( 'yoast_breadcrumb' ) ) {
				yoast_breadcrumb( '<div id="tri-breadcrumbs" class="mb-2">','</div>' );
			}

			// Page Thumbnail
			tri_post_thumbnail();
		} else {

			tri_post_thumbnail();
			the_title( sprintf( '<h2 class="entry-title h3 mb-3 mb-sm-2"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

		} ?>
	</header>

	<div class="entry-content">
		<?php if ( is_single() ) {
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tri' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="sr-only">"', '"</span>', false )
			) );
		} else {
			the_excerpt();
		}

		// Link Pages
		wp_link_pages( array(
			'before'	=> '<div class="page-links">' . esc_html__( 'Pages:', 'tri' ),
			'after'		=> '</div>',
		) );

		// Optionally add content at end of each post
		do_action( 'tri_end_of_post' ); ?>

	</div>

	<?php if ( is_single() ) {
		tri_entry_footer();
	}

	// Add share bar
	if ( is_singular( 'post' ) && !get_theme_mod( 'blog_share_bar' ) ) {
		get_template_part( 'template-parts/share-bar' );
	}

	// Author bio.
	if ( is_single() && is_singular( 'post' ) && get_the_author_meta( 'description' ) ) :
		get_template_part( 'template-parts/author-bio' );
	endif; ?>

</article>