<?php
/**
 * Template Tags
 *
 * Functions that are called directly from template parts or within actions.
 *
 * @package Revision
 */

if ( ! function_exists( 'csco_header_nav_menu' ) ) {
	class CSCO_NAV_Walker extends Walker_Nav_Menu {
		/**
		 * Starts the element output.
		 *
		 * @since 3.0.0
		 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
		 * @since 5.9.0 Renamed `$item` to `$data_object` and `$id` to `$current_object_id`
		 *              to match parent class for PHP 8 named parameter support.
		 *
		 * @see Walker::start_el()
		 *
		 * @param string   $output            Used to append additional content (passed by reference).
		 * @param WP_Post  $data_object       Menu item data object.
		 * @param int      $depth             Depth of menu item. Used for padding.
		 * @param stdClass $args              An object of wp_nav_menu() arguments.
		 * @param int      $current_object_id Optional. ID of the current menu item. Default 0.
		 */
		public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
			// Restores the more descriptive, specific name for use within this method.
			$menu_item = $data_object;

			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$classes   = empty( $menu_item->classes ) ? array() : (array) $menu_item->classes;
			$classes[] = 'menu-item-' . $menu_item->ID;

			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @since 4.4.0
			 *
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param WP_Post  $menu_item Menu item data object.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $menu_item, $depth );

			/**
			 * Filters the CSS classes applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string[] $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $menu_item, $args, $depth ) );

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string   $menu_id   The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post  $menu_item The current menu item.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $menu_item->attr_title ) ? $menu_item->attr_title : '';
			$atts['target'] = ! empty( $menu_item->target ) ? $menu_item->target : '';
			if ( '_blank' === $menu_item->target && empty( $menu_item->xfn ) ) {
				$atts['rel'] = 'noopener';
			} else {
				$atts['rel'] = $menu_item->xfn;
			}
			$atts['href']         = ! empty( $menu_item->url ) ? $menu_item->url : '';
			$atts['aria-current'] = $menu_item->current ? 'page' : '';

			if ( '#' === trim( $menu_item->url ) ) {
					$atts['class'] = 'menu-item-without-link';
			}

			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title        Title attribute.
			 *     @type string $target       Target attribute.
			 *     @type string $rel          The rel attribute.
			 *     @type string $href         The href attribute.
			 *     @type string $aria-current The aria-current attribute.
			 * }
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $menu_item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			/**
			 * The the_title hook.
			 *
			 * @since 1.0.0
			 */
			$title = apply_filters( 'the_title', $menu_item->title, $menu_item->ID );

			/**
			 * Filters a menu item's title.
			 *
			 * @since 4.4.0
			 *
			 * @param string   $title     The menu item's title.
			 * @param WP_Post  $menu_item The current menu item object.
			 * @param stdClass $args      An object of wp_nav_menu() arguments.
			 * @param int      $depth     Depth of menu item. Used for padding.
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $menu_item, $args, $depth );

			$link_tag = 'a';

			$item_output  = $args->before;
			$item_output .= '<' . $link_tag . $attributes . '>';
			$item_output .= $args->link_before . '<span>' . $title . '</span>' . $args->link_after;
			$item_output .= '</' . $link_tag . '>';
			$item_output .= $args->after;

			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string   $item_output The menu item's starting HTML output.
			 * @param WP_Post  $menu_item   Menu item data object.
			 * @param int      $depth       Depth of menu item. Used for padding.
			 * @param stdClass $args        An object of wp_nav_menu() arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args );
		}
	}

	/**
	 * Header Nav Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_nav_menu( $settings = array() ) {
		if ( ! get_theme_mod( 'header_navigation_menu', true ) ) {
			return;
		}

		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'menu_class'      => 'cs-header__nav-inner',
					'theme_location'  => 'primary',
					'container'       => 'nav',
					'container_class' => 'cs-header__nav',
					'walker'          => new CSCO_NAV_Walker(),
				)
			);
		}
	}
}

if ( ! function_exists( 'csco_header_additional_menu' ) ) {
	/**
	 * Header Additional Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_additional_menu( $settings = array() ) {
		if ( has_nav_menu( 'additional' ) ) {
			wp_nav_menu(
				array(
					'menu_class'      => 'cs-header__top-nav',
					'theme_location'  => 'additional',
					'container'       => '',
					'container_class' => '',
					'depth'           => 1,
				)
			);
		}
	}
}

if ( ! function_exists( 'csco_header_logo' ) ) {
	/**
	 * Header Logo
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_logo( $settings = array() ) {

		$logo_default_name = 'logo';
		$logo_dark_name    = 'logo_dark';
		$logo_class        = null;

		$defaults = array(
			'variant' => null,
			'tag'     => 'div',
		);

		if ( is_front_page() && get_theme_mod( 'title_tag', true ) ) {
			$defaults['tag'] = 'h1';
		}

		$settings = apply_filters( 'csco_header_logo_settings', wp_parse_args( $settings, $defaults ) );

		// For hide logo.
		if ( 'hide' === $settings['variant'] ) {
			$logo_class = 'cs-logo-hide';
		}

		// Get default logo.
		$logo_url = get_theme_mod( $logo_default_name );

		$logo_id = attachment_url_to_postid( $logo_url );

		// Set mode of logo.
		$logo_mode = 'cs-logo-once';

		// Check display mode.
		if ( $logo_id ) {
			$logo_mode = 'cs-logo-default';
		}

		// Logo tag
		$logo_tag = $settings['tag'];
		?>
		<<?php echo esc_html( $logo_tag ); ?> class="cs-logo">
			<a class="cs-header__logo <?php echo esc_attr( $logo_mode ); ?> <?php echo esc_attr( $logo_class ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( $logo_id ) {
					csco_get_retina_image( $logo_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' );
				} else {
					bloginfo( 'name' );
				}
				?>
			</a>

			<?php
			if ( 'cs-logo-default' === $logo_mode ) {

				$logo_dark_url = get_theme_mod( $logo_dark_name ) ? get_theme_mod( $logo_dark_name ) : $logo_url;

				$logo_dark_id = attachment_url_to_postid( $logo_dark_url );

				if ( $logo_dark_id ) {
					?>
						<a class="cs-header__logo cs-logo-dark <?php echo esc_attr( $logo_class ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php csco_get_retina_image( $logo_dark_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' ); ?>
						</a>
					<?php
				}
			}
			?>
		</<?php echo esc_html( $logo_tag ); ?>>
		<?php
	}
}

if ( ! function_exists( 'csco_header_offcanvas_toggle' ) ) {
	/**
	 * Header Offcanvas Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_offcanvas_toggle( $settings = array() ) {

		if ( csco_offcanvas_exists() ) {

			if ( ! isset( $settings['mobile'] ) ) {
				if ( ! get_theme_mod( 'header_offcanvas', false ) ) {
					return;
				}
			}

			$class = __return_empty_string();
			?>
				<span class="cs-header__offcanvas-toggle <?php echo esc_attr( $class ); ?>" role="button" aria-label="<?php echo esc_attr__( 'Mobile menu button', 'revision' ); ?>">
					<i class="cs-icon cs-icon-menu1"></i>
				</span>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_header_search_toggle' ) ) {
	/**
	 * Header Search Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_search_toggle( $settings = array() ) {
		if ( ! get_theme_mod( 'header_search_button', true ) ) {
			return;
		}
		?>
		<span class="cs-header__search-toggle" role="button" aria-label="<?php echo esc_attr__( 'Search', 'revision' ); ?>">
			<i class="cs-icon cs-icon-search"></i>
		</span>
		<?php
	}
}

if ( ! function_exists( 'csco_header_scheme_toggle' ) ) {
	/**
	 * Header Scheme Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_scheme_toggle( $settings = array() ) {
		if ( ! get_theme_mod( 'color_scheme_toggle', true ) ) {
			return;
		}
		?>
			<span class="cs-site-scheme-toggle cs-header__scheme-toggle" role="button" aria-label="<?php echo esc_attr__( 'Dark mode toggle button', 'revision' ); ?>">
				<span class="cs-header__scheme-toggle-icons">
					<span class="cs-header__scheme-cs-icon-box cs-light-mode" data-mode="light"><i class="cs-header__scheme-toggle-icon cs-icon cs-icon-light-mode"></i></span>
					<span class="cs-header__scheme-cs-icon-box cs-dark-mode" data-mode="dark"><i class="cs-header__scheme-toggle-icon cs-icon cs-icon-dark-mode"></i></span>
				</span>
			</span>
		<?php
	}
}

if ( ! function_exists( 'csco_header_scheme_toggle_mobile' ) ) {
	/**
	 * Header Scheme Toggle Mobile
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_scheme_toggle_mobile( $settings = array() ) {
		if ( ! get_theme_mod( 'color_scheme_toggle', true ) ) {
			return;
		}
		?>
		<span class="cs-header__scheme-toggle cs-header__scheme-toggle-mobile cs-site-scheme-toggle" role="button" aria-label="<?php echo esc_attr__( 'Scheme Toggle', 'revision' ); ?>">
			<span class="cs-header__scheme-toggle-icons">
				<span class="cs-header__scheme-cs-icon-box cs-light-mode" data-mode="light"><i class="cs-header__scheme-toggle-icon cs-icon cs-icon-light-mode"></i></span>
				<span class="cs-header__scheme-cs-icon-box cs-dark-mode" data-mode="dark"><i class="cs-header__scheme-toggle-icon cs-icon cs-icon-dark-mode"></i></span>
			</span>
		</span>
		<?php
	}
}

if ( ! function_exists( 'csco_header_custom_button' ) ) {
	/**
	 * Header Custom Button
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_header_custom_button( $settings = array() ) {
		if ( ! get_theme_mod( 'header_custom_button', false ) ) {
			return;
		}

		$button = get_theme_mod( 'header_custom_button_label' );
		$link   = get_theme_mod( 'header_custom_button_link' );
		$target = get_theme_mod( 'header_custom_button_target', '_self' );

		if ( $button && $link ) {
			?>
			<a class="cs-button cs-header__custom-button" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
				<?php echo wp_kses( $button, 'content' ); ?>
			</a>
			<?php
		}
	}
}
if ( ! function_exists( 'csco_discover_more_button' ) ) {
	/**
	 * Discover More Button
	 */
	function csco_discover_more_button() {
		$button_label = sprintf(
		/* translators: %s: Post Title */
			__( 'Discover More: %s', 'revision' ),
			get_the_title()
		);
		?>
		<div class="cs-entry__discover-more">
			<a class="cs-button" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( $button_label ); ?>">
				<?php esc_html_e( 'Discover More', 'revision' ); ?>
			</a>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_footer_logo' ) ) {
	/**
	 * Footer Logo
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_logo( $settings = array() ) {
		$logo_url = get_theme_mod( 'footer_logo' );

		$logo_id = attachment_url_to_postid( $logo_url );

		$logo_mode = 'cs-logo-once';

		if ( $logo_id ) {
			$logo_mode = 'cs-logo-default';
		}
		?>
		<div class="cs-logo">
			<a class="cs-footer__logo <?php echo esc_attr( $logo_mode ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( $logo_id ) {
					csco_get_retina_image( $logo_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' );
				} else {
					bloginfo( 'name' );
				}
				?>
			</a>

			<?php
			if ( 'cs-logo-default' === $logo_mode ) {

				$logo_dark_url = get_theme_mod( 'footer_logo_dark' ) ? get_theme_mod( 'footer_logo_dark' ) : $logo_url;

				$logo_dark_id = attachment_url_to_postid( $logo_dark_url );

				if ( $logo_dark_id ) {
					?>
						<a class="cs-footer__logo cs-logo-dark" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php csco_get_retina_image( $logo_dark_id, array( 'alt' => get_bloginfo( 'name' ) ), 'logo' ); ?>
						</a>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'csco_footer_description' ) ) {
	/**
	 * Footer Description
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_description( $settings = array() ) {

		$footer_text = get_theme_mod( 'footer_text' );
		if ( $footer_text ) {
			?>
			<div class="cs-footer__desc">
				<?php echo do_shortcode( $footer_text ); ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_footer_copyright' ) ) {
	/**
	 * Footer Copyright
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_copyright( $settings = array() ) {
		$footer_copyright = get_theme_mod( 'footer_copyright', '© 2024 — Revision. All Rights Reserved.' );
		if ( $footer_copyright ) {
			?>
			<div class="cs-footer__copyright">
				<?php echo do_shortcode( $footer_copyright ); ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_footer_nav_menu' ) ) {
	/**
	 * Footer Nav Menu
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_footer_nav_menu( $settings = array() ) {

		$settings = array_merge(
			array(
				'menu_class' => null,
			),
			$settings
		);

		if ( has_nav_menu( 'footer' ) ) {
			?>
			<div class="cs-footer__nav-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer',
						'container_class' => '',
						'menu_class'      => sprintf( 'cs-footer__nav %s', $settings['menu_class'] ),
						'container'       => '',
						'depth'           => 2,
					)
				);
				?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_misc_subscribe' ) ) {
	/**
	 * Subscribe section
	 */
	function csco_misc_subscribe() {
		$misc_subscribe = get_theme_mod( 'misc_subscribe', false );

		if ( ! $misc_subscribe ) {
			return;
		}

		if ( is_404() ) {
			return;
		}

		$subscribe_heading                = get_theme_mod( 'misc_subscribe_heading' );
		$subscribe_mailchimp              = get_theme_mod( 'misc_subscribe_mailchimp' );
		$subscribe_description            = get_theme_mod( 'misc_subscribe_description' );
		$misc_subscribe_short_description = get_theme_mod( 'misc_subscribe_short_description' );

		if ( $misc_subscribe ) {
			?>
			<div class="cs-subscribe-section">
				<div class="cs-container">
					<div class="cs-subscribe">
						<div class="cs-subscribe__content">
							<?php if ( $subscribe_heading ) { ?>
								<div class="cs-subscribe__header">
									<h3 class="cs-subscribe__heading">
										<?php echo esc_html( $subscribe_heading ); ?>
									</h3>
									<?php if ( $subscribe_description ) { ?>
										<div class="cs-subscribe__description">
											<?php echo do_shortcode( $subscribe_description ); ?>
										</div>
									<?php } ?>
								</div>
							<?php } ?>

							<?php if ( $subscribe_mailchimp ) { ?>
								<form class="cs-subscribe__form cs-form-box" action="<?php echo esc_url( $subscribe_mailchimp ); ?>" method="post" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="novalidate">
									<div class="cs-form-group cs-subscribe__form-group" >
										<input type="email" placeholder="<?php esc_attr_e( 'Enter Your Email', 'revision' ); ?>" name="EMAIL" required>
										<button type="submit" value="<?php esc_attr_e( 'Subscribe', 'revision' ); ?>" aria-label="<?php echo esc_attr__( 'Subscribe', 'revision' ); ?>" name="subscribe" class="cs-button-animated">
											<i class="cs-icon cs-icon-send"></i>
											<span>
												<span><?php esc_html_e( 'Subscribe', 'revision' ); ?></span>
											</span>
										</button>
									</div>
									<div class="cs-subscribe__form-response clear" id="mce-responses">
										<div class="response" id="mce-error-response" style="display:none"></div>
										<div class="response" id="mce-success-response" style="display:none"></div>
									</div>
								</form>
							<?php } ?>

							<?php if ( $misc_subscribe_short_description ) { ?>
								<div class="cs-subscribe__short-description">
									<?php echo do_shortcode( $misc_subscribe_short_description ); ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
if ( ! function_exists( 'csco_off_canvas_button' ) ) {
	/**
	 * Off-Canvas Button
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_off_canvas_button( $settings = array() ) {
		if ( ! get_theme_mod( 'header_custom_button', false ) ) {
			return;
		}

		$button = get_theme_mod( 'header_custom_button_label' );
		$link   = get_theme_mod( 'header_custom_button_link' );

		if ( $button && $link ) {
			?>
			<div class="cs-offcanvas__button">
				<a class="cs-button cs-offcanvas__button" href="<?php echo esc_url( $link ); ?>" target="_blank">
					<?php echo wp_kses( $button, 'content' ); ?>
				</a>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_scroll_to_top' ) ) {
	/**
	 * Scroll to Top
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_scroll_to_top( $settings = array() ) {
		if ( ! get_theme_mod( 'misc_scroll_to_top', true ) ) {
			return;
		}
		?>
			<button class="cs-scroll-top" role="button" aria-label="<?php echo esc_attr__( 'Scroll to top button', 'revision' ); ?>">
				<i class="cs-icon-chevron-up"></i>
				<div class="cs-scroll-top-border">
					<svg width="49" height="49" viewBox="0 0 49 49">
						<path d="M24.5,2 a22.5,22.5 0 0,1 0,45 a22.5,22.5 0 0,1 0,-45" style="stroke-width: 2; fill: none;"></path>
					</svg>
				</div>
				<div class="cs-scroll-top-progress">
					<svg width="49" height="49" viewBox="0 0 49 49">
						<path d="M24.5,2 a22.5,22.5 0 0,1 0,45 a22.5,22.5 0 0,1 0,-45" style="stroke-width: 2; fill: none;"></path>
					</svg>
				</div>
			</button>
		<?php
	}
}

if ( ! function_exists( 'csco_off_canvas_scheme_toggle' ) ) {
	/**
	 * Offcanvas Scheme Toggle
	 *
	 * @param array $settings The advanced settings.
	 */
	function csco_off_canvas_scheme_toggle( $settings = array() ) {
		if ( ! get_theme_mod( 'color_scheme_toggle', true ) ) {
			return;
		}
		?>
			<span class="cs-site-scheme-toggle cs-offcanvas__scheme-toggle" role="button" aria-label="<?php echo esc_attr__( 'Scheme Toggle', 'revision' ); ?>">
				<span class="cs-header__scheme-toggle-icons">
					<span class="cs-header__scheme-cs-icon-box cs-light-mode" data-mode="light"><i class="cs-header__scheme-toggle-icon cs-icon cs-icon-light-mode"></i></span>
					<span class="cs-header__scheme-cs-icon-box cs-dark-mode" data-mode="dark"><i class="cs-header__scheme-toggle-icon cs-icon cs-icon-dark-mode"></i></span>
				</span>
			</span>
		<?php
	}
}

if ( ! function_exists( 'csco_the_post_format_icon' ) ) {
	/**
	 * Post Format Icon
	 *
	 * @param string $content After content.
	 */
	function csco_the_post_format_icon( $content = null ) {
		$post_format = get_post_format();

		if ( 'gallery' === $post_format ) {
			$attachments = count(
				(array) get_children(
					array(
						'post_parent' => get_the_ID(),
						'post_type'   => 'attachment',
					)
				)
			);

			$content = $attachments ? sprintf( '<span>%s</span>', $attachments ) : '';
		}

		if ( $post_format ) {
			?>
			<span class="cs-entry-format">
				<a class="cs-format-icon cs-format-<?php echo esc_attr( $post_format ); ?>" href="<?php the_permalink(); ?>">
					<?php echo wp_kses( $content, 'content' ); ?>
				</a>
			</span>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_post_subtitle' ) ) {
	/**
	 * Post Subtitle
	 */
	function csco_post_subtitle() {
		if ( ! is_single() ) {
			return;
		}

		if ( get_theme_mod( 'post_subtitle', true ) ) {
			/**
			 * The plugins/wp_subtitle/get_subtitle hook.
			 *
			 * @since 1.0.0
			 */
			$subtitle = apply_filters(
				'plugins/wp_subtitle/get_subtitle',
				'',
				array(
					'before'  => '',
					'after'   => '',
					'post_id' => get_the_ID(),
				)
			);

			if ( $subtitle ) {
				?>
				<div class="cs-entry__subtitle">
					<?php echo wp_kses( $subtitle, 'content' ); ?>
				</div>
				<?php
			} elseif ( has_excerpt() ) {
				?>
				<div class="cs-entry__subtitle">
					<?php the_excerpt(); ?>
				</div>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'csco_archive_post_description' ) ) {
	/**
	 * Post Description in Archive Pages
	 */
	function csco_archive_post_description() {
		$description = get_the_archive_description();
		if ( $description ) {
			?>
			<div class="cs-page__archive-description">
				<?php echo do_shortcode( $description ); ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'csco_archive_category_thumbnail' ) ) {
	/**
	 * Category Thumbnail in Archive Pages
	 */
	function csco_archive_category_thumbnail() {
		$category_id = get_queried_object_id();
		$category    = get_term( $category_id, 'category' );
		if ( $category ) {
			$csco_category_logo = get_term_meta( $category_id, 'csco_category_logo', true );
			if ( $csco_category_logo ) {
				?>
			<div class="cs-page__archive-thumbnail">
				<div class="cs-page__archive-thumbnail-box">
					<?php
					csco_get_retina_image(
						$csco_category_logo,
						array(
							'alt'   => esc_attr( $category->name ),
							'title' => esc_attr( $category->name ),
						)
					);
					?>
				</div>
			</div>
				<?php
			}
		}
	}
}


if ( ! function_exists( 'csco_share_links' ) ) {
	/**
	 * Share Links section
	 */
	function csco_share_links() {
		?>

		<div class="cs-share">

			<?php
			$share_url = get_permalink();

			$text = rawurlencode( html_entity_decode( get_the_title( get_the_ID() ) ) );

			$twitter_share_url  = esc_url( 'https://twitter.com/share?t=' . $text . '&url=' . $share_url, null, '' );
			$facebook_share_url = esc_url( 'https://www.facebook.com/sharer.php?text=' . $text . '&u=' . $share_url, null, '' );
			$linkedin_share_url = esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url=' . $share_url, null, '' );
			?>

			<a class="cs-share__link" target="_blank" href="<?php call_user_func( 'printf', '%s', $twitter_share_url ); ?>" title="<?php esc_attr_e( 'Share in Twitter', 'revision' ); ?>">
				<i class="cs-icon cs-icon-twitter-x"></i>
			</a>

			<a class="cs-share__link" target="_blank" href="<?php call_user_func( 'printf', '%s', $facebook_share_url ); ?>" title="<?php esc_attr_e( 'Share on Facebook', 'revision' ); ?>">
				<i class="cs-icon cs-icon-facebook"></i>
			</a>

			<a class="cs-share__link" target="_blank" href="<?php call_user_func( 'printf', '%s', $linkedin_share_url ); ?>" title="<?php esc_attr_e( 'Share in Linkedin', 'revision' ); ?>">
				<i class="cs-icon cs-icon-linkedIn"></i>
			</a>

			<a class="cs-share__link cs-share__copy-link" target="_blank" href="<?php echo esc_url( $share_url ); ?>" title="<?php esc_attr_e( 'Copy link', 'revision' ); ?>">
				<i class="cs-icon cs-icon-link"></i>
			</a>

		</div>

		<?php
	}
}
