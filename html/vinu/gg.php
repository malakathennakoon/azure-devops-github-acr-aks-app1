<?php

	class classDistance{

		function calcDistance($latFrom, $lonFrom, $latTo, $lonTo) {

			/**This calculation returns the minimum distance between two geo coordinates & not the distance we must travel to reach that bin. */

  			$difference = $lonFrom - $lonTo;
  			$distance = sin(deg2rad($latFrom)) * sin(deg2rad($latTo)) +  cos(deg2rad($latFrom)) * cos(deg2rad($latTo)) * cos(deg2rad($difference));
  			$distance = acos($distance);
  			$distance = rad2deg($distance);
  			$distance = $distance * 111.18957696; //Distance in Kilometers
  
  			return $distance;
  		}

	}
    
	require_once('config.php');

	
	//if($_SERVER['REQUEST_METHOD'] =='POST'){
		
		$email = $_POST['email'];
		$lon= $_POST['longitude'];
        	$lat = $_POST['latitude'];
		$rad1 = $_POST['bio'];
        	$rad2 = $_POST['pl'];
        	$rad3 = $_POST['pa'];
        	$rad4 = $_POST['gl'];

        	$sql = "SELECT binID, latitude, longitude FROM bindetail_tbl";

        	$result = mysqli_query($con, $sql);

        	$arrayDistance = array();

        	$classDistance = new classDistance;

        	if($result){

            		while($row = mysqli_fetch_array($result)){

            			$binId = $row["binID"];
            			$distance = $classDistance->calcDistance($lat, $lon, $row["latitude"], $row["longitude"]);

            			$add = $me = array('distance' => $distance, 'id' => $binId );

            			array_push($arrayDistance, $add);
            		}
        	

		
		usort($arrayDistance, function ($a, $b) { return strnatcmp($a['distance'], $b['distance']); });
		//print_r($arrayDistance);

		$firstNearest = $arrayDistance[0]['id'];
		$secondNearest = $arrayDistance[1]['id'];
           
		 echo $firstNearest;
		 echo $secondNearest;
		
		//$sql2 = "SELECT * FROM mon_binLevel_tbl WHERE binID='$firstNearest';";
		//$result3=mysqli_query($con,$sql2);
		//while ($row = mysqli_fetch_assoc($result3)) {
	     //   echo $row['week_1_09:30'];
		//}

                  //first ner w1 9.30 value
		$sql = "SELECT * FROM mon_binLevel_tbl WHERE binID='$firstNearest';";
                   $result = mysqli_query($con, $sql);
                   if (mysqli_num_rows($result) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result)) {   
                      $w1b11 = $row['week_1_09:30'];
                       echo $w1b11;
                        }
                        }
         //first w1 2130 ner value
		 
		 $sql = "SELECT * FROM mon_binLevel_tbl WHERE binID='$firstNearest';";
                   $result = mysqli_query($con, $sql);
                   if (mysqli_num_rows($result) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result)) {   
                      $w1b12 = $row['week_1_21:30'];
                       echo $w1b12;
                        }
                        }
						
		//first ner w2 9.30 value
		$sql = "SELECT * FROM mon_binLevel_tbl WHERE binID='$firstNearest';";
                   $result = mysqli_query($con, $sql);
                   if (mysqli_num_rows($result) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result)) {   
                      $w2b11 = $row['week_2_09:30'];
                       echo $w2b11;
                        }
                        }
		//first ner w2 21.30 value
		$sql = "SELECT * FROM mon_binLevel_tbl WHERE binID='$firstNearest';";
                   $result = mysqli_query($con, $sql);
                   if (mysqli_num_rows($result) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result)) {   
                      $w2b12 = $row['week_2_21:30'];
                       echo $w2b12;
                        }
                        }   


              //second ner w1 9.30 value
		$sql = "SELECT * FROM mon_binLevel_tbl WHERE binID='$secondNearest';";
                   $result = mysqli_query($con, $sql);
                   if (mysqli_num_rows($result) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result)) {   
                      $mw1b21 = $row['week_1_09:30'];
                       echo $mw1b21;
                        }
                        }
         //second w1 2130 ner value
		 
		 $sql = "SELECT * FROM mon_binLevel_tbl WHERE binID='$secondNearest';";
                   $result = mysqli_query($con, $sql);
                   if (mysqli_num_rows($result) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result)) {   
                      $mw1b22 = $row['week_1_21:30'];
                       echo $mw1b22;
                        }
                        }
						
		//second ner w2 9.30 value
		$sql = "SELECT * FROM mon_binLevel_tbl WHERE binID='$secondNearest';";
                   $result = mysqli_query($con, $sql);
                   if (mysqli_num_rows($result) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result)) {   
                      $mw2b21 = $row['week_2_09:30'];
                       echo $mw2b21;
                        }
                        }
		//second ner w2 21.30 value
		$sql = "SELECT * FROM mon_binLevel_tbl WHERE binID='$secondNearest';";
                   $result = mysqli_query($con, $sql);
                   if (mysqli_num_rows($result) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result)) {   
                      $mw2b22 = $row['week_2_21:30'];
                       echo $mw2b22;
                        }
                        }   

  
        
	 
		

		//$sql = "INSERT INTO binReqFeedBack_tbl (cemail, latitude, longitude, nearBin_1, nearBin_2, biodegradable, plastic, paper, glass) VALUES ('$email', '$lat', '$lon', '$firstNearest', '$secondNearest', '$rad1', '$rad2', '$rad3', '$rad4')";
        
		
			
		if(mysqli_query($con,$sql)){
				
			echo "Success";

		}else{
				
			echo "Failed";
			
		}

		mysqli_close($con);

		}

   //	}

	
?>