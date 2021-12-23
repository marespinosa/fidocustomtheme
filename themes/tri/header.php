<?php
/**
 * The Header for our theme.
 * Displays all of the <head> and <header> section and start of wrapper for mobile menu
 *
 * @package Tri Theme
 * @version Tri 1.0
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class('bg-white'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link sr-only js-scroll" href="#content"><?php esc_html_e( 'Skip to content', 'tri' ); ?></a>
	<?php // Get the header/nav/logo part
	if ( 'simple' == get_tri_layout('layout_header') ) {
		// Logo only header
		get_template_part( 'template-parts/header/nav', 'logo-only' );
	} elseif ( 'under' == get_theme_mod( 'menu_position' ) ) {
		// Header with nav underneath
		get_template_part( 'template-parts/header/nav', 'underneath' );
	} elseif ( 'none' != get_tri_layout('layout_header') ) {
		// Header with nav next to it
		get_template_part( 'template-parts/header/nav', 'adjacent' );
	} ?>
	<div id="content" class="site-content">