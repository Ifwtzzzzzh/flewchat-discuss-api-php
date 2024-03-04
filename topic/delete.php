<?php
// Import code from
include '../connection.php';

$id = $_POST['id'];
$images = $_POST['images'];

$sql = "DELETE FROM topic WHERE id = '$id'";
$result = $connect->query($sql);

$list_image = json_decode($images);
if ($result) {
    for ($i = 0; $i < count($list_image); $i++) {
        unlink("../image/topic/".$list_image[$i]);
    }
    $sql_comment = "DELETE FROM comment WHERE id_topic = '$id'";
    $result = $connect->query($sql_comment);
    echo json_encode(array(
        "success" => true
    ));
} else {
    echo json_encode(array(
        "success" => false
    ));
}
?>