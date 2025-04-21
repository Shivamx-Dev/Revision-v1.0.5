<?php
/**
 * All core theme actions.
 *
 * Please do not modify this file directly.
 * You may remove actions in your child theme by using remove_action().
 *
 * Please see /inc/partials.php for the list of partials,
 * added to actions.
 *
 * @package Revision
 */

/**
 * Body
 */

add_action( 'csco_site_before', 'csco_offcanvas' );
add_action( 'csco_main_content_before', 'csco_theme_breadcrumbs', 100 );

/**
 * Main
 */
add_action( 'csco_main_content_before', 'csco_page_header', 100 );

/**
 * Singular
 */
add_action( 'csco_entry_content_before', 'csco_singular_post_type_before', 10 );
add_action( 'csco_entry_content_after', 'csco_singular_post_type_after', 999 );


/**
 * Home Hero
 */
add_action( 'csco_main_content_before', 'csco_home_hero_standard', 110 );
add_action( 'csco_site_content_before', 'csco_home_hero_fullwidth', 10 );

/**
 * Entry Header
 */
add_action( 'csco_main_content_before', 'csco_entry_header', 110 );

/**
 * Entry Sections
 */
add_action( 'csco_entry_content_after', 'csco_page_pagination', 10 );
add_action( 'csco_entry_content_after', 'csco_entry_tags', 20 );
add_action( 'csco_entry_content_after', 'csco_entry_footer', 30 );
add_action( 'csco_entry_content_after', 'csco_entry_prev_next', 40 );
add_action( 'csco_entry_content_after', 'csco_entry_comments', 50 );
add_action( 'csco_footer_before', 'csco_entry_read_next', 20 );



/**
 * Entry Elements
 */
add_action( 'csco_entry_container_start', 'csco_entry_metabar', 10 );

/**
 * Home Post Categories
 */
add_action( 'csco_main_content_before', 'csco_post_categories', 120 );

/**
 * Subscribe
 */
add_action( 'csco_footer_before', 'csco_misc_subscribe', 30 );
