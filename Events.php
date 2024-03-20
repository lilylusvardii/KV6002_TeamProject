<?php

require 'Database.php';

try {
    // Create a database connection and execute the query
    $dbConnection = getConnection();
    $result = $dbConnection->query($sql);
 
    // Fetch all the data as an associative array
    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $row) {
        echo "<li>" . $row["eventname"] . ": " . $row["description"] . ": " . $row["location"] . ": " . $row["capacity"] . "</li>";
    }
} catch( PDOException $e ) {
    // If there is an error, return an error message in JSON format
    $error['error'] = "Database Query Error";
    $error['message'] = $e->getMessage();
 
    $data = $error;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $conn->real_escape_string($_POST['eventName']);
    $desc = $conn->real_escape_string($_POST['desc']);
    $location = $conn->real_escape_string($_POST['location']);
    $capacity = $conn->real_escape_string($_POST['capacity']);
    $organiser = $conn->real_escape_string($_POST['organiser']);

    

    // Insert event data into database
    $sql = "INSERT INTO events (eventName, description, location, capacity, organiser) VALUES ('$eventName', '$desc', '$location', '$capacity', '$organiser')";
    if ($conn->query($sql) === TRUE) {
        echo "event has been added successfully";
    } else { 
        echo "error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>


