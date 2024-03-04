<?php
// Import code from
include '../connection.php';

// Assign the search query from the POST request to the $search_query variable.
$search_query = $_POST['search_query'];

// Query for users whose usernames partially match the search query.
$sql = "SELECT * FROM user WHERE username LIKE '%$search_query%'";
$result = $connect->query($sql);

// Respond with JSON indicating username availability if found.
if ($result -> num_rows > 0) {
    $data = array();
    while ($get_row = $result->fetch_assoc()) {
        $data[] = $get_row;
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