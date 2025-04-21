<?php
/**
 * Customizer Collapsible
 *
 * @package Revision
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CSCO_Customize_Collapsible_Control' ) ) {
	/**
	 * Class Customize Collapsible
	 */
	class CSCO_Customize_Collapsible_Control extends WP_Customize_Control {

		/**
		 * The field type.
		 *
		 * @var string
		 */
		public $type = 'collapsible';

		/**
		 * Render the control content.
		 */
		protected function render_content() {
			$collapsed_class = null;

			if ( isset( $this->input_attrs['collapsed'] ) && $this->input_attrs['collapsed'] ) {
				$collapsed_class = 'customize-collapsed';
			}
			?>
			<div class="customize-collapsible <?php echo esc_attr( $collapsed_class ); ?>"><h3><?php echo esc_html( $this->label ); ?></h3></div>
			<?php
		}
	}
}
