<?php
require 'Database.php';

try {
    $dbConnection = getConnection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['eventName']) && isset($_POST['desc']) && isset($_POST['location']) && isset($_POST['capacity']) && isset($_POST['incomeGroup'])) {
            $eventName = $dbConnection->quote($_POST['eventName']);
            $desc = $dbConnection->quote($_POST['desc']);
            $location = $dbConnection->quote($_POST['location']);
            $capacity = $dbConnection->quote($_POST['capacity']);
            $incomeGroup = $dbConnection->quote($_POST['incomeGroup']);

            //inserting into db
            $sql = "INSERT INTO em_events (eventname, description, location, capacity, icg_id) VALUES (:eventname, :description, :location, :capacity, :icg_id)";
            if ($dbConnection->exec($sql)) {
                echo "your event has been added successfully!";
            } 
            
            else {
                echo "error event couldn't be added";
            }
        } 
    } else {
        echo"error ";
    }
       
} catch (PDOException $e) {
    echo "database error: " . $e->getMessage();
}

$dbConnection = close();


?>




