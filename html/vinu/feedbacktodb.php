<?php
    
	require_once('config.php');

    	if($_SERVER['REQUEST_METHOD']=='POST'){
		
        	$email = $_POST['email'];
		$bin = $_POST['bin'];
        	$sms = $_POST['sms'];
		
		
			$sql = "INSERT INTO smsFeedBack_tbl (cemail, messages, binID) VALUES ('$email', '$sms', '$bin')";

			
			if(mysqli_query($con,$sql)){
				
				echo "Success";
			}else{
				
				echo "Failed";
			}

			mysqli_close($con);

   		}
?>


		


