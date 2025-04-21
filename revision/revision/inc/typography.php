<?php
/**
 * Typography
 *
 * @package Revision
 */

?>

:root {
	/* Base Font */
	--cs-font-base-family: <?php csco_typography( 'font_base', 'font-family', 'DM Sans' ); ?>;
	--cs-font-base-size: <?php csco_typography( 'font_base', 'font-size', '1rem' ); ?>;
	--cs-font-base-weight: <?php csco_typography( 'font_base', 'font-weight', '400' ); ?>;
	--cs-font-base-style: <?php csco_typography( 'font_base', 'font-style', 'normal' ); ?>;
	--cs-font-base-letter-spacing: <?php csco_typography( 'font_base', 'letter-spacing', 'normal' ); ?>;
	--cs-font-base-line-height: <?php csco_typography( 'font_base', 'line-height', '1.55' ); ?>;

	/* Primary Font */
	--cs-font-primary-family: <?php csco_typography( 'font_primary', 'font-family', 'DM Sans' ); ?>;
	--cs-font-primary-size: <?php csco_typography( 'font_primary', 'font-size', '1rem' ); ?>;
	--cs-font-primary-weight: <?php csco_typography( 'font_primary', 'font-weight', '800' ); ?>;
	--cs-font-primary-style: <?php csco_typography( 'font_primary', 'font-style', 'normal' ); ?>;
	--cs-font-primary-letter-spacing: <?php csco_typography( 'font_primary', 'letter-spacing', '-0.03em' ); ?>;
	--cs-font-primary-text-transform: <?php csco_typography( 'font_primary', 'text-transform', 'none' ); ?>;
	--cs-font-primary-line-height: <?php csco_typography( 'font_primary', 'line-height', '1.2' ); ?>;

	/* Secondary Font */
	--cs-font-secondary-family: <?php csco_typography( 'font_secondary', 'font-family', 'DM Sans' ); ?>;
	--cs-font-secondary-size: <?php csco_typography( 'font_secondary', 'font-size', '0.875rem' ); ?>;
	--cs-font-secondary-weight: <?php csco_typography( 'font_secondary', 'font-weight', '400' ); ?>;
	--cs-font-secondary-style: <?php csco_typography( 'font_secondary', 'font-style', 'normal' ); ?>;
	--cs-font-secondary-letter-spacing: <?php csco_typography( 'font_secondary', 'letter-spacing', 'normal' ); ?>;
	--cs-font-secondary-text-transform: <?php csco_typography( 'font_secondary', 'text-transform', 'none' ); ?>;
	--cs-font-secondary-line-height: <?php csco_typography( 'font_secondary', 'line-height', '1.55' ); ?>;

	/* Section Headings Font */
	--cs-font-section-headings-family: <?php csco_typography( 'font_section_headings', 'font-family', 'DM Sans' ); ?>;
	--cs-font-section-headings-size: <?php csco_typography( 'font_section_headings', 'font-size', '0.75rem' ); ?>;
	--cs-font-section-headings-weight: <?php csco_typography( 'font_section_headings', 'font-weight', '800' ); ?>;
	--cs-font-section-headings-style: <?php csco_typography( 'font_section_headings', 'font-style', 'normal' ); ?>;
	--cs-font-section-headings-letter-spacing: <?php csco_typography( 'font_section_headings', 'letter-spacing', '0.1em' ); ?>;
	--cs-font-section-headings-text-transform: <?php csco_typography( 'font_section_headings', 'text-transform', 'uppercase' ); ?>;
	--cs-font-section-headings-line-height: <?php csco_typography( 'font_section_headings', 'line-height', '1.2' ); ?>;

	/* Post Title Font Size */
	--cs-font-post-title-family: <?php csco_typography( 'font_post_title', 'font-family', 'DM Sans' ); ?>;
	--cs-font-post-title-weight: <?php csco_typography( 'font_post_title', 'font-weight', '700' ); ?>;
	--cs-font-post-title-size: <?php csco_typography( 'font_post_title', 'font-size', '3.25rem' ); ?>;
	--cs-font-post-title-letter-spacing: <?php csco_typography( 'font_post_title', 'letter-spacing', '-0.05em' ); ?>;
	--cs-font-post-title-line-height: <?php csco_typography( 'font_post_title', 'line-height', '1.2' ); ?>;

	/* Post Subbtitle */
	--cs-font-post-subtitle-family: <?php csco_typography( 'font_post_subtitle', 'font-family', 'DM Sans' ); ?>;
	--cs-font-post-subtitle-weight: <?php csco_typography( 'font_post_subtitle', 'font-weight', '400' ); ?>;
	--cs-font-post-subtitle-size: <?php csco_typography( 'font_post_subtitle', 'font-size', '1.125rem' ); ?>;
	--cs-font-post-subtitle-letter-spacing: <?php csco_typography( 'font_post_subtitle', 'letter-spacing', 'normal' ); ?>;
	--cs-font-post-subtitle-line-height: <?php csco_typography( 'font_post_subtitle', 'line-height', '1.55' ); ?>;

	/* Post Category Font */
	--cs-font-category-family: <?php csco_typography( 'font_category', 'font-family', 'DM Sans' ); ?>;
	--cs-font-category-size: <?php csco_typography( 'font_category', 'font-size', '0.6875rem' ); ?>;
	--cs-font-category-weight: <?php csco_typography( 'font_category', 'font-weight', '800' ); ?>;
	--cs-font-category-style: <?php csco_typography( 'font_category', 'font-style', 'normal' ); ?>;
	--cs-font-category-letter-spacing: <?php csco_typography( 'font_category', 'letter-spacing', '0.1em' ); ?>;
	--cs-font-category-text-transform: <?php csco_typography( 'font_category', 'text-transform', 'uppercase' ); ?>;
	--cs-font-category-line-height: <?php csco_typography( 'font_category', 'line-height', '1.2' ); ?>;

	/* Post Meta Font */
	--cs-font-post-meta-family: <?php csco_typography( 'font_post_meta', 'font-family', 'DM Sans' ); ?>;
	--cs-font-post-meta-size: <?php csco_typography( 'font_post_meta', 'font-size', '0.9375rem' ); ?>;
	--cs-font-post-meta-weight: <?php csco_typography( 'font_post_meta', 'font-weight', '600' ); ?>;
	--cs-font-post-meta-style: <?php csco_typography( 'font_post_meta', 'font-style', 'normal' ); ?>;
	--cs-font-post-meta-letter-spacing: <?php csco_typography( 'font_post_meta', 'letter-spacing', '-0.02em' ); ?>;
	--cs-font-post-meta-text-transform: <?php csco_typography( 'font_post_meta', 'text-transform', 'none' ); ?>;
	--cs-font-post-meta-line-height: <?php csco_typography( 'font_post_meta', 'line-height', '1.2' ); ?>;

	/* Post Content */
	--cs-font-post-content-family: <?php csco_typography( 'font_post_content', 'font-family', 'DM Sans' ); ?>;
	--cs-font-post-content-weight: <?php csco_typography( 'font_post_content', 'font-weight', '400' ); ?>;
	--cs-font-post-content-size: <?php csco_typography( 'font_post_content', 'font-size', '1.125rem' ); ?>;
	--cs-font-post-content-letter-spacing: <?php csco_typography( 'font_post_content', 'letter-spacing', 'normal' ); ?>;
	--cs-font-post-content-line-height: <?php csco_typography( 'font_post_content', 'line-height', '1.55' ); ?>;

	/* Input Font */
	--cs-font-input-family: <?php csco_typography( 'font_input', 'font-family', 'DM Sans' ); ?>;
	--cs-font-input-size: <?php csco_typography( 'font_input', 'font-size', '0.875rem' ); ?>;
	--cs-font-input-weight: <?php csco_typography( 'font_input', 'font-weight', '400' ); ?>;
	--cs-font-input-style: <?php csco_typography( 'font_input', 'font-style', 'normal' ); ?>;
	--cs-font-input-line-height: <?php csco_typography( 'font_input', 'line-height', '1.55' ); ?>;
	--cs-font-input-letter-spacing: <?php csco_typography( 'font_input', 'letter-spacing', 'normal' ); ?>;
	--cs-font-input-text-transform: <?php csco_typography( 'font_input', 'text-transform', 'none' ); ?>;

	/* Entry Title Font Size */
	--cs-font-entry-title-family: <?php csco_typography( 'font_entry_title', 'font-family', 'DM Sans' ); ?>;
	--cs-font-entry-title-weight: <?php csco_typography( 'font_entry_title', 'font-weight', '700' ); ?>;
	--cs-font-entry-title-letter-spacing: <?php csco_typography( 'font_entry_title', 'letter-spacing', '-0.04em' ); ?>;
	--cs-font-entry-title-line-height: <?php csco_typography( 'font_entry_title', 'line-height', '1.2' ); ?>;

	/* Entry Excerpt */
	--cs-font-entry-excerpt-family: <?php csco_typography( 'font_excerpt', 'font-family', 'DM Sans' ); ?>;
	--cs-font-entry-excerpt-weight: <?php csco_typography( 'font_excerpt', 'font-weight', '400' ); ?>;
	--cs-font-entry-excerpt-size: <?php csco_typography( 'font_excerpt', 'font-size', '1rem' ); ?>;
	--cs-font-entry-excerpt-letter-spacing: <?php csco_typography( 'font_excerpt', 'letter-spacing', 'normal' ); ?>;
	--cs-font-entry-excerpt-line-height: <?php csco_typography( 'font_excerpt', 'line-height', '1.55' ); ?>;

	/* Logos --------------- */

	/* Main Logo */
	--cs-font-main-logo-family: <?php csco_typography( 'font_main_logo', 'font-family', 'DM Sans' ); ?>;
	--cs-font-main-logo-size: <?php csco_typography( 'font_main_logo', 'font-size', '1.375rem' ); ?>;
	--cs-font-main-logo-weight: <?php csco_typography( 'font_main_logo', 'font-weight', '700' ); ?>;
	--cs-font-main-logo-style: <?php csco_typography( 'font_main_logo', 'font-style', 'normal' ); ?>;
	--cs-font-main-logo-letter-spacing: <?php csco_typography( 'font_main_logo', 'letter-spacing', '-0.04em' ); ?>;
	--cs-font-main-logo-text-transform: <?php csco_typography( 'font_main_logo', 'text-transform', 'none' ); ?>;

	/* Footer Logo */
	--cs-font-footer-logo-family: <?php csco_typography( 'font_footer_logo', 'font-family', 'DM Sans' ); ?>;
	--cs-font-footer-logo-size: <?php csco_typography( 'font_footer_logo', 'font-size', '1.375rem' ); ?>;
	--cs-font-footer-logo-weight: <?php csco_typography( 'font_footer_logo', 'font-weight', '700' ); ?>;
	--cs-font-footer-logo-style: <?php csco_typography( 'font_footer_logo', 'font-style', 'normal' ); ?>;
	--cs-font-footer-logo-letter-spacing: <?php csco_typography( 'font_footer_logo', 'letter-spacing', '-0.04em' ); ?>;
	--cs-font-footer-logo-text-transform: <?php csco_typography( 'font_footer_logo', 'text-transform', 'none' ); ?>;

	/* Headings --------------- */

	/* Headings */
	--cs-font-headings-family: <?php csco_typography( 'font_headings', 'font-family', 'DM Sans' ); ?>;
	--cs-font-headings-weight: <?php csco_typography( 'font_headings', 'font-weight', '700' ); ?>;
	--cs-font-headings-style: <?php csco_typography( 'font_headings', 'font-style', 'normal' ); ?>;
	--cs-font-headings-line-height: <?php csco_typography( 'font_headings', 'line-height', '1.2' ); ?>;
	--cs-font-headings-letter-spacing: <?php csco_typography( 'font_headings', 'letter-spacing', '-0.04em' ); ?>;
	--cs-font-headings-text-transform: <?php csco_typography( 'font_headings', 'text-transform', 'none' ); ?>;

	/* Menu Font --------------- */

	/* Menu */
	/* Used for main top level menu elements. */
	--cs-font-menu-family: <?php csco_typography( 'font_menu', 'font-family', 'DM Sans' ); ?>;
	--cs-font-menu-size: <?php csco_typography( 'font_menu', 'font-size', '1rem' ); ?>;
	--cs-font-menu-weight: <?php csco_typography( 'font_menu', 'font-weight', '600' ); ?>;
	--cs-font-menu-style: <?php csco_typography( 'font_menu', 'font-style', 'normal' ); ?>;
	--cs-font-menu-letter-spacing: <?php csco_typography( 'font_menu', 'letter-spacing', '-0.03em' ); ?>;
	--cs-font-menu-text-transform: <?php csco_typography( 'font_menu', 'text-transform', 'none' ); ?>;
	--cs-font-menu-line-height: <?php csco_typography( 'font_menu', 'line-height', '1.2' ); ?>;

	/* Submenu Font */
	/* Used for submenu elements. */
	--cs-font-submenu-family: <?php csco_typography( 'font_submenu', 'font-family', 'DM Sans' ); ?>;
	--cs-font-submenu-size: <?php csco_typography( 'font_submenu', 'font-size', '1rem' ); ?>;
	--cs-font-submenu-weight: <?php csco_typography( 'font_submenu', 'font-weight', '600' ); ?>;
	--cs-font-submenu-style: <?php csco_typography( 'font_submenu', 'font-style', 'normal' ); ?>;
	--cs-font-submenu-letter-spacing: <?php csco_typography( 'font_submenu', 'letter-spacing', '-0.03em' ); ?>;
	--cs-font-submenu-text-transform: <?php csco_typography( 'font_submenu', 'text-transform', 'none' ); ?>;
	--cs-font-submenu-line-height: <?php csco_typography( 'font_submenu', 'line-height', '1.2' ); ?>;

	/* Footer Menu */
	--cs-font-footer-menu-family: <?php csco_typography( 'font_footer_menu', 'font-family', 'DM Sans' ); ?>;
	--cs-font-footer-menu-size: <?php csco_typography( 'font_footer_menu', 'font-size', '0.75rem' ); ?>;
	--cs-font-footer-menu-weight: <?php csco_typography( 'font_footer_menu', 'font-weight', '800' ); ?>;
	--cs-font-footer-menu-style: <?php csco_typography( 'font_footer_menu', 'font-style', 'normal' ); ?>;
	--cs-font-footer-menu-letter-spacing: <?php csco_typography( 'font_footer_menu', 'letter-spacing', '0.1em' ); ?>;
	--cs-font-footer-menu-text-transform: <?php csco_typography( 'font_footer_menu', 'text-transform', 'uppercase' ); ?>;
	--cs-font-footer-menu-line-height: <?php csco_typography( 'font_footer_menu', 'line-height', '1.2' ); ?>;

	/* Footer Submenu Font */
	--cs-font-footer-submenu-family: <?php csco_typography( 'font_footer_submenu', 'font-family', 'DM Sans' ); ?>;
	--cs-font-footer-submenu-size: <?php csco_typography( 'font_footer_submenu', 'font-size', '1rem' ); ?>;
	--cs-font-footer-submenu-weight: <?php csco_typography( 'font_footer_submenu', 'font-weight', '600' ); ?>;
	--cs-font-footer-submenu-style: <?php csco_typography( 'font_footer_submenu', 'font-style', 'normal' ); ?>;
	--cs-font-footer-submenu-letter-spacing: <?php csco_typography( 'font_footer_submenu', 'letter-spacing', '-0.03m' ); ?>;
	--cs-font-footer-submenu-text-transform: <?php csco_typography( 'font_footer_submenu', 'text-transform', 'none' ); ?>;
	--cs-font-footer-submenu-line-height: <?php csco_typography( 'font_footer_submenu', 'line-height', '1.2' ); ?>;
}
