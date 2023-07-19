<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "project";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Failed to connect with database...!!!" . mysqli_connect_error());
}

?>