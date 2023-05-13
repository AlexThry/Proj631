<?php

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
 * Refresh the current user.
 *
 * @throws Exception If the user is not found.
 *
 * @return void
 */
function refresh_user(): void {
	$session_user = get_user();
	if ( ! $session_user ) {
		return;
	}

	$id   = $session_user['id'];
	$user = Database::get_user( $id );
	if ( ! $user ) {
		throw new Exception( 'User not found' );
	}

	$new_user = array(
		'id' => $id,
		'user_name' => $user['user_name'],
		'first_name' => $user['first_name'],
		'last_name' => $user['last_name'],
		'password' => $user['password'],
		'email' => $user['email'],
		'profile_url' => $user['profile_url']
	);

	$_SESSION['current_user'] = $new_user;
}
