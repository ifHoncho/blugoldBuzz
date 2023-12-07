<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContent = $_POST['content'];
} else {
    echo "No POST data received.";
}

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
} else {
    echo "ID is not set in the GET data.";
}
$username = $_SESSION['username'];

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "blugoldBuzz";

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE post SET content = ? WHERE id = ? AND username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $newContent, $id, $username);
$stmt->execute();
header("Location: profile.php");
exit;
?>
