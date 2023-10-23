<?php 

	$path1 = $_SERVER['DOCUMENT_ROOT']; 
	$path1 .= "/Login/dbcon.php";
	include($path1);
	echo $path1;

	/*$path2 = $_SERVER['DOCUMENT_ROOT']; 
	$path2 .= "/assets/regression/Includes/PolynomialRegression/PolynomialRegression.php";
	include($path2);

	$path3 = $_SERVER['DOCUMENT_ROOT']; 
	$path3 .= "/assets/regression/gl.php";
	include($path3);
	
	$path4 = $_SERVER['DOCUMENT_ROOT']; 
	$path4 .= "/assets/regression/pl.php";
	include($path4);
	
	$path5 = $_SERVER['DOCUMENT_ROOT']; 
	$path5 .= "/assets/regression/bd.php";
	include($path5);*/

	/*$query = "SELECT id, paper FROM Waste_collected_per_month ORDER BY id;";
	$result = mysqli_query($con,$query);

	//loop through the returned data
	$data = array();
	foreach ($result as $row) {
		//if($row["id"]>9 && $row["id"]<69){
		$data[] = array($row["id"],$row["paper"]);
		//}
	}
	
	print json_encode($data); */

  /*
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

  for($xpa = 34; $xpa < 46; $xpa++){
	$ypa = $m + $c*$xpa + $d*$xpa*$xpa ;
	$data1[] = $ypa;
  }

	$ar1= array(1,2,3,4,5,6,7,8,9,10,11,12);
	$month= array('January','February','March','April','May','June','July','August','September','October','November','December');

  $lenght = count($ar1);
  $i = 0;

  while ($i < $lenght) {
    $result5[] = array(
        $month[$i]
        , $data1[$i]
        , $data3[$i]
        , $data2[$i]
		, $data4[$i]
    );
    $i++;
  }

	$tpa = array_sum($data1);
	$tpl = array_sum($data3);
	$tgl = array_sum($data2);
	$tbd = array_sum($data4);
	$ttotal = $tpa + $tpl + $tgl + $tbd;
	
	$d =  date('n');
	$avg1 = 0;
	$avg2 = 0;
	$avg3 = 0;
	$avg4 = 0;
	$avgpa = 0;
	$avgpl = 0;
	$avggl = 0;
	$avgbd = 0;
	$avgpar = 0;
	$avgplr = 0;
	$avgglr = 0;
	$avgbdr = 0;
	for($x1=0;$x1<$d;$x1++){
		$avg1 = $avg1 + $data1[$x1];
		$avg2 = $avg2 + $data3[$x1];
		$avg3 = $avg3 + $data2[$x1];
		$avg4 = $avg4 + $data4[$x1];
		
	}
	$avgpa = $avg1/($d-1);
	$avgpar = (($avgpa-$data1[$d])/$avgpa)*100;
	//echo $avgpa.'<br>';
	//echo $avgpar.'<br>';
	
	$avgpl = $avg2/($d-1);
	$avgplr = (($avgpl-$data3[$d])/$avgpl)*100;
	//echo $avgpl.'<br>';
	//echo $avgplr.'<br>';
	
	$avggl = $avg3/($d-1);
	$avgglr = (($avggl-$data2[$d])/$avggl)*100;
	//echo $avggl.'<br>';
	//echo $avgglr.'<br>';
	
	$avgbd = $avg4/($d-1);
	$avgbdr = (($avgbd-$data4[$d])/$avgbd)*100;
	//echo $avgbd.'<br>';
	//echo $avgbdr.'<br>';

/*foreach ( $result5 as $row ) {
    //echo "[", $var[0],",",$var[1],",",$var[2],",",$var[3],"]" ;
	echo "['".$row[0]."', ".$row[1].", ".$row[2].", ".$row[3].", ".$row[4]."],";
}*/
*/
?>
