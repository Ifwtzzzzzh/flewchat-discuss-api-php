<?php
// Import code from
include '../connection.php';

// Retrieve user ID from POST data, ensuring validation and sanitization.
$id_user = $_POST['id_user'];

// Retrieve all follow records for the specified user ID.
$sql = "SELECT * FROM follow WHERE from_id_user = '$id_user'";
$result = $connect->query($sql);

// Fetch following data and create JSON response with user details.
if ($result->num_rows > 0) {
    $data = array();
    while ($row_following = $result->fetch_assoc()) {
        // Fetches following data for each row and stores the first user record in $data.
        $id_following = $row_following["to_id_user"];
        $sql_user = "SELECT * FROM user WHERE id = '$id_following'";
        $result_user = $connect->query($sql_user);

        // Build an array of user data from fetched rows.
        $user = array();
        while ($row_user = $result_user->fetch_assoc()) {
            $user[] = $row_user;
        }
        // Append the first element of $user to the $data array.
        $data[] = $user[0];
    }
    
    echo json_encode(array(
        "success" => true,
        "data" => $data,
    ));
} else {
    echo json_encode(array(
        "success" => false,
        "data" => [],
    ));
}
?>