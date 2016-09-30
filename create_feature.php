<?php 
// Start output buffering
ob_start();

include("checklogin.php");

// Include the connection file
include("connection.php");

// Connect to the Oracle database
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Unable to login to database.");	
?>
<html lang="en">
<head>
 
  <title>RRE - Create Feature</title>
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
	  	  <h1 class="page-title">Create A Feature</h1>
	  	  
			<?php 
				if (empty($_POST["name"])) {
			?>
  	  	
	  	  	<!-- Create Feature form -->
	  	  	<form id="Feature-form" class="edit-form" method="post" action="create_feature.php" onsubmit="return validateForm(this)">
			<fieldset>
			<table align="center" cellpadding="3">
				<tr>
					<td><b><label for="name">Name</label></b></td>
					<td><input type="text" name="name" size="30" required></td>
				</tr>
				<tr>
					<td><b><label for="desc">Description</label></b></td>
					<td><input type="text" name="desc" size="250"></td>
				</tr>
				
			</table><br />
			</fieldset>
			
			<table align="center">
				<tr>
					<td><input type="submit" value="Create Feature"></td>
				</tr>
			</table>
			
			</form>
	  	  	
	  	  	<script language="javascript">
			// Form validation function
			$("#Feature-form").validate();
			</script>

	  	  	<?php
				} else {
					// Else, try to create the Feature
					$query = "INSERT INTO Feature VALUES (feature_seq.nextval, '".$_POST["name"]."', '".$_POST["desc"]."')";
					$stmt = oci_parse($conn, $query);
					
					if (@oci_execute($stmt)) {
						// If the insert was successful
						echo "<p>";
						echo "The Feature '".$_POST["name"]."' was successfully created.";
						echo "</p>";
						echo "<p><a href='feature.php'>Return to Feature Page</a></p>";
					} else {
						// If the insert failed
						echo "<p>";
						echo "Error: the Feature could not be inserted.";
						echo "</p>";
						echo "<p><a href='feature.php'>Return to Feature Page</a></p>";
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
