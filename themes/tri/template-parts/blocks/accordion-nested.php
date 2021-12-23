<?php
/**
 * Nested Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */
 
// create id attribute for specific styling
$id = 'nested-accordion-' . $block['id'];
 
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}
 
// Create class attribute allowing for custom "className" and "align" values.
$className = 'nested_accordion_panel';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
 
//get repeater field name
if( have_rows('nested_accordion_panel') ): ?>
 
      
 <?php
        while ( have_rows('nested_accordion_panel') ) : the_row(); 
                    //vars
                    $child_title = get_sub_field('child_title');
                    $sub_title_acc = get_sub_field('sub_title_acc');
                    ?>
                 
                 
<div class="faq-wrappers">
<ul class="accordion-panel-toggle">

  <li class="accordion-nested-panel">
    <a class="toggle title-accord-top" href="javascript:void(0);"> 
		<h3><?php echo $child_title; ?></h3>
		<p><?php echo $sub_title_acc; ?></p>
	</a>
    <ul class="inner">
      <li>
	  
	   <?php if( have_rows('nested_accordion_box') ): ?>
							<?php while( have_rows('nested_accordion_box') ): the_row(); 
							$title_nested_box = get_sub_field('title_nested_box');
							$nested_content_box = get_sub_field('nested_content_box');  ?>
	  
        <a href="#" class="toggle nested-child-title"><?php echo $title_nested_box; ?></a>
        <div class="inner">
          <p>
            <?php echo $nested_content_box; ?>
          </p>
        </div>
			<?php endwhile; ?>
			<?php endif; ?>
		
		
      </li>
    </ul>
  </li>
  
  
</ul>
</div>

  <?php endwhile; ?>
        </div>
<?php endif; // end accordion ?>