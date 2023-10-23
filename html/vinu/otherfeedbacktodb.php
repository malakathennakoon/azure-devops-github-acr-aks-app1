<?php
    
	require_once('config.php');

    	if($_SERVER['REQUEST_METHOD']=='POST'){
		
        	        $email = $_POST['email'];
			$feedbacktype= $_POST['feedbacktype'];
        	        $feedback = $_POST['feedback'];

			$sql = "INSERT INTO feedback_tbl (cemail, feedbacktype, feedback) VALUES ('$email', '$feedbacktype', '$feedback')";

			
			if(mysqli_query($con,$sql)){
				
				echo "Success";
			}else{
				
				echo "Failed";
			}

			mysqli_close($con);

   		}
?>