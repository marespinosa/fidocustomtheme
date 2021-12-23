<?php
/**
 * Default header for displaying logo and main nav side by side each-other. Used in header.php
 *
 * @package Tri Theme
 * @version Tri 1.0
 */
?>

<header id="tri-header" class="pt-1 pb-1 pt-sm-1 pb-sm-1">
	<?php // Get the topbar above the header
		get_template_part( 'template-parts/header/top-bar' ); ?>
	<div class="container">
		<div id="tri-navbar" class="row middle between no-gutters">
			<div id="logo" class="col-auto mt-1 mb-1 mt-sm-1 mb-sm-1"><?php tri_brand_logo(); ?></div>

			<?php // Add main menu
			wp_nav_menu( array(
				'theme_location' => 'main_nav',
				'container' => 'nav',
				'container_id' => 'tri-menu',
				'container_class' => 'col-md-auto'
			) ); ?>

			<div id="nav-btns">
				<?php // If phone in menu, add button
				if ( get_theme_mod( 'mobile_phone' ) ) { ?>
					<a href="tel:<?php echo esc_attr( get_theme_mod( 'mobile_phone' ) ); ?>" class="nav-btn mobile-call">Phone <?php echo esc_attr( get_theme_mod( 'mobile_phone' ) ); ?></a>
				<?php } ?>

				<button type="button" id="mobile-menu-toggle" class="nav-btn"><?php _e('Menu', 'tri'); ?></button>
			</div>
		</div>
	</div>
</header>