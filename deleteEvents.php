<?php
include 'Database.php';

if(isset($_POST['event_id'])) {
    try {
        $event_id = intval($_POST['event_id']);
        $sql = "DELETE FROM em_events WHERE event_id = :event_id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "the event has been deleted successfully!";
        } else {
            echo "error: event couldn't be deleted";
        }
    } catch (PDOException $e) {
        echo "database error: " . $e->getMessage();
    }
} else {
    echo "error!";
}

$conn = null; 
?>


