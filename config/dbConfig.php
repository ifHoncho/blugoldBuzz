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
userType VARCHAR(50)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table userinfo created successfully";
} else {
    echo "Error creating table: " . $conn->error;
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

$conn->close();
?>