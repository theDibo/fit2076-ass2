<?php
// Checks if the user is logged on, and if not redirects them to the login page. Must be at the top of every page.
session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    // User is logged in
	echo "<!-- User logged in -->";
} else {
	header("Location: login.php"); 
}
?>