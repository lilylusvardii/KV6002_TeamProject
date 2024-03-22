<?php
session_start();
    require 'Database.php' ;
	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
   	// Create a database connection
   	$conn = getConnection();
	
    	$username = $_POST['username'];
    	$password = $_POST['password'];
    	$cat_id = 2;
    	$location = $_POST['location'];
	$phonenumber = $_POST['phonenumber'];
	$icg_id = $_POST['icg_id'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO em_user (username, password, cat_id, location, phonenumber, icg_id) 
					VALUES (:username, :password, :cat_id, :location, :phonenumber, :icg_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
    $stmt->bindValue(':cat_id', $cat_id, SQLITE3_INTEGER);
    $stmt->bindValue(':location', $location, SQLITE3_TEXT);
    $stmt->bindValue(':phonenumber', $phonenumber, SQLITE3_TEXT);
    $stmt->bindValue(':icg_id', $icg_id, SQLITE3_INTEGER);
    $result = $stmt->execute();

    if ($result) {
        echo "User signed up successfully";
    } else {
        echo "Error signing up: " . $conn->lastErrorMsg();
    }

    $stmt->close();
} else {
    echo "Invalid request";
}

?>
