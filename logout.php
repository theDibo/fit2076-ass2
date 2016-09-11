<?php
// Start output buffering
ob_start();

// Set the login variable to false
session_start();
$_SESSION["login"] = false;

// Redirect to the login page
header("Location: login.php");
?>