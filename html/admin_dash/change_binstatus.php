<?php
include("../Login/dbcon.php");

if (isset($_GET['id']))
{
	$id = $_GET['id'];

	$sql1 = "SELECT * FROM binSensor_tbl WHERE binID='$id'";
	$result1 = mysqli_query($con,$sql1);
	while($row1 = mysqli_fetch_array( $result1 )) 
	{
		if($row1[2]=='Active')
		{
			$sql2 = "UPDATE bindetail_tbl SET Status='Inactive' WHERE binID = '$id'";
			$result2 = mysqli_query($con,$sql2);			
			$sql3 = "UPDATE binSensor_tbl SET binStatus='Inactive' WHERE binID = '$id'";
			$result3 = mysqli_query($con,$sql3);
		}
	
		else
		{
			$sql4 = "UPDATE bindetail_tbl SET Status='Active' WHERE binID = '$id'";
			$result4 = mysqli_query($con,$sql4);			
			$sql5 = "UPDATE binSensor_tbl SET binStatus='Active' WHERE binID = '$id'";
			$result5 = mysqli_query($con,$sql5);
		}
	}
	

	header("Location: sensor_table.php");
}

else
{
	header("Location: sensor_table.php");
}

mysqli_close($con);
?>