<?php 
// Start output buffering
ob_start();

// Checks if the user is logged on, and if not redirects them to the login page. Must be at the top of every page.
session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
    // User is logged in
	echo "<!-- User logged in -->";
} else {
	header("Location: login.php"); 
}
?>
<html lang="en">
<head>
 
  <title>Employee Portal</title>
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
	<center><a href="index.php"><img src="images/logo_full.png" alt="Ruthless Real Estate" id="top" /></a></center>
</header>

<?php include("navbar.php"); ?>
  
<div class="container-fluid text-center" id="content">
	<div class="row content">
		<div class="col-sm-2 sidenav">
		  <!-- Blank for spacing -->
		</div>
		<div class="col-sm-8 text-left content-div">
	  <!-- ALL CONTENT GOES INSIDE THIS DIV -->
		  <h1 class="page-title">Ruthless Real Estate - Employee Portal</h1>
		  <p>Welcome to the employee portal for Ruthless Real Estate. Here you can access the functionality you need to manage your business. Use the buttons in the above navigation bar to access the different sections of the system.</p>
		  <br />
		  <p>At the bottom of each page you will find an image which, when clicked, will open a new tab displaying the source code of that page.</p>
		</div>
		<div class="col-sm-2 sidenav">
		  <!-- Blank for spacing -->
		</div>
	</div>
</div>

<?php include("footer.php"); ?>

</body>
</html>

