<?php
 require "init.php";
$timestamp = time();
$date_time = date("Y-m-d H:i:s", $timestamp);
$id = $_POST["user_ID"];
$binid = $_POST["bin_ID"];
$type=$_POST["type"];


		$sql = "INSERT INTO working_tbl (binID,userID,time,jobType) VALUES ('$binid','$id','$date_time','$type')";

		 if (mysqli_query($con, $sql)) {
			echo "New record created successfully";
		} 
		else {
				echo mysqli_error($con);
		}

	mysqli_close($con);	
?>