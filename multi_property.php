<?php 
// Start output buffering
ob_start();

include("checklogin.php");

include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

// Select all property records
$query = "SELECT * FROM Property ORDER BY type_id";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);

?>
<html lang="en">
<head>
 
  <title>RRE - Multi-Property Edit</title>
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
	  	  	<h1 class="page-title">Multi-Property Edit</h1>
			
			<?php 
			if (!isset($_GET["Action"]) || $_GET["Action"] != "Update") {
			?>
			
			<form id="mproperty-form" class="edit-form" method="post" action="multi_property.php?Action=Update" onsubmit="return validateForm(this)">
			
			<input type="submit" value="Update Prices" />
			
			<table border="1" align="center" class="display-table">
	
			<tr>
				<th>ID</th>
				<th>Address</th>
				<th>Suburb</th>
				<th>Type</th>
				<th>Price</th>
			</tr>

			<?php
			  	$results = false;
				while ($row = oci_fetch_array($stmt)) {
					$results = true;
					
					// Select the listing for the property
					$query = "SELECT listing_id, listing_price FROM Listing WHERE property_id =".$row["PROPERTY_ID"];
					$stmt3 = oci_parse($conn, $query);
					oci_execute($stmt3);
					$listing = oci_fetch_array($stmt3);
			?>
			
			<tr>
				<td><?php echo $row["PROPERTY_ID"] ?></td>
				<td><?php echo $row["PROPERTY_ADDRESS"] ?></td>
				<td><?php echo $row["PROPERTY_SUBURB"] ?></td>
				
				<?php
					$query = "SELECT type_name FROM PropertyType WHERE type_id = :type_id";
					$stmt2 = oci_parse($conn, $query);
					oci_bind_by_name($stmt2, ":type_id", $row["TYPE_ID"]);
					oci_execute($stmt2);
					$type = oci_fetch_array($stmt2);
					oci_free_statement($stmt2);
				?>
				<td><?php echo $type["TYPE_NAME"] ?></td>
				
				<td>$<input type="number" name="<?php echo $row["PROPERTY_ID"]; ?>" min="0" value="<?php echo $listing["LISTING_PRICE"]; ?>" required /></td>
				
			</tr>
			
			<?php }
				if (!$results) {
					echo "<tr><td colspan='5'><p>No properties were found.</p></td></tr>";
				}?>
			</table>
			</form>
			<script language="javascript">
			// Form validation function
			$("#mproperty-form").validate();
			</script>
			
			<?php } else {
				// Update the prices
				while ($row = oci_fetch_array($stmt)) {
					
					$query = "UPDATE Listing SET listing_price=:price WHERE property_id=:id";
					$stmt2 = oci_parse($conn, $query);
					oci_bind_by_name($stmt2, ":price", $_POST[$row["PROPERTY_ID"]]);
					oci_bind_by_name($stmt2, ":id", $row["PROPERTY_ID"]);
					oci_execute($stmt2);
					
				}
				
				echo "<p>Prices were updated.</p>";
				echo "<a href='multi_property.php'>Multi Property Edit</a>";
			}
			?>
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