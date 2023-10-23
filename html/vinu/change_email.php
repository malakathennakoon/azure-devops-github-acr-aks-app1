<?php 

	require_once('config.php');
 
	if($_SERVER['REQUEST_METHOD']=='POST'){
 
		$id = $_POST['id'];
		$email = $_POST['email'];

 		$sql = "UPDATE client_tbl SET cemail = '$email' WHERE clientID='$id'";
 
 		$result = mysqli_query($con,$sql);

 		if($result){
 
 			echo "success";
 		}else{

 			echo "fail";
 		}
 		mysqli_close($con);
 	}

?>