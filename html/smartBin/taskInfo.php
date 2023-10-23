<?php

     require "init.php";
	 
	 
		$id =$_POST["user_ID"];
         
		  
		$sql = "select * from workforceTask_tbl where userID = '$id' ORDER BY date DESC;";
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