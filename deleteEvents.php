<?php
//part of adding events subsystem

include 'Database.php';

if(isset($_POST['event_id'])) { //if theres an event id in the post request
    try { //try and catch for error handling (might have to remove caused errors in other code)
        
        $conn = getConnection(); //db connection
        $event_id = ($_POST['event_id']);
        $sql = "DELETE FROM em_events WHERE event_id = :event_id"; //delete sql statement
         
        $stmt = $conn->prepare($sql); //preparing statement
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT); //binding event id param to prepared statement

        if ($stmt->execute()) { //executing the sql statement 
            echo "the event has been deleted successfully!"; //if else to deal with possible outcomes
            echo '<a href="index.php"> click here to go back to the home page</a><br>';
            echo '<a href="Events.html"> click here to go back to the events management page</a>'; //links back to home page so user isnt stuck
        } else {
            echo "error the event couldn't be deleted";
            echo '<a href="index.php"> click here to go back to the home page</a><br>';
            echo '<a href="Events.html"> click here to go back to the events management page</a>';
        }
        $conn = null; //closing db connection
         
    } catch (PDOException $e) { 
        echo "database error: " . $e->getMessage();
    }
} else {
    echo "error occured !";
    echo '<a href="index.php"> click here to go back to the home page</a><br>';
    echo '<a href="Events.html"> click here to go back to the events management page</a>';
}
?>



