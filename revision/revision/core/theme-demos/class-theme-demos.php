<?php
/**
 * Theme Demos
 *
 * @package Revision
 */

if ( ! class_exists( 'CSCO_Theme_Demos' ) ) {
	/**
	 * Theme Demos class.
	 */
	class CSCO_Theme_Demos {
		/**
		 * The slug name to refer to this menu by.
		 *
		 * @var string $menu_slug The menu slug.
		 */
		public $menu_slug = 'theme-demos';

		/**
		 * The dashboard menu slug.
		 *
		 * @var string $dashboard_menu_slug The dashboard menu slug.
		 */
		public $dashboard_menu_slug = 'theme-dashboard';

		/**
		 * The demos of page.
		 *
		 * @var array $demos The demos.
		 */
		public $demos = array();

		/**
		 * Constructor.
		 */
		public function __construct() {
			$self = $this;

			if ( ! function_exists( 'get_plugin_data' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			require_once get_theme_file_path( '/core/theme-demos/import/class-widget-importer.php' );
			require_once get_theme_file_path( '/core/theme-demos/import/class-customizer-importer.php' );

			// Include import.
			require_once get_theme_file_path( '/core/theme-demos/import/class-manager-import.php' );

			// Actions.
			add_action( 'init', array( $this, 'set_demos' ) );

			add_action( 'init', function () use ( $self ) {
				if ( csco_get_license_data( 'status' ) ) {
					add_action( 'admin_menu', array( $self, 'add_menu_page' ) );
				}
			} );

			add_action( 'wp_ajax_csco_html_import_data', array( $this, 'html_import_data' ) );
			add_action( 'wp_ajax_nopriv_csco_html_import_data', array( $this, 'html_import_data' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 5 );
		}

		/**
		 * Add menu page
		 */
		public function add_menu_page() {
			add_submenu_page( 'themes.php', esc_html__( 'Theme Demos', 'revision' ), esc_html__( 'Theme Demos', 'revision' ), 'manage_options', $this->menu_slug, array( $this, 'html_carcase' ), 2 );
		}

		/**
		 * Get plugin status.
		 *
		 * @param string $plugin_path Plugin path.
		 */
		public function get_plugin_status( $plugin_path ) {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			if ( ! file_exists( WP_PLUGIN_DIR . '/' . $plugin_path ) ) {
				return 'not_installed';
			} elseif ( in_array( $plugin_path, (array) get_option( 'active_plugins', array() ), true ) || is_plugin_active_for_network( $plugin_path ) ) {
				return 'active';
			} else {
				return 'inactive';
			}
		}

		/**
		 * Demos
		 *
		 * @param array $demos The demos.
		 */
		public function set_demos( $demos ) {
			/**
			 * The csco_register_demos_list hook.
			 *
			 * @since 1.0.0
			 */
			$this->demos = apply_filters( 'csco_register_demos_list', $this->demos );
		}

		/**
		 * Html Import Data
		 */
		public function html_import_data() {
			global $wpdb;

			check_ajax_referer( 'nonce', 'nonce' );

			$demo_id = isset( $_POST['demo_id'] ) ? sanitize_text_field( $_POST['demo_id'] ) : false;

			if ( $demo_id ) {

				if ( ! isset( $this->demos[ $demo_id ] ) ) {
					wp_send_json_error( esc_html__( 'Invalid demo content id.', 'revision' ) );
					wp_die();
				}

				// Reset import data.
				$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->options} WHERE option_name LIKE %s", $wpdb->esc_like( 'csco_importer_data_' ) . '%' ) ); // db call ok; no-cache ok.

				$demo_data = $this->demos[ $demo_id ];

				ob_start();

				$demo_plugins = isset( $demo_data['plugins'] ) ? $demo_data['plugins'] : array();

				if ( $demo_plugins ) {
					foreach ( $demo_plugins as $key => $plugin ) {
						if ( ! isset( $plugin['name'] ) ) {
							unset( $demo_plugins[ $key ] );
							continue;
						}
						if ( ! isset( $plugin['slug'] ) ) {
							unset( $demo_plugins[ $key ] );
							continue;
						}
						if ( ! isset( $plugin['path'] ) ) {
							unset( $demo_plugins[ $key ] );
							continue;
						}
						if ( 'active' === $this->get_plugin_status( $plugin['path'] ) ) {
							unset( $demo_plugins[ $key ] );
							continue;
						}
					}
				}
				?>
				<div class="cs-import-data">
					<?php if ( $demo_plugins ) { ?>
						<div class="cs-import-plugins">
							<div class="cs-import-subheader">
								<?php esc_html_e( 'Install Plugins', 'revision' ); ?>
							</div>

							<?php
							foreach ( $demo_plugins as $plugin ) {
								$required = isset( $plugin['required'] ) ? $plugin['required'] : false;
								?>
								<form>
									<div class="cs-switcher">
										<?php echo esc_html( $plugin['name'] ); ?> <input class="cs-checkbox" type="checkbox" name="<?php echo esc_attr( $plugin['slug'] ); ?>" value="1" <?php echo wp_kses( $required ? 'readony onclick="return false;"' : null, 'content' ); ?> checked>

										<?php if ( isset( $plugin['desc'] ) && $plugin['desc'] ) { ?>
											<div class="cs-tooltip-help"><i class="dashicons dashicons-editor-help"></i></div>

											<div class="cs-tooltip-desc"><?php echo esc_html( $plugin['desc'] ); ?></div>
										<?php } ?>

										<div class="cs-switch"><span class="cs-switch-slider"></span></div>

										<div class="cs-tooltip"><?php esc_html_e( 'Required plugin will be installed', 'revision' ); ?></div>
									</div>

									<input type="hidden" name="plugin_slug" value="<?php echo esc_attr( $plugin['slug'] ); ?>">

									<input type="hidden" name="plugin_path" value="<?php echo esc_attr( $plugin['path'] ); ?>">

									<input type="hidden" name="step_name" value="<?php esc_attr_e( 'Installing and activating', 'revision' ); ?> <?php echo esc_attr( $plugin['name'] ); ?>...">

									<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'nonce' ) ); ?>">

									<input type="hidden" name="action" value="csco_import_plugin">
								</form>
							<?php } ?>
						</div>
					<?php } ?>

					<div class="cs-import-content">
						<form class="hidden">
							<input type="hidden" name="step_name" value="<?php esc_attr_e( 'Pre import...', 'revision' ); ?>">
							<input type="hidden" name="_nonce" value="<?php echo esc_attr( wp_create_nonce( 'elementor_recreate_kit' ) ); ?>">
							<input type="hidden" name="action" value="elementor_recreate_kit">
							<input class="cs-checkbox" type="checkbox" name="pre_import" value="1" checked>
						</form>

						<div class="cs-import-subheader">
							<?php esc_html_e( 'Import Content', 'revision' ); ?>
						</div>

						<?php
						if ( isset( $demo_data['import']['content'] ) && is_array( $demo_data['import']['content'] ) && $demo_data['import']['content'] ) {
							$kits = $demo_data['import']['content'];
							?>
							<div class="cs-import-kits">
								<?php foreach ( $kits as $kit ) { ?>
									<form>
										<div class="cs-switcher">
											<?php echo esc_html( $kit['label'] ); ?> <input class="cs-checkbox" type="checkbox" name="url" value="<?php echo esc_attr( $kit['url'] ); ?>" checked>

											<?php if ( isset( $kit['desc'] ) && $kit['desc'] ) { ?>
												<div class="cs-tooltip-help"><i class="dashicons dashicons-editor-help"></i></div>

												<div class="cs-tooltip-desc"><?php echo esc_html( $kit['desc'] ); ?></div>
											<?php } ?>

											<div class="cs-switch"><span class="cs-switch-slider"></span></div>

											<input type="hidden" name="type" value="<?php echo esc_attr( isset( $kit['type'] ) ? $kit['type'] : 'default' ); ?>">

											<input type="hidden" name="step_name" value="<?php esc_attr_e( 'Importing', 'revision' ); ?> <?php echo esc_attr( $kit['label'] ); ?> ...">

											<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'nonce' ) ); ?>">

											<input type="hidden" name="action" value="csco_import_contents">
										</div>
									</form>
								<?php } ?>
							</div>
						<?php } ?>

						<?php if ( isset( $demo_data['import']['customizer'] ) && $demo_data['import']['customizer'] ) { ?>
							<form>
								<div class="cs-switcher">
									<?php esc_html_e( 'Customizer', 'revision' ); ?> <input class="cs-checkbox" type="checkbox" name="url" value="<?php echo esc_attr( $demo_data['import']['customizer'] ); ?>" checked>

									<div class="cs-switch"><span class="cs-switch-slider"></span></div>
								</div>

								<input type="hidden" name="step_name" value="<?php esc_attr_e( 'Importing customizer options...', 'revision' ); ?>">

								<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'nonce' ) ); ?>">

								<input type="hidden" name="action" value="csco_import_customizer">
							</form>
						<?php } ?>

						<?php if ( isset( $demo_data['import']['options'] ) && $demo_data['import']['options'] ) { ?>
							<form>
								<div class="cs-switcher">
									<?php esc_html_e( 'Options', 'revision' ); ?> <input class="cs-checkbox" type="checkbox" name="url" value="<?php echo esc_attr( $demo_data['import']['options'] ); ?>" checked>

									<div class="cs-switch"><span class="cs-switch-slider"></span></div>
								</div>

								<input type="hidden" name="step_name" value="<?php esc_attr_e( 'Importing options...', 'revision' ); ?>">

								<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'nonce' ) ); ?>">

								<input type="hidden" name="action" value="csco_import_options">
							</form>
						<?php } ?>

						<?php if ( isset( $demo_data['import']['widgets'] ) && $demo_data['import']['widgets'] ) { ?>
							<form>
								<div class="cs-switcher">
									<?php esc_html_e( 'Widgets', 'revision' ); ?> <input class="cs-checkbox" type="checkbox" name="url" value="<?php echo esc_attr( $demo_data['import']['widgets'] ); ?>" checked>

									<div class="cs-switch"><span class="cs-switch-slider"></span></div>
								</div>

								<input type="hidden" name="step_name" value="<?php esc_attr_e( 'Importing widgets...', 'revision' ); ?>">

								<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'nonce' ) ); ?>">

								<input type="hidden" name="action" value="csco_import_widgets">
							</form>
						<?php } ?>

						<form class="hidden">
							<div class="cs-switcher">
								<?php esc_html_e( 'Finish', 'revision' ); ?> <input class="cs-checkbox" type="checkbox" name="finish" value="1" checked>

								<div class="cs-switch"><span class="cs-switch-slider"></span></div>
							</div>

							<input type="hidden" name="step_name" value="<?php esc_attr_e( 'Finishing setup...', 'revision' ); ?>">

							<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'nonce' ) ); ?>">

							<input type="hidden" name="action" value="csco_import_finish">
						</form>
					</div>
				</div>

				<div class="cs-import-actions">
					<div class="cs-import-theme-cancel">
						<a href="#" class="cs-button cs-demo-import-close button">
							<?php esc_html_e( 'Cancel', 'revision' ); ?>
						</a>
					</div>

					<div class="cs-import-theme-start">
						<a href="#" class="cs-demo-import-start button button-primary">
							<?php esc_html_e( 'Import', 'revision' ); ?>
						</a>
					</div>
				</div>
				<?php
				wp_send_json_success( ob_get_clean() );
			} else {
				wp_send_json_error( esc_html__( 'Demo content id not set.', 'revision' ) );
			}

			wp_die();
		}

		/**
		 * Html Carcase
		 */
		public function html_carcase() {
			?>
			<div class="cs-wrap cs-demos-page">
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
				</div>

				<div class="wrap">
					<h1 class="hidden"><?php esc_html_e( 'Theme Demos', 'revision' ); ?></h1>

					<?php
					if ( $this->demos ) {
						?>
						<div class="cs-demos">
							<?php
							foreach ( $this->demos as $demo_id => $demo ) {
								// Demo Variables.
								$name    = isset( $demo['name'] ) && $demo['name'] ? $demo['name'] : null;
								$preview = isset( $demo['preview'] ) && $demo['preview'] ? $demo['preview'] : 'false';
								?>
								<div class="cs-demo-item cs-demo-item-active"
									data-id="<?php echo esc_attr( $demo_id ); ?>"
									data-name="<?php echo esc_attr( $name ); ?>"
									data-preview="<?php echo esc_url( $preview ); ?>">

									<div class="cs-demo-outer">
										<div class="cs-demo-thumbnail">
											<?php if ( isset( $demo['thumbnail'] ) && $demo['thumbnail'] ) { ?>
												<img src="<?php echo esc_url( $demo['thumbnail'] ); ?>">
											<?php } ?>

											<?php if ( isset( $demo['preview'] ) && $demo['preview'] ) { ?>
												<div class="cs-demo-preview">
													<span>
														<?php esc_html_e( 'Preview Demo', 'revision' ); ?>
													</span>
												</div>
											<?php } ?>
										</div>
										<div class="cs-demo-data">
											<div class="cs-demo-info">
												<?php if ( isset( $demo['name'] ) && $demo['name'] ) { ?>
													<div class="cs-demo-name"><?php echo esc_html( $demo['name'] ); ?></div>
												<?php } ?>
											</div>

											<div class="cs-demo-actions">
												<div class="cs-demo-import">
													<a href="#" target="_blank" data-id="<?php echo esc_attr( $demo_id ); ?>" class="cs-demo-import-open button button-primary">
														<?php esc_html_e( 'Import', 'revision' ); ?>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>

				<div class="cs-import-theme">
					<div class="cs-import-overlay"></div>

					<div class="cs-import-popup">
						<div class="cs-import-container">
							<div class="cs-import-step cs-import-step-active cs-import-start">
								<div class="cs-import-header">
									<?php esc_html_e( 'Import Theme', 'revision' ); ?>
								</div>

								<div class="cs-import-output"></div>
							</div>

							<div class="cs-import-step cs-import-process">
								<div class="cs-import-header">
									<?php esc_html_e( 'Installing', 'revision' ); ?>
								</div>

								<div class="cs-import-output">
									<div class="cs-import-desc">
										<?php esc_html_e( 'Please be patient and don\'t refresh this page, the import process may take a while, this also depends on your server.', 'revision' ); ?>
									</div>

									<div class="cs-import-progress">
										<div class="cs-import-progress-label"></div>

										<div class="cs-import-progress-bar">
											<div class="cs-import-progress-indicator"></div>
										</div>

										<div class="cs-import-progress-sublabel">0%</div>
									</div>
								</div>
							</div>

							<div class="cs-import-step cs-import-finish">
								<div class="cs-import-info">
									<div class="cs-import-logo">
										<svg class="progress-icon" width="96" height="96" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
											<g class="tick-icon" stroke-width="1" stroke="#3FB28F" transform="translate(1, 1.2)">
											<path id="tick-outline-path" d="M14 28c7.732 0 14-6.268 14-14S21.732 0 14 0 0 6.268 0 14s6.268 14 14 14z"/>
											<path id="tick-path" d="M6.173 16.252l5.722 4.228 9.22-12.69"/>
											</g>
										</svg>
									</div>

									<div class="cs-import-title">
										<?php esc_html_e( 'Imported Succefully', 'revision' ); ?>
									</div>

									<div class="cs-import-desc">
										<?php esc_html_e( 'Go ahead, customize the text, images and design to make it yours!', 'revision' ); ?>
									</div>

									<div class="cs-import-customize">
										<a href="<?php echo esc_url( admin_url( '/customize.php' ) ); ?>" class="button button-primary" target="_blank">
											<?php esc_html_e( 'Customize', 'revision' ); ?>
										</a>
									</div>
								</div>

								<div class="cs-import-actions">
									<a href="<?php echo esc_url( add_query_arg( 'page', $this->dashboard_menu_slug, admin_url( 'themes.php' ) ) ); ?>" class="cs-link">
										<?php esc_html_e( 'Return to Dashboard', 'revision' ); ?>
									</a>

									<a href="<?php echo esc_url( home_url() ); ?>" class="cs-button button" target="_blank">
										<?php esc_html_e( 'View Site', 'revision' ); ?>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="cs-preview">
					<div class="cs-header">
						<div class="cs-header-left">
							<div class="cs-header-col cs-header-logo">
								<div class="cs-logo">
									<a target="_blank" href="<?php echo esc_url( 'https://codesupply.co/' ); ?>">
										Code Supply Co.
									</a>
								</div>
							</div>

							<div class="cs-header-col cs-header-arrow">
								<a href="#" class="cs-arrow cs-prev-demo"></a>
							</div>

							<div class="cs-header-col cs-header-arrow">
								<a href="#" class="cs-arrow cs-next-demo"></a>
							</div>

							<div class="cs-header-col cs-header-info"></div>
						</div>

						<div class="cs-header-right">
							<div class="cs-preview-cancel">
								<a href="#" class="button">
									<?php esc_html_e( 'Cancel', 'revision' ); ?>
								</a>
							</div>

							<div class="cs-preview-actions"></div>
						</div>
					</div>

					<i<?php echo esc_attr( 'frame' ); ?> id="cs-preview-i<?php echo esc_attr( 'frame' ); ?>" class="cs-preview-i<?php echo esc_attr( 'frame' ); ?>"></i<?php echo esc_attr( 'frame' ); ?>>
				</div>
			</div>
			<?php
		}

		/**
		 * This function will register scripts and styles for admin dashboard.
		 *
		 * @param string $page Current page.
		 */
		public function admin_enqueue_scripts( $page ) {
			wp_enqueue_script( 'cs-theme-demos', get_theme_file_uri( '/core/theme-demos/assets/theme-demos.js' ), array( 'jquery' ), filemtime( get_theme_file_path( '/core/theme-demos/assets/theme-demos.js' ) ), true );

			wp_localize_script( 'cs-theme-demos', 'cscoThemeDemosConfig', array(
				'ajax_url'       => admin_url( 'admin-ajax.php' ),
				'nonce'          => wp_create_nonce( 'nonce' ),
				'failed_message' => esc_html__( 'Something went wrong, contact support.', 'revision' ),
			) );

			// Styles.
			wp_enqueue_style( 'cs-theme-demos', get_theme_file_uri( '/core/theme-demos/assets/theme-demos.css' ), array(), filemtime( get_theme_file_path( '/core/theme-demos/assets/theme-demos.css' ) ) );

			// Add RTL support.
			wp_style_add_data( 'revision', 'rtl', 'replace' );
		}
	}

	new CSCO_Theme_Demos();
}
