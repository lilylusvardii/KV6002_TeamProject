<?php
session_start();

if(isset($_SESSION['user_id'])) {
    require 'Database.php'; 

    try {
        $conn = getConnection(); 

        $sql = "SELECT cat_id FROM em_users WHERE cat_id = :cat_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cat_id', $_SESSION['cat_id'], PDO::PARAM_INT);
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
    echo "not authorised for this content";
}
?>
