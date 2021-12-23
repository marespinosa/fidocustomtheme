<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments and comment form.
 *
 * @package Tri Theme
 * @version Tri 1.0
 */

/*
 * If current post is protected by password and visitor has not yet entered password
 * return early without loading comments.
 */
if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="comments-area mt-4 mb-4 mt-sm-4 mb-sm-4">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title h4">
			<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One response to &ldquo;%s&rdquo;', 'comments title', 'tri' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s response to &ldquo;%2$s&rdquo;',
							'%1$s responses to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'tri'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2>

		<ol class="comment-list mt-4 mt-sm-4 mb-4 mb-sm-4 pl-0 pl-sm-0">
			<?php
				wp_list_comments( array(
					'style'			=> 'ol',
					'short_ping'	=> true,
					'avatar_size'	=> 60,
				) );
			?>
		</ol>

		<?php the_comments_pagination(
			array(
				'prev_text' => '<i title="Previous" class="tricon">' . tri_get_svg('arrow_back') . '</i><span class="sr-only">' . __( 'Previous', 'tri' ) . '</span>',
				'next_text' => '<span class="sr-only">' . __( 'Next', 'tri' ) . '</span><i title="Next Page" class="tricon">' . tri_get_svg('arrow_forward') . '</i>',
			)
		);

	endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'tri' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>