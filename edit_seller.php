<?php 
// Start output buffering
ob_start();

include("checklogin.php");

include("getselect.php");

include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

// Select the record to edit
$query = "SELECT * FROM Seller WHERE seller_id = ".$_GET["id"];
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
$row = oci_fetch_array($stmt);


?>
<html lang="en">
<head>
 
  <title>RRE - Edit seller</title>
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
		window.location='edit_seller.php?id=<?php echo $_GET["id"]; ?>&Action=ConfirmDelete';
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

		  <center><h1 class="page-title">Edit seller</h1></center>
		  
			<?php
			switch($_GET["Action"]) {
		
			// Update Case
			case "Update":
				
			?>
			
			<form id="seller-form" class="edit-form" method="post" action="edit_seller.php?id=<?php echo $_GET["id"]; ?>&Action=ConfirmUpdate" onsubmit="return validateForm(this)">
			<fieldset>
			<table align="center" cellpadding="3">
				<tr>
					<td><b>ID</b></td>
					<td><?php echo $row["SELLER_ID"]; ?></td>
				</tr>
				<tr>
					<td><b><label for="fname">First name</label></b></td>
					<td><input type="text" name="fname" size="20" value="<?php echo $row["SELLER_FNAME"]; ?>" required></td>
				</tr>
				<tr>
					<td><b><label for="lname">Last name</label></b></td>
					<td><input type="text" name="lname" size="20" value="<?php echo $row["SELLER_LNAME"]; ?>" required></td>
				</tr>
                <tr>
					<td><b><label for="address">Address</label></b></td>
					<td><input type="text" name="address" size="50" value="<?php echo $row["SELLER_ADDRESS"]; ?>" required></td>
				</tr>
                <tr>
					<td><b><label for="suburb">Suburb</label></b></td>
					<td><input type="text" name="suburb" size="30" value="<?php echo $row["SELLER_SUBURB"]; ?>" required></td>
				</tr>
                <tr>
					<td><b><label for="state">State</label></b></td>
					<td><input type="text" name="state" size="3" value="<?php echo $row["SELLER_STATE"]; ?>" required></td>
				</tr>
                <tr>
					<td><b><label for="phone">phone</label></b></td>
					<td><input type="text" name="phone" size="10" value="<?php echo $row["SELLER_PHONE"]; ?>" ></td>
				</tr>
                <tr>
					<td><b><label for="mobile">mobile</label></b></td>
					<td><input type="text" name="mobile" size="10" value="<?php echo $row["SELLER_MOBILE"]; ?>" ></td>
				</tr>wa
                <tr>
					<td><b><label for="email">email</label></b></td>
					<td><input type="text" name="email" size="60" value="<?php echo $row["SELLER_EMAIL"]; ?>" required></td>
				</tr>
                <tr>
					<td><b><label for="mailinglist">Mailing list</label></b></td>
					<td><input type="checkbox" name="mailinglist" value = "Yes"></td>
				</tr>
			
			</table><br />
			</fieldset>
			
			<table align="center">
				<tr>
					<td><input type="submit" value="Update Seller"></td>
					<td><input type="button" value="Cancel" onclick="window.location='SELLERS.php'"></td>
				</tr>
			</table>
			
			</form>
	  	  	
	  	  	<script language="javascript">
			// Form validation function
			$("#seller-form").validate();
			</script>
			
			<?php
				
			break;
		
			// Confirm Update Case
			case "ConfirmUpdate":
                
            if(isset($_POST['mailinglist']) &&  $_POST['mailinglist'] == 'Yes') 
            {
                $mail = 'Y';
            }
            else
            {
                $mail = 'N';
            } 
					
			$query = "UPDATE SELLER set SELLER_FNAME = :fname, SELLER_LNAME = :lname, SELLER_ADDRESS = :address, SELLER_SUBURB = :suburb, SELLER_STATE = :state, SELLER_PHONE = :phone, SELLER_MOBILE = :mobile, SELLER_EMAIL = :email, SELLER_MAILING = '$mail' WHERE SELLER_ID= ".$_GET["id"];
			$stmt = oci_parse($conn, $query);
			oci_bind_by_name($stmt, ":fname", $_POST["fname"]);
            oci_bind_by_name($stmt, ":lname", $_POST["lname"]);
            oci_bind_by_name($stmt, ":address", $_POST["address"]);
            oci_bind_by_name($stmt, ":suburb", $_POST["suburb"]);
            oci_bind_by_name($stmt, ":state", $_POST["state"]);
            oci_bind_by_name($stmt, ":phone", $_POST["phone"]);
            oci_bind_by_name($stmt, ":mobile", $_POST["mobile"]);
            oci_bind_by_name($stmt, ":email", $_POST["email"]);
					
			if (@oci_execute($stmt)) {
				
				// If edit was successful
				echo "Update was successful.";
				echo "<center><input type='button' value='Return' OnClick='window.location=\"sellers.php\"'></center>";
				
			} else {
				
				// If edit failed
				echo "<p>There was an error updating the selected record.</p><br />";
				echo "<center><input type='button' value='Return to List' OnClick='window.location=\"sellers.php\"'></center>";
				
			}
					
			break;
			
			// Delete Case
			case "Delete":
					
			?>
			
			<table align="center" cellpadding="3">
				<tr>
					<td><b>ID</b></td>
					<td><?php echo $row["SELLER_ID"]; ?></td>
				</tr>
				<tr>
					<td><b>First name</b></td>
					<td><?php echo $row["SELLER_FNAME"]; ?></td>
				</tr>
				<tr>
					<td><b>Last name</b></td>
					<td><?php echo $row["SELLER_LNAME"]; ?></td>
				</tr>
				<tr>
					<td><b>Address</b></td>
					<td><?php echo $row["SELLER_ADDRESS"]; ?></td>
				</tr>
				<tr>
					<td><b>Suburb</b></td>
					<td><?php echo $row["SELLER_SUBURB"]; ?></td>
				</tr>
				<tr>
					<td><b>State</b></td>
					<td><?php echo $row["SELLER_STATE"]; ?></td>
				</tr>
                <tr>
					<td><b>Phone</b></td>
					<td><?php echo $row["SELLER_PHONE"]; ?></td>
				</tr>
                <tr>
					<td><b>Mobile</b></td>
					<td><?php echo $row["SELLER_MOBILE"]; ?></td>
				</tr>
                <tr>
					<td><b>Email</b></td>
					<td><?php echo $row["SELLER_EMAIL"]; ?></td>
				</tr>
                <tr>
					<td><b>Mailing List</b></td>
					<td><?php echo $row["SELLER_MAILING"]; ?></td>
				</tr>
			</table><br />
			
			<table align="center">
				<tr>
					<td><input type="button" value="Delete SELLER" onclick="confirm_delete()"></td>
					<td><input type="button" value="Cancel" onclick="window.location='SELLERS.php'"></td>
				</tr>
			</table>
			
			<?php
			
			break;
			
			// Confirm Delete Case
			case "ConfirmDelete":
			
			$query = "DELETE FROM SELLER WHERE SELLER_ID=".$_GET["id"];
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
					<td><?php echo $row["SELLER_ID"] ?></td>
				</tr>
				<tr>
					<td><b>First name</b></td>
					<td><?php echo $row["SELLER_FNAME"] ?></td>
				</tr>
				<tr>
					<td><b>Last name</b></td>
					<td><?php echo $row["SELLER_LNAME"] ?></td>
				</tr>
				<tr>
					<td><b>Address</b></td>
					<td><?php echo $ptype["SELLER_ADDRESS"] ?></td>
				</tr>
				<tr>
					<td><b>Suburb</b></td>
					<td><?php echo $row["SELLER_SUBURB"] ?></td>
				</tr>
				<tr>
					<td><b>State</b></td>
					<td><?php echo $row["SELLER_STATE"] ?></td>
				</tr>
			</table>
			<?php
		} else {
			echo "<center>Error deleting seller. Check that no listings use the seller.";
		} 
		echo "<center><input type='button' value='Return to List'
OnClick='window.location=\"sellers.php\"'>
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

