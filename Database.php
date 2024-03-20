<?php

function getConnection() {
 
    $dbName = "em.sqlite";
 
    try {          
        // Use PDO to create a connection to the database 
        $conn = new PDO('sqlite:'.$dbName);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch( PDOException $e ) {
        $error['error'] = "Database Connection Error";
        $error['message'] = $e->getMessage();
        echo json_encode($error);
        exit();
    }
}
?>