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
// SQL file to execute
$sql_file = "em.sql"; 

// Read SQL file
$sql = file_get_contents($sql_file);

// Execute multi-query
if ($conn->multi_query($sql) === TRUE) {
    echo "SQL file imported successfully";
} else {
    echo "Error importing SQL file: " . $conn->error;
}

// Close connection
$conn->close();
?>
