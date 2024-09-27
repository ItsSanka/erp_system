<?php
$host = "localhost";
$user = "root"; // Your MySQL username
$password = ""; // Your MySQL password (leave blank if you don't have one)
$database = "erp_system";

// Create the connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
