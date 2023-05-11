<?php
/**
 * Contains the subscription form processing.
 */

require_once 'functions.php';

if ( isset( $_POST['subscription-user_name'] ) && isset( $_POST['subscription-password'] ) && isset( $_POST['subscription-confirm-password'] ) ) {
	$res = subscribe_user( htmlentities( $_POST['subscription-user_name'] ), $_POST['subscription-password'], $_POST['subscription-confirm-password'] );
	if ( $res === true ) {
		header( 'Location: account.php' );
		exit();
	} else {
		header( 'Location: subscription.php?subscription_error=' . $res );
		exit();
	}
}


header( 'Location: subscription.php' );
exit();
