<?php
// Import code from
include '../connection.php';

// Retrieve user ID from POST data, ensuring validation and sanitization.
$id_user = $_POST['id_user'];

// Retrieve the ID from the topic table where the id_topic matches the provided user ID.
$sql_topic = "SELECT id FROM topic WHERE id_topic = '$id_user'";
$result_topic = $connect->query($sql_topic);

// Retrieve follower IDs for the given topic ID
$sql_follower = "SELECT id FROM follower WHERE to_id_topic = '$id_user'";
$result_follower = $connect->query($sql_follower);

// Retrieve IDs of followers for the given topic by the user
$sql_following = "SELECT id FROM follower WHERE from_id_topic = '$id_user'";
$result_following = $connect->query($sql_following);

// Encode user counts as JSON, converting row counts to floats for compatibility.
echo json_encode(array(
    "topic" => floatval($result_topic->num_rows),
    "follower" => floatval($result_follower->num_rows),
    "following" => floatval($result_following->num_rows),
));
?>