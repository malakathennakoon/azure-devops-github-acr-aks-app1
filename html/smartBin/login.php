<?php

     require "init.php";
	 
	 // Check whether username or password is set from android	
     //if(isset($_POST['username']) && isset($_POST['password']))
     
		  // Innitialize Variable
		 
	   	$username = $_POST["login_name"];
          	$password = $_POST["login_pass"];
		  
		          
		  $sql = "select * from workforce_tbl where  uName = '$username' and pWord = '$password';";
		  $result=mysqli_query($con,$sql);
		  if(mysqli_num_rows($result)>0)
		  {
			  $row=mysqli_fetch_assoc($result);
			  //$name=$row["uName"];
			  $id=$row["userID"];
				echo $id;
						 
			  
		  }
		  else
		  {
			  echo "Login Failed...";
		  }
       
  		mysqli_close($con);
?>