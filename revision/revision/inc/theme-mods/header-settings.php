<?php
/**
 * Header Settings
 *
 * @package Revision
 */

CSCO_Customizer::add_section(
	'header',
	array(
		'title' => esc_html__( 'Header Settings', 'revision' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'header_collapsible_common',
		'section'     => 'header',
		'label'       => esc_html__( 'Common', 'revision' ),
		'input_attrs' => array(
			'collapsed' => true,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'header_initial_height',
		'label'    => esc_html__( 'Header Initial Height', 'revision' ),
		'section'  => 'header',
		'default'  => '88px',
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-header-initial-height',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'header_height',
		'label'    => esc_html__( 'Header Height', 'revision' ),
		'section'  => 'header',
		'default'  => '88px',
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-header-height',
			),
		),
	)
);


CSCO_Customizer::add_field(
	array(
		'type'     => 'dimension',
		'settings' => 'header_border_width',
		'label'    => esc_html__( 'Header Border Width', 'revision' ),
		'section'  => 'header',
		'default'  => '0px',
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-header-border-width',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'checkbox',
		'settings'    => 'navbar_sticky',
		'label'       => esc_html__( 'Make navigation bar sticky', 'revision' ),
		'description' => esc_html__( 'Enabling this option will make navigation bar visible when scrolling.', 'revision' ),
		'section'     => 'header',
		'default'     => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'navbar_smart_sticky',
		'label'           => esc_html__( 'Enable the smart sticky feature', 'revision' ),
		'description'     => esc_html__( 'Enabling this option will reveal navigation bar when scrolling up and hide it when scrolling down.', 'revision' ),
		'section'         => 'header',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'navbar_sticky',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_offcanvas',
		'label'    => esc_html__( 'Display offcanvas toggle button', 'revision' ),
		'section'  => 'header',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_navigation_menu',
		'label'    => esc_html__( 'Display navigation menu', 'revision' ),
		'section'  => 'header',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'header_collapsible_search',
		'section'  => 'header',
		'label'    => esc_html__( 'Search', 'revision' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_search_button',
		'label'    => esc_html__( 'Display search button', 'revision' ),
		'section'  => 'header',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'checkbox',
		'settings'        => 'header_search_show_categories',
		'label'           => esc_html__( 'Display categories', 'revision' ),
		'section'         => 'header',
		'default'         => true,
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_search_heading',
		'label'           => esc_html__( 'Heading', 'revision' ),
		'section'         => 'header',
		'default'         => esc_html__( 'What are You Looking For?', 'revision' ),
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_search_filter_categories',
		'label'           => esc_html__( 'Categories', 'revision' ),
		'description'     => esc_html__( 'Add comma-separated list of category slugs. For example: &laquo;travel, lifestyle, food&raquo;. Leave empty for all categories.', 'revision' ),
		'section'         => 'header',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_show_categories',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'number',
		'settings'        => 'header_search_categories_limit',
		'label'           => esc_html__( 'Limit', 'revision' ),
		'section'         => 'header',
		'default'         => 4,
		'input_attrs'     => array(
			'min'  => 1,
			'max'  => 99,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'header_search_button',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_show_categories',
				'operator' => '==',
				'value'    => true,
			),
			array(
				'setting'  => 'header_search_filter_categories',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'collapsible',
		'settings' => 'header_collapsible_custom_button',
		'section'  => 'header',
		'label'    => esc_html__( 'Custom Button', 'revision' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'header_custom_button',
		'label'    => esc_html__( 'Display custom button', 'revision' ),
		'section'  => 'header',
		'default'  => false,
	)
);


CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_custom_button_label',
		'label'           => esc_html__( 'Button Label', 'revision' ),
		'section'         => 'header',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_custom_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'header_custom_button_link',
		'label'           => esc_html__( 'Button Link', 'revision' ),
		'section'         => 'header',
		'default'         => '',
		'active_callback' => array(
			array(
				'setting'  => 'header_custom_button',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'header_custom_button_target',
		'section'         => 'header',
		'label'           => esc_html__( 'Target', 'revision' ),
		'default'         => '_self',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'revision' ),
			'_blank' => esc_html__( 'In a new tab', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'header_custom_button',
					'operator' => '==',
					'value'    => true,
				),
			),
		),
	)
);
