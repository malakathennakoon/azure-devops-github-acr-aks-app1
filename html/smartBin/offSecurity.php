<?php
require "init.php";
$id = $_POST["bin_ID"];
$status='Active';
$level=0;
$no='No';


	$sql = "UPDATE bindetail_tbl SET status = '$status', filedLevel='$level' WHERE binID = '$id';";
	$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		  {
			  
			  echo "off";
			 
			  
		  }
		  else
		  {
			  echo "failed";
		  }
		  
	$sql1 =  "UPDATE binSensor_tbl SET binStatus = '$status' WHERE binID = '$id';";
		if (mysqli_query($con, $sql1)) {
			} else {
					}
	$sql1 =  "UPDATE sensorCheck_tbl SET faultCheck1 = '$no',faultCheck2 = '$no',faultCheck3 = '$no' WHERE binID = '$id';";
		if (mysqli_query($con, $sql1)) {
			} else {
					}
					
					
	mysqli_close($con);
?>