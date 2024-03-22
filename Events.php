<?php
//part of adding events subsystem, this is to add new events to database

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//db connection
require 'Database.php';

$dbConnection = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['eventName']) && isset($_POST['desc']) && isset($_POST['location']) && isset($_POST['capacity']) && isset($_POST['incomeGroup']) && isset($_POST['date'])) {
        try {
            //preparing sql statements
            $sql = "INSERT INTO em_events (eventname, description, location, capacity, icg_id, date) VALUES (:eventname, :description, :location, :capacity, :icg_id, :date)";
            $stmt = $dbConnection->prepare($sql);

            $stmt->bindParam(':eventname', $_POST['eventName']);
            $stmt->bindParam(':description', $_POST['desc']);
            $stmt->bindParam(':location', $_POST['location']);
            $stmt->bindParam(':capacity', $_POST['capacity']);
            $stmt->bindParam(':icg_id', $_POST['incomeGroup']);
            $stmt->bindParam(':date', $_POST['date']);

            if ($stmt->execute()) {
                echo "your event has been added successfully!";
                echo '<a href="index.php"> click here to go back to the home page</a><br>';
                echo '<a href="Events.html"> click here to go back to the events managment page</a>';
            } else {
                echo "error, event couldn't be added";
                echo '<a href="index.php"> click here to go back to the home page</a><br>'
                echo '<a href="Events.html"> click here to go back to the events managment page</a>';
            }
        } catch (PDOException $e) {
            echo "database error: " . $e->getMessage();
        }
    }
} else {
    echo "error!";
}
?>





