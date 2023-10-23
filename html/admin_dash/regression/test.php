<?php 

$path1 = $_SERVER['DOCUMENT_ROOT']; 
$path1 .= "/Login/dbcon.php";
include($path1);
  // Load the polynomial regression class. 
  require_once( 'RootDirectory.inc.php' ); 
  require_once( $RootDirectory . 'Includes/PolynomialRegression/PolynomialRegression.php' ); 

  //query to get data from the table
$query = "SELECT id, plastic FROM Waste_collected_per_month ORDER BY id;";

//execute query
//$result = $mysqli->query($query);
$result = mysqli_query($con,$query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = array($row["id"],$row["plastic"]);
}

//echo $data[0][0];
//echo $data[0][1];
print json_encode($data); 

  /*$data = 
    array 
    ( 
      array( 1, 139 ), array( 2, 115 ), 
      array( 3, 130 ), array( 4, 170 ), 
      array( 5, 102  ), array( 6, 132  ), 
      array( 7, 165 ), array( 8, 129 ), 
      array( 9, 228 ), array( 10, 141 ), 
      array( 11, 137), array( 12, 213 ), 
      array( 13, 230 ), array( 14, 117 ), 
      array( 15, 241 ), array( 16, 198 ), 
      array( 17, 186 ), array( 18, 217 ), 
      array( 19, 219 ), array( 20, 211 ), 
      array( 21, 204 ), array( 22, 179 ), 
      array( 23, 175 ), array( 24, 183 )
    ); */

  // Precision digits in BC math. 
  bcscale( 10 ); 

  // Start a regression class of order 2--linear regression. 
  $PolynomialRegression = new PolynomialRegression( 2 ); 

  // Add all the data to the regression analysis. 
  foreach ( $data as $dataPoint ) 
    $PolynomialRegression->addData( $dataPoint[ 0 ], $dataPoint[ 1 ] ); 

  // Get coefficients for the polynomial. 
  $coefficients = $PolynomialRegression->getCoefficients(); 

  // Print slope and intercept of linear regression. 
  echo "Slope : " . round( $coefficients[ 1 ], 2 ) . "<br />"; 
  echo "Y-intercept : " . round( $coefficients[ 0 ], 2 ) . "<br />"; 
  
  $m = round( $coefficients[ 1 ], 2 );
  $c = round( $coefficients[ 0 ], 2 );
  
  echo $m. "<br />";
  echo $c. "<br />";
  
  $x = 78;
 
  
  $y=0;
   for($x=0;$x<83;$x++)
   {
	   $y = $m*$x + $c;
	   echo $x."   -  ".$y. "<br />";
   }
 
?>
