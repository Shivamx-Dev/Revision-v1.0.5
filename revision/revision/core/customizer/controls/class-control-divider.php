<?php
/**
 * Customizer Divider
 *
 * @package Revision
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CSCO_Customize_Divider_Control' ) ) {
	/**
	 * Class Customize Divider
	 */
	class CSCO_Customize_Divider_Control extends WP_Customize_Control {

		/**
		 * The field type.
		 *
		 * @var string
		 */
		public $type = 'divider';

		/**
		 * Render the control content.
		 */
		protected function render_content() {
			?>
				<div class="customizer-divider"></div>
			<?php
		}
	}
}
