<?php
/**
 * Customizer Dimension
 *
 * @package Revision
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CSCO_Customize_Dimension_Control' ) ) {
	/**
	 * Class Customize Dimension
	 */
	class CSCO_Customize_Dimension_Control extends WP_Customize_Control {

		/**
		 * The field type.
		 *
		 * @var string
		 */
		public $type = 'dimension';

		/**
		 * Render the control content.
		 */
		protected function render_content() {
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

					<input type="text" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>"/>
				</label>
			<?php
		}
	}
}
