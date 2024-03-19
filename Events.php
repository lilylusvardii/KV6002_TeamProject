<?php

include 'Database.php';

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


