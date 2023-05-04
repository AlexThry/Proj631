<?php

const DB_USERNAME = 'root';
const DB_PASSWORD = '';

global $conn;

/**
 * Connect to DB.
 *
 * @return void
 */
function connect_db(): void {
	global $conn;

	$conn = new mysqli( 'localhost', DB_USERNAME, DB_PASSWORD );

	if ( ! $conn ) {
		echo 'Erreur de connexion : ' . mysqli_connect_error();
	}

	mysqli_query( $conn, 'USE Proj631' );
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
 * Start debugger.
 *
 * @return void
 */
function start_debugger(): void {
	ini_set( 'display_errors', '1' );
	ini_set( 'display_startup_errors', '1' );
	error_reporting( E_ALL );
}

/**
 * Comute connection.
 *
 * @param string $username Username.
 * @param string $password Password.
 * @return void
 */
function compute_connection( $username, $password ): void {
	// add your code here ...
}

/**
 * Compute subscription.
 *
 * @param string $username Username.
 * @param string $password Password.
 * @param string $confirm_password Confirm password.
 *
 * @return void
 */
function compute_subscription( $username, $password, $confirm_password ): void {
	global $conn;

	if ( $password === $confirm_password ) {
		$date = date( 'Y-m-d' );
		$sql  = "INSERT INTO user (user_name, password, creation_date) VALUES ('" . $username . "','" . $password . "','" . $date . "')";

		if ( mysqli_query( $conn, $sql ) ) {
			echo "<span class='success'>Vous avez créé votre compte.</span>";
		} else {
			echo "<span class='error'>Erreur lors de l'inscription.</span>";
		}
	} else {
		echo "<span class='error'>Les mots de passe ne correspondent pas.</span>";
	}
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
 * Get url basename.
 *
 * Example: http://localhost:8888/Proj631/inscription.php returns inscription
 *
 * @return string
 */
function get_url_basename(): string {
	$file_name = basename( get_url() ); // get the file name with extension
	$extension = pathinfo( $file_name, PATHINFO_EXTENSION ); // get the file extension
	return str_replace( '.' . $extension, '', $file_name ); // remove the extension to get the inscription part
}

/**
 * Main function.
 *
 * @return void
 */
function main(): void {
	start_debugger();
	connect_db();
}

main();
