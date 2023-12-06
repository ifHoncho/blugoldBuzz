<?php
//SEND POST INFO TO THE DB
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

    $title = $_POST['title'];
    $content = $_POST['content'];
    $user = $_SESSION['username'];

    $sql = "INSERT INTO post (username, title, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user, $title, $content);

    if ($stmt->execute()) {
        echo "New post created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
?>