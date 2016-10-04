<?php
include("checklogin.php");

echo "<h1>Display Source</h1>";

if (isset($_GET["page"]) && $_GET["page"] != "") {
	
	echo "<h2>".$_GET["page"]."</h2>";
	echo highlight_file($_GET["page"]);
	
} else {
	
	echo "<p>No page provided - displaying code for display_source.php.</p>"
	echo highlight_file("display_source.php");
	
}
?>