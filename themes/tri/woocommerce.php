<?php
/**
 * Display all woocommerce content.
 *
 * @version 2.1
 */
get_header(); ?>

<div id="primary" class="container content-area">
	<div class="row">

		<main id="main" class="col-12 <?php tri_layout('main_column_size'); ?>">
			<?php woocommerce_content(); ?>
		</main>

		<?php get_sidebar(); // If right sidebar, display it ?>

	</div>
</div>

<?php get_footer(); ?>