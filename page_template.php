<?php 
// Start output buffering
ob_start();

include("checklogin.php");

?>
<html lang="en">
<head>
 
  <title>PAGE TITLE</title>
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
	  	  <br />
		  <h1>Title</h1>
		  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur maximus feugiat ligula, ut consectetur neque volutpat sit amet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus orci dui, euismod quis pharetra in, ornare quis est. Aenean elementum porta felis, ut laoreet risus tristique sed. Donec finibus at nunc vitae ultricies. Sed eget accumsan lacus. Donec aliquam odio est, ac pulvinar massa pharetra nec. Quisque commodo purus a ante tincidunt rutrum. Etiam fringilla pharetra pretium. Aliquam laoreet ipsum eu est consectetur, id placerat eros lacinia. Duis quis congue urna. Ut condimentum dolor eget dignissim dapibus. Nunc vel varius purus, sit amet rhoncus ante.</p>
		  <br />
		  <hr />
		  <br />
		  <h2>Subheading</h2>
		  <p>Proin consectetur est vel dignissim fermentum. Maecenas consequat erat mollis feugiat aliquet. Nunc faucibus id tortor non tristique. Sed ut lacus vitae est rutrum sagittis in a lacus. Ut tempus imperdiet neque, in faucibus metus ullamcorper ac. Morbi nisl ligula, dapibus laoreet tristique quis, tempus hendrerit turpis. Aliquam erat volutpat. Maecenas mi felis, consequat vitae dapibus sollicitudin, dapibus ut tellus. Nulla non volutpat massa, sed hendrerit metus. Suspendisse pretium bibendum justo, eget aliquam ligula ultrices eu. Ut euismod molestie ante vel condimentum. Curabitur in pretium metus, eget varius elit. Aliquam erat volutpat. Nunc dapibus tellus sit amet blandit dignissim. Suspendisse auctor turpis ut tempor auctor. Sed egestas purus vitae varius cursus.

</p>
		</div>
		<div class="col-sm-2 sidenav">
		  <!-- Blank for spacing -->
		</div>
	</div>
</div>

<?php include("footer.php"); ?>

</body>
</html>

