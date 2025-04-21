<?php
/**
 * Colors
 *
 * @package Revision
 */

CSCO_Customizer::add_panel(
	'colors',
	array(
		'title' => esc_html__( 'Colors', 'revision' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'color_scheme',
		'label'    => esc_html__( 'Site Color Scheme', 'revision' ),
		'section'  => 'colors',
		'default'  => 'system',
		'choices'  => array(
			'system' => esc_html__( 'User’s system preference', 'revision' ),
			'light'  => esc_html__( 'Light', 'revision' ),
			'dark'   => esc_html__( 'Dark', 'revision' ),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'color_scheme_toggle',
		'label'    => esc_html__( 'Enable dark/light mode toggle', 'revision' ),
		'section'  => 'colors',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'divider' ),
		'section'  => 'colors',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_primary',
		'label'    => esc_html__( 'Primary Color', 'revision' ),
		'section'  => 'colors',
		'default'  => '#29294B',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-primary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_primary_color_is_dark',
		'label'    => esc_html__( 'Primary Color Dark', 'revision' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-primary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_secondary',
		'label'    => esc_html__( 'Secondary Color', 'revision' ),
		'section'  => 'colors',
		'default'  => '#696981',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-secondary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_secondary_color_is_dark',
		'label'    => esc_html__( 'Secondary Color Dark', 'revision' ),
		'section'  => 'colors',
		'default'  => '#CDCDCD',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-secondary-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_accent',
		'label'    => esc_html__( 'Accent Color', 'revision' ),
		'section'  => 'colors',
		'default'  => '#5955D1',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-accent-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_accent_color_is_dark',
		'label'    => esc_html__( 'Accent Color Dark', 'revision' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-accent-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'divider' ),
		'section'  => 'colors',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'heading',
		'label'    => esc_html__( 'Site Background Color', 'revision' ),
		'settings' => wp_unique_id( 'heading' ),
		'section'  => 'colors',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_site_background_start',
		'label'    => esc_html__( 'Gradient Start', 'revision' ),
		'section'  => 'colors',
		'default'  => '#FDFDFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-site-background-start',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_site_background_start_is_dark',
		'label'    => esc_html__( 'Gradient Start Dark', 'revision' ),
		'section'  => 'colors',
		'default'  => '#1C1C1C',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-site-background-start',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_site_background_end',
		'label'    => esc_html__( 'Gradient End', 'revision' ),
		'section'  => 'colors',
		'default'  => '#F8F7FF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-site-background-end',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_site_background_end_is_dark',
		'label'    => esc_html__( 'Gradient End Dark', 'revision' ),
		'section'  => 'colors',
		'default'  => '#1C1C1C',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-site-background-end',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'divider' ),
		'section'  => 'colors',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_layout_background',
		'label'    => esc_html__( 'Layout Background', 'revision' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-layout-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_layout_background_is_dark',
		'label'    => esc_html__( 'Layout Background Dark', 'revision' ),
		'section'  => 'colors',
		'default'  => '#222222',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-layout-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_offcanvas_background',
		'label'    => esc_html__( 'Offcanvas Background', 'revision' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-offcanvas-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_offcanvas_background_is_dark',
		'label'    => esc_html__( 'Offcanvas Background Dark', 'revision' ),
		'section'  => 'colors',
		'default'  => '#222222',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-offcanvas-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'divider' ),
		'section'  => 'colors',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'heading',
		'label'    => esc_html__( 'Site Header Color', 'revision' ),
		'settings' => wp_unique_id( 'heading' ),
		'section'  => 'colors',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_background',
		'label'    => esc_html__( 'Header Background', 'revision' ),
		'section'  => 'colors',
		'default'  => '#FDFDFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-header-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_background_is_dark',
		'label'    => esc_html__( 'Header Background Dark', 'revision' ),
		'section'  => 'colors',
		'default'  => '#1C1C1C',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-header-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_submenu_background',
		'label'    => esc_html__( 'Header Submenu Background', 'revision' ),
		'section'  => 'colors',
		'default'  => '#FFFFFF',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-header-submenu-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_submenu_background_is_dark',
		'label'    => esc_html__( 'Header Submenu Background Dark', 'revision' ),
		'section'  => 'colors',
		'default'  => '#222222',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-header-submenu-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_highlight_background',
		'label'    => esc_html__( 'Highlight Color', 'revision' ),
		'section'  => 'colors',
		'default'  => '#F2F2F6',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-header-highlight-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'color-alpha',
		'settings' => 'color_header_highlight_background_is_dark',
		'label'    => esc_html__( 'Highlight Color Dark', 'revision' ),
		'section'  => 'colors',
		'default'  => '#3D3D3D',
		'alpha'    => true,
		'output'   => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-header-highlight-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'divider',
		'settings' => wp_unique_id( 'divider' ),
		'section'  => 'colors',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'color_advanced_settings',
		'label'    => esc_html__( 'Display advanced color settings', 'revision' ),
		'section'  => 'colors',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'divider' ),
		'section'         => 'colors',
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => false,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input_background',
		'label'           => esc_html__( 'Input Background', 'revision' ),
		'default'         => '#FFFFFF',
		'section'         => 'colors',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-input-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input_background_is_dark',
		'label'           => esc_html__( 'Input Background Dark', 'revision' ),
		'default'         => '#222222',
		'section'         => 'colors',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-input-background',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input',
		'label'           => esc_html__( 'Input Color', 'revision' ),
		'default'         => '#29294B',
		'section'         => 'colors',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-input-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_input_color_is_dark',
		'label'           => esc_html__( 'Input Color Dark', 'revision' ),
		'default'         => '#FFFFFF',
		'section'         => 'colors',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-input-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'divider' ),
		'section'         => 'colors',
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'heading',
		'label'           => esc_html__( 'Site Buttons Color', 'revision' ),
		'settings'        => wp_unique_id( 'heading' ),
		'section'         => 'colors',
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_start',
		'label'           => esc_html__( 'Primary Gradient Start', 'revision' ),
		'section'         => 'colors',
		'default'         => '#9895FF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-background-start',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_start_is_dark',
		'label'           => esc_html__( 'Primary Dark Gradient Start', 'revision' ),
		'section'         => 'colors',
		'default'         => '#434343',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-background-start',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_end',
		'label'           => esc_html__( 'Primary Gradient End', 'revision' ),
		'section'         => 'colors',
		'default'         => '#514DCC',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-background-end',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_end_is_dark',
		'label'           => esc_html__( 'Primary Dark Gradient End', 'revision' ),
		'section'         => 'colors',
		'default'         => '#0F0F0F',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-background-end',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button',
		'label'           => esc_html__( 'Primary Text Color', 'revision' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_color_is_dark',
		'label'           => esc_html__( 'Primary Text Color Dark', 'revision' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_hover_start',
		'label'           => esc_html__( 'Hover Gradient Start', 'revision' ),
		'section'         => 'colors',
		'default'         => '#8E8BFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-hover-background-start',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_hover_start_is_dark',
		'label'           => esc_html__( 'Hover Dark Gradient Start', 'revision' ),
		'section'         => 'colors',
		'default'         => '#383838',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-hover-background-start',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_hover_end',
		'label'           => esc_html__( 'Hover Gradient End', 'revision' ),
		'section'         => 'colors',
		'default'         => '#4440B4',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-hover-background-end',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_background_hover_end_is_dark',
		'label'           => esc_html__( 'Hover Dark Gradient End', 'revision' ),
		'section'         => 'colors',
		'default'         => '#010101',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-hover-background-end',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_hover',
		'label'           => esc_html__( 'Hover Text Color', 'revision' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-button-hover-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_button_hover_color_is_dark',
		'label'           => esc_html__( 'Hover Text Color Dark', 'revision' ),
		'section'         => 'colors',
		'default'         => '#FFFFFF',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-button-hover-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'divider' ),
		'section'         => 'colors',
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_border',
		'label'           => esc_html__( 'Border Color', 'revision' ),
		'description'     => esc_html__( 'Used on Form Inputs, Separators etc.', 'revision' ),
		'section'         => 'colors',
		'default'         => '#E1E1E8',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-light-border-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_border_color_is_dark',
		'label'           => esc_html__( 'Border Color Dark', 'revision' ),
		'section'         => 'colors',
		'default'         => '#2E2E2E',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root',
				'property' => '--cs-dark-border-color',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_overlay',
		'label'           => esc_html__( 'Overlay Background', 'revision' ),
		'section'         => 'colors',
		'default'         => '#000000',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root, [data-scheme="light"]',
				'property' => '--cs-light-overlay-background-rgb',
				'context'  => array( 'editor', 'front' ),
				'convert'  => 'rgb',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'color-alpha',
		'settings'        => 'color_overlay_color_is_dark',
		'label'           => esc_html__( 'Overlay Background Dark', 'revision' ),
		'section'         => 'colors',
		'default'         => '#000000',
		'alpha'           => true,
		'output'          => array(
			array(
				'element'  => ':root, [data-scheme="dark"]',
				'property' => '--cs-dark-overlay-background-rgb',
				'context'  => array( 'editor', 'front' ),
				'convert'  => 'rgb',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'color_advanced_border_settings',
		'label'    => esc_html__( 'Display border radius settings', 'revision' ),
		'section'  => 'colors',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'divider',
		'settings'        => wp_unique_id( 'divider' ),
		'section'         => 'color_border_settings',
		'active_callback' => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_layout elements_border_radius',
		'label'             => esc_html__( 'Layout Elements Border Radius', 'revision' ),
		'description'       => esc_html__( 'Used on Form Elements, Blockquotes, Block Groups etc.', 'revision' ),
		'section'           => 'colors',
		'default'           => '8px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-layout-elements-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_thumbnail_border_radius',
		'label'             => esc_html__( 'Thumbnail Border Radius', 'revision' ),
		'section'           => 'colors',
		'default'           => '16px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-thumbnail-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_button_border_radius',
		'label'             => esc_html__( 'Button Border Radius', 'revision' ),
		'section'           => 'colors',
		'default'           => '8px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-button-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_input_border_radius',
		'label'             => esc_html__( 'Input Border Radius', 'revision' ),
		'section'           => 'colors',
		'default'           => '8px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-input-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'color_tag_border_radius',
		'label'             => esc_html__( 'Tag Border Radius', 'revision' ),
		'section'           => 'colors',
		'default'           => '6px',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-tag-border-radius',
				'context'  => array( 'editor', 'front' ),
			),
		),
		'active_callback'   => array(
			array(
				'setting'  => 'color_advanced_border_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
