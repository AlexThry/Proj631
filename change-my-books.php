<?php
/**
 * Contains the processing for my-books (adding and removing books in my-books).
 */

require_once 'functions.php';

if ( isset( $_GET['book'] ) && isset( $_GET['previous-url'] ) ) {
    echo $_GET['book'] . $_GET['previous-url'];
    exit();
}

// header( 'Location: connection.php' );
exit();
