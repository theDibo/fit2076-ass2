<?php 
// Start output buffering
ob_start();

include("checklogin.php");

include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

<<<<<<< HEAD
if (isset($_GET["search"]) && $_GET["search"] != "") {
	// Something has been searched, get matching property records
	$query = "PropertyType.* FROM PropertyType WHERE lower(PropertyType.type_name) LIKE '%' || :search || '%' ORDER BY Property.type_id";
	$stmt = oci_parse($conn, $query);
	oci_bind_by_name($stmt,  ":search", $_GET["search"]);
	oci_execute($stmt);
} else {
	// Nothing has been searched, get all property records
	$query = "SELECT * FROM PropertyType ORDER BY type_ID";
    $stmt = oci_parse($conn, $query);
    oci_execute($stmt);
}

=======
$query = "SELECT * FROM PropertyType ORDER BY type_id";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
>>>>>>> 692448bb2a22f132e687494b4d34b623b7980fe3

?>

<html lang="en">
<head>
 
  <title>RRE - Property Type</title>
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
	  	  <center><h1 class="page-title">Property Types</h1></center>
	  	  
	  	  <div class="col-md-6 col-md-offset-2">
		  <a href="create_type.php" class="btn btn-default btn-md col-md-5 custbutton">Create New Type</a>
		  </div>
	  	  
	  	  <table border="1" align="center" class="display-table">
	
			<tr>
	        	<th>ID</th>
				<th>Name</th>
				<th>Description</th>
				<th colspan="2">Options</th>
			</tr>

			<?php
			$results = false;
			while ($row = oci_fetch_array($stmt)) {
				$results = true;
			?>
			<tr>
				<td><?php echo $row["TYPE_ID"] ?></td>
				<td><?php echo $row["TYPE_NAME"] ?></td>
				<td><?php echo $row["TYPE_DESC"] ?></td>
				<td><a href="edit_type.php?id=<?php echo $row["TYPE_ID"] ?>&Action=Update">Update</a></td>
				<td><a href="edit_type.php?id=<?php echo $row["TYPE_ID"] ?>&Action=Delete">Delete</a></td>
			</tr>
		<?php
			}
			if (!$results) {
		?> 
		
			<tr><td colspan="5">No matching records were found.</td></tr>
		
		<?php
			}
		?>

		</table>
	  	  
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