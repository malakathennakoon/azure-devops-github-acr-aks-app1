<?php
require "init.php";
$id = $_POST["task_ID"];
$bid= $_POST["bin_ID"];
$type=$_POST["tType"];
$lon=$_POST["lon"];
$lat=$_POST["lat"];
$timestamp = time();
$date_time = date("Y-m-d H:i:s", $timestamp);
$status='Completed';

list($areaID) = explode("-", $bid);
if(strcmp($areaID,"MLB")==0)
{
	$areaName="Malabe";
}
if(strcmp($areaID,"KDU")==0)
{
	$areaName="Kaduwela";
}


	if(strcmp($type,"Add new bin")==0)
	{
		$sql = "UPDATE workforceTask_tbl SET taskStatus = '$status', date='$date_time'  WHERE taskID = '$id';";
		if (mysqli_query($con, $sql)) 
		  {
			
			
			$sql1="INSERT INTO bindetail_tbl (binID,areaName,areaID,latitude,longitude) VALUES ('$bid','$areaName','$areaID','$lat','$lon');";
			$sql1.="INSERT INTO binLevel_tbl (binID) VALUES ('$bid');";
			$sql1.="INSERT INTO mon_binLevel_tbl (binID) VALUES ('$bid');";
			$sql1.="INSERT INTO tue_binLevel_tbl (binID) VALUES ('$bid');";
			$sql1.="INSERT INTO wen_binLevel_tbl (binID) VALUES ('$bid');";
			$sql1.="INSERT INTO thu_binLevel_tbl (binID) VALUES ('$bid');";
			$sql1.="INSERT INTO fri_binLevel_tbl (binID) VALUES ('$bid');";
			$sql1.="INSERT INTO sat_binLevel_tbl (binID) VALUES ('$bid');";
			$sql1.="INSERT INTO binTotalVolume_tbl (binID) VALUES ('$bid');";
			$sql1.="INSERT INTO sun_binLevel_tbl (binID) VALUES ('$bid');";
			$sql1.="INSERT INTO sensorCheck_tbl (binID) VALUES ('$bid');";
			$sql1.="INSERT INTO binSensor_tbl (binID) VALUES ('$bid')";
			

			
			if (mysqli_multi_query($con,$sql1))
				{
					do
					{
						// Store first result set
						if ($result=mysqli_store_result($con)) {
						// Fetch one and one row
							while ($row=mysqli_fetch_row($result))
							{
							
							}
						// Free result set
							mysqli_free_result($result);
						}
					}
					while (mysqli_next_result($con));
				}
			echo "New bin is Added.";
		  }
		  else
		  {
			  echo "Failed";
		  }
	}
	elseif (strcmp($type,"Remove a bin")==0)
	{
		$sql = "UPDATE workforceTask_tbl SET taskStatus = '$status', date='$date_time' WHERE taskID = '$id';";
			if (mysqli_query($con, $sql)) 
		  {
			echo "Bin remove is Completed.";
		  }
		  else
		  {
			  echo "Failed";
		  }

	}
	else
	{
		$sql = "UPDATE workforceTask_tbl SET taskStatus = '$status', date='$date_time' WHERE taskID = '$id';";
		if (mysqli_query($con, $sql)) 
		  {
			echo "Maintenance is Completed.";
		  }
		  else
		  {
			  echo "Failed";
		  }

		
	}
		
	

	mysqli_close($con);	
	

?>