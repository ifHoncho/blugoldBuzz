<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();


    if (!isset($_SESSION['username'])) {
        die("You must be logged in to post.");
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blugoldBuzz";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $username = $_SESSION['username'];
    $content = $_POST['content'];

    // Assuming you have a database connection $conn
    $sql = "INSERT INTO post (username, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $bindResult = $stmt->bind_param("ss", $username, $content);

    if ($bindResult === false) {
        die("Error binding parameters: " . $stmt->error);
    }

    $executeResult = $stmt->execute();

    if ($executeResult === false) {
        die("Error executing statement: " . $stmt->error);
    }

    header("Location: profile.php"); // Redirect back to the profile page
    ?>
    $conn->close();
?>