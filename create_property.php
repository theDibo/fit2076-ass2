<?php 
// Start output buffering
ob_start();

include("checklogin.php");

// Include the connection file
include("connection.php");

// Connect to the Oracle database
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Unable to login to database.");
	
// Select all PropertyType records
$query = "SELECT * FROM PropertyType ORDER BY type_name";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
?>
<html lang="en">
<head>
 
  <title>RRE - Create Property</title>
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
	  	  <h1 class="page-title">Create New Property</h1>
	  	  
			<?php 
				if (empty($_POST["address"])) {
			?>
  	  	
	  	  	<!-- Create Property form -->
	  	  	<form id="property-form" method="post" action="create_property.php" onsubmit="return validateForm(this)">
			<fieldset>
			<table align="center" cellpadding="3">
				<tr>
					<td><b><label for="address">Address</label></b></td>
					<td><input type="text" name="address" size="50" required></td>
				</tr>
				<tr>
					<td><b><label for="suburb">Suburb</label></b></td>
					<td><input type="text" name="suburb" size="30" required></td>
				</tr>
				<tr>
					<td><b><label for="type">Type</label></b></td>
					<td><select name="type">
						<?php
						while ($row = oci_fetch_array($stmt)) {
						?>

							<option value="<?php echo $row["TYPE_ID"]; ?>">
							<?php echo $row["TYPE_NAME"]; ?>
							</option>

						<?php	
						}
						?>
					</select></td>
				</tr>
				<tr>
					<td><b><label for="bedrooms">Bedrooms</label></b></td>
					<td><input type="number" name="bedrooms" min="0" value="0" required></td>
				</tr>
				<tr>
					<td><b><label for="bathrooms">Bathrooms</label></b></td>
					<td><input type="number" name="bathrooms" min="0" value="0" required></td>
				</tr>
				<tr>
					<td><b><label for="carparks">Carparks</label></b></td>
					<td><input type="number" name="carparks" min="0" value="0" required></td>
				</tr>
			</table><br />
			</fieldset>
			
			<table align="center">
				<tr>
					<td><input type="submit" value="Create Property"></td>
				</tr>
			</table>
			
			</form>
	  	  	
	  	  	<script language="javascript">
			// Form validation function
			$("#property-form").validate();
			</script>

	  	  	<?php
				} else {
					// Else, try to create the property
	
					$query = "INSERT INTO Property VALUES (property_seq.nextval, :address, :suburb, ".$_POST["type"].", :bedrooms, :bathrooms, :carparks)";
					$stmt = oci_parse($conn, $query);
					oci_bind_by_name($stmt, ":address", $_POST["address"]);
					oci_bind_by_name($stmt, ":suburb", $_POST["suburb"]);
					oci_bind_by_name($stmt, ":bedrooms", $_POST["bedrooms"]);
					oci_bind_by_name($stmt, ":bathrooms", $_POST["bathrooms"]);
					oci_bind_by_name($stmt, ":carparks", $_POST["carparks"]);
					
					if (@oci_execute($stmt)) {
						// If the insert was successful
						echo "<p>";
						echo "The property at address '".$_POST["address"]."' was successfully created.";
						echo "</p>";
						echo "<p><a href='property.php'>Return to Property Page</a></p>";
					} else {
						// If the insert failed
						echo "<p>";
						echo "Error: the property could not be inserted.";
						echo "</p>";
						echo "<p><a href='property.php'>Return to Property Page</a></p>";
					}
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