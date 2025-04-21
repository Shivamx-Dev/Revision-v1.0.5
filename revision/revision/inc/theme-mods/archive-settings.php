<?php
/**
 * Archive Settings
 *
 * @package Revision
 */

CSCO_Customizer::add_section(
	'archive_settings',
	array(
		'title' => esc_html__( 'Archive Settings', 'revision' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'archive_collapsible_common',
		'section'     => 'archive_settings',
		'label'       => esc_html__( 'Common', 'revision' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'archive_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'revision' ),
		'section'  => 'archive_settings',
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
		'settings' => 'archive_layout',
		'label'    => esc_html__( 'Layout', 'revision' ),
		'section'  => 'archive_settings',
		'default'  => 'list',
		'choices'  => array(
			'list'    => esc_html__( 'List Layout', 'revision' ),
			'grid'    => esc_html__( 'Grid Layout', 'revision' ),
			'overlay' => esc_html__( 'Overlay Layout', 'revision' ),
			'full'    => esc_html__( 'Full Post Layout', 'revision' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'archive_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'home_layout',
					'operator' => '!=',
					'value'    => 'full',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'archive_discover_more',
		'label'           => esc_html__( 'Display discover more', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => true,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'home_layout',
					'operator' => '!=',
					'value'    => 'full',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'archive_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'revision' ),
		'section'         => 'archive_settings',
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
				array(
					array(
						'setting'  => 'archive_layout',
						'operator' => '!=',
						'value'    => 'full',
					),
					array(
						'setting'  => 'archive_layout',
						'operator' => '!=',
						'value'    => 'overlay',
					),
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'archive_image_size',
		'label'           => esc_html__( 'Image Size', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				array(
					array(
						'setting'  => 'archive_layout',
						'operator' => '!=',
						'value'    => 'full',
					),
					array(
						'setting'  => 'archive_layout',
						'operator' => '!=',
						'value'    => 'overlay',
					),
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'archive_media_preview',
		'label'           => esc_html__( 'Post Preview Image Size', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => 'cropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'revision' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'archive_layout',
					'operator' => '==',
					'value'    => 'full',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'archive_summary',
		'label'           => esc_html__( 'Full Post Summary', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => 'summary',
		'choices'         => array(
			'summary' => esc_html__( 'Use Excerpts', 'revision' ),
			'content' => esc_html__( 'Use Read More Tag', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'archive_layout',
					'operator' => '==',
					'value'    => 'full',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'archive_pagination_type',
		'label'    => esc_html__( 'Pagination', 'revision' ),
		'section'  => 'archive_settings',
		'default'  => 'standard',
		'choices'  => array(
			'standard'  => esc_html__( 'Standard', 'revision' ),
			'load-more' => esc_html__( 'Load More Button', 'revision' ),
			'infinite'  => esc_html__( 'Infinite Load', 'revision' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'archive_collapsible_post_meta',
		'section'     => 'archive_settings',
		'label'       => esc_html__( 'Post Meta', 'revision' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'multicheck',
		'settings' => 'archive_post_meta',
		'label'    => esc_html__( 'Post Meta', 'revision' ),
		'section'  => 'archive_settings',
		'default'  => array( 'category', 'date', 'author', 'reading_time' ),
		/**
		 * Post meta choices.
		 *
		 * @since 1.0.0
		 */
		'choices'  => apply_filters(
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
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'archive_collapsible_number_of_olumns',
		'section'         => 'archive_settings',
		'label'           => esc_html__( 'Number of Columns', 'revision' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'archive_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-columns',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'archive_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 2,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'archive_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => 1,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 2,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'archive_collapsible_gap_between_rows',
		'section'     => 'archive_settings',
		'label'       => esc_html__( 'Gap between Rows', 'revision' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_list_gap_between_rows_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '40px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-archive-list',
				'property' => '--cs-posts-area-grid-row-gap',
			),
			array(
				'element'  => '.cs-read-next .cs-posts-area__read-next',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_grid_gap_between_rows_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '48px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-archive-grid',
				'property' => '--cs-posts-area-grid-row-gap',
			),
			array(
				'element'  => '.cs-read-next .cs-posts-area__read-next',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_overlay_gap_between_rows_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-archive-overlay',
				'property' => '--cs-posts-area-grid-row-gap',
			),
			array(
				'element'  => '.cs-read-next .cs-posts-area__read-next',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'overlay',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_full_gap_between_rows_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '48px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-archive-full',
				'property' => '--cs-posts-area-grid-row-gap',
			),
			array(
				'element'  => '.cs-read-next .cs-posts-area__read-next',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_list_gap_between_rows_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '40px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-list',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
			array(
				'element'     => '.cs-read-next .cs-posts-area__read-next',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_grid_gap_between_rows_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '38px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-grid',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
			array(
				'element'     => '.cs-read-next .cs-posts-area__read-next',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_overlay_gap_between_rows_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-overlay',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
			array(
				'element'     => '.cs-read-next .cs-posts-area__read-next',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'overlay',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_full_gap_between_rows_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '36px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-full',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
			array(
				'element'     => '.cs-read-next .cs-posts-area__read-next',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_grid_gap_between_rows_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '40px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-grid',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
			array(
				'element'     => '.cs-read-next .cs-posts-area__read-next',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_overlay_gap_between_rows_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-overlay',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
			array(
				'element'     => '.cs-read-next .cs-posts-area__read-next',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'overlay',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_full_gap_between_rows_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '40px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-full',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
			array(
				'element'     => '.cs-read-next .cs-posts-area__read-next',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'archive_collapsible_gap_between_columns',
		'section'         => 'archive_settings',
		'label'           => esc_html__( 'Gap between Columns', 'revision' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'overlay',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_gap_between_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-column-gap',
			),
			array(
				'element'  => '.cs-posts-area__archive.cs-posts-area__overlay',
				'property' => '--cs-posts-area-grid-column-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'overlay',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_gap_between_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__overlay',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'overlay',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_gap_between_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
			array(
				'element'     => '.cs-posts-area__archive.cs-posts-area__overlay',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'overlay',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'archive_collapsible_title_size',
		'section'     => 'archive_settings',
		'label'       => esc_html__( 'Title Font Size', 'revision' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_list_title_size_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '1.5rem',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-archive-list',
				'property' => '--cs-entry-title-font-size',
			),
			array(
				'element'  => '.cs-posts-area__read-next',
				'property' => '--cs-entry-title-font-size',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_grid_title_size_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '1.3125rem',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-archive-grid',
				'property' => '--cs-entry-title-font-size',
			),
			array(
				'element'  => '.cs-posts-area__read-next',
				'property' => '--cs-entry-title-font-size',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_overlay_title_size_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '2.0625rem',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-archive-overlay',
				'property' => '--cs-entry-title-font-size',
			),
			array(
				'element'  => '.cs-posts-area__read-next',
				'property' => '--cs-entry-title-font-size',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'overlay',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_full_title_size_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '2rem',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__archive.cs-archive-full',
				'property' => '--cs-entry-title-font-size',
			),
			array(
				'element'  => '.cs-posts-area__read-next',
				'property' => '--cs-entry-title-font-size',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_list_title_size_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '1.375rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-list',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
			array(
				'element'     => '.cs-posts-area__read-next',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_grid_title_size_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '1.3125rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-grid',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
			array(
				'element'     => '.cs-posts-area__read-next',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_overlay_title_size_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '1.75rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-overlay',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
			array(
				'element'     => '.cs-posts-area__read-next',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'overlay',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_full_title_size_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '2rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-full',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
			array(
				'element'     => '.cs-posts-area__read-next',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_list_title_size_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '1.375rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-list',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
			array(
				'element'     => '.cs-posts-area__read-next',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_grid_title_size_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '1.3125rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-grid',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
			array(
				'element'     => '.cs-posts-area__read-next',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_overlay_title_size_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '1.25rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-overlay',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
			array(
				'element'     => '.cs-posts-area__read-next',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'overlay',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'archive_full_title_size_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'archive_settings',
		'default'         => '1.375rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__archive.cs-archive-full',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
			array(
				'element'     => '.cs-posts-area__read-next',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'archive_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);
