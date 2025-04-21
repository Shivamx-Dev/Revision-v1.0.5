<?php
/**
 * Deprecated features and migration functions
 *
 * @package Revision
 */

/**
 * Check Theme Version
 */
function csco_check_theme_version() {

	// Get Theme info.
	$theme_name = get_template();
	$theme      = wp_get_theme( $theme_name );
	$theme_ver  = $theme->get( 'Version' );

	// Get Theme option.
	$csco_theme_version = get_option( 'csco_theme_version_' . $theme_name );

	// Get old version.
	if ( $theme_name && isset( $csco_theme_version ) ) {
		$old_theme_ver = $csco_theme_version;
	}

	// First start.
	if ( ! isset( $old_theme_ver ) ) {
		$old_theme_ver = 0;
	}

	// If versions don't match.
	if ( $old_theme_ver !== $theme_ver ) {

		/**
		 * If different versions call a special hook.
		 *
		 * @param string $old_theme_ver  Old theme version.
		 * @param string $theme_ver      New theme version.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_theme_deprecated', $old_theme_ver, $theme_ver );

		update_option( 'csco_theme_version_' . $theme_name, $theme_ver );
	}
}
add_action( 'init', 'csco_check_theme_version', 30 );

/**
 * Run migration.
 *
 * @param string $old_theme_ver Old Theme version.
 * @param string $theme_ver     Current Theme version.
 */
function csco_run_migration( $old_theme_ver, $theme_ver ) {
	// Version 1.0.1.
	if ( version_compare( '1.0.1', $old_theme_ver, '>' ) ) {
		delete_option( 'csco_elementor_init' );
	}
}
add_action( 'csco_theme_deprecated', 'csco_run_migration', 10, 2 );
