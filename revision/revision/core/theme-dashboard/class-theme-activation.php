<?php
/**
 * Theme Activation.
 *
 * @package Revision
 */

if ( ! class_exists( 'CSCO_Theme_Activation' ) ) {

	/**
	 * This class to activate your theme and open up new opportunities.
	 */
	class CSCO_Theme_Activation {

		/**
		 * The purchase code.
		 *
		 * @var string $purchase_code The purchase code.
		 */
		public $purchase_code = null;

		/**
		 * The current theme slug.
		 *
		 * @var string $theme The current theme slug.
		 */
		public $theme;

		/**
		 * The current theme name.
		 *
		 * @var string $theme_name The current theme name.
		 */
		public $theme_name;

		/**
		 * The server domain.
		 *
		 * @var string $server The server domain.
		 */
		public $server;

		/**
		 * The current domain.
		 *
		 * @var string $theme The current domain.
		 */
		public $domain;

		/**
		 * The message.
		 *
		 * @var string $msg The message.
		 */
		public $msg;

		/**
		 * The urls.
		 *
		 * @var string $urls The urls.
		 */
		public $urls;

		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->init();

			$this->trigger_license();

			/** Initialize actions */
			add_action( 'csco_theme_dashboard_tabs', array( $this, 'register_settings' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_notices', array( $this, 'display_license_notice' ) );
			add_action( 'wp_ajax_csco_activation_dismissed_handler', array( $this, 'dismissed_handler' ) );
		}

		/**
		 * Initialization
		 */
		public function init() {
			// Set current theme slug.
			$this->theme = get_template();
			// Set current theme name.
			$this->theme_name = $this->get_theme_data( 'Name' );
			// Set server url.
			$this->server = $this->get_theme_data( 'AuthorURI' );
			// Set current domain.
			$this->domain = $this->format_domain( home_url() );
			// Set urls.
			$this->urls = array(
				'terms_conditions' => 'Imh0dHBzOlwvXC9jb2Rlc3VwcGx5LmNvXC90ZXJtcy1hbmQtY29uZGl0aW9uc1wvIg==',
				'privacy_policy'   => 'Imh0dHBzOlwvXC9jb2Rlc3VwcGx5LmNvXC9wcml2YWN5LXBvbGljeVwvIg==',
				'envato_support'   => 'Imh0dHBzOlwvXC9oZWxwLm1hcmtldC5lbnZhdG8uY29tXC9oY1wvZW4tdXNcL2FydGljbGVzXC8yMDc4ODY0NzMtRXh0ZW5kaW5nLWFuZC1SZW5ld2luZy1JdGVtLVN1cHBvcnQit',
			);
		}

		/**
		 * Format the domain according to certain rules.
		 *
		 * @param string $string The name of domain.
		 */
		public function format_domain( $string ) {
			$string = rtrim( $string, '/' );

			// Remove 'WWW' from URL inside a string.
			$string = str_replace( 'www.', '', $string );

			return $string;
		}

		/**
		 * Get data about the theme.
		 *
		 * @param mixed $name The name of param.
		 */
		public function get_theme_data( $name ) {
			$data = wp_get_theme( $this->theme );

			return $data->get( $name );
		}


		/**
		 * Add settings to dashboard
		 *
		 * @param array $tabs The tabs.
		 */
		public function register_settings( $tabs ) {

			$tabs[] = array(
				'slug'     => 'license',
				'label'    => esc_html__( 'License Information', 'revision' ),
				'priority' => 10,
				'content'  => $this->render_settings(),
			);

			return $tabs;
		}

		/**
		 * Set message.
		 *
		 * @param string $text The text of message.
		 * @param string $type The type of message.
		 */
		public function set_message( $text, $type = 'error' ) {
			ob_start();
			?>
			<div class="notice notice-<?php echo esc_attr( $type ); ?>">
				<p><?php echo wp_kses( $text, 'common' ); ?></p>
			</div>
			<?php
			return ob_get_clean();
		}

		/**
		 * Purified from the database information about notification.
		 */
		public function reset_notices() {
			delete_transient( sprintf( '%s_license_expired', $this->theme ) );

			delete_transient( sprintf( '%s_license_limit', $this->theme ) );
		}

		/**
		 * Get option name with purchase code.
		 *
		 * @param array $data The data of license.
		 */
		public function setting_purchase_code( $data = null ) {
			$item_id = isset( $data['item_id'] ) ? $data['item_id'] : csco_get_license_data( 'item_id' );

			return sprintf( 'envato_purchase_code_%s', $item_id );
		}

		/**
		 * Get option name with license data.
		 */
		public function setting_license_data() {
			return sprintf( '%s_license_data', $this->theme );
		}


		/**
		 * Get option name with subscribe.
		 */
		public function setting_subscribe() {
			return sprintf( '%s_license_subscribe', md5( $this->domain ) );
		}

		/**
		 * Update subscribe.
		 */
		public function update_subscribe() {
			update_option( $this->setting_subscribe(), true );
		}

		/**
		 * Check license existence.
		 *
		 * @param array $data The data of license.
		 */
		public function check_license( $data ) {
			return isset( $data['item_id'] ) ? true : false;
		}

		/**
		 * Update license.
		 *
		 * @param array $data The data of license.
		 */
		public function update_license( $data ) {
			// Update purchase code.
			update_option( $this->setting_purchase_code( $data ), $this->purchase_code );

			// Update license data.
			update_option( $this->setting_license_data(), $data );
		}

		/**
		 * Delete data of license from database.
		 */
		public function delete_license() {
			$this->purchase_code = null;

			// Delete purchase code.
			delete_option( $this->setting_purchase_code() );

			// Delete license data.
			delete_option( $this->setting_license_data() );
		}

		/**
		 * Remove alliances.
		 *
		 * @param array $haystack The haystack.
		 * @param array $results  The results.
		 */
		public function remove_alliances( $haystack, $results = array() ) {
			if ( $haystack ) {
				foreach ( $haystack as $key => $item ) {
					if ( isset( $item['domain'] ) ) {
						if ( strpos( $item['domain'], 'localhost' ) || strpos( $item['domain'], '127.0.0.1' ) ) {
							continue;
						}

						$parse = explode( '.', wp_parse_url( $item['domain'], PHP_URL_HOST ) );

						if ( 'test' === end( $parse ) || 'dev' === end( $parse ) ) {
							continue;
						}

						$haystack[ $key ]['domain'] = str_replace( array( 'https://', 'http://', 'www.' ), '', $item['domain'] );

						$haystack[ $key ]['domain'] = rtrim( $haystack[ $key ]['domain'], '/' );

						$map = array_map( function ( $item ) {
							return $item['domain'];
						}, $results );

						if ( ! in_array( $haystack[ $key ]['domain'], $map, true ) ) {
							$results[] = $item;
						}
					}
				}
			}

			return $results;
		}

		/**
		 * Render settings
		 */
		public function render_settings() {
			ob_start();

			wp_verify_nonce( null );

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'You do not have sufficient rights to view this page.', 'revision' ) );
			}

			// Message output.
			if ( $this->msg ) {
				echo wp_kses( $this->msg, 'post' );
			}

			// Get current status.
			$status = csco_get_license_data( 'status' );
			?>
			<div class="cs-activation">
				<?php if ( $status && ! get_option( $this->setting_subscribe() ) && 'dev' !== csco_get_license_data( 'item_id' ) ) { ?>
					<div class="cs-activation-postbox">

						<h2 class="hndle"><span><?php esc_html_e( 'Updates', 'revision' ); ?></span></h2>

						<div class="inside">
							<p class="cs-theme-license-msg"><?php esc_html_e( 'We set a special price for all new themes for just a few days. Get notified of all introductory, flash and seasonal sales by signing up to our updates.', 'revision' ); ?></p>

							<form method="post" class="cs-theme-license-form">
								<?php wp_nonce_field(); ?>

								<input type="hidden" name="code" value="<?php echo esc_attr( get_option( $this->setting_purchase_code() ) ); ?>">

								<table class="form-table">
									<!-- Email Address -->
									<tr>
										<th scope="row"><?php esc_html_e( 'Email Address', 'revision' ); ?></label></th>
										<td>
											<input class="regular-text" type="text" name="email" value="<?php echo esc_attr( get_bloginfo( 'admin_email' ) ); ?>">
										</td>
									</tr>
									<!-- Updates -->
									<tr>
										<th scope="row"></th>
										<td>
										<div class="cs-theme-license-updates">
											<input class="cs-theme-license-newsletter" id="newsletter" name="newsletter" type="checkbox" value="1">

											<label for="newsletter">
												<p><?php esc_html_e( 'By checking this box you agree to our', 'revision' ); ?> <a href="<?php echo esc_url( csco_decode_data( $this->urls['terms_conditions'] ) ); ?>" target="_blank"><?php esc_html_e( 'Terms and Conditions', 'revision' ); ?></a> <?php esc_html_e( 'and', 'revision' ); ?> <a href="<?php echo esc_url( csco_decode_data( $this->urls['privacy_policy'] ) ); ?>" target="_blank"><?php esc_html_e( 'Privacy Policy', 'revision' ); ?></a>.</p>

												<p class="description"><?php esc_html_e( 'You may opt-out any time by clicking the unsubscribe link in the footer of any email you receice from us, or by contacting us at', 'revision' ); ?> <a target="_blank" href="mailto:support@codesupply.co"><?php esc_html_e( 'support@codesupply.co', 'revision' ); ?></a>.</p>
											</label>
											</div>
										</td>
									</tr>
									<!-- Submitbox -->
									<tr>
										<th scope="row"></th>
										<td>
											<button name="action" value="subscribe" type="submit" class="button button-primary button-large" id="publish"><?php esc_html_e( 'Subscribe', 'revision' ); ?></button>
										</td>
									</tr>
								</table>
							</form>
						</div>
					</div>
				<?php } ?>

				<div class="cs-activation-postbox">
					<?php if ( ! $status ) { ?>
						<h2 class="hndle">
							<span>
								<?php esc_html_e( 'Activation', 'revision' ); ?>
							</span>
						</h2>
					<?php } ?>

					<div class="inside">
						<!-- Active Websites -->
						<?php if ( $status ) { ?>
							<form method="post">
								<?php wp_nonce_field(); ?>

								<table class="form-table">
									<tr>
										<th scope="row"><?php esc_html_e( 'Active Websites', 'revision' ); ?></label></th>
										<td>
											<?php
											$history = csco_get_license_data( 'license_history' );

											if ( $history ) {
												?>
												<?php
												foreach ( $history as $item ) {
													if ( 'active' === $item['status'] ) {
														echo sprintf( '<p><a target="_blank" href="%1$s">%1$s</a></p>', esc_url( $item['domain'] ) );
													}
												}
												?>
												<br>
												<p>
													<input type="hidden" name="code" value="<?php echo esc_attr( get_option( $this->setting_purchase_code() ) ); ?>">

													<button class="button" type="submit" name="action" value="check"><?php esc_html_e( 'Check Again', 'revision' ); ?></button>
												</p>
												<?php
											} elseif ( 'dev' === csco_get_license_data( 'item_id' ) ) {
												esc_html_e( 'Development Mode', 'revision' );
											}
											?>
										</td>
									</tr>
								</table>
							</form>
						<?php } ?>

						<!-- Information -->
						<form method="post">
							<?php wp_nonce_field(); ?>

							<table class="form-table">
								<!-- Purchase Code -->
								<tr class="<?php echo esc_attr( $status ? 'hidden' : null ); ?>">
									<th scope="row"><?php esc_html_e( 'Purchase Code', 'revision' ); ?></label></th>
									<td>
										<input class="regular-text" type="text" name="code" value="<?php echo esc_attr( get_option( $this->setting_purchase_code() ) ); ?>">
									</td>
								</tr>
								<!-- Purchase Date -->
								<tr class="<?php echo esc_attr( ! $status ? 'hidden' : null ); ?>">
									<th scope="row"><?php esc_html_e( 'Purchase Date', 'revision' ); ?></label></th>
									<td>
										<?php $sold_at = csco_get_license_data( 'sold_at' ); ?>

										<?php echo esc_html( date( 'F d, Y', strtotime( $sold_at ) ) ); ?>
									</td>
								</tr>
								<!-- Supported Until -->
								<?php
								$supported_until = csco_get_license_data( 'supported_until' );

								if ( strtotime( $supported_until ) < strtotime( 'now' ) ) {
									?>
									<tr class="<?php echo esc_attr( ! $status ? 'hidden' : null ); ?>">
										<th scope="row"><?php esc_html_e( 'Supported Until', 'revision' ); ?></label></th>
										<td>
											<span class="cs-theme-license-supported_until">
												<?php echo esc_html( date( 'F d, Y', strtotime( $supported_until ) ) ); ?>

												<?php esc_html_e( ' (Expired)', 'revision' ); ?>
											</span>
											<p class="description"><?php esc_html_e( 'Please renew your item support for any support requests. See', 'revision' ); ?> <a href="<?php echo esc_url( csco_decode_data( $this->urls['envato_support'] ) ); ?>" target="_blank"><?php esc_html_e( 'this document', 'revision' ); ?></a> <?php esc_html_e( 'for more details.', 'revision' ); ?></p>
										</td>
									</tr>
								<?php } ?>
								<!-- Submitbox -->
								<tr>
									<th scope="row">
										<?php
										if ( $status ) {
											esc_html_e( 'Deactivation', 'revision' );
										}
										?>
									</th>
									<td>
										<?php if ( $status ) { ?>
											<button name="action" value="deactivate" type="submit" class="button button-primary button-large" id="publish"><?php esc_html_e( 'Deactivate License', 'revision' ); ?></button>
										<?php } ?>

										<?php if ( ! $status ) { ?>
											<button name="action" value="activate" type="submit" class="button button-primary button-large" id="publish"><?php esc_html_e( 'Activate License', 'revision' ); ?></button>
										<?php } ?>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
			<?php

			return ob_get_clean();
		}

		/**
		 * Trigger license.
		 */
		public function trigger_license() {
			if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'] ) ) { // Input var ok; sanitization ok.
				return;
			}

			$email = null;

			// Get action.
			if ( ! isset( $_POST['action'] ) ) { // Input var ok.
				return;
			}

			// Get purchase code.
			if ( isset( $_POST['code'] ) && $_POST['code'] ) { // Input var ok; sanitization ok.
				$this->purchase_code = sanitize_text_field( $_POST['code'] ); // Input var ok; sanitization ok.
			} else {
				$this->msg = $this->set_message( esc_html__( 'Purchase code not entered.', 'revision' ) );
				return;
			}

			$action = sanitize_text_field( $_POST['action'] ); // Input var ok; sanitization ok.

			// Get email.
			if ( 'subscribe' === $action ) {
				if ( isset( $_POST['email'] ) && $_POST['email'] ) { // Input var ok; sanitization ok.
					$email = sanitize_email( wp_unslash( $_POST['email'] ) ); // Input var ok.
				} else {
					$this->msg = $this->set_message( esc_html__( 'Email address is considered invalid.', 'revision' ) );
					return;
				}

				if ( ! isset( $_POST['newsletter'] ) ) { // Input var ok; sanitization ok.
					$this->msg = $this->set_message( esc_html__( 'Please agree to our terms and conditions.', 'revision' ) );
					return;
				}
			}

			// Get url server.
			$remote_url = sprintf( '%s/wp-json/csco/v1/check-license', $this->server );

			// Remote query.
			$response = wp_remote_post( $remote_url, array(
				'timeout'     => 45,
				'redirection' => 5,
				'httpversion' => '1.0',
				'blocking'    => true,
				'headers'     => array(),
				'body'        => array(
					'code'       => $this->purchase_code,
					'theme_name' => $this->theme_name,
					'domain'     => $this->domain,
					'action'     => $action,
					'email'      => $email,
				),
				'cookies'     => array(),
			) );

			if ( is_wp_error( $response ) ) {
				$this->msg = $this->set_message( esc_html__( 'No connection to the server, try another time, or contact support.', 'revision' ) );
				return;
			}

			// Retrieve data.
			$data = wp_remote_retrieve_body( $response );

			// JSON Decode.
			$data = json_decode( $data, true );

			if ( isset( $data['data'] ) ) {
				$data = $data['data'];
			}

			// Update license.
			if ( 'activate' === $action && $this->check_license( $data ) ) {
				$this->reset_notices();
				$this->update_license( $data );
			}

			// Deactivate license.
			if ( 'deactivate' === $action && $this->check_license( $data ) ) {
				$this->reset_notices();
				$this->delete_license();
			}

			// Check again.
			if ( 'check' === $action ) {
				if ( $this->check_license( $data ) ) {
					$this->update_license( $data );
				} else {
					$this->reset_notices();
					$this->delete_license();
				}
			}

			// Subscribe.
			if ( 'subscribe' === $action ) {
				if ( $this->check_license( $data ) ) {
					$this->update_subscribe();
				} else {
					$this->reset_notices();
					$this->delete_license();
				}
			}

			// Output message.
			if ( ! isset( $data['message'] ) ) {
				$this->msg = $this->set_message( esc_html__( 'Could not receive data from the server, try another time, or contact support.', 'revision' ) );
			} else {
				$this->msg = $data['message'];
			}
		}

		/**
		 * Display a notification of license.
		 */
		public function display_license_notice() {
			$screen = get_current_screen();

			if ( ! csco_get_license_data( 'status' ) ) {
				return;
			}

			// Dismissible.
			$dismissible = null;

			if ( 'appearance_page_theme-dashboard' !== $screen->base ) {
				$dismissible = 'is-dismissible';
			}

			/*
			 * Support expired.
			 */

			// Get license data.
			$supported_until = csco_get_license_data( 'supported_until' );

			// Date comparison.
			if ( strtotime( $supported_until ) < strtotime( 'now' ) ) {
				// Set transient name.
				$transient_name = sprintf( '%s_license_expired', $this->theme );

				if ( ( ! get_transient( $transient_name ) && $dismissible ) || ! $dismissible ) {
					?>
					<div class="cs-activation-notice notice notice-warning <?php echo esc_attr( $dismissible ); ?>" data-notice="<?php echo esc_attr( $transient_name ); ?>">
						<p><strong><?php esc_html_e( 'Support expired.', 'revision' ); ?></strong>
						<?php
							// Translators: theme name and link activation.
							echo wp_kses( sprintf( __( 'Your support for the %1$s theme has expired. Please %2$s for any support requests.', 'revision' ), $this->theme_name, '<a href="' + esc_url( csco_decode_data( $this->urls['envato_support'] ) ) + '" target="_blank">' . __( 'renew your support license', 'revision' ) . '</a>' ), 'common' );
						?>
						</p>
					</div>
					<?php
				}
			}

			/*
			 * Multiple active websites detected.
			 */

			// Get license history.
			$history = (array) csco_get_license_data( 'license_history' );
			$count   = (int) csco_get_license_data( 'purchase_count' );

			// Unique history.
			$history_without_alliances = $this->remove_alliances( $history );

			// Get actived domains.
			$actived = array_filter( $history_without_alliances, function( $item ) {
				return isset( $item['status'] ) && 'active' === $item['status'];
			} );

			// Check the number of purchases.
			if ( count( $actived ) > $count ) {
				// Set transient name.
				$transient_name = sprintf( '%s_license_limit', $this->theme );

				if ( ( ! get_transient( $transient_name ) && $dismissible ) || ! $dismissible ) {
					?>
						<div class="cs-activation-notice notice notice-warning <?php echo esc_attr( $dismissible ); ?>" data-notice="<?php echo esc_attr( $transient_name ); ?>">
							<p><strong><?php esc_html_e( 'Multiple active websites detected.', 'revision' ); ?></strong> <?php esc_html_e( 'Looks like you’re using the same theme license on multiple websites. A website theme can only be customized to create one customized website according to the ThemeForest license terms. If you want to create a second website from the same theme, you’ll need to', 'revision' ); ?> <a href="<?php esc_url( admin_url( '/themes.php?page=theme-dashboard&tab=license' ) ); ?>"><?php esc_html_e( 'purchase another license', 'revision' ); ?></a>.</p>
						</div>
					<?php
				}
			}
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
		 *  Enqunue Scripts
		 *
		 * @param string $page Current page.
		 */
		public function enqueue_scripts( $page ) {
			wp_enqueue_script( 'jquery' );

			ob_start();
			?>
			<script>
				jQuery(function($) {
					$( document ).on( 'click', '.cs-activation-notice .notice-dismiss', function () {
						jQuery.post( 'ajax_url', {
							action: 'csco_activation_dismissed_handler',
							notice: $( this ).closest( '.cs-activation-notice' ).data( 'notice' ),
						});
					} );
				});
			</script>
			<?php
			$script = str_replace( 'ajax_url', admin_url( 'admin-ajax.php' ), ob_get_clean() );

			wp_add_inline_script( 'jquery', str_replace( array( '<script>', '</script>' ), '', $script ) );
		}
	}

	/**
	 * Display the license notification.
	 */
	function csco_license_notice() {
		if ( ! csco_get_license_data( 'status' ) ) {
			?>
			<div class="notice notice-warning notice-alt">
				<p>
					<?php
					if ( is_customize_preview() ) {
						// Translators: link activation.
						echo wp_kses( sprintf( __( 'Please %1$s to unlock theme demos.', 'revision' ), '<a class="button-link" href="' . admin_url( '/themes.php?page=theme-dashboard&tab=license' ) . '">' . __( 'activate your license', 'revision' ) . '</a>' ), 'common' );
					} else {
						// Translators: link activation.
						echo wp_kses( sprintf( __( 'Please %1$s to unlock demo content.', 'revision' ), '<a class="button-link" href="' . admin_url( '/themes.php?page=theme-dashboard&tab=license' ) . '">' . __( 'activate your license', 'revision' ) . '</a>' ), 'common' );
					}
					?>
				</p>
			</div>
			<?php
		}
	}

	/**
	 * Get data of license.
	 *
	 * @param string $param The name param.
	 */
	function csco_get_license_data( $param ) {
		$data = get_option( sprintf( '%s_license_data', get_template() ), array() );

		if ( is_array( $data ) && isset( $data[ $param ] ) ) {
			return $data[ $param ];
		}
	}

	new CSCO_Theme_Activation();
}
