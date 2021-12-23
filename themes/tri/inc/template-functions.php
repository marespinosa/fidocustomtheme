<?php
/**
 * Custom template functions to make shorthand work of simple features.
 *
 * @package Tri Theme
 * @version Tri 1.0
 */

/*******************************************************************************
	Icon - https://tri.web3.com.au/docs/#icon
*******************************************************************************/
// Return a Tri svg icon
function tri_get_svg( $icon = '', $icon_dir = 'material' ) {
	if ( empty( $icon ) ) {
		return;
	}
	if ( !isset( $icon_dir ) ) {
		$icon_dir = 'material';
	}

	// Get base directory
	if ( file_exists( get_stylesheet_directory() . '/assets/img/' . esc_attr( $icon_dir . '/' . $icon ) . '.svg' ) ) {
		$base_dir = get_stylesheet_directory();
	} elseif ( file_exists( get_template_directory() . '/assets/img/' . esc_attr( $icon_dir . '/' . $icon ) . '.svg' ) ) {
		$base_dir = get_template_directory();
	} else {
		return;
	}

	// Get Icons directory
	$icon_dir = ( $icon_dir ? $icon_dir . '/' : 'material/' );

	// Return icon
	ob_start();
	include $base_dir . '/assets/img/' . esc_attr( $icon_dir . $icon ) . '.svg';
	$file = ob_get_contents();
	ob_end_clean();
	return $file;
}

// Helper function to echo the returned svg icon
function tri_svg( $icon, $icon_dir = null ) {
	echo tri_get_svg( $icon, $icon_dir );
}

// Get Tri Icon wrapped in <i> tags
function tri_get_icon( $icon, $classes = null, $icon_dir = null ) {

	// Add classes and prefix with tricon-
	$builtin_icon_classes = array('sm', 'md', 'lg', 'xl', 'xxl', 'circle');
	$class = 'tricon tricon-' . esc_attr( $icon );

	if ( isset( $classes ) ) {
		$classes = explode(" ", $classes);
		foreach ($classes as $a) {
			if ( in_array($a, $builtin_icon_classes) ) {
				$class .= ' tricon-' . esc_attr( $a );
			} else {
				$class .= ' ' . esc_attr( $a );
			}
		}
	}

	return '<i class="' . $class . '" aria-hidden="true">' . tri_get_svg( $icon, $icon_dir ) . '</i>';
}

// Helper function to echo the returned svg icon and <i> tag
function tri_icon( $icon, $classes = null, $icon_dir = null ) {
	echo tri_get_icon( $icon, $classes, $icon_dir );
}


/*******************************************************************************
	Anti-Spam Email
*******************************************************************************/
function tri_antispam_email( $email = false ) {
	if ( is_email( $email ) ) : ?>
		<a class="tri-email" itemprop="email" href="mailto:<?php echo antispambot( trim( $email ) ); ?>">
			<?php echo antispambot( esc_html( $email ) ); ?>
		</a>
	<?php endif;
}


/*******************************************************************************
	Tap-to-call phone number
*******************************************************************************/
function tri_phone( $phone = false ) {
	if( $phone ) : ?>
		<a class="tri-phone" itemprop="telephone" href="tel:<?php echo esc_attr( preg_replace('/\s+/', '', $phone )  ); ?>">
			<?php echo esc_html( $phone ); ?>
		</a>
	<?php endif;
}