<?php 
// Start output buffering
ob_start();

include("checklogin.php");

include("getselect.php");

include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

// Select the record to edit
$query = "SELECT * FROM Property WHERE property_id = ".$_GET["id"];
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
$row = oci_fetch_array($stmt);

// Select the listing to edit
$query = "SELECT * FROM Listing WHERE property_id = ".$_GET["id"];
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
$listing = oci_fetch_array($stmt);

// Select the seller
$query = "SELECT * FROM Seller WHERE seller_id = ".$listing["SELLER_ID"];
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
$seller = oci_fetch_array($stmt);

// Select the current PropertyType record
$query = "SELECT * FROM PropertyType WHERE type_id=".$row["TYPE_ID"];
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
$ptype = oci_fetch_array($stmt);

// Select all PropertyType records
$query = "SELECT * FROM PropertyType ORDER BY type_name";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);

$imagedir = dirname($_SERVER["SCRIPT_FILENAME"])."/images";

$dir = opendir($imagedir);
?>
<html lang="en">
<head>
 
  <title>RRE - Edit Property</title>
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

<script language="javascript">
	// Function to confirm deletion of a record
	function confirm_delete() {
		// Refresh the page with the ConfirmDelete action
		window.location='edit_property.php?id=<?php echo $_GET["id"]; ?>&Action=ConfirmDelete';
	}
</script>

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

		  <center><h1 class="page-title">Edit Property</h1></center>
		  
			<?php
			switch($_GET["Action"]) {
		
			// Update Case
			case "Update":
				
			?>
			
			<form id="property-form" class="edit-form" method="post" action="edit_property.php?id=<?php echo $_GET["id"]; ?>&Action=ConfirmUpdate" onsubmit="return validateForm(this)">
			<fieldset>
			<table align="center" cellpadding="3" class="edit-table">
				<tr>
					<td><b>ID</b></td>
					<td><?php echo $row["PROPERTY_ID"]; ?></td>
				</tr>
				<tr>
					<td><b><label for="address">Address</label></b></td>
					<td><input type="text" name="address" size="50" value="<?php echo $row["PROPERTY_ADDRESS"]; ?>" required></td>
				</tr>
				<tr>
					<td><b><label for="suburb">Suburb</label></b></td>
					<td><input type="text" name="suburb" size="30" value="<?php echo $row["PROPERTY_SUBURB"]; ?>" required></td>
				</tr>
				<tr>
					<td><b><label for="type">Type</label></b></td>
					<td><select name="type">
						<?php
							while ($types = oci_fetch_array($stmt)) {
						?>

						<option value="<?php echo $types["TYPE_ID"]; ?>"
						<?php echo getselect($row["TYPE_ID"], $types["TYPE_ID"]); ?>
						>
						<?php echo $types["TYPE_NAME"]; ?>
						</option>
					
				<?php	
				}
				?>
					</select></td>
				</tr>
				<tr>
					<td><b><label for="bedrooms">Bedrooms</label></b></td>
					<td><input type="number" name="bedrooms" min="0" value="<?php echo $row["PROPERTY_BEDROOMS"]; ?>" required></td>
				</tr>
				<tr>
					<td><b><label for="bathrooms">Bathrooms</label></b></td>
					<td><input type="number" name="bathrooms" min="0" value="<?php echo $row["PROPERTY_BATHROOMS"]; ?>" required></td>
				</tr>
				<tr>
					<td><b><label for="carparks">Carparks</label></b></td>
					<td><input type="number" name="carparks" min="0" value="<?php echo $row["PROPERTY_CARPARKS"]; ?>" required></td>
				</tr>
			</table><br />
			
			<h2>Listing Details</h2>
			<table align="center" cellpadding="3" class="edit-table">
				<tr>
					<td><b><label for="description">Description</label></b></td>
					<td><textarea name="description" cols="68" rows="10"><?php echo $listing["LISTING_DESC"]; ?></textarea></td>
				</tr>
				<tr>
					<td><b><label for="seller">Seller</label></b></td>
					<td><select name="seller">
						<?php
						// Select all Seller records
						$query = "SELECT * FROM Seller ORDER BY seller_lname";
						$stmt = oci_parse($conn, $query);
						oci_execute($stmt);	
					
						while ($row = oci_fetch_array($stmt)) {
						?>

							<option value="<?php echo $row["SELLER_ID"]; ?>" <?php echo getselect($seller["SELLER_ID"], $row["SELLER_ID"]); ?>>
							<?php echo $row["SELLER_FNAME"]." ".$row["SELLER_LNAME"]; ?>
							</option>

						<?php	
						}
						?>
					</select></td>
				</tr>
				<tr>
					<td><b><label for="price">Price</label></b></td>
					<td>$<input type="number" name="price" min="0" value="<?php echo $listing["LISTING_PRICE"]; ?>" required /></td>
				</tr>
			</table>
			
			</fieldset>
			
			<table align="center">
				<tr>
					<td><input type="submit" value="Update Property"></td>
					<td><input type="button" value="Cancel" onclick="window.location='property.php'"></td>
				</tr>
			</table>
			
			</form>
	  	  	
	  	  	<script language="javascript">
			// Form validation function
			$("#property-form").validate();
			</script>
			
			<h2>Property Images</h2>
			
			<?php
			// Select all Picture records for the current property
			$query = "SELECT * FROM Picture WHERE property_id = ".$_GET["id"];
			$stmt = oci_parse($conn, $query);
			oci_execute($stmt);
			?>
			
			<!-- Image Display Table -->
			
			<table align="center" cellpadding="3" class="edit-table">
				
				<tr>
					<th>Image</th>
					<th>Filesize</th>
					<th>Delete</th>
				</tr>
				<?php
			  	$results = false;
				while ($images = oci_fetch_array($stmt)) {
					$results = true; 
				?>
				<tr>
					<td><?php echo "<img src='images/".$images["PIC_NAME"]."' alt='".$images["PIC_NAME"]."' class='property-image'><br />"; ?></td>
					<td><?php echo filesize($imagedir."/".$images["PIC_NAME"])." MB" ?></td>
				</tr>
				<?php 
				} 
				?>
				
			</table>
			
			<form id="property-image-form" class="edit-form" method="post" action="edit_property.php?id=<?php echo $_GET["id"]; ?>&Action=UploadImage">
				
			<!-- Upload Image Form -->	
				
			</form>
			<?php
				
			break;
		
			// Confirm Update Case
			case "ConfirmUpdate":
					
			$query = "UPDATE Property SET property_address=:address, property_suburb=:suburb, type_id = :type, property_bedrooms = :bedrooms, property_bathrooms = :bathrooms, property_carparks = :carparks WHERE property_id=".$_GET["id"];
			$stmt = oci_parse($conn, $query);
			oci_bind_by_name($stmt, ":address", $_POST["address"]);
			oci_bind_by_name($stmt, ":suburb", $_POST["suburb"]);
			oci_bind_by_name($stmt, ":type", $_POST["type"]);
			oci_bind_by_name($stmt, ":bedrooms", $_POST["bedrooms"]);
			oci_bind_by_name($stmt, ":bathrooms", $_POST["bathrooms"]);
			oci_bind_by_name($stmt, ":carparks", $_POST["carparks"]);
					
			if (@oci_execute($stmt)) {
				
				// Update Listing
				$query = "UPDATE Listing SET seller_id=".$_POST["seller"].", listing_desc=:description, listing_price=:price WHERE listing_id=".$listing["LISTING_ID"];
				$stmt = oci_parse($conn, $query);
				oci_bind_by_name($stmt, ":description", $_POST["description"]);
				oci_bind_by_name($stmt, ":price", $_POST["price"]);
				
				if (@oci_execute($stmt)) {
					
					// If edit was successful
					echo "Update was successful.";
					echo "<center><input type='button' value='Return' OnClick='window.location=\"property.php\"'></center>";
					
				} else {
					
					// If edit failed
					echo "<p>There was an error updating the selected listing.</p><br />";
					echo "<center><input type='button' value='Return to List' OnClick='window.location=\"property.php\"'></center>";
					
				}
				
			} else {
				
				// If edit failed
				echo "<p>There was an error updating the selected record.</p><br />";
				echo "<center><input type='button' value='Return to List' OnClick='window.location=\"property.php\"'></center>";
				
			}
					
			break;
			
			// Delete Case
			case "Delete":
					
			?>
			
			<table align="center" cellpadding="3" class="edit-table">
				<tr>
					<td><b>ID</b></td>
					<td><?php echo $row["PROPERTY_ID"]; ?></td>
				</tr>
				<tr>
					<td><b>Address</b></td>
					<td><?php echo $row["PROPERTY_ADDRESS"]; ?></td>
				</tr>
				<tr>
					<td><b>Suburb</b></td>
					<td><?php echo $row["PROPERTY_SUBURB"]; ?></td>
				</tr>
				<tr>
					<td><b>Type</b></td>
					<td><?php echo $ptype["TYPE_NAME"]; ?></td>
				</tr>
				<tr>
					<td><b>Bedrooms</b></td>
					<td><?php echo $row["PROPERTY_BEDROOMS"]; ?></td>
				</tr>
				<tr>
					<td><b>Bathrooms</b></td>
					<td><?php echo $row["PROPERTY_BATHROOMS"]; ?></td>
				</tr>
				<tr>
					<td><b>Carparks</b></td>
					<td><?php echo $row["PROPERTY_CARPARKS"]; ?></td>
				</tr>
			</table><br />
			
			<h2>Listing Details</h2>
			<table align="center" cellpadding="3" class="edit-table">
				<tr>
					<td><b>ID</b></td>
					<td><?php echo $listing["LISTING_ID"]; ?></td>
				</tr>
				<tr>
					<td><b>Seller</b></td>
					<td><?php echo $seller["SELLER_FNAME"]." ".$seller["SELLER_LNAME"]; ?></td>
				</tr>
				<tr>
					<td><b>Description</b></td>
					<td><?php echo $listing["LISTING_DESC"]; ?></td>
				</tr>
				<tr>
					<td><b>Price</b></td>
					<td><?php echo "$ ".$listing["LISTING_PRICE"]; ?></td>
				</tr>
			</table><br />
			
			<table align="center">
				<tr>
					<td><input type="button" value="Delete Property" onclick="confirm_delete()"></td>
					<td><input type="button" value="Cancel" onclick="window.location='property.php'"></td>
				</tr>
			</table>
			
			<?php
			
			break;
			
			// Confirm Delete Case
			case "ConfirmDelete":
			
			// Delete the listing
			$query = "DELETE FROM Listing WHERE listing_id=".$listing["LISTING_ID"];
			$stmt = oci_parse($conn, $query);
			
			// Check that the delete happens successfully
			if (@oci_execute($stmt)) {
				// Delete the listing
				$query = "DELETE FROM Property WHERE property_id=".$_GET["id"];
				$stmt = oci_parse($conn, $query);
				if (@oci_execute($stmt)) {
					?>
					<center><p>Successfully deleted the following record: </p></center>
					<br />
					<table align="center" cellpadding="3" class="edit-table">
					<tr>
						<td><b>ID</b></td>
						<td><?php echo $row["PROPERTY_ID"] ?></td>
					</tr>
					<tr>
						<td><b>Address</b></td>
						<td><?php echo $row["PROPERTY_ADDRESS"] ?></td>
					</tr>
					<tr>
						<td><b>Suburb</b></td>
						<td><?php echo $row["PROPERTY_SUBURB"] ?></td>
					</tr>
					<tr>
						<td><b>Type</b></td>
						<td><?php echo $ptype["TYPE_NAME"] ?></td>
					</tr>
					<tr>
						<td><b>Bedrooms</b></td>
						<td><?php echo $row["PROPERTY_BEDROOMS"] ?></td>
					</tr>
					<tr>
						<td><b>Bathrooms</b></td>
						<td><?php echo $row["PROPERTY_BATHROOMS"] ?></td>
					</tr>
					<tr>
						<td><b>Car Parks</b></td>
						<td><?php echo $row["PROPERTY_CARPARKS"] ?></td>
					</tr>
				</table><br />
				<h2>Listing Details</h2>
				<table align="center" cellpadding="3" class="edit-table">
					<tr>
						<td><b>ID</b></td>
						<td><?php echo $listing["LISTING_ID"]; ?></td>
					</tr>
					<tr>
						<td><b>Seller</b></td>
						<td><?php echo $seller["SELLER_FNAME"]." ".$seller["SELLER_LNAME"]; ?></td>
					</tr>
					<tr>
						<td><b>Description</b></td>
						<td><?php echo $listing["LISTING_DESC"]; ?></td>
					</tr>
					<tr>
						<td><b>Price</b></td>
						<td><?php echo $listing["LISTING_PRICE"]; ?></td>
					</tr>
				</table><br />
				
			<?php
				} else {
					echo "<center><p>There was an error deleting the property.</p>";
				}
			
			} else {
				echo "<center><p>There was an error deleting the listing.</p>";
			} 
				echo "<center><input type='button' value='Return to List'OnClick='window.location=\"property.php\"'></center>"; 
			
			break;
			
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
	closedir($dir);
?>