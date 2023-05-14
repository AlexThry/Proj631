<?php
/**
 * Contains the processing for the wishlist (adding and removing books in my wishlist).
 */

require_once 'functions.php';

$previous_url = isset( $_GET['previous-url'] ) ? $_GET['previous-url'] : null;
$user_id = get_user() ? get_user()['id'] : null;
$book_id = isset( $_GET['book_id'] ) ? $_GET['book_id'] : null;

// End if book_id is not given, or if user is not connected
if($book_id === null || $user_id === null) {
    // Redirect to connection page if user is not connected
    if($user_id === null) header("Location: connection.php");
    // Redirect to previous page if previous url is given
    else if($previous_url !== null) header("Location: $previous_url");
    // Redirect to home page
    else header("Location: ");
    exit();
}



// Check if book is already in wishlist
$sql = "SELECT id_user FROM wants_to_read WHERE id_user = $user_id AND id_book = $book_id;";
$res = $conn->query($sql);

$in_wishlist = mysqli_num_rows($res) > 0;
if($in_wishlist) {
    // Removing
    $sql = "DELETE FROM wants_to_read WHERE id_user = $user_id AND id_book = $book_id;";
} else {
    // Adding
    $sql = "INSERT INTO wants_to_read(id_book, id_user) VALUES ($book_id, $user_id);";
    // Removing from mybooks
    $sql .= "DELETE FROM has_read WHERE id_user = $user_id AND id_book = $book_id;";
}

$conn->multi_query($sql);

if($previous_url !== null) {
    header("Location: $previous_url");
} else {
    header("Location: account.php?tab=user_wishlist");
}
exit();
