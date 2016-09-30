<?php 
// Start output buffering
ob_start();

include("checklogin.php");

include("getselect.php");

include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

// Select the record to edit
$query = "SELECT * FROM feature WHERE feature_id = ".$_GET["id"];
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
$row = oci_fetch_array($stmt);


?>
<html lang="en">
<head>
 
  <title>RRE - Edit feature</title>
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
		window.location='edit_feature.php?id=<?php echo $_GET["id"]; ?>&Action=ConfirmDelete';
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

		  <center><h1 class="page-title">Edit feature</h1></center>
		  
			<?php
			switch($_GET["Action"]) {
		
			// Update Case
			case "Update":
				
			?>
			
			<form id="feature-form" class="edit-form" method="post" action="edit_feature.php?id=<?php echo $_GET["id"]; ?>&Action=ConfirmUpdate" onsubmit="return validateForm(this)">
			<fieldset>
			<table align="center" cellpadding="3">
				<tr>
					<td><b>ID</b></td>
					<td><?php echo $row["FEATURE_ID"]; ?></td>
				</tr>
				<tr>
					<td><b><label for="name">Name</label></b></td>
					<td><input type="text" name="name" size="30" value="<?php echo $row["FEATURE_NAME"]; ?>" required></td>
				</tr>
				<tr>
					<td><b><label for="desc">Description</label></b></td>
					<td><input type="text" name="desc" size="250" value="<?php echo $row["FEATURE_DESC"]; ?>"></td>
				</tr>
               
			
			</table><br />
			</fieldset>
			
			<table align="center">
				<tr>
					<td><input type="submit" value="Update feature"></td>
					<td><input type="button" value="Cancel" onclick="window.location='feature.php'"></td>
				</tr>
			</table>
			
			</form>
	  	  	
	  	  	<script language="javascript">
			// Form validation function
			$("#feature-form").validate();
			</script>
			
			<?php
				
			break;
		
			// Confirm Update Case
			case "ConfirmUpdate":
					
			$query = "UPDATE feature set FEATURE_NAME = '".$_POST["name"]."', FEATURE_DESC = '".$_POST["desc"]."' WHERE FEATURE_ID=".$_GET["id"];
			$stmt = oci_parse($conn, $query);
			oci_bind_by_name($stmt, ":name", $_POST["name"]);
            oci_bind_by_name($stmt, ":desc", $_POST["desc"]);
			if (@oci_execute($stmt)) {
				
				// If edit was successful
				echo "Update was successful.";
				echo "<center><input type='button' value='Return' OnClick='window.location=\"feature.php\"'></center>";
				
			} else {
				
				// If edit failed
				echo "<p>There was an error updating the selected record.</p><br />";
				echo "<center><input type='button' value='Return to List' OnClick='window.location=\"feature.php\"'></center>";
				
			}
					
			break;
			
			// Delete Case
			case "Delete":
					
			?>
			
			<table align="center" cellpadding="3">
				<tr>
					<td><b>ID</b></td>
					<td><?php echo $row["FEATURE_ID"]; ?></td>
				</tr>
				<tr>
					<td><b>First name</b></td>
					<td><?php echo $row["FEATURE_NAME"]; ?></td>
				</tr>
				<tr>
					<td><b>Last name</b></td>
					<td><?php echo $row["FEATURE_DESC"]; ?></td>
				</tr>
			</table><br />
			
			<table align="center">
				<tr>
					<td><input type="button" value="Delete feature" onclick="confirm_delete()"></td>
					<td><input type="button" value="Cancel" onclick="window.location='feature.php'"></td>
				</tr>
			</table>
			
			<?php
			
			break;
			
			// Confirm Delete Case
			case "ConfirmDelete":
			
			$query = "DELETE FROM feature WHERE FEATURE_ID=".$_GET["id"];
			$stmt = oci_parse($conn, $query);
			//echo $query;
			// Check that the delete happens successfully
			if (@oci_execute($stmt)) {
				?>
				<center><p>Successfully deleted the following record: </p></center>
				<br />
				<table align="center" cellpadding="3">
				<tr>
					<td><b>ID</b></td>
					<td><?php echo $row["FEATURE_ID"] ?></td>
				</tr>
				<tr>
					<td><b>First name</b></td>
					<td><?php echo $row["FEATURE_NAME"] ?></td>
				</tr>
				<tr>
					<td><b>Last name</b></td>
					<td><?php echo $row["FEATURE_DESC"] ?></td>
				</tr>
			</table>
			<?php
		} else {
			echo "<center>Error deleting feature. Check that no listings use the feature.";
		} 
		echo "<center><input type='button' value='Return to List'
OnClick='window.location=\"feature.php\"'>
</center>"; 
			
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

