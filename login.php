<?php
// Start output buffering
ob_start();

session_start();

// create MDS constants
 define("MONASH_DIR", "ldap.monash.edu.au");
 define("MONASH_FILTER","o=Monash University, c=au");

// If the user is already logged in, redirect to the home page
if (isset($_SESSION['login']) || $_SESSION['login'] == true) {
    header("Location: index.php"); 
}
?>
<html lang="en">
<head>
 
	<title>RRE - Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</head>
<body>

<header>
	<center><img src="images/logo_full.png" alt="Ruthless Real Estate" id="top" /></center>
</header>

<?php
	// If there is no username in POST, display the form
	if (empty($_POST["username"])) {	
?>
<center><h1>Employee Portal - Login</h1></center>
<br />
<hr />
<br />

<form method="post" action="login.php">
<center>
<table>
<tr>
	<td><label for="username">Username: </label></td>
	<td><input type="text" name="username" /></td>
</tr>
<tr>
	<td><label for="password">Password: </label></td>
	<td><input type="text" name="password" /></td>
</tr>
<br />
<tr><td></td><td><input type="submit" value="Login" /></td></tr>
</table>
</center>
</form>

<?php 
	// If there is an error message
	if (isset($_GET["error"])) {
		$error = $_GET["error"];
		echo "<center><p class='error'>";
		if ($error == 1) {
			echo "Username and password do not match.";
		} else if ($error == 2) {
			echo "Could not connect to the Moansh Authcate server. Please try again later.";
		}
		echo "</p></center>";
	}
?>

	<?php
		// Else, try to log in using the Monash Authcate LDAP server
		} else {
		// Try to connect to the authcate ldap server
		$LDAPconn = @ldap_connect(MONASH_DIR);
		
		// If connection was successful
		if ($LDAPconn) {
			
			// Check if the entered username exists
			$LDAPsearch = @ldap_search($LDAPconn, MONASH_FILTER, "uid=".$_POST["username"]);
			
			// If the username exists
			if ($LDAPsearch) {
				
				// Check if the entered password matches the username
				$LDAPinfo = @ldap_first_entry($LDAPconn, $LDAPsearch);
				
				if ($LDAPinfo) {
					
					$LDAPresult = @ldap_bind($LDAPconn, ldap_get_dn($LDAPconn, $LDAPinfo), $_POST["password"]);
					$LDAPerror = 1;
					
				} else {
					// Username does not 
					$LDAPresult = 0;
					$LDAPerror = 1;
				}
				
			} else {
				// Username does not exist
				$LDAPresult = 0;
				$LDAPerror = 1;
			}
			
		} else {
			// Connection failed
			$LDAPresult = 0;
			$LDAPerror = 2;
		}
		
		// If the login was successful, set session status to logged in, otherwise refresh page and add an error message
		if ($LDAPresult) {
			$_SESSION['login'] = true;
			// Redirect to index page - this could be changed to a target page if desired
			header("Location: index.php");
		} else {
			$_SESSION['login'] = false;
			// Redisplay the form with the error message
			header("Location: index.php?error=$LDAPerror");
		}
	?>


</body>
</html>

