<?php 
// Start output buffering
ob_start();

include("checklogin.php");

<<<<<<< HEAD
include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

if (isset($_GET["search"]) && $_GET["search"] != "") {
	// Something has been searched, get matching property records
	$query = "* FROM Feature WHERE lower(FEATURE_NAME) LIKE '%' || :search || '%' ORDER BY Property.type_id";
	$stmt = oci_parse($conn, $query);
	oci_bind_by_name($stmt,  ":search", $_GET["search"]);
	oci_execute($stmt);
} else {
	// Nothing has been searched, get all property records
	$query = "SELECT * FROM Feature ORDER BY FEATURE_ID";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
}


=======
>>>>>>> 692448bb2a22f132e687494b4d34b623b7980fe3
?>
<html lang="en">
<head>
 
  <title>RRE - Property Feature Edit</title>
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
	  	  <h1 class="page-title">Property Feature Edit</h1>
		</div>
		<div class="col-sm-2 sidenav">
		  <!-- Blank for spacing -->
		</div>
	</div>
</div>

<?php include("footer.php"); ?>

</body>
</html>

