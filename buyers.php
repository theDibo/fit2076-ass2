<?php 
// Start output buffering
ob_start();

include("checklogin.php");

include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

if (isset($_GET["search"]) && $_GET["search"] != "") {
	// Something has been searched, get matching property records
	$query = "SELECT* FROM BUYER WHERE lower(BUYER_FNAME) LIKE '%' || :search || '%' OR lower(BUYER_LNAME) LIKE '%' || :search || '%' OR lower(BUYER_ADDRESS) LIKE '%' || :search || '%' OR lower(BUYER_SUBURB) LIKE '%' || :search || '%' OR lower(BUYER_STATE) LIKE '%' || :search || '%' ORDER BY BUYER_ID";
	$stmt = oci_parse($conn, $query);
	oci_bind_by_name($stmt,  ":search", $_GET["search"]);
	oci_execute($stmt);
} else {
	// Nothing has been searched, get all property records
	$query = "SELECT * FROM BUYER ORDER BY BUYER_ID";
    $stmt = oci_parse($conn, $query);
    oci_execute($stmt);
}



?>

<html lang="en">
<head>
 
  <title>RRE - Buyers</title>
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
  	  
  	  <center><h1 class="page-title">Buyers</h1></center>
  	  
  	  <div class="col-md-6 col-md-offset-2">
	  <a href="create_buyer.php" class="btn btn-default btn-md col-md-5">Create New Buyer</a>
	  </div>
  	  
	  	  <table border="1" align="center" class="display-table">
	
			<tr>
				<th>ID</th>
				<th>First name</th>
				<th>Last name</th>
				<th>Address</th>
				<th>Suburb</th>
				<th>State</th>
				<th>Phone</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Mailing List</th>
				<th colspan="2">Options</th>
			</tr>

			<?php
				while ($row = oci_fetch_array($stmt)) {
			?>
			<tr>
				<td><?php echo $row["BUYER_ID"] ?></td>
				<td><?php echo $row["BUYER_FNAME"] ?></td>
				<td><?php echo $row["BUYER_LNAME"] ?></td>
				<td><?php echo $row["BUYER_ADDRESS"] ?></td>
				<td><?php echo $row["BUYER_SUBURB"] ?></td>
				<td><?php echo $row["BUYER_STATE"] ?></td>
                <td><?php echo $row["BUYER_PHONE"] ?></td>
                <td><?php echo $row["BUYER_MOBILE"] ?></td>
                <td><?php echo $row["BUYER_EMAIL"] ?></td>
                <td><?php echo $row["BUYER_MAILING"] ?></td>
				<td><a href="edit_BUYER.php?id=<?php echo $row["BUYER_ID"] ?>&Action=Update">Update</a></td>
				<td><a href="edit_BUYER.php?id=<?php echo $row["BUYER_ID"] ?>&Action=Delete">Delete</a></td>
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
