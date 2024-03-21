<?php
function getConnection() {

    $dbName = "em2.sqlite";
 
    try {
        $conn = new PDO("sqlite:" . $dbName);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;

    } catch(PDOException $e) {
        echo "connection failed: " . $e->getMessage();
        exit(); //leaving script if it fails
    }
}
?>


