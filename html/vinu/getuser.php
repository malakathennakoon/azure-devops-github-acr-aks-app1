<?php 

	require_once('config.php');
 
	if($_SERVER['REQUEST_METHOD']=='GET'){
 
		$email = $_GET['email'];
 
 		$sql = "SELECT * FROM client_tbl WHERE cemail='$email'";
 
 		$result = mysqli_query($con,$sql);
 	
 		$response = array();
    		$row =mysqli_fetch_assoc($result);

    		$response['id'] = $row['clientID'];
		$response['name'] = $row['clientName'];
    	
		echo json_encode($response);
 		
 		mysqli_close($con);
 	
 	}

?>

