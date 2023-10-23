<?php
    
	require_once('config.php');

    	if($_SERVER['REQUEST_METHOD']=='POST'){
		
        	$name = $_POST['name'];
		$email = $_POST['email'];
        	$password = $_POST['password'];
        	$city = $_POST['city'];
		$pic = $_POST['pic'];
                $rolee = client;
		
		$mysql = "SELECT * FROM client_tbl WHERE cemail='$email'";
 
 		$myresult = mysqli_query($con,$mysql);
 	
 		$mycheck = mysqli_fetch_array($myresult);
		
		if(isset($mycheck)){
 
 			echo "Exist";
 		
		}else{
		
			$sql = "INSERT INTO client_tbl (clientName, password, cemail, areaName, role) VALUES ('$name', '$password', '$email', '$city', '$rolee')";

			
			if(mysqli_query($con,$sql)){
				
				$id = mysqli_insert_id($con);
 			    $path = "../profilepictures/$id.jpg";
 			    file_put_contents($path,base64_decode($pic));

 			    echo "Success";

			}else{
				
				echo "Failed";
			}
			
 		}

		
    }else{

        echo 'Error';

    }
?>


		


