<?php

     require "init.php";
	 
	 
	//$id = $_POST["bin_ID"];
         
		  
		 
         
		 $sql = "select * from bindetail_tbl;";
		 $result=mysqli_query($con,$sql);
		 $num_rows = mysqli_num_rows($result);
		 if($num_rows>0)
		 {
		 
				while($r = mysqli_fetch_assoc($result)) {
				$rows[] = $r;
				}
				print json_encode($rows);
				
		 }
		 else
		 {
			 echo "no rows";
		 }
		
       mysqli_close($con);
	
?>