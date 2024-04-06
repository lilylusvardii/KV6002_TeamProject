<?php
// Sabeeha signup subsystem
session_start();
require 'Database.php';

// Create a database connection
try {
    $dbConnection = getConnection();
} catch (PDOException $e) {
    $response = array('success' => false, 'message' => 'Database connection error: ' . $e->getMessage());
    echo json_encode($response);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $location = trim($_POST['location']);
    $phone = trim($_POST['phone']); // Adjusted to match the form field name
    $icg_id = intval($_POST['icg_id']);

    if (empty($username) || empty($password) || empty($location) || empty($phone) || empty($icg_id)) {
        $response = array('success' => false, 'message' => 'All fields are required');
        echo json_encode($response);
        exit();
    }

    // Prepare data for insertion
	
    // this is for future development to make it more secure.
	//$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare SQL statement
        $sql = "INSERT INTO em_user (username, password, cat_id, location, phonenumber, icg_id) VALUES (:username, :password, :cat_id, :location, :phonenumber, :icg_id)";
        $stmt = $dbConnection->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindValue(':cat_id', 2);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':phonenumber', $phone);
        $stmt->bindParam(':icg_id', $icg_id);

        // Execute the query
        $result = $stmt->execute();

        if ($result) {
            $response = array('success' => true, 'message' => 'User signed up successfully');
            echo json_encode($response);
        } else {
            $response = array('success' => false, 'message' => 'Error signing up');
            echo json_encode($response);
        }
    } catch (PDOException $e) {
        $response = array('success' => false, 'message' => 'Database error: ' . $e->getMessage());
        echo json_encode($response);
    }
} else {
    $response = array('success' => false, 'message' => 'Invalid request');
    echo json_encode($response);
}
?>
