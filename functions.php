<?php

require_once 'classes/Readable.php';

/**
 * Comute connection.
 *
 * @param string $username Username.
 * @param string $password Password.
 * @return void
 */
function compute_connection( $username, $password ): void {
	global $conn;
	
	// Validate inputs.
	$errors = array();
	if ( empty( $username ) ) {
		$errors[] = "Insérez votre nom d'utilisateur";
	}
	if ( empty( $password ) ) {
		$errors[] = 'Insérez votre mot de passe';
	}
	if ( ! empty( $errors ) ) {
		foreach ( $errors as $error_message ) {
			AlertManager::display_error( $error_message );
		}
		return;
	}

	// Protect from XSS attack.
	$query = sprintf(
		"SELECT * FROM user WHERE user_name='%s' LIMIT 1",
		$conn->real_escape_string( $username )
	);

	$result = $conn->query( $query );
	if ( ! $result ) {
		AlertManager::display_error( 'Erreur de connexion (' . mysql_error() . ')' );
		return;
	}

	$result = mysqli_fetch_assoc( $result );
	if ( ! $result ) {
		AlertManager::display_error( "Ce compte n'existe pas." );
		return;
	}

	$hash_password = md5( $password );
	if ( $result['password'] !== $hash_password ) {
		AlertManager::display_error( 'Mot de passe incorrect.' );
		return;
	}

	AlertManager::display_success( 'Authentifié avec succès.' );

	$_SESSION['current_user'] = new User( (int) $result['id'], $result['user_name'], $result['password'] );

	header( 'Location: account.php' );
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

	// Validate inputs.
	$errors = array();
	if ( empty( $username ) ) {
		$errors[] = "Insérez votre nom d'utilisateur";
	}
	if ( empty( $password ) ) {
		$errors[] = 'Insérez votre mot de passe';
	}
	if ( ! empty( $password ) && empty( $confirm_password ) ) {
		$errors[] = 'Confirmer votre mot de passe';
	}
	if ( ! empty( $errors ) ) {
		foreach ( $errors as $error_message ) {
			AlertManager::display_error( $error_message );
		}
		return;
	}

	if ( $password === $confirm_password ) {
		$date          = date( 'Y-m-d' );
		$hash_password = md5( $password );
		$sql           = "INSERT INTO user (user_name, password, creation_date) VALUES ('" . $username . "','" . $hash_password . "','" . $date . "')";

		if ( mysqli_query( $conn, $sql ) ) {
			AlertManager::display_success( 'Vous avez créé votre compte avec succès.' );
		} else {
			AlertManager::display_error( "Erreur lors de l'inscription." );
		}
	} else {
		AlertManager::display_error( 'Les mots de passe ne correspondent pas.' );
	}
}


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
 * Returns the current user or false if theres none.
 *
 * @return bool|User
 */
function get_user() {
	if ( ! isset( $_SESSION['current_user'] ) ) {
		return false;
	}
	return $_SESSION['current_user'];
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

Readable::start();
