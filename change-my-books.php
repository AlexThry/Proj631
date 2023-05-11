<?php
/**
 * Contains the processing for my-books (adding and removing books in my-books).
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

// Check if book is already in my books
$sql = "SELECT id FROM has_read WHERE id_user = $user_id AND id_book = $book_id";
$res = $conn->query($sql);

$in_mybooks = mysqli_num_rows($res) > 0;
if($in_mybooks) {
    // Removing
    $sql = "DELETE FROM has_read WHERE id_user = $user_id AND id_book = $book_id";
} else {
    // Adding
    $sql = "INSERT INTO has_read(id_book, id_user) VALUES ($book_id, $user_id)";
}

$conn->query($sql);

if($previous_url !== null) {
    header("Location: $previous_url");
} else {
    header("Location: account.php?tab=user_books");
}
exit();
