<?php
/**
 * Manager Import.
 *
 * @package Revision
 */

/**
 * Manager Import Class
 */
class CSCO_Manager_Import {

	/**
	 * Singleton instance
	 *
	 * @var CSCO_Manager_Import
	 */
	private static $instance;

	/**
	 * Sites Server API URL
	 *
	 * @var string
	 */
	public $api_url;

	/**
	 * Get singleton instance.
	 *
	 * @return CSCO_Manager_Import
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Time in milliseconds, marking the beginning of the import.
	 *
	 * @var float
	 */
	private $microtime;

	/**
	 * Class constructor
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'init' ) );
	}

	/**
	 * Initialize plugin.
	 */
	public function init() {
		add_action( 'upload_mimes', array( $this, 'add_custom_mimes' ) );
		add_filter( 'wp_check_filetype_and_ext', array( $this, 'real_mime_type_for_xml' ), 10, 4 );
		add_filter( 'admin_init', array( $this, 'ajax_runtime_hide_errors' ), 0 );
		add_filter( 'query', array( $this, 'ajax_wpdb_hide_errors' ), 0 );
		add_action( 'wp_ajax_csco_import_plugin', array( $this, 'ajax_import_plugin' ) );
		add_action( 'wp_ajax_csco_import_contents', array( $this, 'ajax_import_contents' ) );
		add_action( 'wp_ajax_csco_import_customizer', array( $this, 'ajax_import_customizer' ) );
		add_action( 'wp_ajax_csco_import_widgets', array( $this, 'ajax_import_widgets' ) );
		add_action( 'wp_ajax_csco_import_options', array( $this, 'ajax_import_options' ) );
		add_action( 'wp_ajax_csco_import_finish', array( $this, 'ajax_import_finish' ) );
	}

	/**
	 * Pre Plugin Setup
	 */
	public function pre_plugin_setup() {
		/* Woocommerce */
		add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_false' );
		add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );

		/* Elementor */
		set_transient( 'elementor_activation_redirect', false );
	}

	/**
	 * Helper function: Import image.
	 *
	 * @param string $url    Image url.
	 * @param bool   $retina Support retina.
	 * @return array The import data.
	 */
	public static function import_custom_image( $url, $retina = true ) {

		$data = self::sideload_image( $url );

		if ( $retina ) {
			// Upload @2x image.
			self::sideload_image(
				str_replace( array( '.jpg', '.jpeg', '.png', '.gif', '.webp' ),
					array( '@2x.jpg', '@2x.jpeg', '@2x.png', '@2x.gif', '@2x.webp' ),
					$url
				)
			);
		}

		if ( ! is_wp_error( $data ) ) {
			return $data;
		}
	}

	/**
	 * Taken from the core media_sideload_image function and
	 * modified to return an array of data instead of html.
	 *
	 * @param string $file The image file path.
	 * @return array An array of image data.
	 */
	public static function sideload_image( $file ) {
		$data = new stdClass();

		if ( ! function_exists( 'media_handle_sideload' ) ) {
			call_user_func( 'require_once', ABSPATH . 'wp-admin/includes/media.php' );
			call_user_func( 'require_once', ABSPATH . 'wp-admin/includes/file.php' );
			call_user_func( 'require_once', ABSPATH . 'wp-admin/includes/image.php' );
		}

		if ( ! empty( $file ) ) {
			// Set variables for storage, fix file filename for query strings.
			preg_match( '/[^\?]+\.(jpe?g|jpe|gif|png|webp)\b/i', $file, $matches );

			$file_array = array();

			$file_array['name'] = basename( $matches[0] );

			// Download file to temp location.
			$file_array['tmp_name'] = download_url( $file );

			// If error storing temporarily, return the error.
			if ( is_wp_error( $file_array['tmp_name'] ) ) {
				return $file_array['tmp_name'];
			}

			// Do the validation and storage stuff.
			$id = media_handle_sideload( $file_array, 0 );

			// If error storing permanently, unlink.
			if ( is_wp_error( $id ) ) {
				unlink( $file_array['tmp_name'] );
				return $id;
			}

			// Build the object to return.
			$meta                = wp_get_attachment_metadata( $id );
			$data->attachment_id = $id;
			$data->url           = wp_get_attachment_url( $id );
			$data->thumbnail_url = wp_get_attachment_thumb_url( $id );
			$data->height        = $meta['height'];
			$data->width         = $meta['width'];
		}

		return $data;
	}

	/**
	 * Checks to see whether a string is an image url or not.
	 *
	 * @param string $string The string to check.
	 * @return bool Whether the string is an image url or not.
	 */
	public static function is_image_url( $string = '' ) {
		if ( is_string( $string ) ) {
			if ( preg_match( '/\.(jpg|jpeg|png|gif|webp)/i', $string ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Add custom mimes for the uploader.
	 *
	 * @param array $mimes The mimes.
	 */
	public function add_custom_mimes( $mimes ) {
		// Allow XML files.
		$mimes['xml'] = 'text/xml';

		// Allow JSON files.
		$mimes['json'] = 'application/json';

		return $mimes;
	}

	/**
	 * Filters the "real" file type of the given file.
	 *
	 * @param array  $wp_check_filetype_and_ext The wp_check_filetype_and_ext.
	 * @param string $file                      The file.
	 * @param string $filename                  The filename.
	 * @param array  $mimes                     The mimes.
	 */
	public function real_mime_type_for_xml( $wp_check_filetype_and_ext, $file, $filename, $mimes ) {
		if ( '.xml' === substr( $filename, -4 ) ) {
			$wp_check_filetype_and_ext['ext']  = 'xml';
			$wp_check_filetype_and_ext['type'] = 'text/xml';
		}

		return $wp_check_filetype_and_ext;
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
	 * Install a plugin.
	 *
	 * @param string $plugin_slug Plugin slug.
	 */
	public function install_plugin( $plugin_slug ) {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		if ( ! function_exists( 'plugins_api' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
		}
		if ( ! class_exists( 'WP_Upgrader' ) ) {
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		}

		if ( false === filter_var( $plugin_slug, FILTER_VALIDATE_URL ) ) {
			$api = plugins_api(
				'plugin_information',
				array(
					'slug'   => $plugin_slug,
					'fields' => array(
						'short_description' => false,
						'sections'          => false,
						'requires'          => false,
						'rating'            => false,
						'ratings'           => false,
						'downloaded'        => false,
						'last_updated'      => false,
						'added'             => false,
						'tags'              => false,
						'compatibility'     => false,
						'homepage'          => false,
						'donate_link'       => false,
					),
				)
			);

			$download_link = $api->download_link;
		} else {
			$download_link = $plugin_slug;
		}

		// Use AJAX upgrader skin instead of plugin installer skin.
		// ref: function wp_ajax_install_plugin().
		$upgrader = new Plugin_Upgrader( new WP_Ajax_Upgrader_Skin() );

		$this->pre_plugin_setup();

		$install = $upgrader->install( $download_link );

		if ( false === $install ) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Activate a plugin.
	 *
	 * @param string $plugin_path Plugin path.
	 */
	public function activate_plugin( $plugin_path ) {

		if ( ! current_user_can( 'install_plugins' ) ) {
			return false;
		}

		$this->pre_plugin_setup();

		$activate = activate_plugin( $plugin_path, '', false, true );

		if ( is_wp_error( $activate ) ) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Detect ajax import.
	 */
	public function is_ajax_import() {
		if ( __return_false() ) {
			check_ajax_referer();
		}

		$current_action = __return_empty_string();

		if ( isset( $_REQUEST['action'] ) ) {
			$current_action = sanitize_text_field( $_REQUEST['action'] );
		}

		if ( preg_match( '/csco_import/', $current_action ) ) {
			return $current_action;
		}
	}

	/**
	 * Hide errors for wpdb
	 *
	 * @param object $query The query.
	 */
	public function ajax_wpdb_hide_errors( $query ) {
		global $wpdb;

		if ( $this->is_ajax_import() ) {
			$wpdb->hide_errors();
		}

		return $query;
	}

	/**
	 * Hide errors for runtime
	 */
	public function ajax_runtime_hide_errors() {
		call_user_func( 'ini_set', 'display_errors', 'Off' );
	}

	/**
	 * Ajax import start
	 */
	public function ajax_import_start() {
		ob_start();
	}

	/**
	 * Ajax import end
	 */
	public function ajax_import_end() {
		ob_end_flush();
	}

	/**
	 * Sends a JSON response back to an Ajax request, indicating failure.
	 *
	 * @param mixed $data Data to encode as JSON, then print and die.
	 */
	public function send_json_error( $data = null ) {
		$log = trim( ob_get_clean() );

		if ( $log ) {
			$data .= sprintf( '%s', PHP_EOL . $log );
		}

		wp_send_json_error( $data );
	}

	/**
	 * Sends a JSON response back to an Ajax request, indicating success.
	 *
	 * @param mixed $data Data to encode as JSON, then print and die.
	 */
	public function send_json_success( $data = null ) {
		$log = trim( ob_get_clean() );

		if ( $log ) {
			$data .= sprintf( '%s', PHP_EOL . $log );
		}

		wp_send_json_success( $data );
	}

	/**
	 * AJAX callback to install and activate a plugin.
	 */
	public function ajax_import_plugin() {

		set_time_limit( 0 );

		$this->ajax_import_start();

		check_ajax_referer( 'nonce', 'nonce' );

		if ( ! isset( $_POST['plugin_slug'] ) || ! sanitize_text_field( $_POST['plugin_slug'] ) ) {
			$this->send_json_error( esc_html__( 'Unknown slug in a plugin.', 'revision' ) );
		}

		if ( ! isset( $_POST['plugin_path'] ) || ! sanitize_text_field( $_POST['plugin_path'] ) ) {
			$this->send_json_error( esc_html__( 'Unknown path in a plugin.', 'revision' ) );
		}

		$plugin_slug = sanitize_text_field( $_POST['plugin_slug'] );
		$plugin_path = sanitize_text_field( $_POST['plugin_path'] );

		if ( ! current_user_can( 'install_plugins' ) ) {
			$this->send_json_error( esc_html__( 'Insufficient permissions to install the plugin.', 'revision' ) );
		}

		if ( 'not_installed' === $this->get_plugin_status( $plugin_path ) ) {

			$this->install_plugin( $plugin_slug );

			$this->activate_plugin( $plugin_path );

		} elseif ( 'inactive' === $this->get_plugin_status( $plugin_path ) ) {

			$this->activate_plugin( $plugin_path );
		}

		if ( 'active' === $this->get_plugin_status( $plugin_path ) ) {
			$this->send_json_success();
		}

		/**
		 * The csco_import_plugin hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_import_plugin', $plugin_slug, $plugin_path );

		$this->send_json_error( esc_html__( 'Failed to initialize or activate importer plugin.', 'revision' ) );

		$this->ajax_import_end();
	}

	/**
	 * AJAX callback to import contents and media files from contents.xml.
	 */
	public function ajax_import_contents() {

		$this->ajax_import_start();

		check_ajax_referer( 'nonce', 'nonce' );

		$import_type = 'default';

		if ( ! isset( $_POST['url'] ) || ! sanitize_text_field( $_POST['url'] ) ) {
			$this->send_json_error( esc_html__( 'The url address of the demo content is not specified.', 'revision' ) );
		}

		if ( isset( $_POST['type'] ) && sanitize_text_field( $_POST['type'] ) ) {
			$import_type = sanitize_text_field( $_POST['type'] );
		}

		$file_url = sanitize_text_field( $_POST['url'] );

		$xml_file_hash_id = 'csco_importer_data_' . md5( $file_url );

		$xml_file_path = get_transient( $xml_file_hash_id );

		if ( ! $xml_file_path ) {

			if ( ! current_user_can( 'edit_theme_options' ) ) {
				$this->send_json_error( esc_html__( 'You are not permitted to import contents.', 'revision' ) );
			}

			if ( ! isset( $file_url ) ) {
				$this->send_json_error( esc_html__( 'No XML file specified.', 'revision' ) );
			}

			/**
			 * Download contents.xml
			 */
			if ( ! function_exists( 'download_url' ) ) {
				require_once ABSPATH . 'wp-admin/includes/file.php';
			}

			$url             = wp_unslash( $file_url );
			$timeout_seconds = 5;

			add_filter( 'https_ssl_verify', '__return_false' );

			// Download file to temp dir.
			$temp_file = download_url( $url, $timeout_seconds );

			add_filter( 'https_local_ssl_verify', '__return_false' );

			if ( is_wp_error( $temp_file ) ) {
				$this->send_json_error( $temp_file->get_error_message() );
			}

			// Array based on $_FILE as seen in PHP file uploads.
			$file_args = array(
				'name'     => basename( $url ),
				'tmp_name' => $temp_file,
				'error'    => 0,
				'size'     => filesize( $temp_file ),
			);

			$overrides = array(
				// This tells WordPress to not look for the POST form
				// fields that would normally be present. Default is true.
				// Since the file is being downloaded from a remote server,
				// there will be no form fields.
				'test_form'   => false,

				// Setting this to false lets WordPress allow empty files – not recommended.
				'test_size'   => true,

				// A properly uploaded file will pass this test.
				// There should be no reason to override this one.
				'test_upload' => true,

				'mimes'       => array(
					'xml' => 'text/xml',
				),
			);

			// Move the temporary file into the uploads directory.
			$download_response = wp_handle_sideload( $file_args, $overrides );

			// Error when downloading XML file.
			if ( isset( $download_response['error'] ) ) {
				$this->send_json_error( $download_response['error'] );
			}

			// Define the downloaded contents.xml file path.
			$xml_file_path = $download_response['file'];

			set_transient( $xml_file_hash_id, $xml_file_path, HOUR_IN_SECONDS );
		}

		/**
		 * Import content and media files using WXR Importer.
		 */
		if ( ! class_exists( 'WP_Importer' ) ) {
			if ( ! defined( 'WP_LOAD_IMPORTERS' ) ) {
				define( 'WP_LOAD_IMPORTERS', true );
			}

			require_once ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		}

		/**
		 * Import Core.
		 */
		require_once get_theme_file_path( '/core/theme-demos/import/wp-content-importer-v2/WPImporterLogger.php' );
		require_once get_theme_file_path( '/core/theme-demos/import/wp-content-importer-v2/WPImporterLoggerCLI.php' );
		require_once get_theme_file_path( '/core/theme-demos/import/wp-content-importer-v2/WXRImportInfo.php' );
		require_once get_theme_file_path( '/core/theme-demos/import/wp-content-importer-v2/WXRImporter.php' );
		require_once get_theme_file_path( '/core/theme-demos/import/wp-content-importer-v2/Logger.php' );

		/**
		 * Prepare the importer.
		 */

		// Time to run the import!
		set_time_limit( 0 );

		$this->microtime = microtime( true );

		// Are we allowed to create users?
		add_filter( 'wxr_importer.pre_process.user', '__return_null' );

		// Check, if we need to send another AJAX request and set the importing author to the current user.
		add_filter( 'wxr_importer.pre_process.post', array( $this, 'ajax_request_maybe' ) );

		// Set the WordPress Importer v2 as the importer used in this plugin.
		// More: https://github.com/humanmade/WordPress-Importer.
		$importer = new CSCO_WXRImporter( array(
			'fetch_attachments' => true,
			'default_author'    => get_current_user_id(),
		) );

		/**
		 * Logger options for the logger used in the importer.
		 *
		 * The csco_logger_options hook.
		 *
		 * @since 1.0.0
		 */
		$logger_options = apply_filters( 'csco_logger_options', array(
			'logger_min_level' => 'warning',
		) );

		// Configure logger instance and set it to the importer.
		$logger            = new CSCO_Logger();
		$logger->min_level = $logger_options['logger_min_level'];

		// Set logger.
		$importer->set_logger( $logger );

		/**
		 * Process import.
		 */
		$importer->import( $xml_file_path );

		// Is error ?.
		if ( is_wp_error( $importer ) ) {
			$this->send_json_error( $importer->get_error_message() );
		}

		if ( $logger->error_output ) {
			$this->send_json_error( $logger->error_output );
		}

		/**
		 * The csco_import_contents hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_import_contents' );

		/**
		 * Return successful AJAX.
		 */
		$this->send_json_success();

		$this->ajax_import_end();
	}

	/**
	 * Check if we need to create a new AJAX request, so that server does not timeout.
	 *
	 * @param array $data current post data.
	 * @return array
	 */
	public function ajax_request_maybe( $data ) {

		$time = microtime( true ) - $this->microtime;

		/**
		 * We should make a new ajax call, if the time is right.
		 *
		 * The csco_time_for_one_ajax_call hook.
		 *
		 * @since 1.0.0
		 */
		if ( $time > apply_filters( 'csco_time_for_one_ajax_call', 22 ) ) {
			$response = array(
				'success' => true,
				'status'  => 'newAJAX',
				'message' => 'Time for new AJAX request!: ' . $time,
			);

			// Send the request for a new AJAX call.
			wp_send_json( $response );
		}

		// Set importing author to the current user.
		// Fixes the [WARNING] Could not find the author for ... log warning messages.
		$current_user_obj = wp_get_current_user();

		$data['post_author'] = $current_user_obj->user_login;

		return $data;
	}

	/**
	 * AJAX callback to import customizer settings from customizer.json.
	 */
	public function ajax_import_customizer() {

		set_time_limit( 0 );

		$this->ajax_import_start();

		check_ajax_referer( 'nonce', 'nonce' );

		if ( ! isset( $_POST['url'] ) || ! sanitize_text_field( $_POST['url'] ) ) {
			$this->send_json_error( esc_html__( 'The url address of the demo content is not specified.', 'revision' ) );
		}

		$file_url = sanitize_text_field( $_POST['url'] );

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			$this->send_json_error( esc_html__( 'You are not permitted to import customizer.', 'revision' ) );
		}

		if ( ! isset( $file_url ) ) {
			$this->send_json_error( esc_html__( 'No customizer JSON file specified.', 'revision' ) );
		}

		/**
		 * Process customizer.json.
		 */

		// Get JSON data from customizer.json.
		$raw = wp_remote_get( wp_unslash( $file_url ), array(
			'sslverify' => false,
		) );

		// Abort if customizer.json response code is not successful.
		if ( 200 !== wp_remote_retrieve_response_code( $raw ) ) {
			$this->send_json_error();
		}

		// Decode raw JSON string to associative array.
		$data = json_decode( wp_remote_retrieve_body( $raw ), true );

		$customizer = new CSCO_Customizer_Importer();

		// Import.
		$results = $customizer->import( $data );

		if ( is_wp_error( $results ) ) {
			$error_message = $results->get_error_message();

			$this->send_json_error( $error_message );
		}

		/**
		 * The csco_import_customizer hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_import_customizer', $data );

		/**
		 * Return successful AJAX.
		 */

		$this->send_json_success();

		$this->ajax_import_end();
	}

	/**
	 * AJAX callback to import widgets on all sidebars from widgets.json.
	 */
	public function ajax_import_widgets() {

		set_time_limit( 0 );

		$this->ajax_import_start();

		check_ajax_referer( 'nonce', 'nonce' );

		if ( ! isset( $_POST['url'] ) || ! sanitize_text_field( $_POST['url'] ) ) {
			$this->send_json_error( esc_html__( 'The url address of the demo content is not specified.', 'revision' ) );
		}

		$file_url = sanitize_text_field( $_POST['url'] );

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			$this->send_json_error( esc_html__( 'You are not permitted to import widgets.', 'revision' ) );
		}

		if ( ! isset( $file_url ) ) {
			$this->send_json_error( esc_html__( 'No widgets WIE file specified.', 'revision' ) );
		}

		/**
		 * Process widgets.json.
		 */

		// Get JSON data from widgets.json.
		$raw = wp_remote_get( wp_unslash( $file_url ), array(
			'sslverify' => false,
		) );

		// Abort if customizer.json response code is not successful.
		if ( 200 !== (int) wp_remote_retrieve_response_code( $raw ) ) {
			$this->send_json_error();
		}

		// Decode raw JSON string to associative array.
		$data = json_decode( wp_remote_retrieve_body( $raw ) );

		$widgets = new CSCO_Widget_Importer();

		// Import.
		$results = $widgets->import( $data );

		if ( is_wp_error( $results ) ) {
			$error_message = $results->get_error_message();

			$this->send_json_error( $error_message );
		}

		/**
		 * The csco_import_widgets hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_import_widgets' );

		/**
		 * Return successful AJAX.
		 */
		$this->send_json_success();

		$this->ajax_import_end();
	}

	/**
	 * AJAX callback to import other options from options.json.
	 */
	public function ajax_import_options() {

		set_time_limit( 0 );

		$this->ajax_import_start();

		check_ajax_referer( 'nonce', 'nonce' );

		if ( ! isset( $_POST['url'] ) || ! sanitize_text_field( $_POST['url'] ) ) {
			$this->send_json_error( esc_html__( 'The url address of the demo content is not specified.', 'revision' ) );
		}

		$file_url = sanitize_text_field( $_POST['url'] );

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			$this->send_json_error( esc_html__( 'You are not permitted to import options.', 'revision' ) );
		}

		if ( ! isset( $file_url ) ) {
			$this->send_json_error( esc_html__( 'No options JSON file specified.', 'revision' ) );
		}

		/**
		 * Process options.json.
		 */

		// Get JSON data from options.json.
		$raw = wp_remote_get( wp_unslash( $file_url ), array(
			'sslverify' => false,
		) );

		// Abort if customizer.json response code is not successful.
		if ( 200 !== (int) wp_remote_retrieve_response_code( $raw ) ) {
			$this->send_json_error();
		}

		// Decode raw JSON string to associative array.
		$array = json_decode( wp_remote_retrieve_body( $raw ), true );

		/**
		 * Import options to DB.
		 */
		foreach ( $array as $key => $value ) {
			// Skip option key with "__" prefix, because it will be treated specifically via the action hook.
			if ( '__' === substr( $key, 0, 2 ) ) {
				continue;
			}

			// Insert to options table.
			update_option( $key, $value );
		}

		/**
		 * The csco_import_options hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_import_options', $array );

		/**
		 * Return successful AJAX.
		 */
		$this->send_json_success();

		$this->ajax_import_end();
	}

	/**
	 * AJAX callback to finish import.
	 */
	public function ajax_import_finish() {

		set_time_limit( 0 );

		$this->ajax_import_start();

		/**
		 * The csco_finish_import hook.
		 *
		 * @since 1.0.0
		 */
		do_action( 'csco_finish_import' );

		/**
		 * Return successful AJAX.
		 */
		$this->send_json_success();

		$this->ajax_import_end();
	}
}

new CSCO_Manager_Import();
