<?php
session_start();

//unset all the session variables
$_SESSION = array();

unset($_SESSION['user_logged_in']);

//set the logout message
$_SESSION['message'] = 'Logout successful!';

// Redirect to homepage with a logout success message
header("Location: index.php");
exit;
?>