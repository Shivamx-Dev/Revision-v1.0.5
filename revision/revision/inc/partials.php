<?php
/**
 * These functions are used to load template parts (partials) or actions when used within action hooks,
 * and they probably should never be updated or modified.
 *
 * @package Revision
 */

if ( ! function_exists( 'csco_singular_post_type_before' ) ) {
	/**
	 * Add Before Singular Hooks for specific post type.
	 */
	function csco_singular_post_type_before() {
		if ( 'post' === get_post_type() ) {
			/**
			 * The csco_post_content_before hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_post_content_before' );
		}
		if ( 'page' === get_post_type() ) {
			/**
			 * The csco_page_content_before hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_page_content_before' );
		}
	}
}

if ( ! function_exists( 'csco_singular_post_type_after' ) ) {
	/**
	 * Add After Singular Hooks for specific post type.
	 */
	function csco_singular_post_type_after() {
		if ( 'post' === get_post_type() ) {
			/**
			 * The csco_post_content_after hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_post_content_after' );
		}
		if ( 'page' === get_post_type() ) {
			/**
			 * The csco_page_content_after hook.
			 *
			 * @since 1.0.0
			 */
			do_action( 'csco_page_content_after' );
		}
	}
}

if ( ! function_exists( 'csco_home_hero_standard' ) ) {
	/**
	 * Home Hero Type 1, Type 2.
	 */
	function csco_home_hero_standard() {
		if ( is_home() && get_theme_mod( 'home_hero', false ) && (
				'hero-type-1' === get_theme_mod( 'home_hero_layout', 'hero-type-1' ) ||
				'hero-type-2' === get_theme_mod( 'home_hero_layout', 'hero-type-1' )
			) ) {
			get_template_part( 'template-parts/hero' );
		}
	}
}

if ( ! function_exists( 'csco_home_hero_fullwidth' ) ) {
	/**
	 * Home Hero Type 2.
	 */
	function csco_home_hero_fullwidth() {
		if ( is_home() && get_theme_mod( 'home_hero', false ) && (
			'hero-type-3' === get_theme_mod( 'home_hero_layout', 'hero-type-1' )
			) ) {
			get_template_part( 'template-parts/hero' );
		}
	}
}

if ( ! function_exists( 'csco_offcanvas' ) ) {
	/**
	 * Off-canvas
	 */
	function csco_offcanvas() {
		get_template_part( 'template-parts/offcanvas' );
	}
}

if ( ! function_exists( 'csco_site_scheme' ) ) {
	/**
	 * Site Scheme
	 */
	function csco_site_scheme() {
		$site_scheme = csco_site_scheme_data();

		if ( ! $site_scheme ) {
			return;
		}

		call_user_func( 'printf', '%s', "data-scheme='{$site_scheme}'" );
	}
}

if ( ! function_exists( 'csco_site_search' ) ) {
	/**
	 * Site Search
	 */
	function csco_site_search() {
		if ( ! get_theme_mod( 'header_search_button', true ) ) {
			return;
		}
		get_template_part( 'template-parts/site-search' );
	}
}

if ( ! function_exists( 'csco_site_nav_mobile' ) ) {
	/**
	 * Site Nav Mobile
	 */
	function csco_site_nav_mobile() {
		get_template_part( 'template-parts/site-nav-mobile' );
	}
}

if ( ! function_exists( 'csco_theme_breadcrumbs' ) ) {
	/**
	 * Theme Breadcrumbs
	 */
	function csco_theme_breadcrumbs() {

		$header_type = csco_get_page_header_type();

		/**
		 * The csco_theme_breadcrumbs hook.
		 *
		 * @since 1.0.0
		 */
		if ( ! apply_filters( 'csco_theme_breadcrumbs', true ) ) {
			return;
		}

		if ( is_front_page() || is_404() ) {
			return;
		}

		if ( ! is_user_logged_in() && function_exists( 'is_account_page' ) && is_account_page() ) {
			return;
		}

		csco_breadcrumbs();
	}
}

if ( ! function_exists( 'csco_page_header' ) ) {
	/**
	 * Page Header
	 */
	function csco_page_header() {
		if ( ! ( is_home() || is_archive() || is_search() || is_404() ) ) {
			return;
		}
		get_template_part( 'template-parts/page-header' );
	}
}

if ( ! function_exists( 'csco_page_pagination' ) ) {
	/**
	 * Post Pagination
	 */
	function csco_page_pagination() {
		if ( ! is_singular() ) {
			return;
		}

		/**
		 * The csco_pagination_before hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_pagination_before' );

		wp_link_pages(
			array(
				'before'           => '<div class="navigation pagination posts-navigation"><div class="nav-links">',
				'after'            => '</div></div>',
				'link_before'      => '<span class="page-number">',
				'link_after'       => '</span>',
				'next_or_number'   => 'number',
				'separator'        => ' ',
				'nextpagelink'     => esc_html__( 'Next page', 'revision' ),
				'previouspagelink' => esc_html__( 'Previous page', 'revision' ),
			)
		);

		/**
		 * The csco_pagination_after hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_pagination_after' );
	}
}

if ( ! function_exists( 'csco_entry_breadcrumbs' ) ) {
	/**
	 * Entry Breadcrumbs
	 */
	function csco_entry_breadcrumbs() {
		csco_breadcrumbs();
	}
}

if ( ! function_exists( 'csco_entry_header' ) ) {
	/**
	 * Entry Header Simple and Standard
	 */
	function csco_entry_header() {
		if ( ! is_singular() ) {
			return;
		}

		if ( 'none' === csco_get_page_header_type() ) {
			return;
		}

		get_template_part( 'template-parts/entry/entry-header' );
	}
}

if ( ! function_exists( 'csco_entry_media' ) ) {
	/**
	 * Entry Media
	 */
	function csco_entry_media() {
		if ( ! is_singular() ) {
			return;
		}

		if ( 'none' === csco_get_page_header_type() ) {
			return;
		}

		get_template_part( 'template-parts/entry/entry-media' );
	}
}

if ( ! function_exists( 'csco_entry_tags' ) ) {
	/**
	 * Entry Tags
	 */
	function csco_entry_tags() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		if ( false === get_theme_mod( 'post_tags', true ) ) {
			return;
		}

		the_tags( '<div class="cs-entry__tags"><ul><li>', '</li><li>', '</li></ul></div>' );
	}
}

if ( ! function_exists( 'csco_entry_footer' ) ) {
	/**
	 * Entry Footer
	 */
	function csco_entry_footer() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		if ( false === get_theme_mod( 'post_footer', true ) ) {
			return;
		}
		get_template_part( 'template-parts/entry/entry-footer' );
	}
}

if ( ! function_exists( 'csco_entry_comments' ) ) {
	/**
	 * Entry Comments
	 */
	function csco_entry_comments() {
		if ( post_password_required() ) {
			return;
		}

		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	}
}

if ( ! function_exists( 'csco_entry_read_next' ) ) {
	/**
	 * Entry Read Next
	 */
	function csco_entry_read_next() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		if ( false === get_theme_mod( 'post_read_next', true ) ) {
			return;
		}

		get_template_part( 'template-parts/entry/entry-read-next' );
	}
}

if ( ! function_exists( 'csco_entry_prev_next' ) ) {
	/**
	 * Entry Prev Next
	 */
	function csco_entry_prev_next() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		if ( false === get_theme_mod( 'post_prev_next', true ) ) {
			return;
		}

		get_template_part( 'template-parts/entry/entry-prev-next' );
	}
}

if ( ! function_exists( 'csco_entry_metabar' ) ) {
	/**
	 * Entry Metabar
	 */
	function csco_entry_metabar() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}
		if ( false === get_theme_mod( 'post_metabar', true ) ) {
			return;
		}

		?>
		<div class="cs-entry__metabar">
			<div class="cs-entry__metabar-inner">
				<?php if ( get_theme_mod( 'post_reading_time', true ) ) { ?>
					<div class="cs-entry__metabar-item cs-entry__metabar-reading_time">
						<?php csco_component( 'single_get_meta_reading_time' ); ?>
					</div>
				<?php } ?>
				<div class="cs-entry__metabar-item cs-entry__metabar-share">
					<?php csco_component( 'share_links' ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_misc_social_links' ) ) {
	/**
	 * Social Links
	 */
	function csco_misc_social_links() {

		if ( false === get_theme_mod( 'misc_social_links', false ) ) {
			return;
		}

		get_template_part( 'template-parts/social-links' );
	}
}
