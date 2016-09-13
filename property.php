<?php 
// Start output buffering
ob_start();

include("checklogin.php");

include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");
$query = "SELECT * FROM Property ORDER BY type_id";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);

?>

<html lang="en">
<head>
 
  <title>RRE - Properties</title>
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

<?php include("navbar.php"); ?>
  
<div class="container-fluid text-center" id="content">
	<div class="row content">
		<div class="col-sm-2 sidenav">
		  <!-- Blank for spacing -->
		</div>
		<div class="col-sm-8 text-left content-div">
	  <!-- ALL CONTENT GOES INSIDE THIS DIV -->
	  	  <table border="1" align="center" class="display-table">
	
			<tr>
				<th>ID</th>
				<th>Address</th>
				<th>Suburb</th>
				<th>Type</th>
				<th>Bedrooms</th>
				<th>Bathrooms</th>
				<th>Car Parks</th>
				<th colspan="2">Options</th>
			</tr>

			<?php
				while ($row = oci_fetch_array($stmt)) {
			?>
			<tr>
				<td><?php echo $row["PROPERTY_ID"] ?></td>
				<td><?php echo $row["PROPERTY_ADDRESS"] ?></td>
				<td><?php echo $row["PROPERTY_SUBURB"] ?></td>
				<?php
					$query = "SELECT * FROM PropertyType WHERE type_id = :type_id";
					$stmt2 = oci_parse($conn, $query);
					oci_bind_by_name($stmt2, ":type_id", $row["TYPE_ID"]);
					oci_execute($stmt2);
					$type = oci_fetch_array($stmt2);
					oci_free_statement($stmt2);
				?>
				<td><?php echo $type["TYPE_NAME"] ?></td>
				<td><?php echo $row["PROPERTY_BEDROOMS"] ?></td>
				<td><?php echo $row["PROPERTY_BATHROOMS"] ?></td>
				<td><?php echo $row["PROPERTY_CARPARKS"] ?></td>
				<td><a href="edit_property.php?propertyid=<?php echo $row["PROPERTY_ID"] ?>&Action=Update">Update</a></td>
				<td><a href="edit_property.php?propertyid=<?php echo $row["PROPERTY_ID"] ?>&Action=Delete">Delete</a></td>
			</tr>
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
