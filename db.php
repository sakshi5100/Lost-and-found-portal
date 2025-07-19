<?php
$host = "localhost";
$port = "3307";
$user = "root"; // use your MySQL username
$password = ""; // use your MySQL password
$dbname = "lost_and_found";

$conn = new mysqli($host, $user, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
