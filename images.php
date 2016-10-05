<?php 
// Start output buffering
ob_start();

include("checklogin.php");

include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

$imagedir = dirname($_SERVER["SCRIPT_FILENAME"])."/property_images";
$dir = opendir($imagedir);
?>
<html lang="en">
<head>
 
  <title>RRE - Images</title>
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
	  	  
	  	  <?php
			if (!isset($_POST["check"])) {
			// Display the images	
			?>
	  	  
	  	  <form method="post" action="images.php">
	  	  
	  	  <input type="submit" value="Delete selected images" />
	  	  
	  	  	<table border="1" align="center" class="display-table">
	  	  		
	  	  		<tr>
	  	  			<th>Image</th>
	  	  			<th>Filesize</th>
	  	  			<th>Property</th>
	  	  			<th>Delete</th>
	  	  		</tr>
	  	  		
	  	  		<?php
				$imageext = array("jpg", "jpeg", "png", "gif");
				
				$results = false;
				
	  	  		while($file = readdir($dir)) {
					
					if ($file == "." || $file =="..") {
						continue;
					} 
					
					if (!is_dir($file)) {
						
						$ext = pathinfo($file, PATHINFO_EXTENSION);
						// Check that the file is an image
						if (in_array($ext, $imageext)) {
							$results = true;
							echo "<tr>";
							echo "<td><img src='property_images/".$file."' alt='".$file."' class='small-property-image'/></td>";
							echo "<td><p>".ceil(filesize("property_images/".$file) / 1024)." KB</p></td>";
							
							// Select the Picture entry, if it exists
							$query = "SELECT property_id FROM Picture WHERE pic_name = :pfile";
							$stmt = oci_parse($conn, $query);
							$filename = ''.$file;
							oci_bind_by_name($stmt, ":pfile", $filename);
							oci_execute($stmt);
							
							echo "<td><p>";
							
							if ($pic = oci_fetch_array($stmt)) {
								
								// Select the property for the picture
								$query = "SELECT property_address FROM Property WHERE property_id =".$pic["PROPERTY_ID"];
								$stmt = oci_parse($conn, $query);
								oci_execute($stmt);
								$property = oci_fetch_array($stmt);
								
								echo $property["PROPERTY_ADDRESS"];
								
							} else {
								
								echo "Image is not assigned to a property.";
								
							}
							
							echo "</p></td>";
							echo "<td><input type='checkbox' name='check[]' value='".$file."'></td>";
							echo "</tr>";
							
						oci_free_statement($stmt);
						}
						
					}
				}
				if (!$results) {
					echo "<tr><td colspan='4'>No images to display.</td></tr>";
				}
				?>
			</table>
	  	  	
	  	  </form>
				<?php
			} else {
					
				echo "<h2>Deleted Images:</h2>";
				echo "<ul>";

				// Delete the posted images
				foreach($_POST["check"] as $file) {
					
					// Delete the record, if it exists
					$query = "DELETE FROM Picture WHERE pic_name = :pfile";
					$stmt = oci_parse($conn, $query);
					oci_bind_by_name($stmt, ":pfile", $file);
					oci_execute($stmt);

					// Delete the file
					unlink("property_images/".$file);

					echo "<li><p>Image ".$file.".</p></li>";
				}

				echo "</ul>";
				
				echo "<a href='images.php'>Images</a>";
			}
			?>
	  	  
		</div>
		<div class="col-sm-2 sidenav">
		  <!-- Blank for spacing -->
		</div>
	</div>
</div>

<a href="display_source.php?page=images.php" target="_blank"><img src="images/images.png" alt="images"/></a>

<?php include("footer.php"); ?>

</body>
</html>

<?php
	oci_close($conn);
	closedir($dir);
?>