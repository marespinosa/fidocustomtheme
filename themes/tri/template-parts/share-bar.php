<?php
/**
 * The social media share bar that floats on the left of each single blog post.
 *
 * @package Tri Theme
 * @version Tri 1.0
 */
?>

<div id="tri-sharebar" class="text-sm-center text-center bg-white">
	<p class="text-uppercase share-title small mb-0 font-weight-bold text-grey text-shadow-white d-inline-block"><?php _e( 'Share', 'tri' ); ?></p>
	<a class="js-open-window bg-facebook animate fadeInLeft show-on-scroll delay-2 ml-sm-2 pt-2 pb-2 pt-sm-3" href="https://www.facebook.com/sharer/sharer.php?href=<?php echo urlencode( get_permalink() ) . '&amp;t=' . urlencode( strip_tags( get_the_title() ) ); ?>" title="<?php esc_attr_e( 'Share on Facebook', 'tri' ); ?>" target="_blank" rel="noopener noreferrer">
		<?php tri_svg( 'facebook', 'social-icons' ); ?><span class="sr-only">Share <?php the_title(); ?> on Facebook</span>
	</a>
	<a class="js-open-window bg-twitter animate fadeInLeft show-on-scroll delay-3 ml-sm-2 pt-2 pb-2 pt-sm-3" href="https://twitter.com/intent/tweet?text=<?php echo urlencode( strip_tags( get_the_title() ) ) .'%20'. urlencode( get_permalink() ); ?>" title="<?php esc_attr_e( 'Share on Twitter', 'tri' ); ?>" target="_blank" rel="noopener noreferrer">
		<?php tri_svg( 'twitter', 'social-icons' ); ?><span class="sr-only">Share <?php the_title(); ?> on Twitter</span>
	</a>
	<a class="js-open-window bg-linkedin animate fadeInLeft show-on-scroll delay-4 ml-sm-2 pt-2 pb-2 pt-sm-3" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode( get_permalink() ) . '&amp;title=' . urlencode( strip_tags( get_the_title() ) ) . '&amp;source=' . urlencode( get_bloginfo( 'name' ) ); ?>" title="<?php esc_attr_e( 'Share on Linkedin', 'tri' ); ?>" target="_blank" rel="noopener noreferrer">
		<?php tri_svg( 'linkedin', 'social-icons' ); ?><span class="sr-only">Share <?php the_title(); ?> on LinkedIn</span>
	</a>
</div>