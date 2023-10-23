<?php

     require "init.php";
	 
	 
	$id = $_POST["bin_ID"];
         
		  
		 $sql = "select * from bindetail_tbl where  binID = '$id';";
		 $result=mysqli_query($con,$sql);
		 $num_rows = mysqli_num_rows($result);
		 if($num_rows>0)
		 {
				$row[] = mysqli_fetch_assoc($result);
				print(json_encode($row));
				
		 }
		 else
		 {
			 echo "no rows";
		 }
		
       	mysqli_close($con);

?>