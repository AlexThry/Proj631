<?php
/**
 * Adds and removes user from circles.
 */

require_once 'functions.php';

$circle_id    = isset( $_GET['circle-id'] ) ? $_GET['circle-id'] : null;
$previous_url = isset( $_GET['previous-url'] ) ? $_GET['previous-url'] : null;
$user_id      = get_user() ? get_user()['id'] : null;

// End if circle_id is not given, or if user is not connected
if($circle_id === null || $user_id === null) {
    if($previous_url !== null) header("Location: $previous_url");
    else header("Location: connection.php");
    exit();
}

// Check if user is already in circle
$is_subscribed = Database::user_is_subscribed($user_id, $circle_id);
if($is_subscribed) {
    // Removing
    $sql = "DELETE FROM user_in_circle WHERE user_id = $user_id AND circle_id = $circle_id;";
} else {
    // Adding
    $sql = "INSERT INTO user_in_circle(circle_id, user_id) VALUES ($circle_id, $user_id);";
}

$conn->query($sql);

if($previous_url === null) header("Location: circle.php?id=$circle_id");
else header("Location: $previous_url");
exit();
