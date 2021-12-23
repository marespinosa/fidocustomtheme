<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Tri Theme
 * @version Tri 1.0
 */
// Dont display if no sidebar
if ( 'none' == get_tri_layout('sidebar_position') ) {
	return;
}

do_action( 'tri_sidebar_before' ); ?>
<div id="secondary" class="widget-area sidebar col-12 col-lg-3 <?php tri_layout('sidebar_position'); ?>" role="complementary">
	<?php do_action( 'tri_sidebar_inside_before' );

	dynamic_sidebar( get_tri_layout('sidebar') );

	do_action( 'tri_sidebar_inside_after' ); ?>
</div>
<?php do_action( 'tri_sidebar_after' );