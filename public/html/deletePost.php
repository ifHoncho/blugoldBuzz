<?php

// create connection
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'blugoldbuzz';

$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM post WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header('Location: profile.php');
?>