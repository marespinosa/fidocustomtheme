<?php
/**
 * Shortcode functions
 *
 * @package Tri Theme
 * @version Tri 1.0
 */


/* Email link
 *
==============================================================================*/
// [email email=""]
function trisense_email_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'email' => '',
		'class' => ''
	), $atts );

	if ( ! is_email( $a['email'] ) ) { return; }

	// Add additional classes
	if( $a['class'] ) {
		$a['class'] = ' ' . esc_attr( $a['class'] );
	}

	// Output shortcode
	return '<a class="tri-email' . $a['class'] . '" itemprop="email" href="mailto:' . antispambot( trim( $a['email'] ) ) . '">' . antispambot( esc_html( $a['email'] ) ) . '</a>';
}
add_shortcode( 'email', 'trisense_email_shortcode' );


/* Phone link
 *
==============================================================================*/
// [phone number=""]
function trisense_phone_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		'number' => '',
		'class' => ''
	), $atts );

	// Add additional classes
	if( $a['class'] ) {
		$a['class'] = ' ' . esc_attr( $a['class'] );
	}

	// Output shortcode
	return '<a class="tri-phone' . $a['class'] . '" itemprop="telephone" href="tel:' . esc_attr( preg_replace('/\s+/', '', $a['number'])  ) . '">' . esc_html( $a['number'] ) . '</a>';
}
add_shortcode( 'phone', 'trisense_phone_shortcode' );

function trisense_icon_shortcode( $atts ) {
	$type = isset( $atts['type'] ) ? $atts['type'] : 'material';
	$size = isset( $atts['size'] ) ? $atts['size'] : 'md';
	return tri_get_icon( $atts['icon'], $size, $type );
}
add_shortcode( 'icon', 'trisense_icon_shortcode' );



add_shortcode( 'slider-list','hero_slider_carousel_custom' );

function hero_slider_carousel_custom ( $atts ) {

  $contentview = '';
  $atts = shortcode_atts( array(
    'category' => ''
  ), $atts );
    $terms = get_terms('category');
    
	wp_reset_query();
    $args = array('post_type' => 'hero_slider_carousel',
      'tax_query' => array(
        array(
          'taxonomy' => 'category',
          'field' => 'slug',
          'terms' => $atts,
        ),
      ),
     );
     
	$query = new WP_Query($args);
	
	$formshortcode = do_shortcode('[gravityform id="5" title="true" description="true"]');
	$form_mobile = do_shortcode( '[gravityform id="6" title="false" description="false" ajax="true"]' );

    if($query->have_posts()) :
 
        while($query->have_posts()) :

            $query->the_post() ;
                     
        $contentview .= '<div class="hero-item" >';
        $contentview .= '<div id="js-drawer" class="Drawer" hidden>';
		$contentview .= '<div class="new-desc"><div class="new-desc-inner">' .  get_field("contentdescp") . '</div></div>'; 
        $contentview .= '' . $formshortcode . '';
		$contentview .= '<button class="Button js-close-button"></button>';
        $contentview .= '</div>';
		$contentview .= '<div class="hero-desc"><div class="inner-desc-wrap">' . get_the_content() . '</div>'; 
		$contentview .= '<div class="mobile-apply-now">' .  get_field("mobile_view_apply_now") . '</div>';
		
		$contentview .= ' <div id="ex1" class="modal">';
		$contentview .= '<div class="modal-content">' . $form_mobile . '</div>';
        $contentview .= '</div>';
		
		$contentview .= '</div>';
		$contentview .= '<div class="hero-thumbnail">' . get_the_post_thumbnail() . '</div>';
        $contentview .= '</div>';
 

        endwhile;
 
        wp_reset_postdata();
 
    endif;    
 
    return $contentview;            
}


add_shortcode( 'testimonial-list','testimonial_two_columns' );



function testimonial_two_columns ( $attributes ) {

   $result='';
   $attributes = array(
                    'post_type'      => 'testimonial',
                    'posts_per_page' => '10',
                    'publish_status' => 'published',
                 );
 
    $query = new WP_Query($attributes);
 
    if($query->have_posts()) :
 
        while($query->have_posts()) :

            $query->the_post() ;
		
        $result .= '<div id="testimonial-slider">';
		$result .= '<div class="rating">' . get_field('field_rate_review') . '</div>'; 
        $result .= '<div class="testimonial-desc">' . get_the_content() . '</div>'; 
		$result .= '<div class="featured-image">' . get_the_post_thumbnail() . '</div>';
        $result .= '<div class="testimonial-name"><span>' . get_field('field_testimname') . '</span> <br/>' . get_field('field_testimcomp') . '</div>'; 
        $result .= '</div>';
 
        endwhile;
 
        wp_reset_postdata();
 
    endif;    
 
    return $result;           

}


