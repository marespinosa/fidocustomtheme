<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Tri Theme
 * @version Tri 1.0
 */

get_header(); ?>

<div id="primary" class="container content-area">
	<main id="main">

		<section class="error-404 not-found">

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try searching for what you\'re looking for?', 'tri' ); ?></p>

				<?php get_search_form(); ?>

				<div class="row mt-3">
					<div class="col">
						<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
					</div>

					<div class="widget widget_categories col">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'tri' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'		=> 'count',
								'order'			=> 'DESC',
								'show_count'	=> 0,
								'title_li'		=> '',
								'number'		=> 10,
							) );
						?>
						</ul>
					</div>

				</div>

				<div class="row mt-3">
					<div class="col">
						<?php the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>" ); ?>
					</div>
					<div class="col">
						<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
					</div>
				</div>

			</div>
		</section>

	</main>
</div>

<?php get_footer(); ?>