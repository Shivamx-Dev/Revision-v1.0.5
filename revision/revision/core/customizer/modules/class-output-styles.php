<?php
/**
 * Theme Customizer Output Styles
 *
 * @package Revision
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CSCO_Customizer_Output_Styles' ) ) {
	/**
	 * Class Theme Customizer Output
	 */
	class CSCO_Customizer_Output_Styles {

		/**
		 * The class constructor
		 */
		public function __construct() {
			if ( ! is_admin() || is_customize_preview() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_output_styles' ), 999 );
			} else {
				add_action( 'enqueue_block_assets', array( $this, 'enqueue_output_styles' ), 999 );
			}
		}

		/**
		 * Gets all our styles and returns them as a string.
		 */
		public function get_output_styles() {

			$output_styles = __return_empty_string();

			// Get an array of all our fields.
			$fields = CSCO_Customizer::$fields;

			// Check if we need to exit early.
			if ( empty( $fields ) || ! is_array( $fields ) ) {
				return;
			}

			// Initially we're going to format our styles as an array.
			// This is going to make processing them a lot easier
			// and make sure there are no duplicate styles etc.
			$css = array();

			// Start parsing our fields.
			foreach ( $fields as $field ) {
				// No need to process fields without an output, or an improperly-formatted output.
				if ( ! isset( $field['output'] ) || empty( $field['output'] ) || ! is_array( $field['output'] ) ) {
					continue;
				}

				// Get the value of this field.
				$value = CSCO_Customizer_Helper::get_value( $field['settings'] );

				// Check active callback.
				if ( ! CSCO_Customizer_Helper::active_callback( $field ) ) {
					continue;
				}

				// Start parsing the output arguments of the field.
				foreach ( $field['output'] as $output ) {

					if ( is_admin() && ! is_customize_preview() ) {
						// Check if this is an admin style.
						if ( ! isset( $output['context'] ) || ! in_array( 'editor', $output['context'], true ) ) {
							continue;
						}
					} elseif ( isset( $output['context'] ) && ! in_array( 'front', $output['context'], true ) ) {
						// Check if this is a frontend style.
						continue;
					}

					$output = wp_parse_args(
						$output, array(
							'element'       => '',
							'property'      => '',
							'media_query'   => 'global',
							'prefix'        => '',
							'units'         => '',
							'suffix'        => '',
							'value_pattern' => '$',
							'choice'        => '',
							'convert'       => '',
						)
					);
					// If element is an array, convert it to a string.
					if ( is_array( $output['element'] ) ) {
						$output['element'] = implode( ',', $output['element'] );
					}
					// Simple fields.
					if ( ! is_array( $value ) ) {
						$value_pattern = str_replace( '$', ( $value ? $value : '' ), $output['value_pattern'] );

						if ( 'rgb' === $output['convert'] ) {
							$value_pattern = csco_hex2rgba( $value_pattern, false );
						}

						if ( ! empty( $output['element'] ) && ! empty( $output['property'] ) && $value_pattern ) {
							$css[ $output['media_query'] ][ $output['element'] ][ $output['property'] ] = $output['prefix'] . $value_pattern . $output['units'] . $output['suffix'];
						}
					} else {
						if ( 'typography' === $field['type'] ) {

							$value = CSCO_Customizer_Helper::typography_sanitize( $value );

							$properties = array(
								'font-family',
								'font-size',
								'variant',
								'font-weight',
								'font-style',
								'letter-spacing',
								'word-spacing',
								'line-height',
								'text-align',
								'text-transform',
								'text-decoration',
								'color',
							);

							foreach ( $properties as $property ) {
								// Early exit if the value is not in the defaults.
								if ( ! isset( $field['default'][ $property ] ) ) {
									continue;
								}

								// Early exit if the value is not saved in the values.
								if ( ! isset( $value[ $property ] ) || ! $value[ $property ] ) {
									continue;
								}

								// Take care of variants.
								if ( 'variant' === $property && isset( $value['variant'] ) && ! empty( $value['variant'] ) ) {

									// Get the font_weight.
									$font_weight = str_replace( 'italic', '', $value['variant'] );
									$font_weight = in_array( $font_weight, array( '', 'regular' ), true ) ? '400' : $font_weight;

									$css[ $output['media_query'] ][ $output['element'] ]['font-weight'] = $font_weight;

									// Is this italic?
									$is_italic = ( false !== strpos( $value['variant'], 'italic' ) );
									if ( $is_italic ) {
										$css[ $output['media_query'] ][ $output['element'] ]['font-style'] = 'italic';
									}
									continue;
								}

								$css[ $output['media_query'] ][ $output['element'] ][ $property ] = $output['prefix'] . $value[ $property ] . $output['suffix'];
							}
						} elseif ( 'multicolor' === $field['type'] ) {

							if ( ! empty( $output['element'] ) && ! empty( $output['property'] ) && ! empty( $output['choice'] ) ) {
								$css[ $output['media_query'] ][ $output['element'] ][ $output['property'] ] = $output['prefix'] . $value[ $output['choice'] ] . $output['units'] . $output['suffix'];
							}
						} else {
							foreach ( $value as $key => $subvalue ) {
								$property = $key;

								if ( false !== strpos( $output['property'], '%%' ) ) {

									$property = str_replace( '%%', $key, $output['property'] );

								} elseif ( ! empty( $output['property'] ) ) {

									$output['property'] = $output['property'] . '-' . $key;
								}

								if ( 'background-image' === $output['property'] && false === strpos( $subvalue, 'url(' ) ) {
									$subvalue = sprintf( 'url("%s")', set_url_scheme( $subvalue ) );
								}
								if ( $subvalue ) {
									$css[ $output['media_query'] ][ $output['element'] ][ $property ] = $subvalue;
								}
							}
						}
					}
				}
			}

			// Process the array of CSS properties and produce the final CSS.
			if ( ! is_array( $css ) || empty( $css ) ) {
				return null;
			}

			foreach ( $css as $media_query => $styles ) {
				$output_styles .= ( 'global' !== $media_query ) ? $media_query . '{' : '';

				foreach ( $styles as $style => $style_array ) {
					$css_for_style = '';

					foreach ( $style_array as $property => $value ) {
						if ( is_string( $value ) && '' !== $value ) {
							$css_for_style .= sprintf( '%s:%s;', $property, $value );
						} elseif ( is_array( $value ) ) {
							foreach ( $value as $subvalue ) {
								if ( is_string( $subvalue ) && '' !== $subvalue ) {
									$css_for_style .= sprintf( '%s:%s;', $property, $subvalue );
								}
							}
						}
						$value = ( is_string( $value ) ) ? $value : '';
					}
					if ( '' !== $css_for_style ) {
						$output_styles .= $style . sprintf( '{%s}', $css_for_style );
					}
				}

				$output_styles .= ( 'global' !== $media_query ) ? '}' : '';
			}

			/**
			 * The csco_customizer_output_styles hook.
			 *
			 * @since 1.0.0
			 */
			$output_styles = apply_filters( 'csco_customizer_output_styles', $output_styles );

			return $output_styles;
		}

		/**
		 * Enqueue output styles.
		 */
		public function enqueue_output_styles() {
			wp_register_style( 'cs-customizer-output-styles', false, array(), csco_get_theme_data( 'Version' ) );

			wp_enqueue_style( 'cs-customizer-output-styles' );

			wp_add_inline_style( 'cs-customizer-output-styles', $this->get_output_styles() );
		}
	}

	new CSCO_Customizer_Output_Styles();
}
