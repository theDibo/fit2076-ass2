<?php 
// Start output buffering
ob_start();

include("checklogin.php");

include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

// 
$query = "SELECT * FROM Seller WHERE SELLER_MAILING = 'Y'";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);
?>

<html lang="en">
<head>
 
  <title>RRE - Features</title>
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
	  <h1 class="page-title">Send Mail to Sellers</h1>
  <?php
    if (!isset($_POST["subject"]))
    {
 ?>
      <form method="post" action="sellers_email.php">
        <table border="0" width="100%">
        <tr>
          <td>Subject</td>
          <td>
            <input type="text" name="subject" size="60">
          </td>
        </tr>
        <tr>
          <td>Message</td>
          <td valign="top" align="left">
            <textarea cols="68" name="message" rows="10"></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="2"><br /><br />
            <input type="submit" value="Send Email">
            <input type="reset" value="Reset">
          </td>
        </tr>
        </table>
      </form>
<?php
    }
    else
    {
      $from = "From: The Employee <hnpha5@student.monash.edu.au>";
      while ($row = oci_fetch_array($stmt)){
          $adresses[] = $row['SELLER_EMAIL']; 
      }
        
        $to = implode(",",$adresses);
        
        $msg =  $_POST["message"];
      $subject = $_POST["subject"];
      if(mail($to, $subject, $msg, $from))
      {
        echo "Mail Sent";
?>
        <form action="sellers.php">
        <input type="submit" value="Go back to sellers page" />
        </form>
<?php
      }
      else
      {
        echo "Error Sending Mail";
?>
        <form action="sellers.php">
        <input type="submit" value="Go back to sellers page" />
        </form>
<?php
      }
    }
 ?>	  


		</table>
		</div>
		<div class="col-sm-2 sidenav">
		  <!-- Blank for spacing -->
		</div>
	</div>
</div>

<a href="display_source.php?page=sellers_email.php" target="_blank"><img src="images/client.png" alt="client"/></a>

<?php include("footer.php"); ?>

</body>
</html>

<?php
	oci_free_statement($stmt);
	oci_close($conn);
?>