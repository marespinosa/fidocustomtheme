<?php // Register all the Gutenberg blocks with Advanced Custom Fields.


function tri_register_blocks_and_fields() {

	// Check function exists.
	if( !function_exists('acf_register_block_type') ) {
		return;
	}

	// Testimonial block
	acf_register_block_type(array(
		'name'              => 'testimonial',
		'title'             => __('Testimonial', 'tri'),
		'description'       => __('Testimonials slider from testimonials post type.', 'tri'),
		'render_template'   => 'template-parts/blocks/slider-testimonial.php',
		'category'          => 'formatting',
		'icon'              => 'images-alt2',
		'supports'			=> array(
			'align' => 'false',
		)
	));

	// Tabs block
	acf_register_block_type(array(
		'name'              => 'tab',
		'title'             => __('Tabs', 'tri'),
		'description'       => __('Tabbed content', 'tri'),
		'render_template'   => 'template-parts/blocks/tabs.php',
		'category'          => 'formatting',
		'icon'              => 'excerpt-view',
		'supports'			=> array(
			'align' => 'false',
		)
	));

	// Popup block
	acf_register_block_type(array(
		'name'              => 'popup',
		'title'             => __('Popup', 'tri'),
		'description'       => __('Show hidden content in a modal window when the anchor is clicked', 'tri'),
		'render_template'   => 'template-parts/blocks/popup.php',
		'category'          => 'formatting',
		'icon'              => 'slides',
		'supports'			=> array(
			'align' => 'false',
		)
	));

	// Count Up block
	acf_register_block_type(array(
		'name'              => 'count-up',
		'title'             => __('Count Up', 'tri'),
		'description'       => __('Make a number count up from 0', 'tri'),
		'render_template'   => 'template-parts/blocks/count-up.php',
		'category'          => 'formatting',
		'icon'              => 'arrow-up-alt2',
		'supports'			=> array(
			'align' => 'false',
		)
	));

	// Accordion block
	acf_register_block_type(array(
		'name'              => 'accordion',
		'title'             => __('Accordion', 'tri'),
		'description'       => __('Accordion toggle to show and hide content', 'tri'),
		'render_template'   => 'template-parts/blocks/accordion.php',
		'category'          => 'formatting',
		'icon'              => 'list-view',
		'supports'			=> array(
			'align' => 'false',
		)
		
	));

	// Icon block
	acf_register_block_type(array(
		'name'              => 'icon',
		'title'             => __('Icon', 'tri'),
		'description'       => __('Material Icon', 'tri'),
		'render_template'   => 'template-parts/blocks/icon.php',
		'category'          => 'common',
		'icon'              => 'smiley',
		'supports'			=> array(
			'align' => 'false',
		)
	));

	// Team Members block
	acf_register_block_type(array(
		'name'              => 'team',
		'title'             => __('Team Member', 'tri'),
		'description'       => __('List the team members in the Team Members post type', 'tri'),
		'render_template'   => 'template-parts/blocks/team-member.php',
		'category'          => 'common',
		'icon'              => 'groups',
		'supports'			=> array(
			'align' => 'false',
		)
	));

	// Pricing Table block
	acf_register_block_type(array(
		'name'              => 'pricing',
		'title'             => __('Pricing Table', 'tri'),
		'description'       => __('Display a pricing table', 'tri'),
		'render_template'   => 'template-parts/blocks/pricing-table.php',
		'category'          => 'common',
		'icon'              => 'editor-table',
		'supports'			=> array(
			'align' => 'false',
		)
	));

	// Register a Slider block
	acf_register_block_type(array(
		'name'              => 'slider',
		'title'             => __('Slider', 'tri'),
		'description'       => __('A custom slider block.', 'tri'),
		'render_template'   => 'template-parts/blocks/slider-image.php',
		'category'          => 'formatting',
		'icon' 				=> 'images-alt2',
		'supports'			=> array(
			'align' => 'false',
		)
	));

	// Post Grid block
	acf_register_block_type(array(
		'name'              => 'postgrid',
		'title'             => __('Post Grid', 'tri'),
		'description'       => __('Display Custom posts in a grid', 'tri'),
		'render_template'   => 'template-parts/blocks/post-grid.php',
		'category'          => 'formatting',
		'icon'              => 'screenoptions',
		'supports'			=> array(
			'align' => 'false',
		)
	));
	
	// Add Advanced Custom Field items to theme

	// Accordion Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_accord',
		'title' => 'Block: Accordion',
		'fields' => array(
			array(
				'key' => 'field_accordtitl',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'text',
				'placeholder' => 'Accordion Title',
			),
			array(
				'key' => 'field_accordcont',
				'label' => 'Content',
				'name' => 'content',
				'type' => 'wysiwyg',
				'tabs' => 'all',
				'toolbar' => 'basic',
				'media_upload' => 0,
				'delay' => 1,
			),
			array(
				'key' => 'field_accordexpa',
				'name' => 'expanded',
				'type' => 'true_false',
				'message' => 'Expanded on load',
				'default_value' => 0,
			)
			
		
		),
		
			
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/accordion',
				),
			),
		),
	));

	// Count Up Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_countup',
		'title' => 'Block: Count Up',
		'fields' => array(
			array(
				'key' => 'field_countupnum',
				'label' => 'Number',
				'name' => 'count_number',
				'type' => 'number',
			),
			array(
				'key' => 'field_countuppre',
				'label' => 'Prefix',
				'name' => 'count_prefix',
				'type' => 'text',
				'placeholder' => 'Text Before Number',
			),
			array(
				'key' => 'field_countupsuf',
				'label' => 'Suffix',
				'name' => 'count_suffix',
				'type' => 'text',
				'placeholder' => 'Text After Number',
			),
			array(
				'key' => 'field_countupdur',
				'label' => 'Count Duration',
				'name' => 'count_duration',
				'type' => 'number',
				'default_value' => 3,
				'append' => 'Seconds',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/count-up',
				),
			),
		),
	));

	// Icon Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_icon',
		'title' => 'Block: Icon',
		'fields' => array(
			array(
				'key' => 'field_iconico',
				'label' => 'Icon',
				'name' => 'icon',
				'type' => 'text',
				'instructions' => 'Enter the material icon code name',
				'placeholder' => 'person',
			),
			array(
				'key' => 'field_iconsiz',
				'label' => 'Size',
				'name' => 'size',
				'type' => 'select',
				'choices' => array(
					'sm' => 'Small',
					'md' => 'Medium',
					'lg' => 'Large',
					'xl' => 'Extra Large',
					'xxl' => 'Extra Extra Large',
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/icon',
				),
			),
		),
	));

	// Popup Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_popup',
		'title' => 'Block: Popup',
		'fields' => array(
			array(
				'key' => 'field_popuptitl',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'text',
			),
			array(
				'key' => 'field_popuptype',
				'label' => '',
				'name' => 'content_type',
				'type' => 'flexible_content',
				'layouts' => array(
					'layout_popuptypevid' => array(
						'key' => 'layout_popuptypevidkey',
						'name' => 'video',
						'label' => 'Video',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_popupvidurl',
								'label' => 'Video URL',
								'name' => 'youtube',
								'type' => 'text',
								'placeholder' => 'https://youtube.com/watch?v=dQw4w9WgXcQ',
							),
						),
					),
					'layout_popuptypewysiwyg' => array(
						'key' => 'layout_popuptypewysiwygkey',
						'name' => 'wysiwyg',
						'label' => 'Text',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_popupwysiwygcont',
								'label' => 'Content',
								'name' => 'content',
								'type' => 'wysiwyg',
								'tabs' => 'all',
								'toolbar' => 'basic',
								'media_upload' => 0,
								'delay' => 1,
							),
						),
					),
				),
				'button_label' => 'Choose Content',
				'max' => 1,
			),
			array(
				'key' => 'field_popupid',
				'label' => 'ID',
				'name' => 'id',
				'type' => 'text',
				'placeholder' => 'Override default anchor ID',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/popup',
				),
			),
		),
	));

	// Pricing Table Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_pricing',
		'title' => 'Block: Pricing Table',
		'fields' => array(
			array(
				'key' => 'field_pricingpac',
				'label' => 'Packages',
				'name' => 'packages',
				'type' => 'repeater',
				'collapsed' => '',
				'min' => 1,
				'layout' => 'block',
				'button_label' => 'Add Package',
				'sub_fields' => array(
					array(
						'key' => 'field_pricingtitl',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
					),
					array(
						'key' => 'field_pricingpric',
						'label' => 'Price',
						'name' => 'price',
						'type' => 'text',
					),
					array(
						'key' => 'field_pricingfeats',
						'label' => 'Features',
						'name' => 'features',
						'type' => 'repeater',
						'collapsed' => '',
						'min' => 0,
						'layout' => 'table',
						'button_label' => '',
						'sub_fields' => array(
							array(
								'key' => 'field_pricingfeat',
								'label' => 'Feature',
								'name' => 'feature',
								'type' => 'text',
							),
						),
					),
					array(
						'key' => 'field_pricinglink',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'link',
						'return_format' => 'array',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/pricing',
				),
			),
		),
		'style' => 'seamless',
	));

	// Tabs Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_tabs',
		'title' => 'Block: Tabs',
		'fields' => array(
			array(
				'key' => 'field_tabs',
				'label' => 'Tabs',
				'name' => 'tabs',
				'type' => 'repeater',
				'collapsed' => '',
				'min' => 1,
				'layout' => 'block',
				'button_label' => 'Add Tab',
				'sub_fields' => array(
					array(
						'key' => 'field_tabstitl',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'text',
					),
					array(
						'key' => 'field_tabsbod',
						'label' => 'Body',
						'name' => 'body',
						'type' => 'wysiwyg',
						'tabs' => 'all',
						'toolbar' => 'basic',
						'media_upload' => 0,
						'delay' => 1,
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/tab',
				),
			),
		),
	));

	// Team Member Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_team',
		'title' => 'Block: Team Member',
		'fields' => array(
			array(
				'key' => 'field_teamimg',
				'label' => 'Image',
				'name' => 'image',
				'type' => 'image',
				'return_format' => 'id',
				'preview_size' => 'medium',
			),
			array(
				'key' => 'field_teamtitl',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'text',
			),
			array(
				'key' => 'field_teamrole',
				'label' => 'Role',
				'name' => 'role',
				'type' => 'text',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/team',
				),
			),
		),
		'position' => 'side',
	));

	// Testimonial Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_testim',
		'title' => 'CPT: Testimonial',
		'fields' => array(
			array(
				'key' => 'field_testimname',
				'label' => 'Name',
				'name' => 'name',
				'type' => 'text',
				'required' => 1,
			),
			array(
				'key' => 'field_rate_review',
				'label' => 'Rate',
				'name' => 'rates',
				'type' => 'text',
			),
			array(
				'key' => 'field_testimcomp',
				'label' => 'Company or Year',
				'name' => 'company',
				'type' => 'text',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'testimonial',
				),
			),
		),
		'position' => 'side',
	));
	
	

	// Image Slider Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_sliderimg',
		'title' => 'Block: Slider - Image',
		'fields' => array(
			array(
				'key' => 'field_sliderimgslides',
				'label' => 'Slides',
				'name' => 'slides',
				'type' => 'repeater',
				'collapsed' => '',
				'min' => 1,
				'layout' => 'table',
				'button_label' => 'Add Slide',
				'sub_fields' => array(
					array(
						'key' => '_sliderimgslideimg',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'return_format' => 'array',
						'preview_size' => 'medium',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/slider',
				),
			),
		),
		'menu_order' => 5,
	));

	// Testimonial Slider Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_slidertesti',
		'title' => 'Block: Slider - Testimonial',
		'fields' => array(
			array(
				'key' => 'field_slidertesti',
				'label' => 'Choose Testimonials',
				'name' => 'testimonial',
				'type' => 'post_object',
				'post_type' => array(
					0 => 'testimonial',
				),
				'taxonomy' => '',
				'allow_null' => 1,
				'multiple' => 1,
				'return_format' => 'object',
				'ui' => 1,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/testimonial',
				),
			),
		),
		'menu_order' => 5,
	));	

	// Footer CTA Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_footcta',
		'title' => 'Footer: Call to Action',
		'fields' => array(
			array(
				'key' => 'field_footcta',
				'label' => '',
				'name' => 'footer_cta',
				'type' => 'group',
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_footctahead',
						'label' => 'Heading',
						'name' => 'heading',
						'type' => 'text',
					),
					array(
						'key' => 'field_footctapara',
						'label' => 'Paragraph',
						'name' => 'paragraph',
						'type' => 'textarea',
						'wrapper' => array(
							'width' => '60',
						),
						'rows' => 5,
						'new_lines' => 'wpautop',
					),
					array(
						'key' => 'field_footctaimg',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'wrapper' => array(
							'width' => '40',
						),
						'return_format' => 'id',
						'preview_size' => 'thumbnail',
					),
					array(
						'key' => 'field_footctabtn',
						'label' => 'Button',
						'name' => 'button',
						'type' => 'link',
						'wrapper' => array(
							'width' => '40',
						),
						'return_format' => 'array',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 10,
	));

	// Post Grid Block ACF Fields
	acf_add_local_field_group(array(
		'key' => 'group_pgrid',
		'title' => 'Block: Post Grid',
		'fields' => array(
			array(
				'key' => 'field_pgrid',
				'label' => 'Post Type Slug',
				'name' => 'post_type',
				'type' => 'text',
				'placeholder' => 'testimonial',
			),
			array(
				'key' => 'field_pgridcount',
				'label' => 'Items to show',
				'name' => 'count',
				'type' => 'number',
				'default_value' => 3,
				'placeholder' => 4,
				'min' => -1,
				'max' => 25,
			),
			array(
				'key' => 'field_pgridcols',
				'label' => 'Columns',
				'name' => 'columns',
				'type' => 'number',
				'default_value' => 3,
				'placeholder' => 4,
				'min' => 1,
				'max' => 6,
			),
			array(
				'key' => 'field_pgridshad',
				'label' => 'Shadow',
				'name' => 'shadow',
				'type' => 'select',
				'choices' => array(
					'no-box-shadow' => 'None',
					'box-shadow' => 'Static Shadow',
					'box-shadow-hover' => 'Hover Shadow',
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/postgrid',
				),
			),
		),
	));

	// Animate all blocks
	acf_add_local_field_group(array(
		'key' => 'group_animations',
		'title' => 'Animations',
		'fields' => array(
			array(
				'key' => 'field_anim',
				'label' => 'Animate',
				'name' => 'animate',
				'type' => 'select',
				'choices' => array(
					0 => 'None',
					'fadeIn' => 'Fade in',
					'fadeInUp' => 'Fade in upwards',
					'fadeInDown' => 'Fade in downwards',
					'fadeInLeft' => 'Fade in from right',
					'fadeInRight' => 'Fade in from left',
					'flipInX' => 'Flip in vertically',
					'flipInY' => 'Flip in horizontally',
					'bounceIn' => 'Expand',
					'bounceInUp' => 'Slide in from bottom',
					'spin' => 'Spin',
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'all',
				),
			),
		),
		'menu_order' => 2,
	));

}
add_action('acf/init', 'tri_register_blocks_and_fields');




if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_607ce3a838a8c',
	'title' => 'Nested Accordion',
	'fields' => array(
		array(
			'key' => 'field_607d050fd1b6f',
			'label' => 'Nested Accordion',
			'name' => 'nested_accordion_panel',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => 'field_607d1f25ea66c',
			'min' => 0,
			'max' => 0,
			'layout' => 'row',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'field_607d1a972ba89',
					'label' => 'Child Title',
					'name' => 'child_title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_607d06f6f2252',
					'label' => 'Sub Title',
					'name' => 'sub_title_acc',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_607d1f25ea66c',
					'label' => 'Nested Accordion Box',
					'name' => 'nested_accordion_box',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => 'field_607d1f3bea66d',
					'min' => 0,
					'max' => 0,
					'layout' => 'row',
					'button_label' => '',
					'sub_fields' => array(
						array(
							'key' => 'field_607d1f3bea66d',
							'label' => 'Title Nested Box',
							'name' => 'title_nested_box',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
						),
						array(
							'key' => 'field_607d1f59ea66e',
							'label' => 'Nested Content Box',
							'name' => 'nested_content_box',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 1,
							'delay' => 0,
						),
					),
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'block',
				'operator' => '==',
				'value' => 'acf/nested-accordion',
			),
		),
	),
	'menu_order' => 2,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'left',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;



if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_6073b6f4043da',
	'title' => 'Slider 2 Columns',
	'fields' => array(
		array(
			'key' => 'field_6073b759b535d',
			'label' => 'Content Description',
			'name' => 'contentdescp',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_60760a5d06828',
			'label' => 'Mobile View Apply Now',
			'name' => 'mobile_view_apply_now',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'hero_slider_carousel',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;