<?php
// Database connection details for the Discuss app
$sever = "localhost";
$user = "root";
$password = "";
$db = "discuss_app_db";

// Establish a new MySQLi connection using provided credentials.
$connect = new mysqli($host, $user, $password, $db);
?>