<?php
/**
 * Alternative header for displaying logo and content side by side each-other and main nav underneath. Used in header.php
 * This is used when the theme options "Header layout" is set to "Logo and content side by side + menu underneath"
 *
 * @package Tri Theme
 * @version Tri 1.0
 */
?>

<header id="tri-header" class="pt-1 pb-1 pt-sm-1 pb-sm-1">
	<?php // Get the topbar above the header
		get_template_part( 'template-parts/header/top-bar' ); ?>
	<div class="container">
		<div class="row middle-md no-gutters">
			<div class="logo-container">
				<div id="logo"><?php tri_brand_logo(); ?></div>
			</div>
			<div class="col-md col-12 end-md">
				<?php do_action( 'tri_nav_content_area' );
				if ( is_active_sidebar( 'header-widget' ) ) :
					dynamic_sidebar( 'header-widget' );
				endif; ?>
			</div>
		</div>
	</div>
	<div class="tri-full-nav">
		<div class="container">
			<div class="row middle">
				<?php // Add main menu
				wp_nav_menu( array(
					'theme_location' => 'main_nav',
					'container' => 'nav',
					'container_id' => 'tri-menu',
					'container_class' => 'col'
				) ); ?>

				<div class="ml-auto d-md-none">
					<?php // If phone in menu, add button
					if ( get_theme_mod( 'mobile_phone' ) ) { ?>
						<a href="tel:<?php echo esc_attr( get_theme_mod( 'mobile_phone' ) ); ?>" class="nav-btn mobile-call">Phone <?php echo esc_attr( get_theme_mod( 'mobile_phone' ) ); ?></a>
					<?php } ?>

					<button type="button" id="mobile-menu-toggle" class="nav-btn"><?php _e('Menu', 'tri'); ?></button>
				</div>
			</div>
		</div>
	</div>
</header>