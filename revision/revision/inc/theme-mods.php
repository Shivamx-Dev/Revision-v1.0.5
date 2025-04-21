<?php
/**
 * Theme mods
 *
 * @package Revision
 */

/**
 * Register Theme Mods
 */
function csco_register_theme_mods() {

	/**
	 * Site Identity.
	 */
	require get_template_directory() . '/inc/theme-mods/site-identity.php';

	/**
	* Colors.
	*/
	require get_template_directory() . '/inc/theme-mods/colors-settings.php';

	/**
	 * Typography.
	 */
	require get_template_directory() . '/inc/theme-mods/typography-settings.php';

	/**
	 * Header Settings.
	 */
	require get_template_directory() . '/inc/theme-mods/header-settings.php';

	/**
	* Footer Settings.
	*/
	require get_template_directory() . '/inc/theme-mods/footer-settings.php';

	/**
	* Homepage Settings.
	*/
	require get_template_directory() . '/inc/theme-mods/homepage-settings.php';

	/**
	* Archive Settings.
	*/
	require get_template_directory() . '/inc/theme-mods/archive-settings.php';

	/**
	* Posts Settings.
	*/
	require get_template_directory() . '/inc/theme-mods/post-settings.php';

	/**
	* Pages Settings.
	*/
	require get_template_directory() . '/inc/theme-mods/page-settings.php';

	/**
	* Miscellaneous Settings.
	*/
	require get_template_directory() . '/inc/theme-mods/miscellaneous-settings.php';
}
add_action( 'after_setup_theme', 'csco_register_theme_mods', 20 );
