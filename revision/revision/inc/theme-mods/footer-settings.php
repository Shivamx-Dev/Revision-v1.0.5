<?php
/**
 * Footer Settings
 *
 * @package Revision
 */

CSCO_Customizer::add_section(
	'footer',
	array(
		'title' => esc_html__( 'Footer Settings', 'revision' ),
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'footer_text',
		'label'             => esc_html__( 'Footer Text', 'revision' ),
		'section'           => 'footer',
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
	)
);

CSCO_Customizer::add_field(
	array(
		'type'              => 'textarea',
		'settings'          => 'footer_copyright',
		'label'             => esc_html__( 'Footer Copyright', 'revision' ),
		'section'           => 'footer',
		'default'           => esc_html__( '© 2024 — Revision. All Rights Reserved.', 'revision' ),
		'sanitize_callback' => function ( $val ) {
			return wp_kses( $val, 'content' );
		},
	)
);
