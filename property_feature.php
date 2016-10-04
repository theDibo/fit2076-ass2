<?php 
// Start output buffering
ob_start();

include("checklogin.php");

include("getselect.php");

include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

$query = "SELECT * FROM Feature ORDER BY FEATURE_ID";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);

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
	  	  
	  	  <?php
			
			// Display the property selection drop-down list
			?>
			
			<form method="get" action="property_feature.php">
				
				<table align="center" class="edit-table">
				
				<tr>
					<th>Select Property</th>
					<td>
						<select name="id">
						
						<option value="">Select a property...</option>
						
						<?php
							// Select all Property records
							$query = "SELECT * FROM Property ORDER BY type_id";
							$stmt = oci_parse($conn, $query);
							oci_execute($stmt);	

							while ($row = oci_fetch_array($stmt)) {
							?>

								<option value="<?php echo $row["PROPERTY_ID"]; ?>" 
								<?php // If there is an id set, use getselect
								if (isset($_GET["id"])) {
								echo getselect($_GET["id"], $row["PROPERTY_ID"]); 
									} ?>>
								<?php echo $row["PROPERTY_ADDRESS"]; ?>
								</option>

							<?php	
							}
							?>

					</select>
					</td>
					<td>
						<input type="submit" value="Go" />
					</td>
				</tr>
				
				</table>
				
			</form>
			
			<?php
			
			if (isset($_GET["id"]) && $_GET["id"] != "") {
				
				// Display the feature selection form
				
			} else {
				
				// No property has been selected
				echo "<p>Please select a property to edit.</p>";
				
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