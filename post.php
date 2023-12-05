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

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["photo"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $sql = "INSERT INTO post (username, title, content, photo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $user, $title, $content, $target_file);

    if ($stmt->execute()) {
        echo "New post created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>