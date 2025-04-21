<?php
/**
 * Customizer Color Alpha
 *
 * @package Revision
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CSCO_Customize_Color_Alpha_Control' ) ) {
		/**
		 * Class Customize Color Alpha
		 */
	class CSCO_Customize_Color_Alpha_Control extends WP_Customize_Control {

		/**
		 * The field type.
		 *
		 * @var string
		 */
		public $type = 'color-alpha';

		/**
		 * Add support for palettes to be passed in.
		 *
		 * Supported palette values are true, false, or an array of RGBa and Hex colors.
		 *
		 * @var bool
		 */
		public $palette;

		/**
		 * Add support for showing the opacity value on the slider handle.
		 *
		 * @var bool
		 */
		public $alpha;

		/**
		 * Render the control.
		 */
		public function render_content() {

			if ( is_array( $this->palette ) ) {
				$palette = implode( '|', $this->palette );
			} else {
				$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
			}

			$alpha = ( false === $this->alpha || 'false' === $this->alpha ) ? 'false' : 'true';
			?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

					<?php
					if ( isset( $this->description ) && $this->description ) {
						?>
						<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
						<?php
					}
					?>
				</label>

				<input class="color-alpha-control" type="text" data-alpha="<?php echo esc_attr( $alpha ); ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />
			<?php
		}
	}

}
