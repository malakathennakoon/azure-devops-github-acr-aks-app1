<?php 

	require_once('config.php');
 
	if($_SERVER['REQUEST_METHOD']=='POST'){
 
		$email = $_POST['email'];
 		$password = $_POST['password'];

 		$sql = "SELECT * FROM client_tbl WHERE cemail='$email' AND password='$password'";
 
 		$result = mysqli_query($con,$sql);
 	
 		$check = mysqli_fetch_array($result);

 		if(isset($check)){
 
 			echo "success";
 		}else{

 			echo "fail";
 		}
 		mysqli_close($con);
 	}

?>