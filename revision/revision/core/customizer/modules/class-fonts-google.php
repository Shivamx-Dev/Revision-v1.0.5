<?php
/**
 * Customizer Fonts Google
 *
 * @package Revision
 */

if ( ! class_exists( 'CSCO_Customizer_Fonts_Google' ) ) {
	/**
	 * Customizer Fonts Google Class.
	 */
	final class CSCO_Customizer_Fonts_Google {

		/**
		 * The array of fonts
		 *
		 * @var array
		 */
		public $fonts_output = array();

		/**
		 * An array of all google fonts.
		 *
		 * @var array
		 */
		private $google_fonts = array();

		/**
		 * Fonts to load.
		 *
		 * @var array
		 */
		protected $fonts_to_load = array();

		/**
		 * The class constructor.
		 */
		public function __construct() {
			$this->google_fonts = CSCO_Customizer_Fonts::get_google_fonts();

			/** Initialize actions */
			add_action( 'wp_loaded', array( $this, 'populate_fonts' ) );
			add_filter( 'wp_resource_hints', array( $this, 'resource_hints' ), 10, 2 );

			if ( ! is_admin() || is_customize_preview() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_google_fonts' ), 999 );
			} else {
				add_action( 'enqueue_block_assets', array( $this, 'enqueue_google_fonts' ), 999 );
			}
		}

		/**
		 * Loader for Google Fonts.
		 */
		public function populate_fonts() {
			// Go through our fields and populate $this->fonts_output.
			$this->loop_fields();

			// Goes through $this->fonts_output and adds or removes things as needed.
			$this->process_fonts();

			foreach ( $this->fonts_output as $font => $weights ) {
				foreach ( $weights as $key => $value ) {
					if ( 'italic' === $value ) {
						$weights[ $key ] = '400i';
					} else {
						$weights[ $key ] = str_replace( array( 'regular', 'bold', 'italic' ), array( '400', '', 'i' ), $value );
					}
				}

				$this->fonts_to_load[] = array(
					'family'  => $font,
					'weights' => $weights,
				);
			}
		}

		/**
		 * Goes through all our fields and then populates the $this->fonts_output property.
		 */
		public function loop_fields() {
			$fields = CSCO_Customizer::$fields;

			if ( is_array( $fields ) && $fields ) {
				foreach ( $fields as $field ) {
					if ( ! isset( $field['type'] ) || false === strpos( $field['type'], 'typography' ) ) {
						continue;
					}

					// Check active callback.
					if ( ! CSCO_Customizer_Helper::active_callback( $field ) ) {
						continue;
					}

					// Get the value.
					$value = CSCO_Customizer_Helper::get_value( $field['settings'] );

					// If we don't have a font-family then we can skip this.
					if ( ! isset( $value['font-family'] ) ) {
						continue;
					}

					// If not a google-font, then we can skip this.
					if ( ! isset( $value['font-family'] ) || ! CSCO_Customizer_Fonts::is_google_font( $value['font-family'] ) ) {
						continue;
					}

					// Set a default value for variants.
					if ( ! isset( $value['variant'] ) ) {
						$value['variant'] = 'regular';
					}

					// Add the requested google-font.
					if ( ! isset( $this->fonts_output[ $value['font-family'] ] ) ) {
						$this->fonts_output[ $value['font-family'] ] = array();
					}

					if ( ! in_array( $value['variant'], $this->fonts_output[ $value['font-family'] ], true ) ) {
						$this->fonts_output[ $value['font-family'] ][] = $value['variant'];
					}

					if ( isset( $field['choices']['variant'] ) && is_array( $field['choices']['variant'] ) ) {
						foreach ( $field['choices']['variant'] as $extra_variant ) {
							if ( ! in_array( $extra_variant, $this->fonts_output[ $value['font-family'] ], true ) ) {
								$this->fonts_output[ $value['font-family'] ][] = $extra_variant;
							}
						}
					}
				}
			}
		}

		/**
		 * Determines the vbalidity of the selected font as well as its properties.
		 * This is vital to make sure that the google-font script that we'll generate later
		 * does not contain any invalid options.
		 */
		public function process_fonts() {

			// Early exit if font-family is empty.
			if ( empty( $this->fonts_output ) ) {
				return;
			}

			foreach ( $this->fonts_output as $font => $variants ) {

				// Determine if this is indeed a google font or not.
				// If it's not, then just remove it from the array.
				if ( ! array_key_exists( $font, $this->google_fonts ) ) {
					unset( $this->fonts_output[ $font ] );
					continue;
				}

				// Get all valid font variants for this font.
				$font_variants = array();

				if ( isset( $this->google_fonts[ $font ]['variants'] ) ) {
					$font_variants = $this->google_fonts[ $font ]['variants'];
				}

				foreach ( $variants as $variant ) {
					// If this is not a valid variant for this font-family
					// then unset it and move on to the next one.
					if ( ! in_array( strval( $variant ), $font_variants, true ) ) {
						$variant_key = array_search( $variant, $this->fonts_output[ $font ], true );
						unset( $this->fonts_output[ $font ][ $variant_key ] );
						continue;
					}
				}
			}
		}

		/**
		 * Add preconnect for Google Fonts.
		 *
		 * @param array  $urls          URLs to print for resource hints.
		 * @param string $relation_type The relation type the URLs are printed.
		 */
		public function resource_hints( $urls, $relation_type ) {
			$fonts_to_load = $this->fonts_output;

			if ( ! empty( $fonts_to_load ) && 'preconnect' === $relation_type ) {
				$urls[] = array(
					'href' => 'https://fonts.gstatic.com',
					'crossorigin',
				);
			}
			return $urls;
		}

		/**
		 * Enqueue Google fonts.
		 */
		public function enqueue_google_fonts() {

			foreach ( $this->fonts_to_load as $font ) {
				// Set family.
				$family = str_replace( ' ', '+', trim( $font['family'] ) );

				// Set weights.
				$weights = join( ',', $font['weights'] );

				/**
				 * The csco_customizer_google_fonts_subset hook.
				 *
				 * @since 1.0.0
				 */
				$subset = apply_filters( 'csco_customizer_google_fonts_subset', 'latin,latin-ext,cyrillic,cyrillic-ext,vietnamese' );

				$url = "https://fonts.googleapis.com/css?family={$family}:{$weights}&subset={$subset}&display=swap";

				wp_enqueue_style( md5( $url ), $url, array(), csco_get_theme_data( 'Version' ) );
			}
		}
	}

	new CSCO_Customizer_Fonts_Google();
}
