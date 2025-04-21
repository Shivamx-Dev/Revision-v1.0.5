<?php
/**
 * Miscellaneous Settings
 *
 * @package Revision
 */

CSCO_Customizer::add_section(
	'miscellaneous',
	array(
		'title' => esc_html__( 'Miscellaneous Settings', 'revision' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_published_date',
		'label'    => esc_html__( 'Display published date instead of modified date', 'revision' ),
		'section'  => 'miscellaneous',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'misc_social_links_section',
		'label'       => esc_html__( 'Social Links', 'revision' ),
		'section'     => 'miscellaneous',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_social_links',
		'label'    => esc_html__( 'Enable social links', 'revision' ),
		'section'  => 'miscellaneous',
		'default'  => false,
	)
);

// Social 1.
CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_1',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Link 1', 'revision' ),
		'default'         => 'none',
		'choices'         => array(
			'none'   => esc_html__( 'None', 'revision' ),
			'preset' => esc_html__( 'Preset', 'revision' ),
			'custom' => esc_html__( 'Custom', 'revision' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_links',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_1_network',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Network', 'revision' ),
		'default'         => 'instagram',
		'choices'         => array(
			'facebook'  => esc_html__( 'Facebook', 'revision' ),
			'instagram' => esc_html__( 'Instagram', 'revision' ),
			'twitter'   => esc_html__( 'X (Twitter)', 'revision' ),
			'youtube'   => esc_html__( 'Youtube', 'revision' ),
			'linkedin'  => esc_html__( 'LinkedIn', 'revision' ),
			'pinterest' => esc_html__( 'Pinterest', 'revision' ),
			'dribbble'  => esc_html__( 'Dribbble', 'revision' ),
			'behance'   => esc_html__( 'Behance', 'revision' ),
			'reddit'    => esc_html__( 'Reddit', 'revision' ),
			'github'    => esc_html__( 'Github', 'revision' ),
			'telegram'  => esc_html__( 'Telegram', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_1',
					'operator' => '==',
					'value'    => 'preset',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_1_icon',
		'label'           => esc_html__( 'Icon', 'revision' ),
		'description'     => esc_html__( 'Please upload your icon, recommended width and height is 24px.', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_1',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_1_label',
		'label'           => esc_html__( 'Label', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_1',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_1_url',
		'label'           => esc_html__( 'URL', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_1',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_1_target',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Target', 'revision' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'revision' ),
			'_blank' => esc_html__( 'In a new tab', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_1',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

// Social 2.
CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_2',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Link 2', 'revision' ),
		'default'         => 'none',
		'choices'         => array(
			'none'   => esc_html__( 'None', 'revision' ),
			'preset' => esc_html__( 'Preset', 'revision' ),
			'custom' => esc_html__( 'Custom', 'revision' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_links',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_2_network',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Network', 'revision' ),
		'default'         => 'instagram',
		'choices'         => array(
			'facebook'  => esc_html__( 'Facebook', 'revision' ),
			'instagram' => esc_html__( 'Instagram', 'revision' ),
			'twitter'   => esc_html__( 'X (Twitter)', 'revision' ),
			'youtube'   => esc_html__( 'Youtube', 'revision' ),
			'linkedin'  => esc_html__( 'LinkedIn', 'revision' ),
			'pinterest' => esc_html__( 'Pinterest', 'revision' ),
			'dribbble'  => esc_html__( 'Dribbble', 'revision' ),
			'behance'   => esc_html__( 'Behance', 'revision' ),
			'reddit'    => esc_html__( 'Reddit', 'revision' ),
			'github'    => esc_html__( 'Github', 'revision' ),
			'telegram'  => esc_html__( 'Telegram', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_2',
					'operator' => '==',
					'value'    => 'preset',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_2_icon',
		'label'           => esc_html__( 'Icon', 'revision' ),
		'description'     => esc_html__( 'Please upload your icon, recommended width and height is 24px.', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_2',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_2_label',
		'label'           => esc_html__( 'Label', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_2',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_2_url',
		'label'           => esc_html__( 'URL', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_2',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_2_target',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Target', 'revision' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'revision' ),
			'_blank' => esc_html__( 'In a new tab', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_2',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

// Social 3.
CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_3',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Link 3', 'revision' ),
		'default'         => 'none',
		'choices'         => array(
			'none'   => esc_html__( 'None', 'revision' ),
			'preset' => esc_html__( 'Preset', 'revision' ),
			'custom' => esc_html__( 'Custom', 'revision' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_links',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_3_network',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Network', 'revision' ),
		'default'         => 'instagram',
		'choices'         => array(
			'facebook'  => esc_html__( 'Facebook', 'revision' ),
			'instagram' => esc_html__( 'Instagram', 'revision' ),
			'twitter'   => esc_html__( 'X (Twitter)', 'revision' ),
			'youtube'   => esc_html__( 'Youtube', 'revision' ),
			'linkedin'  => esc_html__( 'LinkedIn', 'revision' ),
			'pinterest' => esc_html__( 'Pinterest', 'revision' ),
			'dribbble'  => esc_html__( 'Dribbble', 'revision' ),
			'behance'   => esc_html__( 'Behance', 'revision' ),
			'reddit'    => esc_html__( 'Reddit', 'revision' ),
			'github'    => esc_html__( 'Github', 'revision' ),
			'telegram'  => esc_html__( 'Telegram', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_3',
					'operator' => '==',
					'value'    => 'preset',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_3_icon',
		'label'           => esc_html__( 'Icon', 'revision' ),
		'description'     => esc_html__( 'Please upload your icon, recommended width and height is 24px.', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_3',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_3_label',
		'label'           => esc_html__( 'Label', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_3',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_3_url',
		'label'           => esc_html__( 'URL', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_3',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_3_target',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Target', 'revision' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'revision' ),
			'_blank' => esc_html__( 'In a new tab', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_3',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

// Social 4.
CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_4',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Link 4', 'revision' ),
		'default'         => 'none',
		'choices'         => array(
			'none'   => esc_html__( 'None', 'revision' ),
			'preset' => esc_html__( 'Preset', 'revision' ),
			'custom' => esc_html__( 'Custom', 'revision' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_links',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_4_network',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Network', 'revision' ),
		'default'         => 'instagram',
		'choices'         => array(
			'facebook'  => esc_html__( 'Facebook', 'revision' ),
			'instagram' => esc_html__( 'Instagram', 'revision' ),
			'twitter'   => esc_html__( 'X (Twitter)', 'revision' ),
			'youtube'   => esc_html__( 'Youtube', 'revision' ),
			'linkedin'  => esc_html__( 'LinkedIn', 'revision' ),
			'pinterest' => esc_html__( 'Pinterest', 'revision' ),
			'dribbble'  => esc_html__( 'Dribbble', 'revision' ),
			'behance'   => esc_html__( 'Behance', 'revision' ),
			'reddit'    => esc_html__( 'Reddit', 'revision' ),
			'github'    => esc_html__( 'Github', 'revision' ),
			'telegram'  => esc_html__( 'Telegram', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_4',
					'operator' => '==',
					'value'    => 'preset',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_4_icon',
		'label'           => esc_html__( 'Icon', 'revision' ),
		'description'     => esc_html__( 'Please upload your icon, recommended width and height is 24px.', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_4',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_4_label',
		'label'           => esc_html__( 'Label', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_4',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_4_url',
		'label'           => esc_html__( 'URL', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_4',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_4_target',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Target', 'revision' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'revision' ),
			'_blank' => esc_html__( 'In a new tab', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_4',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);


// Social 5.
CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_5',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Link 5', 'revision' ),
		'default'         => 'none',
		'choices'         => array(
			'none'   => esc_html__( 'None', 'revision' ),
			'preset' => esc_html__( 'Preset', 'revision' ),
			'custom' => esc_html__( 'Custom', 'revision' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_social_links',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_5_network',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Social Network', 'revision' ),
		'default'         => 'instagram',
		'choices'         => array(
			'facebook'  => esc_html__( 'Facebook', 'revision' ),
			'instagram' => esc_html__( 'Instagram', 'revision' ),
			'twitter'   => esc_html__( 'X (Twitter)', 'revision' ),
			'youtube'   => esc_html__( 'Youtube', 'revision' ),
			'linkedin'  => esc_html__( 'LinkedIn', 'revision' ),
			'pinterest' => esc_html__( 'Pinterest', 'revision' ),
			'dribbble'  => esc_html__( 'Dribbble', 'revision' ),
			'behance'   => esc_html__( 'Behance', 'revision' ),
			'reddit'    => esc_html__( 'Reddit', 'revision' ),
			'github'    => esc_html__( 'Github', 'revision' ),
			'telegram'  => esc_html__( 'Telegram', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_5',
					'operator' => '==',
					'value'    => 'preset',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'image',
		'settings'        => 'misc_social_5_icon',
		'label'           => esc_html__( 'Icon', 'revision' ),
		'description'     => esc_html__( 'Please upload your icon, recommended width and height is 24px.', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_5',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_5_label',
		'label'           => esc_html__( 'Label', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_5',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_social_5_url',
		'label'           => esc_html__( 'URL', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => '',
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_5',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'select',
		'settings'        => 'misc_social_5_target',
		'section'         => 'miscellaneous',
		'label'           => esc_html__( 'Target', 'revision' ),
		'default'         => '_blank',
		'choices'         => array(
			'_self'  => esc_html__( 'In the active tab', 'revision' ),
			'_blank' => esc_html__( 'In a new tab', 'revision' ),
		),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'misc_social_links',
					'operator' => '==',
					'value'    => true,
				),
			),
			array(
				array(
					'setting'  => 'misc_social_5',
					'operator' => '!=',
					'value'    => 'none',
				),
			),
		),
	)
);


CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'misc_sticky_sidebar_section',
		'label'       => esc_html__( 'Sticky Sidebar', 'revision' ),
		'section'     => 'miscellaneous',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_sticky_sidebar',
		'label'    => esc_html__( 'Enable sticky sidebar', 'revision' ),
		'section'  => 'miscellaneous',
		'default'  => true,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'radio',
		'settings'        => 'misc_sticky_sidebar_method',
		'label'           => esc_html__( 'Sticky Method', 'revision' ),
		'section'         => 'miscellaneous',
		'default'         => 'cs-stick-to-top',
		'choices'         => array(
			'cs-stick-to-top'    => esc_html__( 'Sidebar top edge', 'revision' ),
			'cs-stick-to-bottom' => esc_html__( 'Sidebar bottom edge', 'revision' ),
			'cs-stick-last'      => esc_html__( 'Last widget top edge', 'revision' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'misc_sticky_sidebar',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'misc_scroll_to_top_section',
		'label'       => esc_html__( 'Scroll to Top', 'revision' ),
		'section'     => 'miscellaneous',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_scroll_to_top',
		'label'    => esc_html__( 'Enable scroll to top button', 'revision' ),
		'section'  => 'miscellaneous',
		'default'  => true,
	)
);
CSCO_Customizer::add_field(
	array(
		'type'        => 'collapsible',
		'settings'    => 'footer_collapsible_subscribe',
		'label'       => esc_html__( 'Subscribe', 'revision' ),
		'section'     => 'miscellaneous',
		'input_attrs' => array(
			'collapsed' => false,
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'     => 'checkbox',
		'settings' => 'misc_subscribe',
		'label'    => esc_html__( 'Enable subscribe section', 'revision' ),
		'section'  => 'miscellaneous',
		'default'  => false,
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_subscribe_heading',
		'label'           => esc_html__( 'Heading', 'revision' ),
		'section'         => 'miscellaneous',
		'active_callback' => array(
			array(
				'setting'  => 'misc_subscribe',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'misc_subscribe_description',
		'label'             => esc_html__( 'Description', 'revision' ),
		'section'           => 'miscellaneous',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'misc_subscribe',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'            => 'text',
		'settings'        => 'misc_subscribe_mailchimp',
		'label'           => esc_html__( 'Mailchimp Form Link', 'revision' ),
		'section'         => 'miscellaneous',
		'active_callback' => array(
			array(
				'setting'  => 'misc_subscribe',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'text',
		'settings'          => 'misc_subscribe_short_description',
		'label'             => esc_html__( 'Short Description', 'revision' ),
		'section'           => 'miscellaneous',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
		'active_callback'   => array(
			array(
				'setting'  => 'misc_subscribe',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
