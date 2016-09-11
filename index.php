<?php 
// Start output buffering
ob_start();

// Checks if the user is logged on, and if not redirects them to the login page. Must be at the top of every page.
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("Location: login.html"); 
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
	<center><img src="images/logo_full.png" alt="Ruthless Real Estate" id="top" /></center>
</header>

<nav class="navbar navbar-inverse">
  <div class="container-fluid topnavbar">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Menu</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Properties</a></li>
        <li><a href="#">Multiple Property Edit</a></li>
        <li><a href="#">Property Types</a></li>
        <li><a href="#">Property Features</a></li>
        <li><a href="#">Buyers</a></li>
        <li><a href="#">Sellers</a></li>
        <li><a href="#">Images</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Documentation</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center" id="content">
	<div class="row content">
		<div class="col-sm-2 sidenav">
		  <!-- Blank for spacing -->
		</div>
		<div class="col-sm-8 text-left content-div">
	  <!-- ALL CONTENT GOES INSIDE THIS DIV -->
	  	  <br />
		  <h1>Ruthless Real Estate - Employee Portal</h1>
		  <p>Welcome to the employee portal for Ruthless Real Estate. Here you can access the functionality you need to manage your business. Use the buttons in the above navigation bar to access the different sections of the system.</p>
		  <br />
		  <hr />
		  <br />
		  <h2>Source Code</h2>
		  <p>Use the images below to access the source code for the different pages / functionality implemented for this assignment.</p>
		</div>
		<div class="col-sm-2 sidenav">
		  <!-- Blank for spacing -->
		</div>
	</div>
</div>

<footer class="container-fluid text-center">
  <p>This site was created for Assignment 2 of unit FIT2076-S2-2016 by Andrew (Ha Nam Anh) Pham and Douglas Rintoul. Logo uses image provided by freepik.com.</p>
</footer>

</body>
</html>

