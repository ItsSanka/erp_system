<?php
$host = "localhost";
$user = "root"; // 
$password = ""; // 
$database = "erp_system";

// Create the connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
