<?php
$servername = "dt5.ehb.be";
$username = "WDA034";
$password = "Test123";
$dbname = "WDA034";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>