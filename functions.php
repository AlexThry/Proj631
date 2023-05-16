<?php

require_once 'classes/Answerable.php';

/**
 * Displays a value field for html inputs
 * Only if the input is in $_POST or $_GET
 */
function display_input_value( $input ): void {
	if ( isset( $_POST[ $input ] ) ) {
		echo "value='" . $_POST[ $input ] . "'";
	}
	if ( isset( $_GET[ $input ] ) ) {
		echo "value='" . $_GET[ $input ] . "'";
	}
}

/**
 * Generates a random string of a given length.
 *
 * @param integer $length Length of the string to generate.
 * @return string Random string.
 */
function generate_random_string( $length = 10 ) {
	return substr( str_shuffle( str_repeat( $x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil( $length / strlen( $x ) ) ) ), 1, $length );
}

/**
 * Remove falsy values from an array.
 *
 * @param array $array Array to filter.
 * @return array Filtered array.
 */
function remove_falsy_values( $array ): array {
	foreach ( $array as $key => $value ) {
		if ( ! $value ) {
			unset( $array[ $key ] );
		}
	}

	return $array;
}

/**
 * Get current url.
 *
 * @return string
 */
function get_url(): string {
	return "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}

/**
 * Get home url.
 *
 * @return string
 */
function get_home_url(): string {
	return basename( 'index.php' );
}

/**
 * Check if current page is home page.
 *
 * @return boolean
 */
function is_home_page(): bool {
	return get_url_basename() === 'Proj631';
}

/**
 * Get url basename.
 *
 * Example: http://localhost:8888/Proj631/inscription.php returns inscription
 *
 * @return string
 */
function get_url_basename(): string {
	$file_name = basename( get_url() ); // get the file name with extension.
	$extension = pathinfo( $file_name, PATHINFO_EXTENSION ); // get the file extension.
	return str_replace( '.' . $extension, '', $file_name ); // remove the extension to get the inscription part.
}

Answerable::start();
