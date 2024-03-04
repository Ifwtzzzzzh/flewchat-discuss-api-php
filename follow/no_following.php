<?php
// Import code from
include '../connection.php';

// Retrieve user IDs from POST data for further processing.
$from_id_user = $_POST['from_id_user'];
$to_id_user = $_POST['to_id_user'];

// Check if a follow relationship exists between the specified users.
$sql = "DELETE FROM follow WHERE from_id_user = '$from_id_user' AND to_id_user = '$to_id_user'";
$result = $connect->query($sql);

// Encode success status as JSON based on query results.
if ($result->num_rows > 0) {
    echo json_encode(array(
        "success" => true,
    ));
} else {
    echo json_encode(array(
        "success" => false
    ));
}
?>