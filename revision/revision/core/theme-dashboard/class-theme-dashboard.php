<?php
/**
 * Theme Dashboard
 *
 * @package Revision
 */

if ( ! class_exists( 'CSCO_Theme_Dashboard' ) ) {
	/**
	 * Theme Dashboard Class.
	 */
	class CSCO_Theme_Dashboard {
		/**
		 * The slug name to refer to this menu by.
		 *
		 * @var string $menu_slug The menu slug.
		 */
		public $menu_slug = 'theme-dashboard';

		/**
		 * The settings of page.
		 *
		 * @var array $settings The settings.
		 */
		public $settings = array();

		/**
		 * Constructor.
		 */
		public function __construct() {
			$self = $this;

			/** Include files */
			if ( ! function_exists( 'get_plugin_data' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			require_once get_theme_file_path( '/core/theme-dashboard/class-theme-activation.php' );

			/** Initialize actions */
			add_action( 'init', array( $this, 'set_settings' ) );

			add_action( 'init', function () use ( $self ) {
				add_action( 'admin_menu', array( $self, 'add_menu_page' ) );
			} );

			add_action( 'admin_notices', array( $this, 'notice' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 5 );
			add_action( 'admin_enqueue_scripts', array( $this, 'notice_enqueue_scripts' ), 5 );

			add_action( 'wp_ajax_csco_dashboard_dismissed_handler', array( $this, 'dismissed_handler' ) );

			add_action( 'switch_theme', array( $this, 'reset_notices' ) );
			add_action( 'after_switch_theme', array( $this, 'reset_notices' ) );
		}

		/**
		 * Add menu page
		 */
		public function add_menu_page() {
			add_submenu_page( 'themes.php', esc_html__( 'Theme Dashboard', 'revision' ), esc_html__( 'Theme Dashboard', 'revision' ), 'manage_options', $this->menu_slug, array( $this, 'render_page' ), 1 );
		}

		/**
		 * Settings
		 *
		 * @param array $settings The settings.
		 */
		public function set_settings( $settings ) {
			$theme = wp_get_theme( get_template() );

			// Hero.
			/* translators: Theme Name */
			$this->settings['hero_title'] = sprintf( esc_html__( 'Welcome to %1$s', 'revision' ), $theme->get('Name') );
			/* translators: Theme Name */
			$this->settings['hero_desc']  = sprintf( esc_html__( '%1$s is now installed and activated. To help you with the next step, we\'ve gathered together on this page all the resources you might need. We hope you enjoy using this theme.', 'revision' ), $theme->get('Name') );
			$this->settings['hero_image'] = __return_false();

			// Documentation.
			$this->settings['documentation_link'] = sprintf( 'https://codesupply.co/documentation/%s/', $theme->get('TextDomain') );

			// Changelog.
			$this->settings['changelog_link'] = sprintf( 'https://codesupply.co/documentation/%s/changelog/', $theme->get('TextDomain') );

			// Support.
			$this->settings['support_link'] = 'https://codesupply.co/support/';

			// Community.
			$this->settings['community_link'] = 'https://www.facebook.com/codesupplyco/';
		}

		/**
		 * Render Hero
		 *
		 * @param string $location The location.
		 */
		public function render_hero( $location = null ) {
			global $pagenow;

			$theme = wp_get_theme( get_template() );

			$screen = get_current_screen();
			?>
			<div class="cs-hero">
				<div class="cs-hero-content">
					<div class="cs-hero-hello">
						<?php esc_html_e( 'Hello, ', 'revision' ); ?>

						<?php
						$current_user = wp_get_current_user();

						echo esc_html( $current_user->display_name );
						?>

						<?php esc_html_e( '👋🏻', 'revision' ); ?>
					</div>

					<div class="cs-hero-title">
						<?php echo wp_kses( $this->settings['hero_title'], 'content' ); ?>
					</div>

					<?php if ( csco_get_license_data( 'status' ) ) { ?>
						<?php if ( isset( $this->settings['hero_desc'] ) && $this->settings['hero_desc'] ) { ?>
							<div class="cs-hero-desc">
								<?php echo wp_kses( $this->settings['hero_desc'], 'content' ); ?>
							</div>
						<?php } ?>
					<?php } else { ?>
						<div class="cs-hero-desc">
							<?php echo esc_html( $theme->get( 'Name' ) ); ?> <?php esc_html_e( 'is now installed and ready to go. Please', 'revision' ); ?> <a href="<?php echo esc_url( admin_url( '/themes.php?page=theme-dashboard&tab=license' ) ); ?>"><?php esc_html_e( 'activate your license', 'revision' ); ?></a> <?php esc_html_e( 'to enable theme demos.', 'revision' ); ?>
						</div>
					<?php } ?>

					<?php if ( csco_get_license_data( 'status' ) ) { ?>
						<a href="<?php echo esc_url( admin_url( '/themes.php?page=theme-demos' ) ); ?>" class="cs-hero-go button button-primary">
							<?php esc_html_e( 'Go to Theme Demos', 'revision' ); ?>
						</a>
					<?php } ?>
				</div>

				<?php if ( isset( $this->settings['hero_image'] ) && $this->settings['hero_image'] ) { ?>
					<div class="cs-hero-image">
						<span>
							<img src="<?php echo esc_url( $this->settings['hero_image'] ); ?>">
						</span>
					</div>
				<?php } ?>
			</div>
			<?php
		}

		/**
		 * Render page
		 */
		public function render_page() {
			?>
			<div class="cs-wrap cs-theme-dashboard">
				<div class="cs-header">
					<div class="cs-header-left">
						<div class="cs-header-col cs-header-col-logo">
							<div class="cs-logo">
								<a target="_blank" href="<?php echo esc_url( 'https://codesupply.co/' ); ?>">
									Code Supply Co.
								</a>
							</div>
						</div>
					</div>

					<div class="cs-header-right">
						<a href="<?php echo esc_url( $this->settings['documentation_link'] ); ?>" class="cs-link-documentation" target="_blank">
							<span><?php esc_html_e( 'Documentation', 'revision' ); ?></span>

							<i class="dashicons dashicons-external"></i>
						</a>
					</div>
				</div>

				<div class="wrap">

					<h1 class="hidden"><?php esc_html_e( 'Theme Dashboard', 'revision' ); ?></h1>

					<div class="cs-main">
						<div class="cs-main-content">
							<?php $this->render_hero(); ?>

							<?php
							$dashboard_tabs = apply_filters( 'csco_theme_dashboard_tabs', array() );

							if ( $dashboard_tabs ) {
								// Sort priority.
								usort( $dashboard_tabs, function ( $item1, $item2 ) {
									if ( $item1['priority'] === $item2['priority'] ) {
										return 0;
									}

									return $item1['priority'] < $item2['priority'] ? -1 : 1;
								});

								// Set active tab.
								$active_tab = isset( $_GET['tab'] ) ? esc_attr( $_GET['tab'] ) : $dashboard_tabs[0]['slug']; // phpcs:ignore.
								?>
								<div class="cs-panel cs-panel-general">
									<div class="cs-panel-head cs-panel-tabs">
										<?php

										foreach ( $dashboard_tabs as $tab_data ) {
											$tab_url = add_query_arg( array(
												'page' => $this->menu_slug,
												'tab'  => $tab_data['slug'],
											), admin_url( 'themes.php' ) );

											$tab_status = __return_empty_string();

											if ( $active_tab === $tab_data['slug'] ) {
												$tab_status = 'cs-panel-tab-active';
											}
											?>
											<div class="cs-panel-tab <?php echo esc_attr( $tab_status ); ?>">
												<h3 class="cs-panel-title">
													<a href="<?php echo esc_url( $tab_url ); ?>">
														<?php echo esc_html( $tab_data['label'] ); ?>
													</a>
												</h3>
											</div>
											<?php
										}
										?>
									</div>

									<div class="cs-panel-content cs-panel-content-tabs">
										<?php
										foreach ( $dashboard_tabs as $tab_data ) {
											$tab_status = __return_empty_string();

											if ( $active_tab === $tab_data['slug'] ) {
												$tab_status = 'cs-panel-tab-active';
											}
											?>
											<div id="<?php echo esc_url( $tab_data['slug'] ); ?>" class="cs-panel-tab <?php echo esc_attr( $tab_status ); ?>">
												<?php call_user_func( 'printf', '%s', $tab_data['content'] ); ?>
											</div>
											<?php
										}
										?>
									</div>
								</div>
							<?php } ?>
						</div>

						<div class="cs-main-sidebar">
							<div class="cs-panel cs-panel-changelog">
								<div class="cs-panel-head">
									<h3 class="cs-panel-title"><?php esc_html_e( 'Changelog', 'revision' ); ?></h3>
								</div>
								<div class="cs-panel-content">
									<div class="cs-description"><?php esc_html_e( 'Keep informed with the latest changes about each theme.', 'revision' ); ?></div>

									<a href="<?php echo esc_url( $this->settings['changelog_link'] ); ?>" class="cs-changelog-link" target="_blank">
										<?php echo esc_html_e( 'See the Changelog', 'revision' ); ?>
									</a>
								</div>
							</div>

							<div class="cs-panel cs-panel-support">
								<div class="cs-panel-head">
									<h3 class="cs-panel-title"><?php esc_html_e( 'Support', 'revision' ); ?></h3>
								</div>
								<div class="cs-panel-content">
									<div class="cs-content-primary">
										<div class="cs-title">
											<?php echo esc_html__( 'Need help? We\'re here for you!', 'revision' ); ?>
										</div>

										<div class="cs-description"><?php esc_html_e( 'Have a question? Hit a bug? Get the help you need, when you need it from our friendly support staff.', 'revision' ); ?></div>

										<div class="cs-button-wrap">
											<a href="<?php echo esc_url( $this->settings['support_link'] ); ?>" class="cs-button button" target="_blank">
												<?php echo esc_html_e( 'Get Support', 'revision' ); ?>
											</a>
										</div>
									</div>
								</div>
							</div>

							<div class="cs-panel cs-panel-community">
								<div class="cs-panel-head">
									<h3 class="cs-panel-title"><?php esc_html_e( 'Community', 'revision' ); ?></h3>
								</div>
								<div class="cs-panel-content">
									<div class="cs-title">
										<?php echo esc_html__( 'Join our Facebook community', 'revision' ); ?>
									</div>

									<div class="cs-description"><?php esc_html_e( 'Discuss products and ask for community support or help the community.', 'revision' ); ?></div>

									<div class="cs-button-wrap">
										<a href="<?php echo esc_url( $this->settings['community_link'] ); ?>" class="cs-button button" target="_blank">
											<?php echo esc_html_e( 'Join Now', 'revision' ); ?>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Notice
		 */
		public function notice() {
			global $pagenow;

			$screen = get_current_screen();

			if ( 'themes.php' === $pagenow && 'themes' === $screen->base ) {
				$transient_name = sprintf( '%s_hero_notice', get_template() );

				if ( ! get_transient( $transient_name ) ) {
					?>
					<div class="cs-dashboard-notice notice notice-success cs-theme-dashboard cs-theme-dashboard-notice is-dismissible" data-notice="<?php echo esc_attr( $transient_name ); ?>">
						<?php $this->render_hero( 'themes' ); ?>
					</div>
					<?php
				}
			}
		}

		/**
		 * Purified from the database information about notification.
		 */
		public function reset_notices() {
			delete_transient( sprintf( '%s_hero_notice', get_template() ) );
		}

		/**
		 * Dismissed handler
		 */
		public function dismissed_handler() {
			wp_verify_nonce( null );

			if ( isset( $_POST['notice'] ) ) { // Input var ok; sanitization ok.

				set_transient( sanitize_text_field( wp_unslash( $_POST['notice'] ) ), true, 90 * DAY_IN_SECONDS ); // Input var ok.
			}
		}

		/**
		 * Notice Enqunue Scripts
		 *
		 * @param string $page Current page.
		 */
		public function notice_enqueue_scripts( $page ) {
			wp_enqueue_script( 'jquery' );

			ob_start();
			?>
			<script>
				jQuery(function($) {
					$( document ).on( 'click', '.cs-dashboard-notice .notice-dismiss', function () {
						jQuery.post( 'ajax_url', {
							action: 'csco_dashboard_dismissed_handler',
							notice: $( this ).closest( '.cs-dashboard-notice' ).data( 'notice' ),
						});
					} );
				});
			</script>
			<?php
			$script = str_replace( 'ajax_url', admin_url( 'admin-ajax.php' ), ob_get_clean() );

			wp_add_inline_script( 'jquery', str_replace( array( '<script>', '</script>' ), '', $script ) );
		}

		/**
		 * This function will register scripts and styles for admin dashboard.
		 *
		 * @param string $page Current page.
		 */
		public function admin_enqueue_scripts( $page ) {
			wp_enqueue_script( 'csco-theme-dashboard', get_theme_file_uri( '/core/theme-dashboard/assets/theme-dashboard.js' ), array( 'jquery' ), filemtime( get_theme_file_path( '/core/theme-dashboard/assets/theme-dashboard.js' ) ), true );

			wp_localize_script( 'csco-theme-dashboard', 'cscoThemeDashboardConfig', array(
				'ajax_url'       => admin_url( 'admin-ajax.php' ),
				'nonce'          => wp_create_nonce( 'nonce' ),
				'failed_message' => esc_html__( 'Something went wrong, contact support.', 'revision' ),
			) );

			// Styles.
			wp_enqueue_style( 'csco-theme-dashboard', get_theme_file_uri( '/core/theme-dashboard/assets/theme-dashboard.css' ), array(), filemtime( get_theme_file_path( '/core/theme-dashboard/assets/theme-dashboard.css' ) ) );

			// Add RTL support.
			wp_style_add_data( 'revision', 'rtl', 'replace' );
		}
	}

	new CSCO_Theme_Dashboard();
}
