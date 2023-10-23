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
			$mbio 		= filter_var($_POST["bio"], FILTER_SANITIZE_STRING);
			$mgl 		= filter_var($_POST["glass"], FILTER_SANITIZE_STRING);
			$mpa 		= filter_var($_POST["paper"], FILTER_SANITIZE_STRING);
			$mpl 		= filter_var($_POST["plastic"], FILTER_SANITIZE_STRING);
			$region 	= filter_var($_POST["region"], FILTER_SANITIZE_STRING);
			$email 		= filter_var($_POST["email"], FILTER_SANITIZE_STRING);
			$status 	= filter_var($_POST["status"], FILTER_SANITIZE_STRING);
			$reqid	= filter_var($_POST["reqid"], FILTER_SANITIZE_STRING);
			
		if($region == 'MLB'){
			$userid = 1;
		}
		else if($region == 'KDU'){
			$userid = 2;
		}
		
		$query = mysqli_query($con, "UPDATE binReqFeedBack_tbl SET status='Approved' WHERE reqID = '$reqid'");
		if(!$query)
			{
				header('HTTP/1.1 500 Error: Error!'); 
			}
		

		if($region == 'MLB' && $mpl == 'pl'){
		$i = 0;
		$query = "SELECT binID FROM `bindetail_tbl` WHERE `binID` Like 'MLB-%-PL'";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array( $result )) {
			list($areaID, $no, $type) = explode("-", $row["binID"]);
			if($no >= $i){
				$i = $no;
			}
		}
		
		$x = 0;
		$query1 = "SELECT binID FROM `workforceTask_tbl` WHERE `binID` Like 'MLB-%-PL'";
		$result1 = mysqli_query($con,$query1);
		while($row1 = mysqli_fetch_array( $result1 )) {
			list($areaID1, $no1, $type1) = explode("-", $row1["binID"]);
			if($no1 >= $x){
				$x = $no1;
			}
		}

		if($i>$x){
			$max = $i + 1;
		}
		else if($x>$i){
			$max = $x + 1;
		}
		$tpe = strtoupper($mpl);
		$binid = $region . "-" . $max. "-" .$tpe;
		
		
			$query5 = mysqli_query($con, "INSERT INTO workforceTask_tbl (userID, binID, taskType, latitude, longitude, taskStatus) VALUES ('$userid','$binid', 'Add new bin', '$mLat', '$mLng', 'In Progress')");
			if(!$query5)
			{
				header('HTTP/1.1 500 Error: Could not create marker!'); 
			}
	}
	
	if($region == 'MLB' && $mpa == 'pa'){
		$i = 0;
		$query = "SELECT binID FROM `bindetail_tbl` WHERE `binID` Like 'MLB-%-PA'";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array( $result )) {
			list($areaID, $no, $type) = explode("-", $row["binID"]);
			if($no >= $i){
				$i = $no;
			}
		}
		
		$x = 0;
		$query1 = "SELECT binID FROM `workforceTask_tbl` WHERE `binID` Like 'MLB-%-PA'";
		$result1 = mysqli_query($con,$query1);
		while($row1 = mysqli_fetch_array( $result1 )) {
			list($areaID1, $no1, $type1) = explode("-", $row1["binID"]);
			if($no1 >= $x){
				$x = $no1;
			}
		}

		if($i>$x){
			$max = $i + 1;
		}
		else if($x>$i){
			$max = $x + 1;
		}
		$tpe = strtoupper($mpa);
		$binid = $region . "-" . $max. "-" .$tpe;
		
		$mLat = $mLat + 0.000010;
		$mLng = $mLng + 0.000010;
		
			$query5 = mysqli_query($con, "INSERT INTO workforceTask_tbl (userID, binID, taskType, latitude, longitude, taskStatus) VALUES ('$userid','$binid', 'Add new bin', '$mLat', '$mLng', 'In Progress')");
			if(!$query5)
			{
				header('HTTP/1.1 500 Error: Could not create marker!'); 
			}
	}
	
	if($region == 'MLB' && $mgl == 'gl'){
		$i = 0;
		$query = "SELECT binID FROM `bindetail_tbl` WHERE `binID` Like 'MLB-%-GL'";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array( $result )) {
			list($areaID, $no, $type) = explode("-", $row["binID"]);
			if($no >= $i){
				$i = $no;
			}
		}
		
		$x = 0;
		$query1 = "SELECT binID FROM `workforceTask_tbl` WHERE `binID` Like 'MLB-%-GL'";
		$result1 = mysqli_query($con,$query1);
		while($row1 = mysqli_fetch_array( $result1 )) {
			list($areaID1, $no1, $type1) = explode("-", $row1["binID"]);
			if($no1 >= $x){
				$x = $no1;
			}
		}

		if($i>$x){
			$max = $i + 1;
		}
		else if($x>$i){
			$max = $x + 1;
		}
		$tpe = strtoupper($mgl);
		$binid = $region . "-" . $max. "-" .$tpe;
		
		$mLat = $mLat + 0.000012;
		$mLng = $mLng + 0.000012;
		
			$query5 = mysqli_query($con, "INSERT INTO workforceTask_tbl (userID, binID, taskType, latitude, longitude, taskStatus) VALUES ('$userid','$binid', 'Add new bin', '$mLat', '$mLng', 'In Progress')");
			if(!$query5)
			{
				header('HTTP/1.1 500 Error: Could not create marker!'); 
			}
	}
	
	if($region == 'MLB' && $mbio == 'bio'){
		$i = 0;
		$query = "SELECT binID FROM `bindetail_tbl` WHERE `binID` Like 'MLB-%-BI'";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array( $result )) {
			list($areaID, $no, $type) = explode("-", $row["binID"]);
			if($no >= $i){
				$i = $no;
			}
		}
		
		$x = 0;
		$query1 = "SELECT binID FROM `workforceTask_tbl` WHERE `binID` Like 'MLB-%-BI'";
		$result1 = mysqli_query($con,$query1);
		while($row1 = mysqli_fetch_array( $result1 )) {
			list($areaID1, $no1, $type1) = explode("-", $row1["binID"]);
			if($no1 >= $x){
				$x = $no1;
			}
		}

		if($i>$x){
			$max = $i + 1;
		}
		else if($x>$i){
			$max = $x + 1;
		}
		//$tpe = strtoupper($mbio);
		$binid = $region . "-" . $max. "-" .'BI';
		
		$mLat = $mLat + 0.000015;
		$mLng = $mLng + 0.000015;
		
			$query5 = mysqli_query($con, "INSERT INTO workforceTask_tbl (userID, binID, taskType, latitude, longitude, taskStatus) VALUES ('$userid','$binid', 'Add new bin', '$mLat', '$mLng', 'In Progress')");
			if(!$query5)
			{
				header('HTTP/1.1 500 Error: Could not create marker!'); 
			}
	}
	
	if($region == 'KDU' && $mpl == 'pl'){
		$i = 0;
		$query = "SELECT binID FROM `bindetail_tbl` WHERE `binID` Like 'KDU-%-PL'";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array( $result )) {
			list($areaID, $no, $type) = explode("-", $row["binID"]);
			if($no >= $i){
				$i = $no;
			}
		}
		
		$x = 0;
		$query1 = "SELECT binID FROM `workforceTask_tbl` WHERE `binID` Like 'KDU-%-PL'";
		$result1 = mysqli_query($con,$query1);
		while($row1 = mysqli_fetch_array( $result1 )) {
			list($areaID1, $no1, $type1) = explode("-", $row1["binID"]);
			if($no1 >= $x){
				$x = $no1;
			}
		}

		if($i>$x){
			$max = $i + 1;
		}
		else if($x>$i){
			$max = $x + 1;
		}
		$tpe = strtoupper($mpl);
		$binid = $region . "-" . $max. "-" .$tpe;
		
			$query5 = mysqli_query($con, "INSERT INTO workforceTask_tbl (userID, binID, taskType, latitude, longitude, taskStatus) VALUES ('$userid','$binid', 'Add new bin', '$mLat', '$mLng', 'In Progress')");
			if(!$query5)
			{
				header('HTTP/1.1 500 Error: Could not create marker!'); 
			}
	}
	
	if($region == 'KDU' && $mpa == 'pa'){
		$i = 0;
		$query = "SELECT binID FROM `bindetail_tbl` WHERE `binID` Like 'KDU-%-PA'";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array( $result )) {
			list($areaID, $no, $type) = explode("-", $row["binID"]);
			if($no >= $i){
				$i = $no;
			}
		}
		
		$x = 0;
		$query1 = "SELECT binID FROM `workforceTask_tbl` WHERE `binID` Like 'KDU-%-PA'";
		$result1 = mysqli_query($con,$query1);
		while($row1 = mysqli_fetch_array( $result1 )) {
			list($areaID1, $no1, $type1) = explode("-", $row1["binID"]);
			if($no1 >= $x){
				$x = $no1;
			}
		}

		if($i>$x){
			$max = $i + 1;
		}
		else if($x>$i){
			$max = $x + 1;
		}
		$tpe = strtoupper($mpa);
		$binid = $region . "-" . $max. "-" .$tpe;
		
		$mLat = $mLat + 0.000010;
		$mLng = $mLng + 0.000010;
		
			$query5 = mysqli_query($con, "INSERT INTO workforceTask_tbl (userID, binID, taskType, latitude, longitude, taskStatus) VALUES ('$userid','$binid', 'Add new bin', '$mLat', '$mLng', 'In Progress')");
			if(!$query5)
			{
				header('HTTP/1.1 500 Error: Could not create marker!'); 
			}
	}
	
	if($region == 'KDU' && $mgl == 'gl'){
		$i = 0;
		$query = "SELECT binID FROM `bindetail_tbl` WHERE `binID` Like 'KDU-%-GL'";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array( $result )) {
			list($areaID, $no, $type) = explode("-", $row["binID"]);
			if($no >= $i){
				$i = $no;
			}
		}
		
		$x = 0;
		$query1 = "SELECT binID FROM `workforceTask_tbl` WHERE `binID` Like 'KDU-%-GL'";
		$result1 = mysqli_query($con,$query1);
		while($row1 = mysqli_fetch_array( $result1 )) {
			list($areaID1, $no1, $type1) = explode("-", $row1["binID"]);
			if($no1 >= $x){
				$x = $no1;
			}
		}

		if($i>$x){
			$max = $i + 1;
		}
		else if($x>$i){
			$max = $x + 1;
		}
		$tpe = strtoupper($mgl);
		$binid = $region . "-" . $max. "-" .$tpe;
		
		$mLat = $mLat + 0.000012;
		$mLng = $mLng + 0.000012;
		
			$query5 = mysqli_query($con, "INSERT INTO workforceTask_tbl (userID, binID, taskType, latitude, longitude, taskStatus) VALUES ('$userid','$binid', 'Add new bin', '$mLat', '$mLng', 'In Progress')");
			if(!$query5)
			{
				header('HTTP/1.1 500 Error: Could not create marker!'); 
			}
	}
	
	if($region == 'KDU' && $mbio == 'bio'){
		$i = 0;
		$query = "SELECT binID FROM `bindetail_tbl` WHERE `binID` Like 'KDU-%-BI'";
		$result = mysqli_query($con,$query);
		while($row = mysqli_fetch_array( $result )) {
			list($areaID, $no, $type) = explode("-", $row["binID"]);
			if($no >= $i){
				$i = $no;
			}
		}
		
		$x = 0;
		$query1 = "SELECT binID FROM `workforceTask_tbl` WHERE `binID` Like 'KDU-%-BI'";
		$result1 = mysqli_query($con,$query1);
		while($row1 = mysqli_fetch_array( $result1 )) {
			list($areaID1, $no1, $type1) = explode("-", $row1["binID"]);
			if($no1 >= $x){
				$x = $no1;
			}
		}

		if($i>$x){
			$max = $i + 1;
		}
		else if($x>$i){
			$max = $x + 1;
		}
		//$tpe = strtoupper($mbio);
		$binid = $region . "-" . $max. "-" .'BI';
		
		$mLat = $mLat + 0.000015;
		$mLng = $mLng + 0.000015;
		
			$query5 = mysqli_query($con, "INSERT INTO workforceTask_tbl (userID, binID, taskType, latitude, longitude, taskStatus) VALUES ('$userid','$binid', 'Add new bin', '$mLat', '$mLng', 'In Progress')");
			if(!$query5)
			{
				header('HTTP/1.1 500 Error: Could not create marker!'); 
			}
	}
		

	} 

	exit();
}


################ Continue generating Map XML #################

//Create a new DOMDocument object
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers"); //Create new element node
$parnode = $dom->appendChild($node); //make the node show up 

// Select all the rows in the markers table
$results = $con->query("SELECT * FROM binReqFeedBack_tbl WHERE 1");
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
  
  $newnode->setAttribute("binid", $obj->reqID);
  $newnode->setAttribute("email",$obj->cemail);
  $newnode->setAttribute("lat", $obj->latitude);  
  $newnode->setAttribute("lng", $obj->longitude);
  $newnode->setAttribute("bio", $obj->biodegradable);
  $newnode->setAttribute("plastic", $obj->plastic);
  $newnode->setAttribute("paper", $obj->paper);
  $newnode->setAttribute("glass", $obj->glass);
  $newnode->setAttribute("status", $obj->status);
  $newnode->setAttribute("confirm", $obj->binconfirm);
  $newnode->setAttribute("region", $obj->region);  
}

echo $dom->saveXML();
//echo $xmlfile;
?>
<?php mysqli_close($con);?>