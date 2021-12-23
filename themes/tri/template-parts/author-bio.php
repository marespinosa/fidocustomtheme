<?php
/**
 * The template for displaying Author bios
 *
 * @package Tri Theme
 * @version Tri 1.0
 */
?>

<div id="author-info" class="row no-gutters middle-md mt-4 mt-sm-4">
	<?php echo get_avatar( get_the_author_meta( 'ID' ), 110, 'mystery', get_the_author() ); ?>

	<div class="col">
		<h2 class="author-title h4">
			<?php esc_html_e( 'Published by', 'tri' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php echo get_the_author(); ?>
			</a>
		</h2>
		<p><?php the_author_meta( 'description' ); ?></p>
	</div>
</div>