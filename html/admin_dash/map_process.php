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
		/* $results = $con->query("DELETE FROM bindetail_tbl WHERE latitude=$mLat AND longitude=$mLng");
		if (!$results) {  
		  header('HTTP/1.1 500 Error: Could not delete Markers!'); 
		  exit();
		} 
		exit("Done!"); */
		$bid 	= filter_var($_POST["binid"], FILTER_SANITIZE_STRING);
		$areaid 	= filter_var($_POST["areaid"], FILTER_SANITIZE_STRING);
		
		if($areaid == 'MLB'){
			$userid = 1;
		}
		else if($areaid == 'KDU'){
			$userid = 2;
		}
		
		$sql = "INSERT INTO workforceTask_tbl (userID, binID, taskType, latitude, longitude, taskStatus) VALUES ('$userid','$bid', 'Remove a bin', '$mLat', '$mLng', 'In Progress')";
		if (mysqli_query($con, $sql)) 
		  {
			
			$sql1="DELETE FROM binSensor_tbl WHERE binID='$bid';";
			$sql1.="DELETE FROM sensorCheck_tbl WHERE binID='$bid';";
			$sql1.="DELETE FROM sun_binLevel_tbl WHERE binID='$bid';";
			$sql1.="DELETE FROM sat_binLevel_tbl WHERE binID='$bid';";
			$sql1.="DELETE FROM fri_binLevel_tbl WHERE binID='$bid';";
			$sql1.="DELETE FROM thu_binLevel_tbl WHERE binID='$bid';";
			$sql1.="DELETE FROM wen_binLevel_tbl WHERE binID='$bid';";
			$sql1.="DELETE FROM tue_binLevel_tbl WHERE binID='$bid';";
			$sql1.="DELETE FROM mon_binLevel_tbl WHERE binID='$bid';";
			$sql1.="DELETE FROM binLevel_tbl WHERE binID='$bid';";
			$sql1.="DELETE FROM binTotalVolume_tbl WHERE binID='$bid';";
			$sql1.="DELETE FROM bindetail_tbl WHERE binID='$bid'";

			if (mysqli_multi_query($con,$sql1))
				{
					do
					{
						// Store first result set
						if ($result2=mysqli_store_result($con)) {
						// Fetch one and one row
							while ($row=mysqli_fetch_row($result2))
							{
							
							}
						// Free result set
							mysqli_free_result($result2);
						}
					}
					while (mysqli_next_result($con));
				}
			//echo "Bin is Removed.";
		  }
		  else
		  {
			  //echo "Failed";
		  }
		  exit();
	}
	
	$mName 		= filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$maddress 	= filter_var($_POST["address"], FILTER_SANITIZE_STRING);
	
	if($maddress == 'MLB'){
		$userid = 1;
	}
	else if($maddress == 'KDU'){
		$userid = 2;
	}
	
	if($maddress == 'MLB' && $mName == 'PL'){
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
		$binid = $maddress . "-" . $max. "-" .$mName;	
	}
	else if($maddress == 'MLB' && $mName == 'PA'){
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
		$binid = $maddress . "-" . $max. "-" .$mName;
	}
	else if($maddress == 'MLB' && $mName == 'GL'){
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
		$binid = $maddress . "-" . $max. "-" .$mName;
	}
	else if($maddress == 'MLB' && $mName == 'BD'){
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
		$binid = $maddress . "-" . $max. "-" .$mName;
	}
	else if($maddress == 'KDU' && $mName == 'PL'){
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
		$binid = $maddress . "-" . $max. "-" .$mName;
	}
	else if($maddress == 'KDU' && $mName == 'PA'){
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
		$binid = $maddress . "-" . $max. "-" .$mName;
	}
	else if($maddress == 'KDU' && $mName == 'GL'){
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
		$binid = $maddress . "-" . $max. "-" .$mName;
	}
	else if($maddress == 'KDU' && $mName == 'BD'){
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
		$binid = $maddress . "-" . $max. "-" .$mName;
	}
	
	
	$query = mysqli_query($con, "INSERT INTO workforceTask_tbl (userID, binID, taskType, latitude, longitude, taskStatus) VALUES ('$userid','$binid', 'Add new bin', '$mLat', '$mLng', 'In Progress')");
	if(!$query)
	{
		header('HTTP/1.1 500 Error: Could not create marker!'); 
	}

	exit();
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
