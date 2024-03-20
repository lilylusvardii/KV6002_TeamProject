<?php
include 'Database.php';

if(isset($_POST['event_id'])) {
    $event_id = intval($_POST['event_id']);

    //prepared sql statement
    $sql = "DELETE FROM events WHERE event_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $event_id);
        if ($stmt->execute()) {
            echo "the event has been deleted sucessfully";
        } else {
            echo "error deleting event: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "error preparing statement: " . $conn->error;
    }
} else {
    echo "no event ID";
}

$conn->close();
?>

