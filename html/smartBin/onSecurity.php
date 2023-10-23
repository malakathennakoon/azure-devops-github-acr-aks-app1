<?php
require "init.php";
$id =$_POST["bin_ID"];//'MLB-10-PL';//
$status='Inactive';


	/*$sql = "UPDATE bindetail_tbl SET status = '$status' WHERE binID = '$id';";
	$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		  {
				$sql = "SELECT  filedLevel FROM bindetail_tbl WHERE binID = '$id';";
				$result = mysqli_query($con,$sql);
				$value = mysqli_fetch_object($result);
				
			 echo $value;
			  
			  echo "Name was Updated.";
			 
			  
		  }
		  else
		  {
			  echo "Failed";
		  }*/
		  
	$sql =  "UPDATE bindetail_tbl SET status = '$status' WHERE binID = '$id';";

		if (mysqli_query($con, $sql)) {
					
						$sql1 = "SELECT  filedLevel FROM bindetail_tbl WHERE binID = '$id';";
						$result1 = mysqli_query($con,$sql1);
						$value = mysqli_fetch_assoc($result1);
						$recent=($value['filedLevel']/100)*(31250);
						echo $recent;
						$sql2 = "SELECT  totalVolume FROM binTotalVolume_tbl WHERE binID = '$id';";
						$result2 = mysqli_query($con,$sql2);
						$value1 = mysqli_fetch_assoc($result2);
						$past=$value1['totalVolume'];
						echo $past;
						
						$last=$past+$recent;
						$sql3 = "UPDATE binTotalVolume_tbl SET totalVolume = '$last' WHERE binID = '$id';";
						
						if (mysqli_query($con, $sql3)) {
							 echo "Name was Updated.";
						} else {
						echo "Failed";
						}
			 
		} else {
						echo "Error updating record: " . mysqli_error($conn);
		}

		
		$sql1 =  "UPDATE binSensor_tbl SET binStatus = '$status' WHERE binID = '$id';";
		if (mysqli_query($con, $sql1)) {
			} else {
					}
	mysqli_close($con);
?>