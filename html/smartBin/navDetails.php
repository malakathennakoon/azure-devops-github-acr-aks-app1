<?php

     require "init.php";
	 
	 // Check whether username or password is set from android	
     //if(isset($_POST['username']) && isset($_POST['password']))
     
		  // Innitialize Variable
		 
	   	  $id = $_POST["user_ID"];
         
		  
		  // Query database for row exist or not
         
		 $sql = "select * from workforce_tbl where  userID = '$id';";
		 $result=mysqli_query($con,$sql);
		 $num_rows = mysqli_num_rows($result);
		 if($num_rows>0)
		 {
				$row[] = mysqli_fetch_assoc($result);
				//$row["image"]=base64_encode($row["image"]);
				print(json_encode($row));
				
		 }
		 else
		 {
			 echo "no rows";
		 }
		
 		mysqli_close($con);      
?>