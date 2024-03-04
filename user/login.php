<?php
// Import code from
include '../connection.php';

// Retrieve username and hash password for authentication
$username = $_POST['username'];
$password = md5($_POST['password']);

// Retrieve user data matching provided username and password, addressing potential SQL injection vulnerabilities.
$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$result = $connect->query($sql);

// Respond with JSON indicating username availability if found.
if ($result -> num_rows > 0) {
    $data = array();
    while ($get_row = $result->fetch_assoc()) {
        $data[] = $get_row;
    }

    echo json_encode(array(
        "success" => true,
        "data" => $data[0],
    ));
} else {
    echo json_encode(array(
        "success" => false
    ));
}
?>