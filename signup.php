<?php
session_start();
require 'Database.php';

// Create a database connection
try {
    $dbConnection = getConnection();
} catch (PDOException $e) {
    echo "Database connection error: " . $e->getMessage();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "INSERT INTO em_user (username, password, cat_id, location, phonenumber, icg_id) 
                VALUES (:username, :password, :cat_id, :location, :phonenumber, :icg_id)";
        $stmt = $dbConnection->prepare($sql); // Prepare data for the database
        $stmt->bindParam(':username', $_POST['username']);
        $stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
        $stmt->bindParam(':cat_id', 2);
        $stmt->bindParam(':location', $_POST['location']);
        $stmt->bindParam(':phonenumber', $_POST['phonenumber']);
        $stmt->bindParam(':icg_id', $_POST['icg_id']);
        $result = $stmt->execute(); // Submit data to database

        if ($result) {
            echo "User signed up successfully";
        } else {
            echo "Error signing up";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage(); // Error handling
    }
} else {
    echo "Invalid request";
}
?>
