<?php

/**
 * Check if password is secure enough.
 * To be secure, a password must:
 *  - contains at least 8 characters
 *  - contains at least 1 lowercase letter
 *  - contains at least 1 uppercase letter
 *  - contains at least 1 number
 *
 * @param string $password Password to check.
 * @return boolean
 */
function password_is_secure_enough( $password ): bool {
	return preg_match( '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $password );
}

/**
 * Comute connection.
 *
 * @param string $user_name Username.
 * @param string $password Password.
 * @return true|string True if success, error message otherwise.
 */
function connect_user( $user_name, $password ) {
	global $conn;

	// Validate inputs.
	$errors = array();
	if ( empty( $user_name ) ) {
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
		$conn->real_escape_string( $user_name )
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

	$user = array(
		'id' => (int) $result['id'],
		'user_name' =>$result['user_name'],
		'first_name' =>$result['first_name'],
		'last_name' =>$result['last_name'],
		'password' =>$result['password'],
		'email' =>$result['email']
	);

	$_SESSION['current_user'] = $user;

	return true;
}


/**
 * Compute subscription.
 *
 * @param string $user_name Username.
 * @param string $password Password.
 * @param string $confirm_password Confirm password.
 *
 * @return true|string True if success, error message otherwise.
 */
function subscribe_user( $user_name, $password, $confirm_password ) {
	global $conn;

	// Validate inputs.
	$errors = array();
	if ( empty( $user_name ) ) {
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

	if ( $password !== $confirm_password ) {
		return 'Les mots de passe ne correspondent pas.';
	}

	if ( ! password_is_secure_enough( $password ) ) {
		return 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre.';
	}

	$date          = date( 'Y-m-d' );
	$hash_password = md5( $password );
	$sql           = "INSERT INTO user (user_name, password, creation_date) VALUES ('" . $user_name . "','" . $hash_password . "','" . $date . "')";

	if ( mysqli_query( $conn, $sql ) ) {
		return true;
	} else {
		return "Erreur lors de l'inscription.";
	}
}
