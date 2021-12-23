<!-- Tabs -->
<?php
/**
 * Tab Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'tab-' . $block['id'];

// Create class attribute allowing for custom "className" value.
$class = '';
$class .= ( !empty( $block['className'] ) ? ' ' . $block['className'] : '' );
$class .= ( get_field('tab_style') ? ' is-' . get_field('tab_style') : ' is-horizontal' );

// Add animations
$animation = get_field('animate');
if ( $animation ) {
	$class .= ' animate show-on-scroll ' . $animation;
}

$tabs = get_field('tabs');
if( $tabs ) { ?>
	<div id="<?php echo esc_attr( $id ); ?>" class="tri-tabs mb-3<?php echo esc_attr( $class ); ?>">
		<div class="tri-tab-nav">
			<?php $i = 1;
			foreach( $tabs as $tab ) : ?>
				<span id="<?php echo $i; ?>" class="p-2"><?php echo esc_html( $tab['title'] ); ?></span>
			<?php $i++;
			endforeach; ?>
		</div>
		<div class="tri-tab-content">
			<?php $i = 1;
			foreach( $tabs as $tab ) : ?>
				<div class="tri-tab-pane <?php echo ( $i == 1 ? 'is-active' : ''); ?>"><?php echo $tab['body']; ?></div>
				<?php $i++;
			endforeach; ?>
		</div>
	</div>
<?php } ?>
<!-- End: Tabs -->