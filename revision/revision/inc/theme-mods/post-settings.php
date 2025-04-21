<?php
/**
 * Post Settings
 *
 * @package Revision
 */

CSCO_Customizer::add_section(
	'post_settings',
	array(
		'title' => esc_html__( 'Post Settings', 'revision' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'post_collapsible_common',
		'section'     => 'post_settings',
		'label'       => esc_html__( 'Common', 'revision' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'post_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'revision' ),
		'section'  => 'post_settings',
		'default'  => 'right',
		'choices'  => array(
			'right'    => esc_html__( 'Right Sidebar', 'revision' ),
			'left'     => esc_html__( 'Left Sidebar', 'revision' ),
			'disabled' => esc_html__( 'No Sidebar', 'revision' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'post_header_type',
		'label'    => esc_html__( 'Default Page Header Type', 'revision' ),
		'section'  => 'post_settings',
		'default'  => 'standard',
		'choices'  => array(
			'standard' => esc_html__( 'Standard', 'revision' ),
			'split'    => esc_html__( 'Split', 'revision' ),
			'overlay'  => esc_html__( 'Overlay', 'revision' ),
			'title'    => esc_html__( 'Page Title Only', 'revision' ),
			'none'     => esc_html__( 'None', 'revision' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'post_media_preview',
		'label'           => esc_html__( 'Standard Page Header Preview', 'revision' ),
		'section'         => 'post_settings',
		'default'         => 'cropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'revision' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'post_header_type',
					'operator' => '==',
					'value'    => 'standard',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'multicheck',
		'settings' => 'post_meta',
		'label'    => esc_html__( 'Post Meta', 'revision' ),
		'section'  => 'post_settings',
		'default'  => array( 'category', 'date', 'author' ),
		/**
		 * Post meta choices.
		 *
		 * @since 1.0.0
		 */
		'choices'  => apply_filters(
			'csco_post_meta_choices',
			array(
				'category' => esc_html__( 'Category', 'revision' ),
				'date'     => esc_html__( 'Date', 'revision' ),
				'author'   => esc_html__( 'Author', 'revision' ),
				'comments' => esc_html__( 'Comments', 'revision' ),
				'views'    => esc_html__( 'Views', 'revision' ),
			)
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_metabar',
		'label'    => esc_html__( 'Display metabar section', 'revision' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_reading_time',
		'label'           => esc_html__( 'Display reading time', 'revision' ),
		'section'         => 'post_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'post_metabar',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_subtitle',
		'label'    => esc_html__( 'Display excerpt as post subtitle', 'revision' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_tags',
		'label'    => esc_html__( 'Display tags', 'revision' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_footer',
		'label'    => esc_html__( 'Display post footer', 'revision' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_prev_next',
		'label'    => esc_html__( 'Enable prev/next section', 'revision' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);


CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'post_collapsible_read_next',
		'section'  => 'post_settings',
		'label'    => esc_html__( 'Read Next Links', 'revision' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_read_next',
		'label'    => esc_html__( 'Display read next links', 'revision' ),
		'section'  => 'post_settings',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'post_read_next_posts',
		'label'           => esc_html__( 'Display posts', 'revision' ),
		'description'     => esc_html__( 'The section will display posts from the current category, published after the current post\'s date, before it, or the newest posts. In case fewer than tree or four posts meet the requirements, the section will display other posts from the current category. In case there are fewer than three or four posts in the current category, the section will display posts from other categories.', 'revision' ),
		'section'         => 'post_settings',
		'default'         => 'after',
		'choices'         => apply_filters(
			'csco_header_layouts',
			array(
				'after'  => esc_html__( 'After current post date', 'revision' ),
				'before' => esc_html__( 'Before current post date', 'revision' ),
				'new'    => esc_html__( 'Newest posts', 'revision' ),
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'post_read_next_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'revision' ),
		'section'         => 'post_settings',
		'default'         => 'landscape-16-9',
		'choices'         => array(
			'original'       => esc_html__( 'Original', 'revision' ),
			'landscape'      => esc_html__( 'Landscape 4:3', 'revision' ),
			'landscape-3-2'  => esc_html__( 'Landscape 3:2', 'revision' ),
			'landscape-16-9' => esc_html__( 'Landscape 16:9', 'revision' ),
			'landscape-21-9' => esc_html__( 'Landscape 21:9', 'revision' ),
			'portrait'       => esc_html__( 'Portrait 3:4', 'revision' ),
			'portrait-2-3'   => esc_html__( 'Portrait 2:3', 'revision' ),
			'square'         => esc_html__( 'Square', 'revision' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'post_read_next_image_size',
		'label'           => esc_html__( 'Image Size', 'revision' ),
		'section'         => 'post_settings',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'read_next_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'revision' ),
		'section'         => 'post_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'read_next_discover_more',
		'label'           => esc_html__( 'Display discover more', 'revision' ),
		'section'         => 'post_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'post_read_next_meta',
		'label'           => esc_html__( 'Post Meta', 'revision' ),
		'section'         => 'post_settings',
		'default'         => array( 'category', 'date', 'author', 'reading_time' ),
		/**
		 * Post meta choices.
		 *
		 * @since 1.0.0
		 */
		'choices'         => apply_filters(
			'csco_post_meta_choices',
			array(
				'category'     => esc_html__( 'Category', 'revision' ),
				'reading_time' => esc_html__( 'Reading time', 'revision' ),
				'date'         => esc_html__( 'Date', 'revision' ),
				'author'       => esc_html__( 'Author', 'revision' ),
				'comments'     => esc_html__( 'Comments', 'revision' ),
				'views'        => esc_html__( 'Views', 'revision' ),
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'post_read_next',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);


// Auto Load next post.
CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'post_collapsible_load_nextpost',
		'section'  => 'post_settings',
		'label'    => esc_html__( 'Auto Load Next Post', 'revision' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'post_load_nextpost',
		'label'    => esc_html__( 'Enable the auto load next post feature', 'revision' ),
		'section'  => 'post_settings',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_load_nextpost_same_category',
		'label'           => esc_html__( 'Auto load posts from the same category only', 'revision' ),
		'section'         => 'post_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'post_load_nextpost',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'post_load_nextpost_reverse',
		'label'           => esc_html__( 'Auto load previous posts instead of next ones', 'revision' ),
		'section'         => 'post_settings',
		'default'         => false,
		'active_callback' => array(
			array(
				'setting'  => 'post_load_nextpost',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
