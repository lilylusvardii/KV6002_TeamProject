<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'Database.php';

$dbConnection = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['eventName']) && isset($_POST['desc']) && isset($_POST['location']) && isset($_POST['capacity']) && isset($_POST['incomeGroup'])) {
        try {
            //preparing sql statements
            $sql = "INSERT INTO em_events (eventname, description, location, capacity, icg_id) VALUES (:eventname, :description, :location, :capacity, :icg_id)";
            $stmt = $dbConnection->prepare($sql);

            $stmt->bindParam(':eventname', $_POST['eventName']);
            $stmt->bindParam(':description', $_POST['desc']);
            $stmt->bindParam(':location', $_POST['location']);
            $stmt->bindParam(':capacity', $_POST['capacity']);
            $stmt->bindParam(':icg_id', $_POST['incomeGroup']);

            if ($stmt->execute()) {
                echo "your event has been added successfully!";
            } else {
                echo "error, event couldn't be added";
            }
        } catch (PDOException $e) {
            echo "database error: " . $e->getMessage();
        }
    }
} else {
    echo "error!";
}
?>





