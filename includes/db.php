<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'jersey_store';

// Create connection
$conn = new mysqli("localhost", "root", "", "jersey_db");


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
