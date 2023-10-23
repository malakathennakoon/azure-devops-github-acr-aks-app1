<?php 

	require_once('config.php');
 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
 
		$id = $_POST['id'];
		$oldPassword = $_POST['oldpassword'];
		$password = $_POST['password'];
	
		$mysql = "SELECT * FROM client_tbl WHERE clientID='$id'";
		$result = mysqli_query($con,$mysql);
		$row = mysqli_fetch_assoc($result);
		$oldPass = $row['cpassword'];

		if($oldPass == $oldPassword){

			$sql = "UPDATE client_tbl SET password = '$password' WHERE clientID='$id'";
 
 			$result = mysqli_query($con,$sql);

 			if($result){
 
 				echo "success";
 			}else{

 				echo "fail";
 			}


		}else{

			echo "not match";
		}

 		mysqli_close($con);
 	}

?>