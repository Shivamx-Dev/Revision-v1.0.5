<?php
/**
 * Promo Banner
 *
 * Handles the display and management of promotional banners in the WordPress admin area.
 *
 * This class fetches banner data from a JSON file, displays banners based on certain conditions,
 * and allows users to dismiss banners. It also includes methods for handling AJAX requests
 * and ensures that data is updated periodically.
 *
 * @package Authentic
 */

if ( ! class_exists( 'CSCO_Promo_Banner' ) ) {
	/**
	 * Class CSCO_Promo_Banner
	 */
	class CSCO_Promo_Banner {
		/**
		 * Singleton instance of the class.
		 *
		 * @var CSCO_Promo_Banner|null
		 */
		private static $instance = null;

		/**
		 * URL to the JSON file containing the banners data.
		 *
		 * @var string
		 */
		private $json_url = 'https://cloud.codesupply.co/promo-banner/data.json';

		/**
		 * Option name for storing banners data.
		 *
		 * @var string
		 */
		private $option_name = 'csco_promo_banners_data';

		/**
		 * Option name for storing banners data timestamp.
		 *
		 * @var string
		 */
		private $option_timestamp = 'csco_promo_banners_data_timestamp';

		/**
		 * Prefix for the transient key used to store dismissed banners.
		 *
		 * @var string
		 */
		private $dismiss_transient_prefix = 'csco_promo_banner_dismissed_';

		/**
		 * Update interval in hours.
		 *
		 * @var int
		 */
		private $update_interval_hours = 24;

		/**
		 * Dismissed banner expiration in seconds (6 months).
		 *
		 * @var int
		 */
		private $dismiss_expiration = 6 * 30 * DAY_IN_SECONDS; // Approximately 6 months.

		/**
		 * Constructor function.
		 * Sets up the necessary WordPress hooks.
		 */
		private function __construct() {
			// Display banners in admin notices.
			add_action( 'admin_notices', array( $this, 'display_promo_banners' ) );

			// Handle AJAX requests.
			add_action( 'wp_ajax_save_promo_banners_data', array( $this, 'save_promo_banners_data' ) );
			add_action( 'wp_ajax_dismiss_promo_banner', array( $this, 'dismiss_promo_banner' ) );

			// Enqueue CSS and JavaScript to fetch banners data and handle dismiss actions.
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}

		/**
		 * Gets the singleton instance of the class.
		 *
		 * @return CSCO_Promo_Banner The singleton instance.
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new CSCO_Promo_Banner();
			}
			return self::$instance;
		}

		/**
		 * Handles the AJAX request to save the banners data fetched via JavaScript.
		 *
		 * @return void
		 */
		public function save_promo_banners_data() {
			check_ajax_referer( 'csco_promo_banners_nonce', 'nonce' );

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error( 'Unauthorized' );
			}

			if ( ! isset( $_POST['banners_data'] ) ) {
				wp_send_json_error( 'No data received' );
			}

			// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Input is sanitized in sanitize_json_input().
			$raw_data = wp_unslash( $_POST['banners_data'] );

			$data = $this->sanitize_json_input( $raw_data );

			if ( is_wp_error( $data ) ) {
				wp_send_json_error( 'Invalid JSON data: ' . $data->get_error_message() );
			}

			// Save data and timestamp.
			update_option( $this->option_name, wp_json_encode( $data ) );
			update_option( $this->option_timestamp, time() );

			wp_send_json_success( 'Data saved' );
		}

		/**
		 * Sanitizes JSON input by decoding and recursively sanitizing each value.
		 *
		 * @param string $json_string The raw JSON string input.
		 * @return array|WP_Error     Returns sanitized data array or WP_Error on failure.
		 */
		private function sanitize_json_input( $json_string ) {
			// Decode the JSON string.
			$data = json_decode( $json_string, true );

			if ( json_last_error() !== JSON_ERROR_NONE ) {
				return new WP_Error( 'json_decode_error', json_last_error_msg() );
			}

			// Recursively sanitize the data.
			$sanitized_data = $this->recursive_sanitize_text_field( $data );

			return $sanitized_data;
		}

		/**
		 * Recursively sanitizes an array or scalar value.
		 *
		 * @param mixed $value The value to sanitize.
		 * @return mixed       Sanitized value.
		 */
		private function recursive_sanitize_text_field( $value ) {
			$allowed_tags = wp_kses_allowed_html( 'post' );

			$allowed_tags['style'] = array(
				'type' => true,
			);

			if ( is_array( $value ) ) {
				foreach ( $value as $key => $sub_value ) {
					$value[ $key ] = $this->recursive_sanitize_text_field( $sub_value );
				}
			} elseif ( is_string( $value ) ) {
				$value = wp_kses( $value, $allowed_tags );
			}

			return $value;
		}

		/**
		 * Displays the promo banners in the admin notices area.
		 *
		 * @return void
		 */
		public function display_promo_banners() {
			$data = get_option( $this->option_name );
			if ( $data ) {
				$banners = json_decode( $data, true );
				if ( $banners && isset( $banners['banners'] ) ) {
					$current_screen = get_current_screen();
					$current_page   = $current_screen ? $current_screen->id : '';

					// Get current theme or parent theme if child theme is active.
					$theme = wp_get_theme();
					if ( is_child_theme() ) {
						$theme = $theme->parent();
					}
					$current_theme_textdomain = $theme->get( 'TextDomain' );

					foreach ( $banners['banners'] as $banner ) {
						$this->display_banner_if_applicable( $banner, $current_page, $current_theme_textdomain );
					}
				}
			}
		}

		/**
		 * Checks if the banner should be displayed and displays it if applicable.
		 *
		 * @param array  $banner                   The banner data.
		 * @param string $current_page             The current admin page ID.
		 * @param string $current_theme_textdomain The current theme's TextDomain.
		 *
		 * @return void
		 */
		private function display_banner_if_applicable( $banner, $current_page, $current_theme_textdomain ) {
			$utc = new DateTime( 'now', new DateTimeZone( 'UTC' ) );
			$now = $utc->getTimestamp();

			$display_banner = true;

			// Check date and time.
			if ( isset( $banner['startDate'] ) && isset( $banner['endDate'] ) ) {
				$date_formats = array( 'Y-m-d H:i', 'Y-m-d' );

				$start_date = false;
				$end_date   = false;

				foreach ( $date_formats as $format ) {
					if ( ! $start_date ) {
						$start_date = DateTime::createFromFormat( $format, $banner['startDate'], new DateTimeZone( 'UTC' ) );
						if ( $start_date && 'Y-m-d' === $format ) {
							$start_date->setTime( 0, 0, 0 );
						}
					}
					if ( ! $end_date ) {
						$end_date = DateTime::createFromFormat( $format, $banner['endDate'], new DateTimeZone( 'UTC' ) );
						if ( $end_date && 'Y-m-d' === $format ) {
							$end_date->setTime( 23, 59, 59 );
						}
					}
				}

				if ( $start_date && $end_date ) {
					$start_timestamp = $start_date->getTimestamp();
					$end_timestamp   = $end_date->getTimestamp();

					if ( $now < $start_timestamp || $now > $end_timestamp ) {
						$display_banner = false;
					}
				} else {
					// Invalid date format, skip the banner.
					$display_banner = false;
				}
			}

			// Check pages.
			if ( $display_banner && isset( $banner['pages'] ) && is_array( $banner['pages'] ) && ! empty( $banner['pages'] ) ) {
				if ( ! in_array( '*', $banner['pages'], true ) && ! in_array( $current_page, $banner['pages'], true ) ) {
					$display_banner = false;
				}
			}

			// Check themes (TextDomain).
			if ( $display_banner && isset( $banner['themes'] ) && is_array( $banner['themes'] ) && ! empty( $banner['themes'] ) ) {
				if ( ! in_array( '*', $banner['themes'], true ) && ! in_array( $current_theme_textdomain, $banner['themes'], true ) ) {
					$display_banner = false;
				}
			}

			// Check if the user has dismissed this banner.
			$user_id      = get_current_user_id();
			$dismiss_key  = $this->dismiss_transient_prefix . $banner['id'] . '_' . $user_id;
			$is_dismissed = get_transient( $dismiss_key );

			if ( $is_dismissed ) {
				$display_banner = false;
			}

			// Display the banner.
			if ( $display_banner ) {
				$this->display_banner( $banner );
			}
		}

		/**
		 * Outputs the banner as a WordPress admin notice.
		 *
		 * @param array $banner The banner data.
		 *
		 * @return void
		 */
		private function display_banner( $banner ) {

			$class = 'cs-promo-banner notice';

			if ( isset( $banner['type'] ) ) {
				switch ( $banner['type'] ) {
					case 'blank':
						$class .= ' notice-blank';
						break;
					case 'error':
						$class .= ' notice-error';
						break;
					case 'warning':
						$class .= ' notice-warning';
						break;
					case 'success':
						$class .= ' notice-success';
						break;
					case 'info':
					default:
						$class .= ' notice-info';
						break;
				}
			} else {
				$class .= ' notice-info';
			}

			// Check if banner is dismissible.
			$is_dismissible = isset( $banner['dismissible'] ) ? $banner['dismissible'] : true;
			if ( $is_dismissible ) {
				$class .= ' is-dismissible';
			}

			// Allowed tags.
			$allowed_tags = wp_kses_allowed_html( 'post' );

			$allowed_tags['style'] = array(
				'type' => true,
			);

			// Output the notice.
			?>
			<div class="<?php echo esc_attr( $class ); ?>" data-banner-id="<?php echo esc_attr( $banner['id'] ); ?>">
				<?php
				if ( isset( $banner['html'] ) ) {

					echo wp_kses( $banner['html'], $allowed_tags );

				} elseif ( isset( $banner['text'] ) ) {
					?>
					<p><?php echo wp_kses( $banner['text'], $allowed_tags ); ?></p>
					<?php
				}
				?>
			</div>
			<?php
		}

		/**
		 * Handles the AJAX request to dismiss a promo banner.
		 *
		 * @return void
		 */
		public function dismiss_promo_banner() {
			check_ajax_referer( 'csco_promo_banners_nonce', 'nonce' );

			if ( ! current_user_can( 'edit_posts' ) ) {
				wp_send_json_error();
			}

			$banner_id = isset( $_POST['banner_id'] ) ? sanitize_text_field( wp_unslash( $_POST['banner_id'] ) ) : '';

			if ( ! $banner_id ) {
				wp_send_json_error( 'Invalid banner ID' );
			}

			$user_id     = get_current_user_id();
			$dismiss_key = $this->dismiss_transient_prefix . $banner_id . '_' . $user_id;

			// Set transient to indicate that the banner has been dismissed.
			set_transient( $dismiss_key, true, $this->dismiss_expiration );

			wp_send_json_success();
		}

		/**
		 * Enqueue CSS and JavaScript to fetch banners data and handle dismiss actions.
		 *
		 * @return void
		 */
		public function admin_enqueue_scripts() {
			wp_enqueue_script( 'csco-promo-banner', get_theme_file_uri( '/core/promo-banner/assets/promo-banner.js' ), array( 'jquery' ), filemtime( get_theme_file_path( '/core/promo-banner/assets/promo-banner.js' ) ), true );

			wp_localize_script(
				'csco-promo-banner',
				'cscoPromoBannerConfig',
				array(
					'data_timestamp'  => (int) get_option( $this->option_timestamp, 0 ),
					'json_url'        => esc_url_raw( $this->json_url ),
					'ajax_url'        => esc_url_raw( admin_url( 'admin-ajax.php' ) ),
					'nonce'           => wp_create_nonce( 'csco_promo_banners_nonce' ),
					'update_interval' => intval( $this->update_interval_hours ) * 3600,
				)
			);

			// Styles.
			wp_enqueue_style( 'csco-promo-banner', get_theme_file_uri( '/core/promo-banner/assets/promo-banner.min.css' ), array(), filemtime( get_theme_file_path( '/core/promo-banner/assets/promo-banner.min.css' ) ) );
		}
	}

	// Initialize the class.
	CSCO_Promo_Banner::get_instance();
}
