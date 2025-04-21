<?php
/**
 * Class for the customizer importer.
 *
 * Code is mostly from the Customizer Export/Import plugin.
 *
 * @see https://wordpress.org/plugins/customizer-export-import/
 * @package Revision
 */

/**
 * Customizer Importer
 */
class CSCO_Customizer_Importer {
	/**
	 * Import customizer.
	 *
	 * @param array $data The data.
	 */
	public static function import( $data ) {
		// Try to import the customizer settings.
		return self::import_customizer_options( $data );
	}

	/**
	 * Imports uploaded mods and calls WordPress core customize_save actions so
	 * themes that hook into them can act before mods are saved to the database.
	 *
	 * Update: WP core customize_save actions were removed, because of some errors.
	 *
	 * @param array $data The data.
	 * @return void|WP_Error
	 */
	public static function import_customizer_options( $data ) {
		// Setup global vars.
		global $wp_customize;

		// Data check.
		if ( ! is_array( $data ) || ! isset( $data['mods'] ) ) {
			return new WP_Error(
				'customizer_import_data_error',
				esc_html__( 'Error: The customizer import file is not in a correct format. Please make sure to use the correct customizer import file.', 'revision' )
			);
		}

		/**
		 * Import images.
		 *
		 * The csco_customizer_import_images hook.
		 *
		 * @since 1.0.0
		 */
		if ( apply_filters( 'csco_customizer_import_images', true ) ) {
			$data['mods'] = self::import_customizer_images( $data['mods'] );
		}

		// Import custom options.
		if ( isset( $data['options'] ) ) {
			// Require modified customizer options class.
			if ( ! class_exists( 'WP_Customize_Setting' ) ) {
				require_once ABSPATH . 'wp-includes/class-wp-customize-setting.php';
			}

			if ( ! class_exists( 'CSCO_Customizer_Option' ) ) {
				require_once get_theme_file_path( '/core/theme-demos/import/class-customizer-option.php' );
			}

			foreach ( $data['options'] as $option_key => $option_value ) {
				$option = new CSCO_Customizer_Option( $wp_customize, $option_key, array(
					'default'    => '',
					'type'       => 'option',
					'capability' => 'edit_theme_options',
				) );

				$option->import( $option_value );
			}
		}

		/**
		 * The csco_enable_wp_customize_save_hooks hook.
		 *
		 * @since 1.0.0
		 */
		$use_wp_customize_save_hooks = apply_filters( 'csco_enable_wp_customize_save_hooks', false );

		if ( $use_wp_customize_save_hooks ) {
			/**
			 * The customize_save hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'customize_save', $wp_customize );
		}

		// Import mods.
		if ( isset( $data['mods'] ) && $data['mods'] ) {
			foreach ( $data['mods'] as $key => & $value ) {
				if ( $use_wp_customize_save_hooks ) {
					/**
					 * The customize_save_{$key} hook.
					 *
					 * @since 1.0.0
					 */
					do_action( 'customize_save_' . $key, $wp_customize );
				}

				// Save the mod.
				set_theme_mod( $key, $value );
			}
		}

		// Import mods Adobe Fonts.
		if ( isset( $data['mods_adobe'] ) && $data['mods_adobe'] ) {
			foreach ( $data['mods_adobe'] as $key => & $value ) {
				if ( $use_wp_customize_save_hooks ) {
					/**
					 * The customize_save_{$key} hook.
					 *
					 * @since 1.0.0
					 */
					do_action( 'customize_save_' . $key, $wp_customize );
				}

				$token = get_option( 'powerkit_typekit_fonts_token' );
				$kit   = get_option( 'powerkit_typekit_fonts_kit' );

				$kit_fonts  = get_option( 'pk_typekit_' . $kit . '_s' );
				$families   = ( $kit_fonts ) ? $kit_fonts['kit']['families'] : false;
				$font_found = false;

				// Search for the font slug from a theme_mod in the active Adobe font kit.
				if ( isset( $value['font-family'] ) && $families ) {
					foreach ( $families as $k => $v ) {
						if ( isset( $v['slug'] ) && $value['font-family'] === $v['slug'] ) {
							$font_found = true;
							break;
						}
						if ( isset( $v['css_names'][0] ) && $value['font-family'] === $v['css_names'][0] ) {
							$font_found = true;
							break;
						}
					}
				}

				// Set default font family.
				if ( is_array( $value ) && ( ! $token || ! $kit || ! $font_found ) ) {
					$value['font-family'] = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
				}

				// Save the mod.
				set_theme_mod( $key, $value );
			}
		}

		if ( $use_wp_customize_save_hooks ) {
			/**
			 * The customize_save_after hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'customize_save_after', $wp_customize );
		}
	}

	/**
	 * Helper function: Customizer import - imports images for settings saved as mods.
	 *
	 * @param array $mods An array of customizer mods.
	 * @return array The mods array with any new import data.
	 */
	private static function import_customizer_images( $mods ) {
		foreach ( $mods as $key => $val ) {
			if ( CSCO_Manager_Import::is_image_url( $val ) ) {

				$data = CSCO_Manager_Import::import_custom_image( $val );

				if ( ! is_wp_error( $data ) ) {
					$mods[ $key ] = $data->url;
				}
			}
		}

		return $mods;
	}
}
