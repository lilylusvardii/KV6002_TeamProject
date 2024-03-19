<?php
    include 'db/Database.php';

    if(isset($_POST['event_id'])) {
        $event_id = $_POST['event_id'];

        //sql to delete
        $sql = "DELETE FROM em_events WHERE event_id=$event_id";
        if ($conn->query($sql) === TRUE) {
            echo "event has been deleted successfully";
        } else {
            echo "error deleting event: " . $conn->error;
        }
    } else {
        echo "error: no event ID";
    }

    $conn->close();
    ?>
