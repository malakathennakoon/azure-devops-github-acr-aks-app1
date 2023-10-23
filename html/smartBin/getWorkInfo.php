<?php

     require "init.php";
	 
	 
		$id =$_POST["user_ID"];
         
		  
		$sql = "select working_tbl.binID,working_tbl.time,working_tbl.jobType,bindetail_tbl.areaName from working_tbl,bindetail_tbl where working_tbl.userID = '$id' && bindetail_tbl.binID=working_tbl.binID ORDER BY working_tbl.time DESC;";
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