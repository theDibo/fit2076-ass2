<?php 
// Start output buffering
ob_start();
include("checklogin.php");
include("connection.php");
$conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");

define('FPDF_FONTPATH','FPDF/font/');
  require('FPDF/fpdf.php');
  
  class XFPDF extends FPDF
  {
    function FancyTable($header,$data)
    {
      $this->SetFillColor(255,0,0);       
      $this->SetTextColor(255,255,255);   
      $this->SetDrawColor(128,0,0);      
      $this->SetLineWidth(.3);        
      $this->SetFont('','B');
      $w=array(10,25,25,50,40,25,20,20,40,15);

      $this->Cell($w[0],9,'ID',1,0,'C',1);
        $this->Cell($w[1],9,'First name',1,0,'C',1);
        $this->Cell($w[2],9,'Last name',1,0,'C',1);
        $this->Cell($w[3],9,'Address',1,0,'C',1);
        $this->Cell($w[4],9,'Suburb',1,0,'C',1);
        $this->Cell($w[5],9,'State',1,0,'C',1);
        $this->Cell($w[6],9,'Phone',1,0,'C',1);
        $this->Cell($w[7],9,'Mobile',1,0,'C',1);
        $this->Cell($w[8],9,'Email',1,0,'C',1);
        $this->Cell($w[9],9,'Mailing',1,0,'C',1);
        
      $this->Ln();
      $this->SetFillColor(224,235,255);
      $this->SetTextColor(0,0,0);     
      $this->SetFont('');         
      $fill=0;
      
      foreach($data as $row)
      {
        $this->Cell($w[0],7,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],7,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],7,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[3],7,$row[3],'LR',0,'L',$fill);
        $this->Cell($w[4],7,$row[4],'LR',0,'L',$fill);
        $this->Cell($w[5],7,$row[5],'LR',0,'L',$fill);
        $this->Cell($w[6],7,$row[6],'LR',0,'L',$fill);
        $this->Cell($w[7],7,$row[7],'LR',0,'L',$fill);
        $this->Cell($w[8],7,$row[8],'LR',0,'L',$fill);
          $this->Cell($w[9],7,$row[9],'LR',0,'L',$fill);
        $this->Ln();
        $fill=!$fill;
      } 
      $this->Cell(array_sum($w),0,'','T'); 
    }
  }
  
  include("connection.php");
  $conn = oci_connect($UName, $PWord, $DB)
	or die("Error: Couldn't log in to database.");
  $query="SELECT * FROM BUYER ORDER BY BUYER_FNAME";
  $stmt = oci_parse($conn,$query);
  oci_execute($stmt);
  
  $nrows = oci_fetch_all($stmt,$results);

  if ($nrows> 0)
  {
    $data = array();
    $header= array();
    while(list($column_name) = each($results))
    {
      $header[]=$column_name;
    }
    for ($i = 0; $i<$nrows; $i++)
    {
      reset($results);
      $j=0;
      while (list(,$column_value) = each($results))
      {
        $data[$i][$j] = $column_value[$i];
        $j++;
      }
    }
  }
  else
  {
    echo "No Records found";
  }
  oci_free_statement($stmt);
  
  $pdf=new XFPDF();
  $pdf->Open();
  $pdf->SetFont('Arial','',9);
  $pdf->AddPage('L');
  $pdf->FancyTable($header,$data);
  $pdf->Output("buyer_PDF.pdf");

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

$query = "SELECT * FROM BUYER ORDER BY BUYER_ID";
$stmt = oci_parse($conn, $query);
oci_execute($stmt);

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
  	  
  	  <center><h1 class="page-title">Documentation</h1></center>
  	           

            
            
            
            
            
            
		</div>
	</div>
	<div class="col-sm-2 sidenav">
	  <!-- Blank for spacing -->
	</div>
</div>

<?php include("footer.php"); ?>

</body>
</html>

<?php
	oci_free_statement($stmt);
	oci_close($conn);
?>