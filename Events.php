<?php

require 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Create a database connection
        $dbConnection = getConnection();

        // Escape user inputs to prevent SQL injection
        $eventName = $dbConnection->quote($_POST['eventName']);
        $desc = $dbConnection->quote($_POST['desc']);
        $location = $dbConnection->quote($_POST['location']);
        $capacity = $dbConnection->quote($_POST['capacity']);
        $organiser = $dbConnection->quote($_POST['organiser']);

        // Insert event data into database
        $sql = "INSERT INTO events (eventName, description, location, capacity, organiser) VALUES ($eventName, $desc, $location, $capacity, $organiser)";
        if ($dbConnection->exec($sql)) {
            echo "Event has been added successfully";
        } else {
            echo "Error occurred while adding the event";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    try {
        // Create a database connection
        $dbConnection = getConnection();

        // Fetch all the data as an associative array
        $result = $dbConnection->query("SELECT eventname, description, location, capacity FROM events");
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        // Display events
        echo "<ul>";
        foreach ($data as $row) {
            echo "<li>" . $row["eventname"] . ": " . $row["description"] . ": " . $row["location"] . ": " . $row["capacity"] . "</li>";
        }
        echo "</ul>";
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}

// Close the database connection
$dbConnection = null;

?>



