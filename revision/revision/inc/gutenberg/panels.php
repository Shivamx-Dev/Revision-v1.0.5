<?php
/**
 * Adding New Panels.
 *
 * @package Revision
 */

/**
 * Register meta fields for gutenberg panels
 */
function csco_gutenberg_panels_register_meta() {

	$post_types = array( 'post', 'page' );

	// Loop Post Types.
	foreach ( $post_types as $post_type ) {

		/**
		 * ==================================
		 * Layout Options
		 * ==================================
		 */

		register_post_meta(
			$post_type,
			'csco_singular_sidebar',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			$post_type,
			'csco_page_header_type',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);

		register_post_meta(
			$post_type,
			'csco_page_load_nextpost',
			array(
				'show_in_rest'  => true,
				'type'          => 'string',
				'single'        => true,
				'auth_callback' => function () {
					return current_user_can( 'edit_posts' );
				},
			)
		);
	}
}
add_action( 'init', 'csco_gutenberg_panels_register_meta' );

/**
 * Filters whether a meta key is considered protected.
 *
 * @param bool   $protected Whether the key is considered protected.
 * @param string $meta_key  Metadata key.
 * @param string $meta_type Type of object metadata is for.
 */
function csco_is_protected_meta( $protected, $meta_key, $meta_type ) {
	$hide_meta_keys = array(
		'csco_singular_sidebar',
		'csco_page_header_type',
		'csco_page_load_nextpost',
	);

	if ( in_array( $meta_key, $hide_meta_keys, true ) ) {
		$protected = true;
	}

	return $protected;
}
add_filter( 'is_protected_meta', 'csco_is_protected_meta', 10, 3 );

/**
 * Enqueue assets  for gutenberg panels
 */
function csco_gutenberg_panels_assets() {

	$post_id = get_the_ID();

	if ( ! $post_id ) {
		return;
	}

	$post = get_post( $post_id );

	$page_static = array();

	// Add pages static.
	$page_static[] = get_option( 'page_on_front' );
	$page_static[] = get_option( 'page_for_posts' );

	// Set options.
	$singular_sidebar = array(
		array(
			'value' => 'default',
			'label' => esc_html__( 'Default', 'revision' ),
		),
		array(
			'value' => 'right',
			'label' => esc_html__( 'Right Sidebar', 'revision' ),
		),
		array(
			'value' => 'left',
			'label' => esc_html__( 'Left Sidebar', 'revision' ),
		),
		array(
			'value' => 'disabled',
			'label' => esc_html__( 'No Sidebar', 'revision' ),
		),
	);

	$page_header_type = array();
	$page_load_nextpost = array();

	if ( 'post' === $post->post_type || 'page' === $post->post_type ) {
		$page_header_type = array(
			array(
				'value' => 'default',
				'label' => esc_html__( 'Default', 'revision' ),
			),
			array(
				'value' => 'standard',
				'label' => esc_html__( 'Standard', 'revision' ),
			),
			array(
				'value' => 'split',
				'label' => esc_html__( 'Split', 'revision' ),
			),
			array(
				'value' => 'overlay',
				'label' => esc_html__( 'Overlay', 'revision' ),
			),
			array(
				'value' => 'title',
				'label' => esc_html__( 'Page Title Only', 'revision' ),
			),
			array(
				'value' => 'none',
				'label' => esc_html__( 'None', 'revision' ),
			),
		);

		if ( 'post' === $post->post_type ) {
			$page_load_nextpost = array(
				array(
					'value' => 'default',
					'label' => esc_html__( 'Default', 'revision' ),
				),
				array(
					'value' => 'enabled',
					'label' => esc_html__( 'Enabled', 'revision' ),
				),
				array(
					'value' => 'disabled',
					'label' => esc_html__( 'Disabled', 'revision' ),
				),
			);
		}
	}

	$panels_data = array(
		'postType'         => $post->post_type,
		'singularSidebar'  => $singular_sidebar,
		'pageHeaderType'   => $page_header_type,
		'pageLoadNextpost' => apply_filters( 'csco_editor_page_load_nextpost', $page_load_nextpost ),
	);

	// Enqueue scripts.
	wp_enqueue_script(
		'csco-editor-panels',
		get_template_directory_uri() . '/assets/jsx/panels.js',
		array(
			'wp-i18n',
			'wp-blocks',
			'wp-edit-post',
			'wp-element',
			'wp-editor',
			'wp-components',
			'wp-data',
			'wp-plugins',
			'wp-edit-post',
			'wp-hooks',
		),
		csco_get_theme_data( 'Version' ),
		true
	);

	// Localize scripts.
	wp_localize_script(
		'csco-editor-panels',
		'csPanelsData',
		apply_filters( 'csco_panels_data', $panels_data, $post )
	);
}
add_action( 'enqueue_block_editor_assets', 'csco_gutenberg_panels_assets' );
