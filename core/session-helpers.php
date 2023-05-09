<?php

/**
 * Returns the current user or false if theres none.
 *
 * @return bool|User
 */
function get_user(): mixed {
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

	$id   = $session_user->get_id();
	$user = Database::get_user_by_id( $id );
	if ( ! $user ) {
		throw new Exception( 'User not found' );
	}

	$_SESSION['current_user'] = new User( $id, $user['user_name'], $user['first_name'], $user['last_name'], $user['password'] );
}
