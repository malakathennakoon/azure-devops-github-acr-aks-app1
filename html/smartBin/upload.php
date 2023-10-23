<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		$image = $_POST['image'];
                $userid = $_POST['id'];
		
		require_once('init.php');
		
		/*$sql ="SELECT id FROM uploads ORDER BY id ASC";
		
		$res = mysqli_query($con,$sql);
		
		$id = 0;
		
		while($row = mysqli_fetch_array($res)){
				$id = $row['id'];
		}*/
		
		$path = "uploads/$userid.png";
		
		$actualpath = "http://52.220.95.27/smartBin/$path";
		
		$sql = "UPDATE workforce_tbl SET image='$actualpath' WHERE userID = '$userid';";
		
		if(mysqli_query($con,$sql))
		{
			file_put_contents($path,base64_decode($image));
			echo "Successfully Uploaded";
		}
		
		mysqli_close($con);
	}
	else
	{
		echo "Error";
	}
	
	mysqli_close($con);
?>