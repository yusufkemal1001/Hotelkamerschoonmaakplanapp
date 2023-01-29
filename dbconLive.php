<?php
$servername = "localhost";
$username = "deb85590_yusuf";
$password = "8xfYXNZ7";
$dbname = "deb85590_yusuf";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>