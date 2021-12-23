<?php
/**
 * The template part for displaying a message when posts cannot be found.
 *
 * @package Tri Theme
 * @version Tri 1.0
 */

?>

<section class="no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title mb-3 mb-sm-2"><?php esc_html_e( 'Nothing Found', 'tri' ); ?></h1>
	</header>

	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf(
				/* translators: %1$s: the new post url */
				__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'tri' ),
				esc_url( admin_url( 'post-new.php' ) )
			); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'tri' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'tri' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</section>