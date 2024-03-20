<?php
session_start();

include 'Database.php';

if ($conn->connect_error) {
    die("connection failed, " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM em_users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("index.php"); 
        exit();
    } else {
        
        echo "Invalid username or password";
    }
}

if (isset($_GET['logout'])) {
   
    $_SESSION = array();
    session_destroy();

    header("Login.html");
    exit();
}


$conn->close();
?>
