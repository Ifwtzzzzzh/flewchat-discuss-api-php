<?php
// Import code from
include '../connection.php';

// Retrieve username and hash password for authentication
$username = $_POST['username'];
$password = md5($_POST['password']);

// Check if a user with the given username exists in the database.
$sql_check_username = "SELECT * FROM user WHERE username = '$username'";
$result_check_username = $connect->query($sql_check_username);

// Respond with JSON indicating username availability if found.
if ($result_check_username -> num_rows > 0) {
    echo json_encode(array(
        "success" => false,
        "message" => "username",
    ));
} else {
    // Insert a new user into the database with default image.
    $sql = "INSERT INTO user SET username = '$username', password = '$password', image = 'default_user_image.jpg'";
    $result = $connect->query($sql);

    // Encode a JSON response indicating success or failure based on $result value.
    if ($result) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false));
    }
}
?>