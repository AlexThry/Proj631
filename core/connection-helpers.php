<?php

/**
 * Comute connection.
 *
 * @param string $username Username.
 * @param string $password Password.
 * @return true|string True if success, error message otherwise.
 */
function connect_user( $username, $password ) {
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
			return $error_message;
		}
	}

	// Protect from XSS attack.
	$query = sprintf(
		"SELECT * FROM user WHERE user_name='%s' LIMIT 1",
		$conn->real_escape_string( $username )
	);

	$result = $conn->query( $query );
	if ( ! $result ) {
		return 'Erreur de connexion (' . mysql_error() . ')';
	}

	$result = mysqli_fetch_assoc( $result );
	if ( ! $result ) {
		return "Ce compte n'existe pas.";
	}

	$hash_password = md5( $password );
	if ( $result['password'] !== $hash_password ) {
		return 'Mot de passe incorrect.';
	}

	$_SESSION['current_user'] = new User( (int) $result['id'], $result['user_name'], $result['first_name'], $result['last_name'], $result['password'], $result['email'] );

	return true;
}


/**
 * Compute subscription.
 *
 * @param string $username Username.
 * @param string $password Password.
 * @param string $confirm_password Confirm password.
 *
 * @return true|string True if success, error message otherwise.
 */
function subscribe_user( $username, $password, $confirm_password ) {
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
			return $error_message;
		}
	}

	if ( $password === $confirm_password ) {
		$date          = date( 'Y-m-d' );
		$hash_password = md5( $password );
		$sql           = "INSERT INTO user (user_name, password, creation_date) VALUES ('" . $username . "','" . $hash_password . "','" . $date . "')";

		if ( mysqli_query( $conn, $sql ) ) {
			return true;
		} else {
			return "Erreur lors de l'inscription.";
		}
	} else {
		return 'Les mots de passe ne correspondent pas.';
	}
}
