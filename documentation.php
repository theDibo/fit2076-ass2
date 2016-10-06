<?php 
// Start output buffering
ob_start();
include("checklogin.php");
include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

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

    <style>
table, th, td {
    border: 1px solid black;
}
th, td {
    padding: 5px;
    text-align: center;
}
th {
    text-align: center;
}
</style>
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
  	  
  	  <center><h1 class="page-title">Documentation</h1></center>
            <center>
            <table style="width:50%">
            <caption><h3>Authors</h3></caption>
                <tr>
                <th>Name</th>
                <th>Student ID</th>
                </tr>
                <tr>
                <td>Ha Nam Anh Pham</td>
                <td>26060167</td>
                </tr>
                <tr>
                <td>Dougulas Rintoul</td>
                <td>26913224</td>
                </tr>
            </table>
            <h4>Date of submission: 7th October, 2016</h4>
            </br>
            <h3>Authcate Details</h3>
            <h4>Username: s26913224</h4>
        <h4>Password: monash00</h4>
        </br>
        <a href="Documentation/CreateTable.pdf"><h3>Click here for the 'Click table' statements</h3></a>
        <a href="Documentation/export.html"><h3>click here for the current data in the database</h3></a>
        <a href="Documentation/WorkBreakdown.pdf"><h3>Click here for the work breakdown</h3></a>
        </center>
		</div>
	</div>
	<div class="col-sm-2 sidenav">
	  <!-- Blank for spacing -->
	</div>
</div>

<?php include("footer.php"); ?>

</body>
</html>