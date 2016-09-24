<?php 
// Start output buffering
ob_start();

include("checklogin.php");

include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

// Select all images
$query = "SELECT * FROM Picture ORDER BY property_id";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
?>
<html lang="en">
<head>
 
  <title>RRE - Property Images</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/jquery.validate.js"></script>
  <script src="js/additional-methods.js"></script>

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
	  	  <center><h1 class="page-title">Property Images</h1></center>
	  	  <form method="post" action="delete_images.php">
	  	  
	  	  	<table border="1" align="center" class="display-table">
	  	  		
	  	  		<tr>
	  	  			<th>ID</th>
	  	  			<th>Image</th>
	  	  			<th>Filesize</th>
	  	  			<th>Property</th>
	  	  			<th>Delete</th>
	  	  		</tr>
	  	  		
	  	  	</table>
	  	  	
	  	  </form>
	  	  
		</div>
		<div class="col-sm-2 sidenav">
		  <!-- Blank for spacing -->
		</div>
	</div>
</div>

<?php include("footer.php"); ?>

</body>
</html>

<?php
	oci_free_statement($stmt);
	oci_close($conn);
?>