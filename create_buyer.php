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
 
  <title>RRE - Create buyer</title>
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
	  	  <h1 class="page-title">Create A buyer</h1>
	  	  
			<?php 
				if (empty($_POST["fname"])) {
			?>
  	  	
	  	  	<!-- Create buyer form -->
	  	  	<form id="buyer-form" class="edit-form" method="post" action="create_buyer.php" onsubmit="return validateForm(this)">
			<fieldset>
			<table align="center" cellpadding="3">
				<tr>
					<td><b><label for="fname">First name</label></b></td>
					<td><input type="text" name="fname" size="20" required></td>
				</tr>
				<tr>
					<td><b><label for="lname">Last name</label></b></td>
					<td><input type="text" name="lname" size="20" required></td>
				</tr>
				<tr>
					<td><b><label for="address">Address</label></b></td>
					<td><input type="Text" name="address" size="50" required></td>
				</tr>
				<tr>
					<td><b><label for="suburb">Suburb</label></b></td>
					<td><input type="Text" name="suburb" size="30" required></td>
				</tr>
				<tr>
					<td><b><label for="state">State</label></b></td>
					<td><input type="Text" name="state" size="3" required></td>
				</tr>
                <tr>
					<td><b><label for="phone">Phone</label></b></td>
					<td><input type="Text" name="Phone" size="10"></td>
				</tr>
                <tr>
					<td><b><label for="mobile">Mobile</label></b></td>
					<td><input type="Text" name="mobile" size="10"></td>
				</tr>
                <tr>
					<td><b><label for="email">Email</label></b></td>
					<td><input type="text" name="email" size="60" required></td>
				</tr>
                <tr>
					<td><b><label for="mailinglist">Mailing list</label></b></td>
					<td><input type="text" name="mailinglist" size="1" required></td>
				</tr>
			</table><br />
			</fieldset>
			
			<table align="center">
				<tr>
					<td><input type="submit" value="Create buyer"></td>
				</tr>
			</table>
			
			</form>
	  	  	
	  	  	<script language="javascript">
			// Form validation function
			$("#buyer-form").validate();
			</script>

	  	  	<?php
				} else {
					// Else, try to create the buyer
	
					$query = "INSERT INTO buyer VALUES (buyer_seq.nextval, :fname, :lname, :address, :suburb, :state, :phone, :mobile, :email, :mailinglist)";
					$stmt = oci_parse($conn, $query);
					oci_bind_by_name($stmt, ":fname", $_POST["fname"]);
					oci_bind_by_name($stmt, ":lname", $_POST["lname"]);
					oci_bind_by_name($stmt, ":address", $_POST["address"]);
					oci_bind_by_name($stmt, ":suburb", $_POST["suburb"]);
					oci_bind_by_name($stmt, ":state", $_POST["state"]);
                    oci_bind_by_name($stmt, ":phone", $_POST["phone"]);
					oci_bind_by_name($stmt, ":mobile", $_POST["mobile"]);
					oci_bind_by_name($stmt, ":email", $_POST["email"]);
                    oci_bind_by_name($stmt, ":mailinglist", $_POST["mailinglist"]);
					
					if (@oci_execute($stmt)) {
						// If the insert was successful
						echo "<p>";
						echo "The buyer '".$_POST["fname"]."' '".$_POST["lname"]."'  was successfully created.";
						echo "</p>";
						echo "<p><a href='buyer.php'>Return to buyer Page</a></p>";
					} else {
						// If the insert failed
						echo "<p>";
						echo "Error: the buyer could not be inserted.";
						echo "</p>";
						echo "<p><a href='buyer.php'>Return to buyer Page</a></p>";
					}
				}
			?>
		</div>
        <?php
            oci_free_statement($stmt);
            oci_close($conn);
        ?>
		<div class="col-sm-2 sidenav">
		  <!-- Blank for spacing -->
		</div>
	</div>
</div>

<?php include("footer.php"); ?>

</body>
</html>

