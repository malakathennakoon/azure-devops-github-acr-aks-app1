<?php 

	$path1 = $_SERVER['DOCUMENT_ROOT']; 
	$path1 .= "/Login/dbcon.php";
	include($path1);

	/*$path4 = $_SERVER['DOCUMENT_ROOT']; 
	$path4 .= "/assets/regression/Includes/PolynomialRegression/PolynomialRegression.php";
	include($path4);*/

	$query = "SELECT id, bio FROM Waste_collected_per_month ORDER BY id;";
	$result = mysqli_query($con,$query);

	//loop through the returned data
	$data = array();
	foreach ($result as $row) {
		//if($row["id"]>9 && $row["id"]<69){
		$data[] = array($row["id"],$row["bio"]);
		//}
	}
	
	//print json_encode($data); 

  // Precision digits in BC math. 
  bcscale( 10 ); 

  // Start a regression class with a maximum of 4rd degree polynomial. 
  $polynomialRegression = new PolynomialRegression( 3 ); 

  // Add all the data to the regression analysis. 
  foreach ( $data as $dataPoint ) 
    $polynomialRegression->addData( $dataPoint[ 0 ], $dataPoint[ 1 ] ); 

  // Get coefficients for the polynomial. 
  $coefficients = $polynomialRegression->getCoefficients(); 

  $functionText = "f( x ) = "; 
  foreach ( $coefficients as $power => $coefficient ) 
  { 
    if ( $power > 0 ) 
      $functionText .= " + "; 

    $functionText .= round( $coefficient, 2 ); 

    if ( $power > 0 ) 
    { 
      $functionText .= "x"; 
      if ( $power > 1 ) 
        $functionText .= "^" . $power; 
    } 
  } 

  $m = round( $coefficients[ 0 ], 2 );
  $c = round( $coefficients[ 1 ], 2 );
  $d = round( $coefficients[ 2 ], 2 );
  
  for($xbd = 34; $xbd < 46; $xbd++){
	$ybd = $m + $c*$xbd + $d*$xbd*$xbd ;
	$data4[] = $ybd;
  }

	//print json_encode($data4);



?>
