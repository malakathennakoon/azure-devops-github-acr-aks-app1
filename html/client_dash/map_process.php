<?php

include("../Login/dbcon.php");

if (mysqli_connect_errno()) 
{
	header('HTTP/1.1 500 Error: Could not connect to db!'); 
	exit();
}

################ Save & delete markers #################
if($_POST) //run only if there's a post data
{
	//make sure request is comming from Ajax
	$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
	if (!$xhr){ 
		header('HTTP/1.1 500 Error: Request must come from Ajax!'); 
		exit();	
	}
	
	// get marker position and split it for database
	$mLatLang	= explode(',',$_POST["latlang"]);
	$mLat 		= filter_var($mLatLang[0], FILTER_VALIDATE_FLOAT);
	$mLng 		= filter_var($mLatLang[1], FILTER_VALIDATE_FLOAT);
	
	//Delete Marker
	if(isset($_POST["del"]) && $_POST["del"]==true)
	{
		$results = $con->query("DELETE FROM bindetail_tbl WHERE latitude=$mLat AND longitude=$mLng");
		if (!$results) {  
		  header('HTTP/1.1 500 Error: Could not delete Markers!'); 
		  exit();
		} 
		exit("Done!");
	}
	
	$mName 		= filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$mAddress 	= filter_var($_POST["address"], FILTER_SANITIZE_STRING);
	$mType		= filter_var($_POST["type"], FILTER_SANITIZE_STRING);
	
	$results = $con->query("INSERT INTO bindetail_tbl (binID, areaName, latitude, longitude, Status) VALUES ('$mName','$mAddress',$mLat, $mLng, '$mType')");
	if (!$results) {  
		  header('HTTP/1.1 500 Error: Could not create marker!'); 
		  exit();
	} 
	
	$output = '<h1 class="marker-heading">'.$mName.'</h1><p>'.$mAddress.'</p>';
	exit($output);
}


################ Continue generating Map XML #################

//Create a new DOMDocument object
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers"); //Create new element node
$parnode = $dom->appendChild($node); //make the node show up 

// Select all the rows in the markers table
$results = $con->query("SELECT * FROM bindetail_tbl WHERE 1");
if (!$results) {  
	header('HTTP/1.1 500 Error: Could not get markers!'); 
	exit();
} 

//set document header to text/xml
header("Content-type: text/xml"); 

// Iterate through the rows, adding XML nodes for each
while($obj = $results->fetch_object())
{
  $node = $dom->createElement("marker");  
  $newnode = $parnode->appendChild($node);
  
  $newnode->setAttribute("binid", $obj->binID);
  $newnode->setAttribute("areaname",$obj->areaName);
  $newnode->setAttribute("areaid", $obj->areaID);
  $newnode->setAttribute("filedlevel", $obj->filedLevel);
  $newnode->setAttribute("lat", $obj->latitude);  
  $newnode->setAttribute("lng", $obj->longitude);  
  $newnode->setAttribute("status", $obj->Status);	
}

echo $dom->saveXML();
//echo $xmlfile;
?>
<?php mysqli_close($con);?>