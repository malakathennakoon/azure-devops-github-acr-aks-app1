<?php 
	header('Content-Type: application/json');

	require_once('config.php');
 
	if($_SERVER['REQUEST_METHOD']=='GET'){
 
 		$sql = "SELECT * FROM bindetail_tbl WHERE areaID='KDU' OR areaID='MLB'";
 
 		$result = mysqli_query($con,$sql);
 	
 		$return = array();
		$response = array();

		while($row =mysqli_fetch_array($result)){

		$response['id'] = $row['binID'];
		$response['level'] = $row['filedLevel'];
		$response['latitude'] = $row['latitude'];
		$response['longitude'] = $row['longitude'];

		array_push($return,$response);
		
		}
    	
		$array = array('result' => $return);
		echo json_encode($array);
 		
 		mysqli_close($con);
 	
 	}

?>

