<?php
/**
 * Logger Class
 *
 * @package Revision
 */

/**
 * Logger Class
 */
class CSCO_Logger extends CSCO_WPImporterLoggerCLI {
	/**
	 * Variable for front-end error display.
	 *
	 * @var string
	 */
	public $error_output = '';

	/**
	 * Overwritten log function from CSCO_WP_Importer_Logger_CLI.
	 *
	 * Logs with an arbitrary level.
	 *
	 * @param mixed  $level level of reporting.
	 * @param string $message log message.
	 * @param array  $context context to the log message.
	 */
	public function log( $level, $message, array $context = array() ) {
		// Save error messages for front-end display.
		$this->error_output( $level, $message, $context = array() );

		if ( $this->level_to_numeric( $level ) < $this->level_to_numeric( $this->min_level ) ) {
			return;
		}
	}


	/**
	 * Save messages for error output.
	 * Only the messages greater then Error.
	 *
	 * @param mixed  $level level of reporting.
	 * @param string $message log message.
	 * @param array  $context context to the log message.
	 */
	public function error_output( $level, $message, array $context = array() ) {
		if ( $this->level_to_numeric( $level ) < $this->level_to_numeric( 'error' ) ) {
			return;
		}

		$this->error_output .= sprintf( '[%s] %s<br>', strtoupper( $level ), $message );
	}
}
