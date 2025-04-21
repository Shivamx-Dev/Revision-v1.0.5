<?php
/**
 * Typography
 *
 * @package Revision
 */

CSCO_Customizer::add_panel(
	'typography',
	array(
		'title' => esc_html__( 'Typography', 'revision' ),
	)
);

CSCO_Customizer::add_section(
	'typography_general',
	array(
		'title' => esc_html__( 'General', 'revision' ),
		'panel' => 'typography',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'typography',
		'settings' => 'font_base',
		'label'    => esc_html__( 'Base Font', 'revision' ),
		'section'  => 'typography_general',
		'default'  => array(
			'font-family'    => 'DM Sans',
			'variant'        => '400',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1rem',
			'letter-spacing' => 'normal',
			'line-height'    => '1.55',
		),
		'choices'  => array(
			'variant' => array(
				'regular',
				'italic',
				'500italic',
				'500',
				'700',
				'700italic',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'typography',
		'settings'    => 'font_primary',
		'label'       => esc_html__( 'Primary Font', 'revision' ),
		'description' => esc_html__( 'Used for buttons, and tags and other actionable elements.', 'revision' ),
		'section'     => 'typography_general',
		'default'     => array(
			'font-family'    => 'DM Sans',
			'variant'        => '800',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1rem',
			'letter-spacing' => '-0.03em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'     => array(
			'variant' => array(
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'typography',
		'settings'    => 'font_secondary',
		'label'       => esc_html__( 'Secondary Font', 'revision' ),
		'description' => esc_html__( 'Used for breadcrumbs and other secondary elements.', 'revision' ),
		'section'     => 'typography_general',
		'default'     => array(
			'font-family'    => 'DM Sans',
			'variant'        => '400',
			'subsets'        => array( 'latin' ),
			'font-size'      => '0.875rem',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
			'line-height'    => '1.55',
		),
		'choices'     => array(
			'variant' => array(
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'typography_advanced_settings',
		'label'    => esc_html__( 'Display advanced typography settings', 'revision' ),
		'section'  => 'typography_general',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_section_headings',
		'label'           => esc_html__( 'Section Headings Font', 'revision' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'DM Sans',
			'variant'        => '800',
			'subsets'        => array( 'latin' ),
			'font-size'      => '0.75rem',
			'letter-spacing' => '0.1em',
			'text-transform' => 'uppercase',
			'line-height'    => '1.2',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_post_title',
		'label'           => esc_html__( 'Post Title Font', 'revision' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'DM Sans',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'font-size'      => '3.25rem',
			'letter-spacing' => '-0.05em',
			'line-height'    => '1.2',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_post_subtitle',
		'label'           => esc_html__( 'Post Subtitle Font', 'revision' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'DM Sans',
			'variant'        => '400',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1.125rem',
			'letter-spacing' => 'normal',
			'line-height'    => '1.55',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'500italic',
				'500',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_category',
		'label'           => esc_html__( 'Post Category Font', 'revision' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'DM Sans',
			'variant'        => '800',
			'subsets'        => array( 'latin' ),
			'font-size'      => '0.6875rem',
			'letter-spacing' => '0.1em',
			'text-transform' => 'uppercase',
			'line-height'    => '1.2',
		),
		'choices'         => array(),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_post_meta',
		'label'           => esc_html__( 'Post Meta Font', 'revision' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'DM Sans',
			'variant'        => '600',
			'subsets'        => array( 'latin' ),
			'font-size'      => '0.9375rem',
			'letter-spacing' => '-0.02em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_post_content',
		'label'           => esc_html__( 'Post Content Font', 'revision' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'DM Sans',
			'variant'        => '400',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1.125rem',
			'letter-spacing' => 'normal',
			'line-height'    => '1.55',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_input',
		'label'           => esc_html__( 'Input Font', 'revision' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'DM Sans',
			'variant'        => '400',
			'subsets'        => array( 'latin' ),
			'font-size'      => '0.875rem',
			'line-height'    => '1.55rem',
			'letter-spacing' => 'normal',
			'text-transform' => 'none',
		),
		'choices'         => array(),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_entry_title',
		'label'           => esc_html__( 'Entry Title Font', 'revision' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'DM Sans',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'letter-spacing' => '-0.04em',
			'line-height'    => '1.2',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_excerpt',
		'label'           => esc_html__( 'Entry Excerpt Font', 'revision' ),
		'section'         => 'typography_general',
		'default'         => array(
			'font-family'    => 'DM Sans',
			'variant'        => '400',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1rem',
			'letter-spacing' => 'normal',
			'line-height'    => '1.55',
		),
		'choices'         => array(
			'variant' => array(
				'regular',
				'italic',
				'500',
				'500italic',
				'600',
				'700',
				'700italic',
			),
		),
		'active_callback' => array(
			array(
				'setting'  => 'typography_advanced_settings',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_section(
	'typography_logos',
	array(
		'title' => esc_html__( 'Logos', 'revision' ),
		'panel' => 'typography',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_main_logo',
		'label'           => esc_html__( 'Main Logo', 'revision' ),
		'description'     => esc_html__( 'The main logo is used in the navigation bar and mobile view of your website.', 'revision' ),
		'section'         => 'typography_logos',
		'default'         => array(
			'font-family'    => 'DM Sans',
			'font-size'      => '1.375rem',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'letter-spacing' => '-0.04em',
			'text-transform' => 'none',
		),
		'choices'         => array(),
		'active_callback' => array(
			array(
				'setting'  => 'logo',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'typography',
		'settings'        => 'font_footer_logo',
		'label'           => esc_html__( 'Footer Logo', 'revision' ),
		'description'     => esc_html__( 'The footer logo is used in the site footer in desktop and mobile view.', 'revision' ),
		'section'         => 'typography_logos',
		'default'         => array(
			'font-family'    => 'DM Sans',
			'font-size'      => '1.375rem',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'letter-spacing' => '-0.04em',
			'text-transform' => 'none',
		),
		'choices'         => array(),
		'active_callback' => array(
			array(
				'setting'  => 'footer_logo',
				'operator' => '==',
				'value'    => '',
			),
		),
	)
);

CSCO_Customizer::add_section(
	'typography_headings',
	array(
		'title' => esc_html__( 'Headings', 'revision' ),
		'panel' => 'typography',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'typography',
		'settings' => 'font_headings',
		'label'    => esc_html__( 'Headings', 'revision' ),
		'section'  => 'typography_headings',
		'default'  => array(
			'font-family'    => 'DM Sans',
			'variant'        => '700',
			'subsets'        => array( 'latin' ),
			'letter-spacing' => '-0.04em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'  => array(
			'variant' => array(
				'regular',
				'italic',
				'500',
				'500italic',
				'700',
				'700italic',
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'typography_headings_collapsible',
		'section'     => 'typography_headings',
		'label'       => esc_html__( 'Headings Font Size', 'revision' ),
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);


CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h1_size',
		'label'             => esc_html__( 'Heading 1', 'revision' ),
		'section'           => 'typography_headings',
		'default'           => '3.25rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-1-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h2_size',
		'label'             => esc_html__( 'Heading 2', 'revision' ),
		'section'           => 'typography_headings',
		'default'           => '2.625rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-2-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h3_size',
		'label'             => esc_html__( 'Heading 3', 'revision' ),
		'section'           => 'typography_headings',
		'default'           => '2.0625rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-3-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h4_size',
		'label'             => esc_html__( 'Heading 4', 'revision' ),
		'section'           => 'typography_headings',
		'default'           => '1.5rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-4-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h5_size',
		'label'             => esc_html__( 'Heading 5', 'revision' ),
		'section'           => 'typography_headings',
		'default'           => '1.3125rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-5-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'dimension',
		'settings'          => 'font_h6_size',
		'label'             => esc_html__( 'Heading 6', 'revision' ),
		'section'           => 'typography_headings',
		'default'           => '1.125rem',
		'sanitize_callback' => 'esc_html',
		'output'            => array(
			array(
				'element'  => ':root',
				'property' => '--cs-heading-6-font-size',
				'context'  => array( 'editor', 'front' ),
			),
		),
	)
);

CSCO_Customizer::add_section(
	'typography_navigation',
	array(
		'title' => esc_html__( 'Navigation', 'revision' ),
		'panel' => 'typography',
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'typography',
		'settings'    => 'font_menu',
		'label'       => esc_html__( 'Menu Font', 'revision' ),
		'description' => esc_html__( 'Used for main top level menu elements.', 'revision' ),
		'section'     => 'typography_navigation',
		'default'     => array(
			'font-family'    => 'DM Sans',
			'variant'        => '600',
			'subsets'        => array( 'latin' ),
			'font-size'      => '1rem',
			'letter-spacing' => '-0.03em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'     => array(),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'typography',
		'settings'    => 'font_submenu',
		'label'       => esc_html__( 'Submenu Font', 'revision' ),
		'description' => esc_html__( 'Used for submenu elements.', 'revision' ),
		'section'     => 'typography_navigation',
		'default'     => array(
			'font-family'    => 'DM Sans',
			'subsets'        => array( 'latin' ),
			'variant'        => '600',
			'font-size'      => '1rem',
			'letter-spacing' => '-0.03em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'     => array(),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'typography',
		'settings' => 'font_footer_menu',
		'label'    => esc_html__( 'Footer Menu Font', 'revision' ),
		'section'  => 'typography_navigation',
		'default'  => array(
			'font-family'    => 'DM Sans',
			'variant'        => '800',
			'subsets'        => array( 'latin' ),
			'font-size'      => '0.75rem',
			'letter-spacing' => '0.1em',
			'text-transform' => 'uppercase',
			'line-height'    => '1.2',
		),
		'choices'  => array(),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'typography',
		'settings' => 'font_footer_submenu',
		'label'    => esc_html__( 'Footer Submenu Font', 'revision' ),
		'section'  => 'typography_navigation',
		'default'  => array(
			'font-family'    => 'DM Sans',
			'subsets'        => array( 'latin' ),
			'variant'        => '600',
			'font-size'      => '1rem',
			'letter-spacing' => '-0.03em',
			'text-transform' => 'none',
			'line-height'    => '1.2',
		),
		'choices'  => array(),
	)
);
