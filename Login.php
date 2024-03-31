<?php
session_start();

require 'Database.php';

$conn = getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM em_user WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $isAdmin = $result['cat_id'] == 1;

        // Set session variables
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $isAdmin = isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : false; // Save admin status as a session variable

        header("Location: indexhoz.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}

if (isset($_GET['logout'])) {
    // Destroy session
    $_SESSION = array();
    session_destroy();

    // Redirect to login page
    header("Location: Login.html");
    exit();
}
?>
