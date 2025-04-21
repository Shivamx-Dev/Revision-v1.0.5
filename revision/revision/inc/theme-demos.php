<?php
/**
 * Theme Demos
 *
 * @package Revision
 */

/**
 * Register Demos of Theme
 */
function csco_demos_list() {

	$plugins = array(
		array(
			'name'     => 'Regenerate Thumbnails',
			'slug'     => 'regenerate-thumbnails',
			'path'     => 'regenerate-thumbnails/regenerate-thumbnails.php',
			'required' => false,
			'desc'     => esc_html__( 'Regenerate the thumbnails for one or more of your image uploads. Useful when changing their sizes or your theme.', 'revision' ),
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'path'     => 'contact-form-7/wp-contact-form-7.php',
			'required' => false,
			'desc'     => esc_html__( 'Just another contact form plugin. Simple but flexible.', 'revision' ),
		),
	);

	$demos = array(
		'classic-list'    => array(
			'name'      => esc_html__( 'Classic List', 'revision' ),
			'preview'   => 'https://revision.codesupply.co/revision/',
			'thumbnail' => get_template_directory_uri() . '/import/classic-list-thumbnail.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/revision/classic-list-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/revision/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'revision' ),
						'url'   => 'https://cloud.codesupply.co/import/revision/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'revision' ),
					),
				),
			),
		),
		'classic-grid'    => array(
			'name'      => esc_html__( 'Classic Grid', 'revision' ),
			'preview'   => 'https://revision.codesupply.co/revision/?homepage=2',
			'thumbnail' => get_template_directory_uri() . '/import/classic-grid-thumbnail.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/revision/classic-grid-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/revision/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'revision' ),
						'url'   => 'https://cloud.codesupply.co/import/revision/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'revision' ),
					),
				),
			),
		),
		'classic-overlay' => array(
			'name'      => esc_html__( 'Classic Overlay', 'revision' ),
			'preview'   => 'https://revision.codesupply.co/revision/?homepage=3',
			'thumbnail' => get_template_directory_uri() . '/import/classic-overlay-thumbnail.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/revision/classic-overlay-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/revision/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'revision' ),
						'url'   => 'https://cloud.codesupply.co/import/revision/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'revision' ),
					),
				),
			),
		),
		'hero-slider'     => array(
			'name'      => esc_html__( 'Hero Slider', 'revision' ),
			'preview'   => 'https://revision.codesupply.co/revision/?homepage=4',
			'thumbnail' => get_template_directory_uri() . '/import/hero-slider-thumbnail.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/revision/hero-slider-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/revision/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'revision' ),
						'url'   => 'https://cloud.codesupply.co/import/revision/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'revision' ),
					),
				),
			),
		),
		'featured-posts'  => array(
			'name'      => esc_html__( 'Featured Posts', 'revision' ),
			'preview'   => 'https://revision.codesupply.co/revision/?homepage=5',
			'thumbnail' => get_template_directory_uri() . '/import/featured-posts-thumbnail.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/revision/featured-posts-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/revision/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'revision' ),
						'url'   => 'https://cloud.codesupply.co/import/revision/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'revision' ),
					),
				),
			),
		),
		'full-list'       => array(
			'name'      => esc_html__( 'Full List', 'revision' ),
			'preview'   => 'https://revision.codesupply.co/revision/?homepage=6',
			'thumbnail' => get_template_directory_uri() . '/import/full-list-thumbnail.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/revision/full-list-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/revision/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'revision' ),
						'url'   => 'https://cloud.codesupply.co/import/revision/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'revision' ),
					),
				),
			),
		),
		'full-grid'       => array(
			'name'      => esc_html__( 'Full Grid', 'revision' ),
			'preview'   => 'https://revision.codesupply.co/revision/?homepage=7',
			'thumbnail' => get_template_directory_uri() . '/import/full-grid-thumbnail.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/revision/full-grid-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/revision/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'revision' ),
						'url'   => 'https://cloud.codesupply.co/import/revision/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'revision' ),
					),
				),
			),
		),
		'full-overlay'    => array(
			'name'      => esc_html__( 'Full Overlay', 'revision' ),
			'preview'   => 'https://revision.codesupply.co/revision/?homepage=8',
			'thumbnail' => get_template_directory_uri() . '/import/full-overlay-thumbnail.jpg',
			'plugins'   => $plugins,
			'import'    => array(
				'customizer' => 'https://cloud.codesupply.co/import/revision/full-overlay-customizer.dat',
				'widgets'    => 'https://cloud.codesupply.co/import/revision/widgets.wie',
				'content'    => array(
					array(
						'label' => esc_html__( 'Demo Content', 'revision' ),
						'url'   => 'https://cloud.codesupply.co/import/revision/content.xml',
						'desc'  => esc_html__( 'Enabling this option will import demo posts, categories, and secondary pages. It\'s recommended to disable this option for existing', 'revision' ),
					),
				),
			),
		),
	);

	return $demos;
}
add_filter( 'csco_register_demos_list', 'csco_demos_list' );

/**
 * Set terms and import associated images for each category.
 *
 * This function loops through all categories, checks for associated images (logos and icons),
 * and imports and assigns them to the corresponding taxonomy meta fields.
 */
function csco_import_terms_images_for_categories() {

	$categories = get_terms( array(
		'taxonomy'   => 'category',
		'hide_empty' => false,
	) );

	$fields = array(
		'csco_category_logo' => '_csco_category_logo',
		'csco_category_icon' => '_csco_category_icon',
	);

	foreach ( $categories as $category ) {

		foreach ( $fields as $meta_key_id => $meta_key_url ) {

			$meta_val = get_term_meta( $category->term_id, $meta_key_url, true );

			if ( $meta_val && CSCO_Manager_Import::is_image_url( $meta_val ) ) {
				$data = CSCO_Manager_Import::import_custom_image( $meta_val );

				if ( ! is_wp_error( $data ) ) {
					update_term_meta( $category->term_id, $meta_key_id, $data->attachment_id );
					update_term_meta( $category->term_id, $meta_key_url, $data->url );
				}
			}
		}
	}
}

/**
 * Finish Import
 */
function csco_hook_finish_import() {

	/* Set menu locations. */
	$nav_menu_locations = array();

	$main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
	if ( $main_menu ) {
		$nav_menu_locations['primary'] = $main_menu->term_id;
	}

	$offcanvas_menu = get_term_by( 'name', 'Mobile', 'nav_menu' );
	if ( $mobile_menu ) {
		$nav_menu_locations['mobile'] = $mobile_menu->term_id;
	}

	$footer_menu = get_term_by( 'name', 'Footer', 'nav_menu' );
	if ( $footer_menu ) {
		$nav_menu_locations['footer'] = $footer_menu->term_id;
	}

	if ( $nav_menu_locations ) {
		set_theme_mod( 'nav_menu_locations', $nav_menu_locations );
	}

	// Call the function directly wherever needed.
	if ( ! get_option( 'once_finished_import' ) ) {
		csco_import_terms_images_for_categories();
	}

	/* Add items to main menu */
	update_option( 'once_finished_import', true );
}
add_action( 'csco_finish_import', 'csco_hook_finish_import' );
