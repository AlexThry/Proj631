<?php
/**
 * Contains the processing for the wishlist (adding and removing books in my wishlist).
 */

require_once 'functions.php';


if ( isset( $_GET['book'] ) && isset( $_GET['previous-url'] ) && get_user() ) {
    $user_id = get_user()['id'];
    $book_id = $_GET['book'];


    // Check if book is already in wishlist
    $sql = "SELECT id FROM wants_to_read WHERE id_user = $user_id AND id_book = $book_id";
    $res = $conn->query($sql);

    $in_wishlist = mysqli_num_rows($res) > 0;
    if($in_wishlist) {
        // Removing
        $sql = "DELETE FROM wants_to_read WHERE id_user = $user_id AND id_book = $book_id";
    } else {
        // Adding
        $sql = "INSERT INTO wants_to_read(id_book, id_user) VALUES ($book_id, $user_id)";
    }

    $conn->query($sql);

    header('Location: account.php?tab=user_wishlist');
    exit();
}

if(isset( $_GET['previous-url'] )) {
    header('Location: '.$_GET['previous-url']);
} else {
    header( 'Location: connection.php' );
}
exit();
