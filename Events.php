<?php
require 'Database.php';

try {
    $dbConnection = getConnection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['eventName']) && isset($_POST['desc']) && isset($_POST['location']) && isset($_POST['capacity']) && isset($_POST['incomeGroup'])) {
            $eventName = $dbConnection->quote($_POST['eventName']);
            $desc = $dbConnection->quote($_POST['desc']);
            $location = $dbConnection->quote($_POST['location']);
            $capacity = intval($_POST['capacity']); // Convert capacity to integer
            $incomeGroup = $dbConnection->quote($_POST['incomeGroup']);

            //inserting into db
            $sql = "INSERT INTO em_events (eventname, description, location, capacity, icg_id) VALUES ($eventName, $desc, $location, $capacity, $incomeGroup)";
            if ($dbConnection->exec($sql)) {
                echo "your event has been added successfully!";
            } else {
                echo "error event couldn't be added";
            }
        } else {
            echo "All fields are required";
        }
    } else {
        $result = $dbConnection->query("SELECT eventname, description, location, capacity FROM em_events");
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        echo "<ul>";
        foreach ($data as $row) {
            echo "<li>" . $row["eventname"] . ": " . $row["description"] . ": " . $row["location"] . ": " . $row["capacity"] . "</li>";
        }
        echo "</ul>";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

$dbConnection = null;

?>




