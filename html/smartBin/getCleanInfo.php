<?php

     require "init.php";
	 
	 
		$id =  $_POST["bin_ID"];
         
		  
		         
		$sql = "select workforce_tbl.Name,working_tbl.jobType,working_tbl.time from working_tbl,workforce_tbl where working_tbl.binID = '$id' && workforce_tbl.userID=working_tbl.userID ORDER BY working_tbl.time DESC;";
		$result=mysqli_query($con,$sql);
		if($result)
		{
    			while($row=mysqli_fetch_array($result))
  			{
    			$data[]=$row;
  			}
    			print(json_encode($data));
		}
		else
		{
  			echo('Not Found ');
		}
       
		mysqli_close($con);
?>