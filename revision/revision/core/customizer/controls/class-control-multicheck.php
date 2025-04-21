<?php
/**
 * Customizer Multicheck
 *
 * @package Revision
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CSCO_Customize_Multicheck_Control' ) ) {
	/**
	 * Class Customize Multicheck
	 */
	class CSCO_Customize_Multicheck_Control extends WP_Customize_Control {

		/**
		 * The field type.
		 *
		 * @var string
		 */
		public $type = 'multicheck';

		/**
		 * Constructor.
		 *
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
		 * @param string               $id      Control ID.
		 * @param array                $args    The args.
		 */
		public function __construct( $manager, $id, $args = array() ) {

			parent::__construct( $manager, $id, $args );

			// Init choices.
			if ( ! is_array( $this->choices ) ) {
				$this->choices = array();
			}
		}

		/**
		 * Render the control's content.
		 */
		protected function render_content() {}

		/**
		 * Sets the $sanitize_callback
		 */
		protected function sanitize_callback() {

			// If a custom sanitize_callback has been defined,
			// then we don't need to proceed any further.
			if ( ! empty( $this->sanitize_callback ) ) {
				return;
			}
			$this->sanitize_callback = array( $this, 'sanitize' );
		}

		/**
		 * The sanitize method that will be used as a falback
		 *
		 * @param string|array $value The control's value.
		 */
		public function sanitize( $value ) {
			$value = ( ! is_array( $value ) ) ? explode( ',', $value ) : $value;
			return ( ! empty( $value ) ) ? array_map( 'sanitize_text_field', $value ) : array();
		}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			// Value.
			$this->json['value'] = $this->value();

			// The link.
			$this->json['link'] = $this->get_link();

			// Choices.
			$this->json['choices'] = $this->choices;

			// The ID.
			$this->json['id'] = $this->id;
		}

		/**
		 * An Underscore (JS) template for this control's content (but not its container).
		 *
		 * Class variables for this control class are available in the `data` JS object;
		 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
		 *
		 * @see WP_Customize_Control::print_template()
		 */
		protected function content_template() {
			?>
			<# if ( ! data.choices ) { return; } #>

			<# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
			<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><# } #>

			<ul>
				<# for ( key in data.choices ) { #>
					<li><label<# if ( _.contains( data.value, key ) ) { #> class="checked"<# } #>><input {{{ data.inputAttrs }}} type="checkbox" value="{{ key }}"<# if ( _.contains( data.value, key ) ) { #> checked<# } #> />{{ data.choices[ key ] }}</label></li>
				<# } #>
			</ul>
			<?php
		}
	}
}
