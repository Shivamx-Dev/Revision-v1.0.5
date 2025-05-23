<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Revision
 */

/**
 * The csco_sidebar hook.
 *
 * @since 1.0.0
 */
$sidebar = apply_filters( 'csco_sidebar', 'sidebar-main' );

if ( 'disabled' !== csco_get_page_sidebar() ) {
	?>
	<aside id="secondary" class="cs-widget-area cs-sidebar__area">
		<div class="cs-sidebar__inner">

			<?php
			/**
			 * The csco_sidebar_start hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_sidebar_start' );
			?>

			<?php dynamic_sidebar( $sidebar ); ?>

			<?php
			/**
			 * The csco_sidebar_end hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_sidebar_end' );
			?>

		</div>
	</aside>
	<?php
}
