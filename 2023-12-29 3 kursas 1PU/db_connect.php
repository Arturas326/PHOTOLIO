<?php
$servername = "localhost";
$username = "root";  // Default XAMPP MySQL root user
$password = "";      // Default XAMPP root user has no password
$dbname = "photo_gallery";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>