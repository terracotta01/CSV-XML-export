<?php
$hostname = "localhost";
$user = "root";
$password = "";
$database = "innercode";
$conn = mysqli_connect($hostname, $user, $password, $database);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>
