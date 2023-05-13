<?php
/**
* Adds and removes a book from a circle.
*/

require_once 'functions.php';

$circle_id    = isset( $_GET['circle-id'] ) ? $_GET['circle-id'] : null;
$previous_url = isset( $_GET['previous-url'] ) ? $_GET['previous-url'] : null;
$book_id      = isset( $_GET['book-id'] ) ? $_GET['book-id'] : null;
$user_id      = get_user() ? get_user()['id'] : null;

// End if circle_id or book_id is not given, or if user is not connected, or if he's not the circle's admin
if($circle_id === null || $user_id === null || $book_id === null || !Database::user_is_circle_admin($user_id, $circle_id) ) {
    if( $previous_url !== null ) header("Location: $previous_url");
    else header("Location: connection.php");
    exit();
}

// Check if book is already in circle
$is_in_circle = Database::book_is_in_circle($book_id, $circle_id);
if($is_in_circle) {
    // Removing
    $sql = "DELETE FROM book_in_circle WHERE book_id = $book_id AND circle_id = $circle_id;";
} else {
    // Adding
    $sql = "INSERT INTO book_in_circle(book_id, circle_id) VALUES ($book_id, $circle_id);";
}

$conn->query($sql);

if($previous_url === null) header("Location: circle.php?id=$circle_id");
else header("Location: $previous_url");
exit();
