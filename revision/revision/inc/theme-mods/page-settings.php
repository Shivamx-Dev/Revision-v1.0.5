<?php
/**
 * Page Settings
 *
 * @package Revision
 */

CSCO_Customizer::add_section(
	'page_settings',
	array(
		'title' => esc_html__( 'Page Settings', 'revision' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'radio',
		'settings' => 'page_sidebar',
		'label'    => esc_html__( 'Default Sidebar', 'revision' ),
		'section'  => 'page_settings',
		'default'  => 'disabled',
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
		'settings' => 'page_header_type',
		'label'    => esc_html__( 'Page Header Type', 'revision' ),
		'section'  => 'page_settings',
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
		'settings'        => 'page_media_preview',
		'label'           => esc_html__( 'Standard Page Header Preview', 'revision' ),
		'section'         => 'page_settings',
		'default'         => 'cropped',
		'choices'         => array(
			'cropped'   => esc_html__( 'Display Cropped Image', 'revision' ),
			'uncropped' => esc_html__( 'Display Preview in Original Ratio', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'page_header_type',
					'operator' => '==',
					'value'    => 'standard',
				),
			),
		),
	)
);
