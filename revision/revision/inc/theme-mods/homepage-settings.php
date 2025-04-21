<?php
/**
 * Homepage Settings
 *
 * @package Revision
 */

/**
 * Removes default WordPress Static Front Page section
 * and re-adds it in our own panel with the same parameters.
 *
 * @param object $wp_customize Instance of the WP_Customize_Manager class.
 */
function csco_reorder_customizer_settings( $wp_customize ) {

	// Get current front page section parameters.
	$static_front_page = $wp_customize->get_section( 'static_front_page' );

	// Remove existing section, so that we can later re-add it to our panel.
	$wp_customize->remove_section( 'static_front_page' );

	// Re-add static front page section with a new name, but same description.
	$wp_customize->add_section(
		'static_front_page',
		array(
			'title'           => esc_html__( 'Static Front Page', 'revision' ),
			'description'     => $static_front_page->description,
			'panel'           => 'home_panel',
			'active_callback' => $static_front_page->active_callback,
		)
	);
}
add_action( 'customize_register', 'csco_reorder_customizer_settings' );

CSCO_Customizer::add_panel(
	'home_panel',
	array(
		'title' => esc_html__( 'Front Page Settings', 'revision' ),
	)
);

CSCO_Customizer::add_section(
	'home_settings',
	array(
		'title' => esc_html__( 'Latest Posts Layout', 'revision' ),
		'panel' => 'home_panel',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_collapsible_common',
		'section'     => 'home_settings',
		'label'       => esc_html__( 'Common', 'revision' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'home_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'revision' ),
		'section'  => 'home_settings',
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
		'settings' => 'home_layout',
		'label'    => esc_html__( 'Layout', 'revision' ),
		'section'  => 'home_settings',
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
		'settings'        => 'home_excerpt',
		'label'           => esc_html__( 'Display excerpt', 'revision' ),
		'section'         => 'home_settings',
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
		'settings'        => 'home_discover_more',
		'label'           => esc_html__( 'Display discover more', 'revision' ),
		'section'         => 'home_settings',
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
		'settings'        => 'home_image_orientation',
		'label'           => esc_html__( 'Image Orientation', 'revision' ),
		'section'         => 'home_settings',
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
						'setting'  => 'home_layout',
						'operator' => '!=',
						'value'    => 'full',
					),
					array(
						'setting'  => 'home_layout',
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
		'settings'        => 'home_image_size',
		'label'           => esc_html__( 'Image Size', 'revision' ),
		'section'         => 'home_settings',
		'default'         => 'csco-thumbnail',
		'choices'         => csco_get_list_available_image_sizes(),
		'active_callback' => array(
			array(
				array(
					array(
						'setting'  => 'home_layout',
						'operator' => '!=',
						'value'    => 'full',
					),
					array(
						'setting'  => 'home_layout',
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
		'settings'        => 'home_media_preview',
		'label'           => esc_html__( 'Post Preview Image Size', 'revision' ),
		'section'         => 'home_settings',
		'default'         => 'cropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'revision' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'home_layout',
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
		'settings'        => 'home_summary',
		'label'           => esc_html__( 'Full Post Summary', 'revision' ),
		'section'         => 'home_settings',
		'default'         => 'summary',
		'choices'         => array(
			'summary' => esc_html__( 'Use Excerpts', 'revision' ),
			'content' => esc_html__( 'Use Read More Tag', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'home_layout',
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
		'settings' => 'home_pagination_type',
		'label'    => esc_html__( 'Pagination', 'revision' ),
		'section'  => 'home_settings',
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
		'settings'    => 'home_collapsible_post_meta',
		'section'     => 'home_settings',
		'label'       => esc_html__( 'Post Meta', 'revision' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'multicheck',
		'settings' => 'home_post_meta',
		'label'    => esc_html__( 'Post Meta', 'revision' ),
		'section'  => 'home_settings',
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
		'settings'        => 'home_collapsible_number_of_columns',
		'section'         => 'home_settings',
		'label'           => esc_html__( 'Number of Columns', 'revision' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'home_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-columns',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'home_settings',
		'default'         => 2,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 2,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'home_settings',
		'default'         => 1,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 2,
			'step' => 1,
		),
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-columns',
				'media_query' => '@media (max-width: 767.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'home_collapsible_gap_between_rows',
		'section'     => 'home_settings',
		'label'       => esc_html__( 'Gap between Rows', 'revision' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_list_gap_between_rows_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '40px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-archive-list',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_grid_gap_between_rows_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '48px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-archive-grid',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_overlay_gap_between_rows_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-archive-overlay',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
		'active_callback' => array(
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
		'settings'        => 'home_full_gap_between_rows_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '48px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-archive-full',
				'property' => '--cs-posts-area-grid-row-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_list_gap_between_rows_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '40px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-list',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_grid_gap_between_rows_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '38px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-grid',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_overlay_gap_between_rows_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-overlay',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
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
		'settings'        => 'home_full_gap_between_rows_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '36px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-full',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_grid_gap_between_rows_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '40px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-grid',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_overlay_gap_between_rows_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-overlay',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
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
		'settings'        => 'home_full_gap_between_rows_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '40px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-full',
				'property'    => '--cs-posts-area-grid-row-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_collapsible_gap_between_columns',
		'section'         => 'home_settings',
		'label'           => esc_html__( 'Gap between Columns', 'revision' ),
		'input_attrs'     => array(
			'collapsed' => false,
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
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
		'settings'        => 'home_gap_between_columns_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-posts-area__grid',
				'property' => '--cs-posts-area-grid-column-gap',
			),
			array(
				'element'  => '.cs-posts-area__home.cs-posts-area__overlay',
				'property' => '--cs-posts-area-grid-column-gap',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
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
		'settings'        => 'home_gap_between_columns_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__overlay',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
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
		'settings'        => 'home_gap_between_columns_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '24px',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__grid',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
			array(
				'element'     => '.cs-posts-area__home.cs-posts-area__overlay',
				'property'    => '--cs-posts-area-grid-column-gap',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
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
		'type'        => 'collapsible',
		'settings'    => 'home_collapsible_title_size',
		'section'     => 'home_settings',
		'label'       => esc_html__( 'Title Font Size', 'revision' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_list_title_size_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '1.5rem',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-archive-list',
				'property' => '--cs-entry-title-font-size',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_grid_title_size_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '1.3125rem',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-archive-grid',
				'property' => '--cs-entry-title-font-size',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_overlay_title_size_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '2.0625rem',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-archive-overlay',
				'property' => '--cs-entry-title-font-size',
			),
		),
		'active_callback' => array(
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
		'settings'        => 'home_full_title_size_desktop',
		'label'           => esc_html__( 'Desktop', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '2rem',
		'output'          => array(
			array(
				'element'  => '.cs-posts-area__home.cs-archive-full',
				'property' => '--cs-entry-title-font-size',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_list_title_size_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '1.375rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-list',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_grid_title_size_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '1.3125rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-grid',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_overlay_title_size_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '1.75rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-overlay',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
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
		'settings'        => 'home_full_title_size_tablet',
		'label'           => esc_html__( 'Tablet', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '2rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-full',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 991.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_list_title_size_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '1.375rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-list',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'list',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_grid_title_size_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '1.3125rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-grid',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'grid',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'dimension',
		'settings'        => 'home_overlay_title_size_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '1.25rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-overlay',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
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
		'settings'        => 'home_full_title_size_mobile',
		'label'           => esc_html__( 'Mobile', 'revision' ),
		'section'         => 'home_settings',
		'default'         => '1.375rem',
		'output'          => array(
			array(
				'element'     => '.cs-posts-area__home.cs-archive-full',
				'property'    => '--cs-entry-title-font-size',
				'media_query' => '@media (max-width: 575.98px)',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_layout',
				'operator' => '==',
				'value'    => 'full',
			),
		),
	)
);

CSCO_Customizer::add_section(
	'home_hero_section',
	array(
		'title'    => esc_html__( 'Hero Section', 'revision' ),
		'panel'    => 'home_panel',
		'priority' => 10,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'home_hero',
		'label'    => esc_html__( 'Display hero section', 'revision' ),
		'section'  => 'home_hero_section',
		'default'  => false,
		'priority' => 10,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'collapsible',
		'settings'        => 'home_hero_collapsible_common',
		'section'         => 'home_hero_section',
		'label'           => esc_html__( 'Common', 'revision' ),
		'input_attrs'     => array(
			'collapsed' => true,
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'home_hero_layout',
		'label'           => esc_html__( 'Layout', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => 'hero-type-1',
		'priority'        => 10,
		'choices'         => array(
			'hero-type-1' => esc_html__( 'Type 1', 'revision' ),
			'hero-type-2' => esc_html__( 'Type 2', 'revision' ),
			'hero-type-3' => esc_html__( 'Type 3', 'revision' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'textarea',
		'settings'        => 'home_hero_heading',
		'label'           => esc_html__( 'Heading', 'revision' ),
		'description'     => esc_html__( 'Wrap phrases with <span></span> tags to emphasize and highlight.', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				array(
					'setting'  => 'home_hero_layout',
					'operator' => '==',
					'value'    => 'hero-type-1',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'textarea',
		'settings'        => 'home_hero_subheading',
		'label'           => esc_html__( 'Subheading', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				array(
					'setting'  => 'home_hero_layout',
					'operator' => '==',
					'value'    => 'hero-type-1',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'home_hero_slider_autoplay',
		'label'           => esc_html__( 'Slider Autoplay', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => 'yes',
		'priority'        => 10,
		'choices'         => array(
			'yes' => esc_html__( 'Enabled', 'revision' ),
			'no'  => esc_html__( 'Disabled', 'revision' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				array(
					'setting'  => 'home_hero_layout',
					'operator' => '==',
					'value'    => 'hero-type-2',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_hero_slider_delay',
		'label'           => esc_html__( 'Autoplay Delay (ms)', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => '5000',
		'input_attrs'     => array(
			'min'  => 3000,
			'max'  => 10000,
			'step' => 500,
		),
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-hero-slider-delay-ms',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'home_hero_slider_autoplay',
				'operator' => '==',
				'value'    => 'yes',
			),
			array(
				array(
					'setting'  => 'home_hero_layout',
					'operator' => '==',
					'value'    => 'hero-type-2',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'home_hero_slider_parallax',
		'label'           => esc_html__( 'Slider Parallax Effect', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => 'yes',
		'priority'        => 10,
		'choices'         => array(
			'yes' => esc_html__( 'Enabled', 'revision' ),
			'no'  => esc_html__( 'Disabled', 'revision' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				array(
					'setting'  => 'home_hero_layout',
					'operator' => '==',
					'value'    => 'hero-type-2',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'multicheck',
		'settings'        => 'home_hero_meta',
		'label'           => esc_html__( 'Post Meta', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => array( 'category', 'author', 'date', 'reading_time' ),
		'priority'        => 10,
		'choices'         => apply_filters(
			'csco_post_meta_choices',
			array(
				'category'     => esc_html__( 'Category', 'revision' ),
				'reading_time' => esc_html__( 'Reading time', 'revision' ),
				'author'       => esc_html__( 'Author', 'revision' ),
				'date'         => esc_html__( 'Date', 'revision' ),
				'comments'     => esc_html__( 'Comments', 'revision' ),
				'views'        => esc_html__( 'Views', 'revision' ),
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				array(
					'setting'  => 'home_hero_layout',
					'operator' => '!=',
					'value'    => 'hero-type-1',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_hero_discover_more',
		'label'           => esc_html__( 'Display discover more', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				array(
					'setting'  => 'home_hero_layout',
					'operator' => '==',
					'value'    => 'hero-type-2',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_hero_filter_categories',
		'label'           => esc_html__( 'Filter by Categories', 'revision' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => '',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'home_hero_filter_tags',
				'operator' => '==',
				'value'    => '',
			),
			array(
				'setting'  => 'home_hero_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
			array(
				'setting'  => 'home_hero_layout',
				'operator' => '!=',
				'value'    => 'hero-type-1',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_hero_filter_tags',
		'label'           => esc_html__( 'Filter by Tags', 'revision' ),
		'description'     => esc_html__( 'Add comma-separated list of tag slugs. For example: &laquo;worth-reading, top-5, playlists&raquo;. Leave empty for all tags.', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => '',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'home_hero_filter_categories',
				'operator' => '==',
				'value'    => '',
			),
			array(
				'setting'  => 'home_hero_filter_posts',
				'operator' => '==',
				'value'    => '',
			),
			array(
				array(
					'setting'  => 'home_hero_layout',
					'operator' => '!=',
					'value'    => 'hero-type-1',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_hero_filter_posts',
		'label'           => esc_html__( 'Filter by Posts', 'revision' ),
		'description'     => esc_html__( 'Add comma-separated list of post IDs (max. 5). For example: 12, 34, 145. Leave empty for all posts.', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => '',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'home_hero_filter_categories',
				'operator' => '==',
				'value'    => '',
			),
			array(
				'setting'  => 'home_hero_filter_tags',
				'operator' => '==',
				'value'    => '',
			),
			array(
				array(
					'setting'  => 'home_hero_layout',
					'operator' => '!=',
					'value'    => 'hero-type-1',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_hero_max_count',
		'label'           => esc_html__( 'Maximum Posts', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => '3',
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 100,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				array(
					'setting'  => 'home_hero_layout',
					'operator' => '==',
					'value'    => 'hero-type-2',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'home_hero_exclude',
		'label'           => esc_html__( 'Exclude hero posts from the main archive', 'revision' ),
		'section'         => 'home_hero_section',
		'default'         => false,
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'home_hero',
				'operator' => '==',
				'value'    => true,
			),
			array(
				array(
					'setting'  => 'home_hero_layout',
					'operator' => '!=',
					'value'    => 'hero-type-1',
				),
			),
		),
	)
);

CSCO_Customizer::add_section(
	'home_featured_categories',
	array(
		'title'    => esc_html__( 'Featured Categories', 'revision' ),
		'panel'    => 'home_panel',
		'priority' => 20,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'home_show_categories',
		'label'    => esc_html__( 'Display categories', 'revision' ),
		'section'  => 'home_featured_categories',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_categories_heading',
		'label'           => esc_html__( 'Heading', 'revision' ),
		'section'         => 'home_featured_categories',
		'default'         => esc_html__( 'Explore Trending Topics', 'revision' ),
		'active_callback' => array(
			array(
				'setting'  => 'home_show_categories',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'home_categories_filter',
		'label'           => esc_html__( 'Filter Categories By Slug', 'revision' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'revision' ),
		'section'         => 'home_featured_categories',
		'default'         => '',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'home_show_categories',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'home_categories_limit',
		'label'           => esc_html__( 'Limit', 'revision' ),
		'section'         => 'home_featured_categories',
		'default'         => 8,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 99,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'home_show_categories',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'home_categories_filter',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);
