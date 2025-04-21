<?php
/**
 * Helper methods
 *
 * @package Revision
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * A simple object containing static methods.
 */
class CSCO_Customizer_Helper {
	/**
	 * Get the value of a field.
	 *
	 * @param string $field_id The field ID.
	 */
	public static function get_value( $field_id = '' ) {

		// Make sure value is defined.
		$value = __return_empty_string();

		// We're using theme_mods so just get the value using get_theme_mod.
		$default_value = __return_null();

		if ( isset( CSCO_Customizer::$fields[ $field_id ] ) && isset( CSCO_Customizer::$fields[ $field_id ]['default'] ) ) {
			$default_value = CSCO_Customizer::$fields[ $field_id ]['default'];
		}

		$value = get_theme_mod( $field_id, $default_value );

		/**
		 * The csco_customizer_values_get_value hook.
		 *
		 * @since 1.0.0
		 */
		return apply_filters( 'csco_customizer_values_get_value', $value, $field_id );
	}

	/**
	 * Compares the 2 values given the condition
	 *
	 * @param mixed  $value1   The 1st value in the comparison.
	 * @param mixed  $value2   The 2nd value in the comparison.
	 * @param string $operator The operator we'll use for the comparison.
	 * @return boolean whether The comparison has succeded (true) or failed (false).
	 */
	public static function compare_values( $value1, $value2, $operator ) {
		if ( '===' === $operator ) {
			return $value1 === $value2;
		}
		if ( '!==' === $operator ) {
			return $value1 !== $value2;
		}
		if ( ( '!=' === $operator || 'not equal' === $operator ) ) {
			return $value1 != $value2; // phpcs:ignore WordPress.PHP.StrictComparisons
		}
		if ( ( '>=' === $operator || 'greater or equal' === $operator || 'equal or greater' === $operator ) ) {
			return $value2 >= $value1;
		}
		if ( ( '<=' === $operator || 'smaller or equal' === $operator || 'equal or smaller' === $operator ) ) {
			return $value2 <= $value1;
		}
		if ( ( '>' === $operator || 'greater' === $operator ) ) {
			return $value2 > $value1;
		}
		if ( ( '<' === $operator || 'smaller' === $operator ) ) {
			return $value2 < $value1;
		}
		if ( 'contains' === $operator || 'in' === $operator ) {
			if ( is_array( $value1 ) && is_array( $value2 ) ) {
				foreach ( $value2 as $val ) {
					if ( in_array( $val, $value1 ) ) { // phpcs:ignore WordPress.PHP.StrictInArray
						return true;
					}
				}
				return false;
			}
			if ( is_array( $value1 ) && ! is_array( $value2 ) ) {
				return in_array( $value2, $value1 ); // phpcs:ignore WordPress.PHP.StrictInArray
			}
			if ( is_array( $value2 ) && ! is_array( $value1 ) ) {
				return in_array( $value1, $value2 ); // phpcs:ignore WordPress.PHP.StrictInArray
			}
			return ( false !== strrpos( $value1, $value2 ) || false !== strpos( $value2, $value1 ) );
		}
		return $value1 == $value2; // phpcs:ignore WordPress.PHP.StrictComparisons
	}

	/**
	 * Process the active_callback parameter.
	 *
	 * @param array $field The current field.
	 */
	public static function active_callback( $field ) {

		if ( isset( $field['active_callback'] ) && is_array( $field['active_callback'] ) ) {
			if ( ! is_callable( $field['active_callback'] ) ) {

				foreach ( $field['active_callback'] as $key => $val ) {
					if ( is_callable( $val ) ) {
						unset( $field['active_callback'][ $key ] );
					}
				}
				if ( isset( $field['active_callback'][0] ) ) {
					$field['required'] = $field['active_callback'];
				}
			}
		}

		// Only continue if field dependencies are met.
		if ( isset( $field['required'] ) && ! empty( $field['required'] ) ) {
			$valid = true;

			foreach ( $field['required'] as $requirement ) {
				if ( isset( $requirement['setting'] ) && isset( $requirement['value'] ) && isset( $requirement['operator'] ) ) {

					$controller_value = self::get_value( $requirement['setting'] );
					if ( ! self::compare_values( $controller_value, $requirement['value'], $requirement['operator'] ) ) {
						$valid = false;
					}
				}
			}
			if ( ! $valid ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Sanitizes typography controls
	 *
	 * @param array $value The value.
	 */
	public static function typography_sanitize( $value ) {
		if ( ! is_array( $value ) ) {
			return array();
		}

		foreach ( $value as $key => $val ) {
			switch ( $key ) {
				case 'font-family':
					$value['font-family'] = sanitize_text_field( $val );
					break;
				case 'font-weight':
					if ( isset( $value['variant'] ) ) {
						break;
					}
					$value['variant'] = $val;
					if ( isset( $value['font-style'] ) && 'italic' === $value['font-style'] ) {
						$value['variant'] = ( '400' !== $val || 400 !== $val ) ? $value['variant'] . 'italic' : 'italic';
					}
					break;
				case 'variant':
					// Use 'regular' instead of 400 for font-variant.
					$value['variant'] = ( 400 === $val || '400' === $val ) ? 'regular' : $val;

					// Get font-weight from variant.
					$value['font-weight'] = filter_var( $value['variant'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
					$value['font-weight'] = ( 'regular' === $value['variant'] || 'italic' === $value['variant'] ) ? 400 : absint( $value['font-weight'] );

					// Get font-style from variant.
					if ( ! isset( $value['font-style'] ) ) {
						$value['font-style'] = ( false === strpos( $value['variant'], 'italic' ) ) ? 'normal' : 'italic';
					}
					break;
				case 'font-size':
				case 'letter-spacing':
				case 'word-spacing':
				case 'line-height':
					$value[ $key ] = '' === trim( $value[ $key ] ) ? '' : sanitize_text_field( $val );
					break;
				case 'text-align':
					if ( ! in_array( $val, array( '', 'inherit', 'left', 'center', 'right', 'justify' ), true ) ) {
						$value['text-align'] = '';
					}
					break;
				case 'text-transform':
					if ( ! in_array( $val, array( '', 'none', 'capitalize', 'uppercase', 'lowercase', 'initial', 'inherit' ), true ) ) {
						$value['text-transform'] = '';
					}
					break;
				case 'text-decoration':
					if ( ! in_array( $val, array( '', 'none', 'underline', 'overline', 'line-through', 'initial', 'inherit' ), true ) ) {
						$value['text-transform'] = '';
					}
					break;
			}
		}

		return $value;
	}
}
