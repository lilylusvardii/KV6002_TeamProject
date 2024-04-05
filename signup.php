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
    // Validate form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $location = trim($_POST['location']);
    $phone = trim($_POST['phonenumber']);
    $icg_id = intval($_POST['icg_id']);

    if (empty($username) || empty($password) || empty($location) || empty($phone) || empty($icg_id)) {
        echo "All fields are required";
        exit();
    }

    // Prepare data for insertion
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare SQL statement
        $sql = "INSERT INTO em_user (username, password, cat_id, location, phonenumber, icg_id) VALUES (:username, :password, :cat_id, :location, :phonenumber, :icg_id)";
        $stmt = $dbConnection->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindValue(':cat_id', 2);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':phonenumber', $phone);
        $stmt->bindParam(':icg_id', $icg_id);

        // Execute the query
        $result = $stmt->execute();

        if ($result) {
            echo "User signed up successfully";
        } else {
            echo "Error signing up";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid request";
}
?>
