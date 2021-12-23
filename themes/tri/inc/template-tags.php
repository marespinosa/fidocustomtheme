<?php
/**
 * Custom template tags for this theme.
 *
 * @package Tri Theme
 * @version Tri 1.0
 */


if ( ! function_exists( 'tri_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function tri_posted_on() {

	// Get the author name; wrap it in a link.
	$byline = sprintf(
		/* translators: %s: post author */
		__( 'by %s', 'tri' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	// Finally, let's write all of this to the page.
	echo '<span class="posted-on">' . tri_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
}
endif;


if ( ! function_exists( 'tri_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function tri_time_link() {
	$time_string = '<time class="entry-date published updated" itemprop="datePublished" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" itemprop="datePublished" datetime="%1$s">%2$s</time><time class="updated" itemprop="dateModified" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	// Preface timestring with 'Posted on' text.
	return '<span class="sr-only">' . __( 'Posted on', 'tri' ) . '</span> ' . $time_string;
}
endif;


if ( ! function_exists( 'tri_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function tri_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'tri' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );

	// Get Tags for posts.
	$tags_list = get_the_tag_list( '', $separate_meta );

	// We don't want to output .entry-footer if it will be empty, so make sure its not.
	if ( ( $categories_list || $tags_list && 'post' === get_post_type() ) ) { ?>

		<footer class="post-foot pt-2 pt-sm-2 pb-2 pb-sm-2 mt-3 mt-sm-3 mb-5 mb-sm-4 txt-grey">
			<span class="cat-tags-links">

				<?php // Make sure there's more than one category before displaying.
				if ( $categories_list ) { ?>
					<span class="cat-links mr-3 mr-sm-3"><?php tri_icon('folder_open', 'sm mr-1 mr-sm-1'); ?><span class="sr-only"><?php echo __( 'Categories', 'tri' ); ?></span><?php echo $categories_list; ?></span>
				<?php }

				if ( $tags_list ) { ?>
					<span class="tags-links mr-3 mr-sm-3"><?php tri_icon('style', 'sm mr-1 mr-sm-1'); ?><span class="sr-only"><?php echo __( 'Tags', 'tri' ); ?></span><?php echo $tags_list; ?></span>
				<?php } ?>

				<span class="posted-on"><?php tri_icon('schedule', 'sm mr-1 mr-sm-1'); echo tri_time_link(); ?></span>

				<?php if( comments_open() ) { ?>
					<a href="#comments" class="js-scroll ml-3 ml-sm-3"><?php tri_icon('chat_bubble_outline', 'sm mr-1 mr-sm-1'); echo __( 'Add Comment', 'tri' ); ?></a>
				<?php } ?>
			</span>
		</footer>
	<?php }
}
endif;



/*************************************************************************************
	Display an optional post thumbnail.
**************************************************************************************/
if ( ! function_exists( 'tri_post_thumbnail' ) ) :
/**
 * Wraps post thumbnail in anchor element on index views, or div on single views
 */
function tri_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) : ?>

		<div class="post-thumbnail d-block mb-2 mb-sm-2">
			<?php the_post_thumbnail( 'large' ); ?>
		</div>

	<?php else : ?>

		<a class="post-thumbnail d-block mb-2 mb-sm-2" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'large' ); ?>
		</a>

	<?php endif; // End is_singular()
}
endif;
