<?php
/**
 * Contains the connection form processing.
 */

require_once 'functions.php';

if ( isset( $_POST['connection-user_name'] ) && isset( $_POST['connection-password'] ) ) {
	$res = connect_user( htmlentities( $_POST['connection-user_name'] ), $_POST['connection-password'] );

	// This is painful, but we must keep the "=== true", because connect_user returns a bool or a non-empty string
	if ( $res === true ) {
		header( 'Location: account.php' );
	} else {
		header( 'Location: connection.php?connection_error=' . htmlentities( $res ) );
	}
	exit();
}

header( 'Location: connection.php' );
exit();
