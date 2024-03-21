<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test-1";

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "test-1";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
