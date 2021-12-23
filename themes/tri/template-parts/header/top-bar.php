<?php
/**
 * The header top bar that gets added into the theme if there are widgets set. Used in header.php
 *
 * @package Tri Theme
 * @version Tri 1.0
 */

if ( is_active_sidebar( 'header-left-sidebar' ) || is_active_sidebar( 'header-right-sidebar' ) ) { ?>
	<div class="tri-top-bar">
		<div class="container">
			<div class="row">
				<div class="col tri-top-bar-left">
					<?php dynamic_sidebar( 'header-left-sidebar' ); ?>
				</div>
				<div class="col tri-top-bar-right text-right">
					<?php dynamic_sidebar( 'header-right-sidebar' ); ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>