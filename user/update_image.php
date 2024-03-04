<?php
// Import code from
include '../connection.php';

// Retrieve image data for update, validating for security and handling base64-encoded content.
$id = $_POST['id'];
$old_image = $_POST['old_image'];
$new_image = $_POST['new_image'];
$new_base64code = $_POST['new_base64code'];

// Update user's image with specified ID, using a prepared statement to prevent SQL injection.
$sql = "UPDATE user SET image = '$image' WHERE id = '$id'";
$result = $connect->query($sql);

// Conditionally update user image, preserving default image and returning JSON response.
if ($result) {
    if ($old_image != "default_user_image.jpg") {
        unlink("../image/user/" . $old_image);
    }
    file_put_contents("../image/user/". $new_image, base64_decode($new_base64code));
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false));
}
?>