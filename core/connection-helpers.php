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
 * Check if mail valid.
 *
 * @param string $mail Mail to check.
 * @return boolean
 */
function valid_mail( $mail ): bool {
	return preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $mail);
}

/**
 * Check if first name or last name is valid.
 *
 * @param string $name name to check.
 * @return boolean
 */
function valid_name( $name ): bool {
	return preg_match('/^[a-zA-ZÀ-ÖØ-öø-ſ]+([ \'-][a-zA-ZÀ-ÖØ-öø-ſ]+)*$/', $name);
}

/**
 * Attempt connection.
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
		return 'Erreur de connexion (' . $conn->error . ')';
	}

	$result = mysqli_fetch_assoc( $result );
	if ( ! $result ) {
		return "Ce compte n'existe pas.";
	}

	$hash_password = md5( $password );
	if ( $result['password'] !== $hash_password ) {
		return 'Mot de passe incorrect.';
	}

	add_user_to_session($result);

	return true;
}

/**
 * Adds a user to the session, using the result of a query.
 *
 * @param array $result The row of a database query (must represent a user)
 * @return void
 */
function add_user_to_session( array $result ): void {
	$user = array(
		'id' => (int) $result['id'],
		'user_name' =>$result['user_name'],
		'first_name' =>$result['first_name'],
		'last_name' =>$result['last_name'],
		'password' =>$result['password'],
		'email' =>$result['email'],
		'profile_url' =>$result['profile_url']
	);

	$_SESSION['current_user'] = $user;
}
/**
 * Attempts subscription.
 *
 * @param string $user_name Username.
 * @param string $password Password.
 * @param string $confirm_password Confirm password.
 * @param string $first_name First name.
 * @param string $last_name Last name.
 * @param string $mail Mail.
 *
 * @return true|string True if subscription was successful, an error message otherwise.
 */
function subscribe_user( $user_name, $password, $confirm_password, $first_name, $last_name, $mail ) {
	global $conn;

	// Validate inputs.
	$errors = array();
	if ( empty( $user_name ) ) $errors[] = "Insérez votre nom d'utilisateur";
	if ( empty( $password ) ) $errors[] = 'Insérez votre mot de passe';
	if ( ! empty( $password ) && empty( $confirm_password ) ) $errors[] = 'Confirmez votre mot de passe';
	if ( ! empty($mail) && ! valid_mail($mail)) $errors[] = "Le mail est incorrect.";
	if ( ! empty($last_name) && ! valid_name($last_name)) $errors[] = "Le nom ne peut pas contenir de chiffre ou de caractère spécial.";
	if ( ! empty($first_name) && ! valid_name($first_name)) $errors[] = "Le prénom ne peut pas contenir de chiffre ou de caractère spécial.";

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

	// Check if user already exists
	$res = $conn->query("SELECT id FROM user WHERE user.user_name = \"$username\" LIMIT 1");
	if(mysqli_num_rows($res)) return "Ce compte existe déjà, insérez un autre nom d'utilisateur.";

	$date          = date( 'Y-m-d' );
	$hash_password = md5( $password );
	$sql           = "INSERT INTO user (user_name, password, creation_date, first_name, last_name, email)
		VALUES ('" . $user_name . "','" . $hash_password . "','" . $date . "','" . $first_name . "','" . $last_name . "','" . $mail . "')";

	// Launch query
	$res = $conn->query($sql);
	if( !$res ) return "Error lors de l'inscription";

	// Get newly created user
	$res = $conn->query("SELECT * FROM user WHERE id = LAST_INSERT_ID()");

	// Connect user
	add_user_to_session(mysqli_fetch_assoc($res));

	return true;
}
