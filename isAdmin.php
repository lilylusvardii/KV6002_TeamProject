<?php
session_start();

if(isset($_SESSION['isAdmin'])) {
    require 'Database.php'; 

    try {
        $conn = getConnection(); 

        $sql = "SELECT cat_id FROM em_users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_INT);
        $stmt->execute();

        $isAdmin = $stmt->fetchColumn();

        //checking if the user is an admin
        if ($isAdmin === 1) {
            $admin = true;
        } else {
            $admin = false;
        }

        $stmt = null;
        $conn = null;

    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
} else {
    echo "Log in as admin to manage events";
}
?>
