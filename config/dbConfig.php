<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE blugoldBuzz";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db("blugoldBuzz");

// sql to create table
$sql = "CREATE TABLE userinfo (
username VARCHAR(30) NOT NULL PRIMARY KEY,
password VARCHAR(255) NOT NULL,
email VARCHAR(50),
userType varchar(10)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table userinfo created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// inserting a dummy user for the demo
$passwordHash = password_hash('123456', PASSWORD_DEFAULT);
$sql = "INSERT INTO userinfo (username, password, email, userType) VALUES ('user1', '$passwordHash', 'user1@example.com', 'student')";

if ($conn->query($sql) === TRUE) {
    echo "User inserted successfully";
} else {
    echo "Error inserting user: " . $conn->error;
}


$sql = "CREATE TABLE post (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    content TEXT,
    post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table post created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
$dbname = 'blugoldBuzz';
// dummy posts
$mysqli = new mysqli($servername, $username, $password, $dbname);
$sql = "INSERT INTO post (username, content) VALUES (?, ?)";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

if ($stmt === false) {
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}

// Bind the parameters and execute the statement
for ($i = 1; $i <= 5; $i++) {
    $user = 'user1';
    $content = 'This is post ' . $i;

    $stmt->bind_param('ss', $user, $content);

    if ($stmt->execute() === false) {
        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }
}

// Close the statement and the connection
$stmt->close();
$mysqli->close();
?>