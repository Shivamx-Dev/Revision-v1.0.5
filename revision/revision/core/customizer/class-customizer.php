<?php
/**
 * Customizer
 *
 * @package Revision
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CSCO_Customizer' ) ) {
	/**
	 * Class Theme Customizer
	 */
	class CSCO_Customizer {

		/**
		 * A reference to an instance of this class.
		 *
		 * @var object
		 */
		private static $instance = null;

		/**
		 * An array of all our panels.
		 *
		 * @var array
		 */
		public static $panels = array();

		/**
		 * An array of all our sections.
		 *
		 * @var array
		 */
		public static $sections = array();

		/**
		 * An array of all our fields.
		 *
		 * @var array
		 */
		public static $fields = array();

		/**
		 * An array of field dependencies.
		 *
		 * @var array
		 */
		private static $dependencies = array();

		/**
		 * Returns the instance.
		 *
		 * @return object
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * The class constructor
		 */
		public function __construct() {
			/** Include file helper */
			require_once get_theme_file_path( '/core/customizer/class-helper.php' );

			/** Include fonts modules */
			require_once get_theme_file_path( '/core/customizer/modules/class-fonts.php' );
			require_once get_theme_file_path( '/core/customizer/modules/class-fonts-google.php' );
			require_once get_theme_file_path( '/core/customizer/modules/class-fonts-theme.php' );
			require_once get_theme_file_path( '/core/customizer/modules/class-output-styles.php' );

			/** Include files of controls */
			if ( class_exists( 'WP_Customize_Control' ) ) {
				require_once get_theme_file_path( '/core/customizer/controls/class-control-dimension.php' );
				require_once get_theme_file_path( '/core/customizer/controls/class-control-divider.php' );
				require_once get_theme_file_path( '/core/customizer/controls/class-control-heading.php' );
				require_once get_theme_file_path( '/core/customizer/controls/class-control-multicheck.php' );
				require_once get_theme_file_path( '/core/customizer/controls/class-control-collapsible.php' );
				require_once get_theme_file_path( '/core/customizer/controls/class-control-color-alpha.php' );
				require_once get_theme_file_path( '/core/customizer/controls/class-control-typography.php' );
			}

			/** Initialize actions */
			add_action( 'customize_register', array( $this, 'customizer_register' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_controls_enqueue_scripts' ) );
			add_filter( 'csco_customizer_field_add_setting_args', array( $this, 'field_add_setting_args' ) );
			add_filter( 'csco_customizer_field_add_control_args', array( $this, 'field_add_control_args' ) );
		}

		/**
		 * Create a new panel.
		 *
		 * @param string $id   The ID for this panel.
		 * @param array  $args The panel arguments.
		 *
		 * @return void
		 */
		public static function add_panel( $id = '', $args = array() ) {
			self::$panels[ $id ] = $args;
		}

		/**
		 * Create a new section.
		 *
		 * @param string $id   The ID for this section.
		 * @param array  $args The section arguments.
		 *
		 * @return void
		 */
		public static function add_section( $id, $args ) {
			self::$sections[ $id ] = $args;
		}

		/**
		 * Create a new field
		 *
		 * @param array $args The field's arguments.
		 *
		 * @return void
		 */
		public static function add_field( $args ) {
			if ( isset( $args['settings'] ) && isset( $args['type'] ) ) {
				self::$fields[ $args['settings'] ] = $args;
			}
		}

		/**
		 * Register new panels, sections and fields
		 *
		 * @param object $wp_customize The component name.
		 *
		 * @return void
		 */
		public function customizer_register( $wp_customize ) {

			// Set panels.
			foreach ( self::$panels as $panel_id => $panel_args ) {
				$wp_customize->add_panel( $panel_id, $panel_args );
			}

			// Set sections.
			foreach ( self::$sections as $section_id => $section_args ) {
				$wp_customize->add_section( $section_id, $section_args );
			}

			// Register the custom control type.
			$wp_customize->register_control_type( 'CSCO_Customize_Typography_Control' );
			$wp_customize->register_control_type( 'CSCO_Customize_Multicheck_Control' );

			// Set fields.
			foreach ( self::$fields as $field_id => $field_args ) {
				/**
				 * The csco_customizer_field_add_setting_args hook.
				 *
				 * @since 1.0.0
				 */
				$params = apply_filters( 'csco_customizer_field_add_setting_args', $field_args, $wp_customize );

				call_user_func( array( $wp_customize, 'add_setting' ), $field_id, $params );
				/**
				 * The csco_customizer_field_add_control_args hook.
				 *
				 * @since 1.0.0
				 */
				$args = apply_filters( 'csco_customizer_field_add_control_args', $field_args, $wp_customize );

				switch ( $field_args['type'] ) {
					case 'color':
						$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $field_id, $args ) );
						break;
					case 'image':
						$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $field_id, $args ) );
						break;
					case 'dimension':
						$wp_customize->add_control( new CSCO_Customize_Dimension_Control( $wp_customize, $field_id, $args ) );
						break;
					case 'divider':
						$wp_customize->add_control( new CSCO_Customize_Divider_Control( $wp_customize, $field_id, $args ) );
						break;
					case 'heading':
						$wp_customize->add_control( new CSCO_Customize_Heading_Control( $wp_customize, $field_id, $args ) );
						break;
					case 'multicheck':
						$wp_customize->add_control( new CSCO_Customize_Multicheck_Control( $wp_customize, $field_id, $args ) );
						break;
					case 'collapsible':
						$wp_customize->add_control( new CSCO_Customize_Collapsible_Control( $wp_customize, $field_id, $args ) );
						break;
					case 'color-alpha':
						$wp_customize->add_control( new CSCO_Customize_Color_Alpha_Control( $wp_customize, $field_id, $args ) );
						break;
					case 'typography':
						$wp_customize->add_control( new CSCO_Customize_Typography_Control( $wp_customize, $field_id, $args ) );
						break;
					default:
						$wp_customize->add_control( $field_id, $args );
						break;
				}
			}
		}

		/**
		 * Filter setting arguments.
		 *
		 * @param array $args The field arguments.
		 *
		 * @return array
		 */
		public function field_add_setting_args( $args ) {

			$args = array(
				'type'                 => isset( $args['type_mod'] ) ? $args['type_mod'] : 'theme_mod',
				'capability'           => isset( $args['capability'] ) ? $args['capability'] : 'edit_theme_options',
				'theme_supports'       => isset( $args['theme_supports'] ) ? $args['theme_supports'] : '',
				'default'              => isset( $args['default'] ) ? $args['default'] : '',
				'transport'            => isset( $args['transport'] ) ? $args['transport'] : 'refresh',
				'sanitize_callback'    => isset( $args['sanitize_callback'] ) ? $args['sanitize_callback'] : '',
				'sanitize_js_callback' => isset( $args['sanitize_js_callback'] ) ? $args['sanitize_js_callback'] : '',
			);

			return $args;
		}

		/**
		 * Filter control arguments.
		 *
		 * @param array $args The field arguments.
		 *
		 * @return array
		 */
		public function field_add_control_args( $args ) {
			if ( isset( $args['active_callback'] ) ) {
				if ( is_array( $args['active_callback'] ) ) {
					if ( ! is_callable( $args['active_callback'] ) ) {
						foreach ( $args['active_callback'] as $key => $val ) {
							if ( is_callable( $val ) ) {
								unset( $args['active_callback'][ $key ] );
							}
						}
						if ( isset( $args['active_callback'][0] ) ) {
							$args['required'] = $args['active_callback'];
						}
					}
				}
				if ( ! empty( $args['required'] ) ) {
					self::$dependencies[ $args['settings'] ] = $args['required'];
					$args['active_callback']                 = '__return_true';
					return $args;
				}
				// No need to proceed any further if we're using the default value.
				if ( '__return_true' === $args['active_callback'] ) {
					return $args;
				}
				// Make sure the function is callable, otherwise fallback to __return_true.
				if ( ! is_callable( $args['active_callback'] ) ) {
					$args['active_callback'] = '__return_true';
				}
			}

			return $args;
		}

		/**
		 * Enqueue Customizer control scripts.
		 *
		 * @return void
		 */
		public function customizer_controls_enqueue_scripts() {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );

			// Register customize selectWoo scripts.
			wp_register_script( 'selectWoo', get_theme_file_uri( '/core/customizer/assets/selectWoo.full.min.js' ), array( 'jquery' ), filemtime( get_theme_file_path( '/core/customizer/assets/selectWoo.full.min.js' ) ), true );

			// Register customize scripts.
			wp_register_script( 'cs-customizer', get_theme_file_uri( '/core/customizer/assets/customizer.js' ), array( 'jquery', 'customize-controls', 'selectWoo' ), filemtime( get_theme_file_path( '/core/customizer/assets/customizer.js' ) ), true );

			// Localize customize scripts.
			wp_localize_script( 'cs-customizer', 'cscoCustomizerConfig', array(
				'dependencies'         => self::$dependencies,
				'advanced_settings'    => esc_html__( 'Advanced settings', 'revision' ),
				'noFileSelected'       => esc_html__( 'No File Selected', 'revision' ),
				'remove'               => esc_html__( 'Remove', 'revision' ),
				'default'              => esc_html__( 'Default', 'revision' ),
				'selectFile'           => esc_html__( 'Select File', 'revision' ),
				'standardFonts'        => esc_html__( 'Standard Fonts', 'revision' ),
				'googleFonts'          => esc_html__( 'Google Fonts', 'revision' ),
				'defaultCSSValues'     => esc_html__( 'CSS Defaults', 'revision' ),
				'defaultBrowserFamily' => esc_html__( 'Default Browser Font-Family', 'revision' ),
			) );

			// Enqueue customize scripts.
			wp_enqueue_script( 'cs-customizer' );

			// Register customize select2 style.
			wp_register_style( 'selectWoo', get_theme_file_uri( '/core/customizer/assets/selectWoo.min.css' ), array(), filemtime( get_theme_file_path( '/core/customizer/assets/selectWoo.min.css' ) ) );

			// Register customize style.
			wp_register_style( 'cs-customizer', get_theme_file_uri( '/core/customizer/assets/customizer.css' ), array( 'selectWoo' ), filemtime( get_theme_file_path( '/core/customizer/assets/customizer.css' ) ) );

			// Enqueue customize style.
			wp_enqueue_style( 'cs-customizer' );
		}
	}

	if ( ! function_exists( 'csco_customizer' ) ) {
		/**
		 * Returns instanse of the Theme Customizer class.
		 *
		 * @return object
		 */
		function csco_customizer() {
			return CSCO_Customizer::get_instance();
		}
	}
	csco_customizer();
}
