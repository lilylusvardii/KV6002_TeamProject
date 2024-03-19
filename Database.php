<?php
$servername = "localhost"; 
$username = "unn_w19039023"; 
$password = "91106400As"; 
$database = "unn_w19039023"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
