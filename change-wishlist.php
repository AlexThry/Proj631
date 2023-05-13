<?php
/**
 * Contains the processing for the wishlist (adding and removing books in my wishlist).
 */

require_once 'functions.php';

$previous_url = isset( $_GET['previous-url'] ) ? $_GET['previous-url'] : null;

// End if book_id is not given, or if user is not connected
if(!isset($_GET['book_id']) || !get_user()) {
    if($previous_url !== null) header("Location: $previous_url");
    else header("Location: connection.php");
    exit();
}

$user_id = get_user()['id'];
$book_id = $_GET['book_id'];

// Check if book is already in wishlist
$sql = "SELECT id FROM wants_to_read WHERE id_user = $user_id AND id_book = $book_id;";
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
