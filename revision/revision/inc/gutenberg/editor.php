<?php
/**
 * Editor Settings.
 *
 * @package Revision
 */

/**
 * Enqueue editor scripts
 */
function csco_block_editor_scripts() {
	wp_enqueue_script(
		'cs-editor-scripts',
		get_template_directory_uri() . '/assets/jsx/editor-scripts.js',
		array(
			'wp-editor',
			'wp-element',
			'wp-compose',
			'wp-data',
			'wp-plugins',
		),
		csco_get_theme_data( 'Version' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'csco_block_editor_scripts' );

/**
 * Adds classes to <div class="editor-styles-wrapper"> tag
 */
function csco_block_editor_wrapper() {
	$script_handle = 'cs-editor-wrapper';
	$script_file   = 'editor-wrapper.js';

	if ( 'enqueue_block_assets' === current_filter() ) {
		if ( ! ( is_admin() && ! is_customize_preview() ) ) {
			return;
		}

		$script_handle = 'cs-editor-iframe';
		$script_file   = 'editor-iframe.js';
	}

	$post_id = get_the_ID();

	if ( ! $post_id ) {
		return;
	}

	// Set post type.
	$post_type = sprintf( 'post-type-%s', get_post_type( $post_id ) );

	// Set page layout.
	$default_layout = csco_get_page_sidebar( $post_id, 'default' );
	$page_layout    = csco_get_page_sidebar( $post_id, false );

	if ( 'disabled' === $default_layout ) {
		$default_layout = 'cs-sidebar-disabled';
	} else {
		$default_layout = 'cs-sidebar-enabled';
	}

	if ( 'disabled' === $page_layout ) {
		$page_layout = 'cs-sidebar-disabled';
	} else {
		$page_layout = 'cs-sidebar-enabled';
	}

	// Set breakpoints.
	$breakpoints = array(
		'cs-breakpoint-up-576px'  => 576,
		'cs-breakpoint-up-768px'  => 768,
		'cs-breakpoint-up-992px'  => 992,
		'cs-breakpoint-up-1200px' => 1200,
		'cs-breakpoint-up-1336px' => 1336,
		'cs-breakpoint-up-1920px' => 1920,
	);

	wp_enqueue_script(
		$script_handle,
		get_template_directory_uri() . '/assets/jsx/' . $script_file,
		array(
			'wp-editor',
			'wp-element',
			'wp-compose',
			'wp-data',
			'wp-plugins',
		),
		csco_get_theme_data( 'Version' ),
		true
	);

	wp_localize_script(
		$script_handle,
		'cscoGWrapper',
		array(
			'post_type'      => $post_type,
			'default_layout' => $default_layout,
			'page_layout'    => $page_layout,
			'breakpoints'    => $breakpoints,
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'csco_block_editor_wrapper' );
add_action( 'enqueue_block_assets', 'csco_block_editor_wrapper' );

/**
 * Change editor color palette.
 */
function csco_change_editor_color_palette() {
	// Editor Color Palette.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Primary', 'revision' ),
				'slug'  => 'primary',
				'color' => get_theme_mod( 'color_primary', '#29294B' ),
			),
			array(
				'name'  => esc_html__( 'Secondary', 'revision' ),
				'slug'  => 'secondary',
				'color' => get_theme_mod( 'color_secondary', '#696981' ),
			),
			array(
				'name'  => esc_html__( 'Layout', 'revision' ),
				'slug'  => 'layout',
				'color' => get_theme_mod( 'color_layout_background', '#F1F1F1' ),
			),
			array(
				'name'  => esc_html__( 'Accent', 'revision' ),
				'slug'  => 'accent',
				'color' => get_theme_mod( 'color_accent', '#5955D1' ),
			),
			array(
				'name'  => esc_html__( 'Border', 'revision' ),
				'slug'  => 'border',
				'color' => get_theme_mod( 'color_border', '#E1E1E8' ),
			),
			array(
				'name'  => esc_html__( 'Blue', 'revision' ),
				'slug'  => 'blue',
				'color' => '#59BACC',
			),
			array(
				'name'  => esc_html__( 'Green', 'revision' ),
				'slug'  => 'green',
				'color' => '#58AD69',
			),
			array(
				'name'  => esc_html__( 'Orange', 'revision' ),
				'slug'  => 'orange',
				'color' => '#FFBC49',
			),
			array(
				'name'  => esc_html__( 'Red', 'revision' ),
				'slug'  => 'red',
				'color' => '#e32c26',
			),
			array(
				'name'  => esc_html__( 'Pale Pink', 'revision' ),
				'slug'  => 'pale-pink',
				'color' => '#f78da7',
			),
			array(
				'name'  => esc_html__( 'White', 'revision' ),
				'slug'  => 'white',
				'color' => '#FFFFFF',
			),
			array(
				'name'  => esc_html__( 'Gray 50', 'revision' ),
				'slug'  => 'gray-50',
				'color' => '#f8f9fa',
			),
			array(
				'name'  => esc_html__( 'Gray 100', 'revision' ),
				'slug'  => 'gray-100',
				'color' => '#f8f9fa',
			),
			array(
				'name'  => esc_html__( 'Gray 200', 'revision' ),
				'slug'  => 'gray-200',
				'color' => '#E1E1E8',
			),
		)
	);
}
add_action( 'after_setup_theme', 'csco_change_editor_color_palette' );
