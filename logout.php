<?php
/**
 * Contains the logout form processing.
*/

require_once 'functions.php';

if ( get_user() ) {
	unset( $_SESSION['current_user'] );
}

header( 'Location: ' . get_home_url() );
exit();
