<!-- CTA Footer -->
<?php $footer_cta = get_field('footer_cta', get_the_ID());
if( $footer_cta && ( '' != $footer_cta['heading'] || '' != $footer_cta['paragraph'] ) ): ?>
	<div class="alignfull mt-5 pt-5 pt-sm-5 pb-5 pb-sm-5">
		<div class="container">
			<div class="row middle center text-center">
				<div class="col-12 col-md-8">
					<p class="h1"><?php the_field('footer_cta_heading'); ?></p>
					<?php the_field('footer_cta_paragraph'); ?>

					<?php $link = get_field('footer_cta_button');
					if( $link ):
					    $link_target = $link['target'] ? $link['target'] : '_self'; ?>
					    <div class="wp-block-button is-style-fill">
							<a class="wp-block-button__link" href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link['title'] ); ?></a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<!-- END CTA Footer -->