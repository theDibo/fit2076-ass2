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
 
  <title>PAGE TITLE</title>
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
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="property.php">Properties</a></li>
        <li><a href="multi_property.php">Multiple Property Edit</a></li>
        <li><a href="property_type.php">Property Types</a></li>
        <li><a href="property_feature.php">Property Features</a></li>
        <li><a href="buyers.php">Buyers</a></li>
        <li><a href="sellers.php">Sellers</a></li>
        <li><a href="images.php">Images</a></li>
        <li><a href="documentation.php"><span class="glyphicon glyphicon-list-alt"></span>  Documentation</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>
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
		  <h1>Title</h1>
		  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur maximus feugiat ligula, ut consectetur neque volutpat sit amet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus orci dui, euismod quis pharetra in, ornare quis est. Aenean elementum porta felis, ut laoreet risus tristique sed. Donec finibus at nunc vitae ultricies. Sed eget accumsan lacus. Donec aliquam odio est, ac pulvinar massa pharetra nec. Quisque commodo purus a ante tincidunt rutrum. Etiam fringilla pharetra pretium. Aliquam laoreet ipsum eu est consectetur, id placerat eros lacinia. Duis quis congue urna. Ut condimentum dolor eget dignissim dapibus. Nunc vel varius purus, sit amet rhoncus ante.</p>
		  <br />
		  <hr />
		  <br />
		  <h2>Subheading</h2>
		  <p>Proin consectetur est vel dignissim fermentum. Maecenas consequat erat mollis feugiat aliquet. Nunc faucibus id tortor non tristique. Sed ut lacus vitae est rutrum sagittis in a lacus. Ut tempus imperdiet neque, in faucibus metus ullamcorper ac. Morbi nisl ligula, dapibus laoreet tristique quis, tempus hendrerit turpis. Aliquam erat volutpat. Maecenas mi felis, consequat vitae dapibus sollicitudin, dapibus ut tellus. Nulla non volutpat massa, sed hendrerit metus. Suspendisse pretium bibendum justo, eget aliquam ligula ultrices eu. Ut euismod molestie ante vel condimentum. Curabitur in pretium metus, eget varius elit. Aliquam erat volutpat. Nunc dapibus tellus sit amet blandit dignissim. Suspendisse auctor turpis ut tempor auctor. Sed egestas purus vitae varius cursus.

</p>
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

