<?php

$path = $_SERVER['DOCUMENT_ROOT']; 
$path .= "/Login/session.php";
include($path);

$path1 = $_SERVER['DOCUMENT_ROOT']; 
$path1 .= "/Login/dbcon.php";
include($path1);

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
	
	$mtype 		= filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$mregion 		= filter_var($_POST["address"], FILTER_SANITIZE_STRING);
	$muser 		= filter_var($_POST["type"], FILTER_SANITIZE_STRING);

	
	$results = $con->query("INSERT INTO binReqFeedBack_tbl (cemail, lattitude, longitude, biodegradable, platic, paper, glass, BinAvailable, status) VALUES ('$login_email', '$mLat', '$mLng', '$mbio', '$mpl', '$mpa', '$mgl', '$mType', 'Approval_Pending')");
	if (!$results) {  
		  header('HTTP/1.1 500 Error: Could not create marker!'); 
		  exit();
	} 

	exit();
}


################ Continue generating Map XML #################

//Create a new DOMDocument object
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers"); //Create new element node
$parnode = $dom->appendChild($node); //make the node show up 

// Select all the rows in the markers table
$results = $con->query("SELECT * FROM workforceTask_tbl WHERE 1");
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
  
  $newnode->setAttribute("userid", $obj->userID);
  $newnode->setAttribute("binid",$obj->binID);
  $newnode->setAttribute("lat", $obj->latitude);  
  $newnode->setAttribute("lng", $obj->longitude);
  $newnode->setAttribute("type", $obj->taskType);
  $newnode->setAttribute("status", $obj->taskStatus);	
}

echo $dom->saveXML();
//echo $xmlfile;
?>
<?php mysqli_close($con);?>