<?php
/**
 * Filters.
 *
 * @package Revision
 */

/**
 * Disable wp_check_widget_editor_deps.
 */
function csco_disable_wp_check_widget_editor_deps() {
	call_user_func( 'remove_filter', 'admin_head', 'wp_check_widget_editor_deps' );
}
add_filter( 'init', 'csco_disable_wp_check_widget_editor_deps' );
