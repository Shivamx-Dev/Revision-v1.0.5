<?php
/**
 * Customizer Typography
 *
 * @package Revision
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CSCO_Customize_Typography_Control' ) ) {
	/**
	 * Class Customize Typography
	 */
	class CSCO_Customize_Typography_Control extends WP_Customize_Control {

		/**
		 * Control's Type.
		 *
		 * @var string
		 */
		public $type = 'typography';

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

			/**
			 * The csco_customizer_fonts_choices hook.
			 *
			 * @since 1.0.0
			 */
			$this->choices = apply_filters( 'csco_customizer_fonts_choices', wp_parse_args(
				$this->choices,
				array(
					'variant' => array(),
					'fonts'   => array(
						'standard' => array(),
						'google'   => array(),
					),
				)
			) );
		}

		/**
		 * Render the control's content.
		 */
		protected function render_content() {}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			// Default value.
			$this->json['default'] = $this->setting->default;

			if ( isset( $this->default ) ) {
				$this->json['default'] = $this->default;
			}

			// Value.
			$this->json['value'] = $this->value();

			// The link.
			$this->json['link'] = $this->get_link();

			// Choices.
			$this->json['choices'] = $this->choices;

			// The ID.
			$this->json['id'] = $this->id;

			// The filter value.
			if ( is_array( $this->json['value'] ) ) {
				foreach ( array_keys( $this->json['value'] ) as $key ) {
					if ( ! in_array( $key, array( 'variant', 'font-weight', 'font-style' ), true ) && ! isset( $this->json['default'][ $key ] ) ) {
						unset( $this->json['value'][ $key ] );
					}

					if ( ! isset( $this->json['default'][ $key ] ) ) {
						unset( $this->json['value'][ $key ] );
					}

					if ( isset( $this->json['default'][ $key ] ) && false === $this->json['default'][ $key ] ) {
						unset( $this->json['value'][ $key ] );
					}
				}
			}

			$this->json['show_variants'] = true;
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
			<label class="customizer-text">
				<# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
				<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><# } #>
			</label>

			<div class="wrapper">

				<# if ( ! _.isUndefined( data.default['font-family'] ) ) { #>
					<# data.value['font-family'] = data.value['font-family'] || data['default']['font-family']; #>

					<# if ( data.choices['fonts'] ) { data.fonts = data.choices['fonts']; } #>

					<div class="font-family">
						<h5><?php esc_html_e( 'Font Family', 'revision' ); ?></h5>
						<select {{{ data.inputAttrs }}} id="cs-typography-font-family-{{{ data.id }}}" placeholder="<?php esc_attr_e( 'Select Font Family', 'revision' ); ?>"></select>
					</div>

					<# if ( true === data.show_variants || false !== data.default.variant ) { #>
						<div class="variant cs-variant-wrapper">
							<h5><?php esc_html_e( 'Variant', 'revision' ); ?></h5>
							<select {{{ data.inputAttrs }}} class="variant" id="cs-typography-variant-{{{ data.id }}}"></select>
						</div>
					<# } #>
				<# } #>

				<# if ( ! _.isUndefined( data.default['font-size'] ) ) { #>
					<# data.value['font-size'] = data.value['font-size'] || data['default']['font-size']; #>
					<div class="font-size">
						<h5><?php esc_html_e( 'Font Size', 'revision' ); ?></h5>
						<input {{{ data.inputAttrs }}} type="text" value="{{ data.value['font-size'] }}"/>
					</div>
				<# } #>

				<# if ( ! _.isUndefined( data.default['line-height'] ) ) { #>
					<# data.value['line-height'] = data.value['line-height'] || data['default']['line-height']; #>
					<div class="line-height">
						<h5><?php esc_html_e( 'Line Height', 'revision' ); ?></h5>
						<input {{{ data.inputAttrs }}} type="text" value="{{ data.value['line-height'] }}"/>
					</div>
				<# } #>

				<# if ( ! _.isUndefined( data.default['letter-spacing'] ) ) { #>
					<# data.value['letter-spacing'] = data.value['letter-spacing'] || data['default']['letter-spacing']; #>
					<div class="letter-spacing">
						<h5><?php esc_html_e( 'Letter Spacing', 'revision' ); ?></h5>
						<input {{{ data.inputAttrs }}} type="text" value="{{ data.value['letter-spacing'] }}"/>
					</div>
				<# } #>

				<# if ( ! _.isUndefined( data.default['word-spacing'] ) ) { #>
					<# data.value['word-spacing'] = data.value['word-spacing'] || data['default']['word-spacing']; #>
					<div class="word-spacing">
						<h5><?php esc_html_e( 'Word Spacing', 'revision' ); ?></h5>
						<input {{{ data.inputAttrs }}} type="text" value="{{ data.value['word-spacing'] }}"/>
					</div>
				<# } #>

				<# if ( ! _.isUndefined( data.default['text-align'] ) ) { #>
					<# data.value['text-align'] = data.value['text-align'] || data['default']['text-align']; #>
					<div class="text-align">
						<h5><?php esc_html_e( 'Text Align', 'revision' ); ?></h5>
						<div class="text-align-choices">
							<input {{{ data.inputAttrs }}} type="radio" value="inherit" name="_customize-typography-text-align-radio-{{ data.id }}" id="{{ data.id }}-text-align-inherit" <# if ( data.value['text-align'] === 'inherit' ) { #> checked="checked"<# } #>>
								<label for="{{ data.id }}-text-align-inherit">
									<span class="dashicons dashicons-editor-removeformatting"></span>
									<span class="screen-reader-text"><?php esc_html_e( 'Inherit', 'revision' ); ?></span>
								</label>
							</input>
							<input {{{ data.inputAttrs }}} type="radio" value="left" name="_customize-typography-text-align-radio-{{ data.id }}" id="{{ data.id }}-text-align-left" <# if ( data.value['text-align'] === 'left' ) { #> checked="checked"<# } #>>
								<label for="{{ data.id }}-text-align-left">
									<span class="dashicons dashicons-editor-alignleft"></span>
									<span class="screen-reader-text"><?php esc_html_e( 'Left', 'revision' ); ?></span>
								</label>
							</input>
							<input {{{ data.inputAttrs }}} type="radio" value="center" name="_customize-typography-text-align-radio-{{ data.id }}" id="{{ data.id }}-text-align-center" <# if ( data.value['text-align'] === 'center' ) { #> checked="checked"<# } #>>
								<label for="{{ data.id }}-text-align-center">
									<span class="dashicons dashicons-editor-aligncenter"></span>
									<span class="screen-reader-text"><?php esc_html_e( 'Center', 'revision' ); ?></span>
								</label>
							</input>
							<input {{{ data.inputAttrs }}} type="radio" value="right" name="_customize-typography-text-align-radio-{{ data.id }}" id="{{ data.id }}-text-align-right" <# if ( data.value['text-align'] === 'right' ) { #> checked="checked"<# } #>>
								<label for="{{ data.id }}-text-align-right">
									<span class="dashicons dashicons-editor-alignright"></span>
									<span class="screen-reader-text"><?php esc_html_e( 'Right', 'revision' ); ?></span>
								</label>
							</input>
							<input {{{ data.inputAttrs }}} type="radio" value="justify" name="_customize-typography-text-align-radio-{{ data.id }}" id="{{ data.id }}-text-align-justify" <# if ( data.value['text-align'] === 'justify' ) { #> checked="checked"<# } #>>
								<label for="{{ data.id }}-text-align-justify">
									<span class="dashicons dashicons-editor-justify"></span>
									<span class="screen-reader-text"><?php esc_html_e( 'Justify', 'revision' ); ?></span>
								</label>
							</input>
						</div>
					</div>
				<# } #>

				<# if ( ! _.isUndefined( data.default['text-transform'] ) ) { #>
					<# data.value['text-transform'] = data.value['text-transform'] || data['default']['text-transform']; #>
					<div class="text-transform">
						<h5><?php esc_html_e( 'Text Transform', 'revision' ); ?></h5>
						<select {{{ data.inputAttrs }}} id="cs-typography-text-transform-{{{ data.id }}}">
							<option value=""<# if ( '' === data.value['text-transform'] ) { #>selected<# } #>></option>
							<option value="none"<# if ( 'none' === data.value['text-transform'] ) { #>selected<# } #>><?php esc_html_e( 'None', 'revision' ); ?></option>
							<option value="capitalize"<# if ( 'capitalize' === data.value['text-transform'] ) { #>selected<# } #>><?php esc_html_e( 'Capitalize', 'revision' ); ?></option>
							<option value="uppercase"<# if ( 'uppercase' === data.value['text-transform'] ) { #>selected<# } #>><?php esc_html_e( 'Uppercase', 'revision' ); ?></option>
							<option value="lowercase"<# if ( 'lowercase' === data.value['text-transform'] ) { #>selected<# } #>><?php esc_html_e( 'Lowercase', 'revision' ); ?></option>
							<option value="initial"<# if ( 'initial' === data.value['text-transform'] ) { #>selected<# } #>><?php esc_html_e( 'Initial', 'revision' ); ?></option>
							<option value="inherit"<# if ( 'inherit' === data.value['text-transform'] ) { #>selected<# } #>><?php esc_html_e( 'Inherit', 'revision' ); ?></option>
						</select>
					</div>
				<# } #>

				<# if ( ! _.isUndefined( data.default['text-decoration'] ) ) { #>
					<# data.value['text-decoration'] = data.value['text-decoration'] || data['default']['text-decoration']; #>
					<div class="text-decoration">
						<h5><?php esc_html_e( 'Text Decoration', 'revision' ); ?></h5>
						<select {{{ data.inputAttrs }}} id="cs-typography-text-decoration-{{{ data.id }}}">
							<option value=""<# if ( '' === data.value['text-decoration'] ) { #>selected<# } #>></option>
							<option value="none"<# if ( 'none' === data.value['text-decoration'] ) { #>selected<# } #>><?php esc_html_e( 'None', 'revision' ); ?></option>
							<option value="underline"<# if ( 'underline' === data.value['text-decoration'] ) { #>selected<# } #>><?php esc_html_e( 'Underline', 'revision' ); ?></option>
							<option value="overline"<# if ( 'overline' === data.value['text-decoration'] ) { #>selected<# } #>><?php esc_html_e( 'Overline', 'revision' ); ?></option>
							<option value="line-through"<# if ( 'line-through' === data.value['text-decoration'] ) { #>selected<# } #>><?php esc_html_e( 'Line-Through', 'revision' ); ?></option>
							<option value="initial"<# if ( 'initial' === data.value['text-decoration'] ) { #>selected<# } #>><?php esc_html_e( 'Initial', 'revision' ); ?></option>
							<option value="inherit"<# if ( 'inherit' === data.value['text-decoration'] ) { #>selected<# } #>><?php esc_html_e( 'Inherit', 'revision' ); ?></option>
						</select>
					</div>
				<# } #>

			</div>
			<input class="typography-hidden-value" type="hidden" {{{ data.link }}}>
			<?php
		}

		/**
		 * Formats variants.
		 *
		 * @param array $variants The variants.
		 * @return array
		 */
		protected function format_variants_array( $variants ) {
			$all_variants = CSCO_Customizer_Fonts::get_all_variants();

			$final_variants = array();
			foreach ( $variants as $variant ) {
				if ( is_string( $variant ) ) {
					$final_variants[] = array(
						'id'    => $variant,
						'label' => isset( $all_variants[ $variant ] ) ? $all_variants[ $variant ] : $variant,
					);
				} elseif ( is_array( $variant ) && isset( $variant['id'] ) && isset( $variant['label'] ) ) {
					$final_variants[] = $variant;
				}
			}

			return $final_variants;
		}
	}
}
