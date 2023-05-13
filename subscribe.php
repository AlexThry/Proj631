<?php
/**
 * Contains the subscription form processing.
 */

require_once 'functions.php';

if ( isset( $_POST['subscription-user_name'] ) && isset( $_POST['subscription-password'] ) && isset( $_POST['subscription-confirm-password'] )
	&& isset( $_POST['subscription-first_name'] ) && isset( $_POST['subscription-last_name'] ) && isset( $_POST['subscription-mail'] ) ) {
	$res = subscribe_user( htmlentities( $_POST['subscription-user_name'] ), $_POST['subscription-password'], $_POST['subscription-confirm-password'],
		$_POST['subscription-first_name'], $_POST['subscription-last_name'], $_POST['subscription-mail'] );
	if ( $res === true ) {
		header( 'Location: account.php' );
	} else {
		header( 'Location: subscription.php?subscription_error=' . $res );
	}
	exit();
}


header( 'Location: subscription.php' );
exit();
