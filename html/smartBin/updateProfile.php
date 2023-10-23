<?php
require "init.php";
$name = $_POST["name"];
$id = $_POST["user_ID"];
$mail=$_POST["mail"];
$contact=$_POST["contact"];
$pwd=$_POST["pwd"];



	if(($name!=null)&&($id!=null))
	{
		$sql = "UPDATE workforce_tbl SET Name = '$name' WHERE userID = '$id';";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		  {
			  
			  echo "Name was Updated.";
			 
			  
		  }
		  else
		  {
			  echo "Failed";
		  }
	}
	else if(($mail!=null)&&($id!=null))
	{
		$sql = "UPDATE workforce_tbl SET email = '$mail' WHERE userID = '$id';";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		  {
			  
			  echo "Email Address was Updated.";
			 
			  
		  }
		  else
		  {
			  echo "Failed";
		  }
	}
	else if(($contact!=null)&&($id!=null))
	{
		$sql = "UPDATE workforce_tbl SET contactNo = '$contact' WHERE userID = '$id';";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		  {
			  
			  echo "Contact Number was Updated.";
			 
			  
		  }
		  else
		  {
			  echo "Failed";
		  }
	}
	else if(($pwd!=null)&&($id!=null))
	{
		$sql = "UPDATE workforce_tbl SET pWord = '$pwd' WHERE userID = '$id';";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0)
		  {
			  
			  echo "Password was changed.";
			 
			  
		  }
		  else
		  {
			  echo "Failed";
		  }
	}
	else 
	{
		echo "Failed";
	}

	mysqli_close($con);	
	

?>