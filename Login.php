<?php
session_start();

require 'Database.php' ;

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM em_users WHERE username = '$username' AND password = '$password'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $isAdmin = $user['cat_id'] == 1;

        
        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['isAdmin'] = $isAdmin;

        header("home: index.php");
    } else {
        echo"invalid username or password";
    }

    if (isset($_GET['logout'])) {
    
        $_SESSION = array();
        session_destroy();

        header("Login.html");
        exit();
    }
}


$conn->close();
?>
