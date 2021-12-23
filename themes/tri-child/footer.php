<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package Tri Theme
 * @version Tri 1.0
 */
?>

		</div><?php // .site-content

		if ( !get_tri_layout('hide_footer') ) :

			do_action( 'tri_footer_before' ); ?>


<div class="popUp-box-footer"><?php dynamic_sidebar( 'footer-Box-popup' ); ?></div>


			<footer id="tri-footer" class="site-footer pt-5 pt-sm-4">

				<?php do_action( 'tri_footer_inner_before' );

				// Display the footer widgets if not disabled in settings

				// Get the footer attributes from the theme settings
				$footer_widgets = get_tri_footer_widgets();

				// Display the footer widget(s) based on how many is set in the settings
				if ( $footer_widgets ) { ?>
					<div class="container footer-widgets">
					
						<?php dynamic_sidebar('top-footer'); ?>
					
						<div class="row">
							<?php if ( is_active_sidebar( 'footer-widget' ) ) : ?>
								<div class="col-12 col-md footer-widget-1">
									<?php dynamic_sidebar( 'footer-widget' ); ?>
								</div>
							<?php endif;

							if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>
								<div class="col-12 col-md footer-widget-2">
									<?php dynamic_sidebar( 'footer-widget-2' ); ?>
								</div>
							<?php endif;

							if ( is_active_sidebar( 'footer-widget-3' ) ) : ?>
								<div class="col-12 col-md footer-widget-3">
									<?php dynamic_sidebar( 'footer-widget-3' ); ?>
								</div>
							<?php endif;

							if ( is_active_sidebar( 'footer-widget-4' ) ) : ?>
								<div class="col-12 col-md footer-widget-4">
									<?php dynamic_sidebar( 'footer-widget-4' ); ?>
								</div>
							<?php endif;

							if ( is_active_sidebar( 'footer-widget-5' ) ) : ?>
								<div class="col-12 col-md footer-widget-5">
									<?php dynamic_sidebar( 'footer-widget-5' ); ?>
								</div>
							<?php endif;  ?>
							
							
						</div>
					</div>
				<?php }

				do_action( 'tri_subfooter_before' );

				if ( !get_theme_mod( 'subfooter' ) ) { ?>

					<div id="subfooter" class="mt-4 mt-sm-3">
						<div class="container small-font pt-4 pb-4 pt-sm-4 pb-sm-4">
							<div class="row">
								<div class="col-12 col-md-9 text-sm-center subfooter-left">
									<?php
									do_action( 'tri_subfooter_left' );
									if ( has_nav_menu( 'footer_nav' ) ) {
										wp_nav_menu( array(
											'theme_location'	=> 'footer_nav',
											'container'			=> '',
											'menu_class'		=> 'footer-menu list-inline mr-4'
										) );
									} ?>
								</div>
								<div class="col-12 col-md-3 subfooter-right text-sm-center text-left">
									<?php dynamic_sidebar('copyrights'); ?>
								</div>
							</div>
						</div>
					</div>
				<?php do_action( 'tri_subfooter_after' );
				} ?>

			</footer>
		<?php endif; // end hide_footer IF ?>

	</div><?php // .site ?>
	
	<div id="site-overlay"></div>
	
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/heroslider-customcode.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<script>
		$('.toggle').click(function(e) {
		e.preventDefault();
	  
		var $this = $(this);
	  
		if ($this.next().hasClass('show')) {
			$this.next().removeClass('show');
			$this.next().slideUp(350);
		} else {
			$this.parent().parent().find('li .inner').removeClass('show');
			$this.parent().parent().find('li .inner').slideUp(350);
			$this.next().toggleClass('show');
			$this.next().slideToggle(350);
		}
	});
	</script>
	
	<?php wp_footer(); ?>
</body>
</html>