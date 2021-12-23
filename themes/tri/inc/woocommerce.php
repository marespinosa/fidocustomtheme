<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package tri
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function tri_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'tri_woocommerce_setup' );


/**
 * Remove the shops "title" on the main shop page
 */
add_filter( 'woocommerce_show_page_title' , '__return_false' );


/**
 * Remove Showing results count display
*/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );


/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function tri_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	// woocommerce shop columns
	if ( is_woocommerce() ) {
		$classes[] = 'columns-' . tri_woocommerce_loop_columns();
	}

	return $classes;
}
add_filter( 'body_class', 'tri_woocommerce_active_body_class' );


/**
 * Products per page.
 *
 * @return integer number of products.
 */
function tri_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'tri_woocommerce_products_per_page' );


/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function tri_woocommerce_thumbnail_columns() {
	return 3;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'tri_woocommerce_thumbnail_columns' );


/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function tri_woocommerce_loop_columns() {
	return get_theme_mod( 'woocommerce_product_columns', 3 );
}
add_filter( 'loop_shop_columns', 'tri_woocommerce_loop_columns' );


/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function tri_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => get_theme_mod( 'woocommerce_related_products', 3 ),
		'columns'        => get_theme_mod( 'woocommerce_related_products', 3 ),
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'tri_woocommerce_related_products_args' );
