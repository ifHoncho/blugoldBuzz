<?php
$servername = "localhost";
$username = "root"; // default XAMPP user
$password = ""; // default XAMPP password is empty
$dbname = "blugoldBuzz";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === FALSE) {
    echo "Error creating database: " . $conn->error;
}

// Select database
mysqli_select_db($conn, $dbname);

// SQL to create table
$sql = "CREATE TABLE IF NOT EXISTS userinfo (
    username VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
)";

if ($conn->query($sql) === FALSE) {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>