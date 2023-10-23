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

	
	if($_SERVER['REQUEST_METHOD'] =='POST'){
		
		$email = $_POST['email'];
		$lon= $_POST['longitude'];
        	$lat = $_POST['latitude'];
		$rad1 = $_POST['bio'];
        	$rad2 = $_POST['pl'];
        	$rad3 = $_POST['pa'];
        	$rad4 = $_POST['gl'];
                $rad5 = $_POST['yes'];
                $feedbacktype1= $_POST['feedbacktype1'];
			$yes = 'yes';
			$no = 'no';
               
                 if ($feedbacktype1 == 'Malabe') {
                        $spinn = 'MLB';
               } elseif ($feedbacktype1 == 'Kaduwela') {
                         $spinn = 'KDU'; 
                        }
                 elseif ($feedbacktype1 == 'Kadawatha') {
                         $spinn = 'KAD'; 
                        } 

        	$sql1 = "SELECT binID, latitude, longitude FROM bindetail_tbl";

        	$result1 = mysqli_query($con, $sql1);

        	$arrayDistance = array();

        	$classDistance = new classDistance;

        	if($result1){

            		while($row1 = mysqli_fetch_array($result1)){

            			$binId = $row1["binID"];
            			$distance = $classDistance->calcDistance($lat, $lon, $row1["latitude"], $row1["longitude"]);

            			$add = $me = array('distance' => $distance, 'id' => $binId );

            			array_push($arrayDistance, $add);
            		}
        	

		
		usort($arrayDistance, function ($a, $b) { return strnatcmp($a['distance'], $b['distance']); });
		//print_r($arrayDistance);

		$firstNearest = $arrayDistance[0]['id'];
		$secondNearest = $arrayDistance[1]['id'];
        $bin = array();
                    

                //first ner w1 9.30 value
		$sql2 = "SELECT * FROM mon_binLevel_tbl WHERE binID='$firstNearest';";
                   $result2 = mysqli_query($con, $sql2);
                   if (mysqli_num_rows($result2) > 0)
                     {
                      while($row1 = mysqli_fetch_assoc($result2)) {   
                      $mw1b11 = $row1['week_1_09:30'];
					  $bin[]=$mw1b11;
                       //echo $mw1b11;
                        }
                        }
         //first w1 2130 ner value
		 
		 $sql3 = "SELECT * FROM mon_binLevel_tbl WHERE binID='$firstNearest';";
                   $result3 = mysqli_query($con, $sql3);
                   if (mysqli_num_rows($result3) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result3)) {   
                      $mw1b12 = $row['week_1_21:30'];
					   $bin[]=$mw1b12;
                      // echo $mw1b12;
                        }
                        }
						
		//first ner w2 9.30 value
		$sql4 = "SELECT * FROM mon_binLevel_tbl WHERE binID='$firstNearest';";
                   $result4 = mysqli_query($con, $sql4);
                   if (mysqli_num_rows($result4) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result4)) {   
                      $mw2b11 = $row['week_2_09:30'];
					   $bin[]=$mw2b11;
                      // echo $mw2b11;
                        }
                        }
		//first ner w2 21.30 value
		$sql5 = "SELECT * FROM mon_binLevel_tbl WHERE binID='$firstNearest';";
                   $result5 = mysqli_query($con, $sql5);
                   if (mysqli_num_rows($result5) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result5)) {   
                      $mw2b12 = $row['week_2_21:30'];
					  $bin[]=$mw2b12;
                      // echo $mw2b12;
                        }
                        }
						
		//second ner w1 9.30 value
		$sql6 = "SELECT * FROM mon_binLevel_tbl WHERE binID='$secondNearest';";
                   $result6 = mysqli_query($con, $sql6);
                   if (mysqli_num_rows($result6) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result6)) {   
                      $mw1b21 = $row['week_1_09:30'];
					  $bin[]=$mw1b21;
                      // echo $mw1b21;
                        }
                        }
         //second w1 2130 ner value
		 
		 $sql7 = "SELECT * FROM mon_binLevel_tbl WHERE binID='$secondNearest';";
                   $result7 = mysqli_query($con, $sql7);
                   if (mysqli_num_rows($result7) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result7)) {   
                      $mw1b22 = $row['week_1_21:30'];
					  $bin[]=$mw1b22;
                      // echo $mw1b22;
                        }
                        }
						
		//second ner w2 9.30 value
		$sql8 = "SELECT * FROM mon_binLevel_tbl WHERE binID='$secondNearest';";
                   $result8 = mysqli_query($con, $sql8);
                   if (mysqli_num_rows($result8) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result8)) {   
                      $mw2b21 = $row['week_2_09:30'];
					  $bin[]=$mw2b21;
                     //  echo $mw2b21;
                        }
                        }
		//second ner w2 21.30 value
		$sql9 = "SELECT * FROM mon_binLevel_tbl WHERE binID='$secondNearest';";
                   $result9 = mysqli_query($con, $sql9);
                   if (mysqli_num_rows($result9) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result9)) {   
                      $mw2b22 = $row['week_2_21:30'];
					  $bin[]=$mw2b22;
                      // echo $mw2b22;
                        }
                        }
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 
		 
		//first ner w1 9.30 value
		$sql10 = "SELECT * FROM wen_binLevel_tbl WHERE binID='$firstNearest';";
                   $result10 = mysqli_query($con, $sql10);
                   if (mysqli_num_rows($result10) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result10)) {   
                      $ww1b11 = $row['week_1_09:30'];
					  $bin[]=$ww1b11;
                      // echo $ww1b11;
                        }
                        }
         //first w1 2130 ner value
		 
		 $sql11 = "SELECT * FROM wen_binLevel_tbl WHERE binID='$firstNearest';";
                   $result11 = mysqli_query($con, $sql11);
                   if (mysqli_num_rows($result11) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result11)) {   
                      $ww1b12 = $row['week_1_21:30'];
					  $bin[]=$ww1b12;
                      // echo $ww1b12;
                        }
                        }
						
		//first ner w2 9.30 value
		$sql12 = "SELECT * FROM wen_binLevel_tbl WHERE binID='$firstNearest';";
                   $result12 = mysqli_query($con, $sql12);
                   if (mysqli_num_rows($result12) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result12)) {   
                      $ww2b11 = $row['week_2_09:30'];
					  $bin[]=$ww2b11;
                     //  echo $ww2b11;
                        }
                        }
		//first ner w2 21.30 value
		$sql13 = "SELECT * FROM wen_binLevel_tbl WHERE binID='$firstNearest';";
                   $result13 = mysqli_query($con, $sql13);
                   if (mysqli_num_rows($result13) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result13)) {   
                      $ww2b12 = $row['week_2_21:30'];
					  $bin[]=$ww2b12;
                      // echo $ww2b12;
                        }
                        }
						
		//second ner w1 9.30 value
		$sql14 = "SELECT * FROM wen_binLevel_tbl WHERE binID='$secondNearest';";
                   $result14 = mysqli_query($con, $sql14);
                   if (mysqli_num_rows($result14) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result14)) {   
                      $ww1b21 = $row['week_1_09:30'];
					  $bin[]=$ww1b21;
                      // echo $ww1b21;
                        }
                        }
         //second w1 2130 ner value
		 
		 $sql15 = "SELECT * FROM wen_binLevel_tbl WHERE binID='$secondNearest';";
                   $result15 = mysqli_query($con, $sql15);
                   if (mysqli_num_rows($result15) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result15)) {   
                      $ww1b22 = $row['week_1_21:30'];
					  $bin[]=$ww1b22;
                      // echo $ww1b22;
                        }
                        }
						
		//second ner w2 9.30 value
		$sql16 = "SELECT * FROM wen_binLevel_tbl WHERE binID='$secondNearest';";
                   $result16 = mysqli_query($con, $sql16);
                   if (mysqli_num_rows($result16) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result16)) {   
                      $ww2b21 = $row['week_2_09:30'];
					  $bin[]=$ww2b21;
                      // echo $ww2b21;
                        }
                        }
		//second ner w2 21.30 value
		$sql17 = "SELECT * wen_binLevel_tbl WHERE binID='$secondNearest';";
                   $result17 = mysqli_query($con, $sql17);
                   if (mysqli_num_rows($result17) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result17)) {   
                      $ww2b22 = $row['week_2_21:30'];
					  $bin[]=$ww2b22;
                      // echo $ww2b22;
                        }
                        } 

           //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 
		 
		//first ner w1 9.30 value
		$sql18 = "SELECT * FROM sun_binLevel_tbl WHERE binID='$firstNearest';";
                   $result18 = mysqli_query($con, $sql18);
                   if (mysqli_num_rows($result18) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result18)) {   
                      $sw1b11 = $row['week_1_09:30'];
					  $bin[]=$sw1b11;
                       //echo $sw1b11;
                        }
                        }
         //first w1 2130 ner value
		 
		 $sql19 = "SELECT * FROM sun_binLevel_tbl WHERE binID='$firstNearest';";
                   $result19 = mysqli_query($con, $sql19);
                   if (mysqli_num_rows($result19) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result19)) {   
                      $sw1b12 = $row['week_1_21:30'];
					  $bin[]=$sw1b12;
                     //  echo $sw1b12;
                        }
                        }
						
		//first ner w2 9.30 value
		$sql20 = "SELECT * FROM sun_binLevel_tbl WHERE binID='$firstNearest';";
                   $result20 = mysqli_query($con, $sql20);
                   if (mysqli_num_rows($result20) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result20)) {   
                      $sw2b11 = $row['week_2_09:30'];
					  $bin[]=$sw2b11;
                      // echo $sw2b11;
                        }
                        }
		//first ner w2 21.30 value
		$sql21 = "SELECT * FROM sun_binLevel_tbl WHERE binID='$firstNearest';";
                   $result21 = mysqli_query($con, $sql21);
                   if (mysqli_num_rows($result21) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result21)) {   
                      $sw2b12 = $row['week_2_21:30'];
					  $bin[]=$sw2b12;
                      // echo $sw2b12;
                        }
                        }
						
		//second ner w1 9.30 value
		$sql22 = "SELECT * FROM sun_binLevel_tbl WHERE binID='$secondNearest';";
                   $result22 = mysqli_query($con, $sql22);
                   if (mysqli_num_rows($result22) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result22)) {   
                      $sw1b21 = $row['week_1_09:30'];
					  $bin[]=$sw1b21;
                      // echo $sw1b21;
                        }
                        }
         //second w1 2130 ner value
		 
		 $sql23 = "SELECT * FROM sun_binLevel_tbl WHERE binID='$secondNearest';";
                   $result23 = mysqli_query($con, $sql23);
                   if (mysqli_num_rows($result23) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result23)) {   
                      $sw1b22 = $row['week_1_21:30'];
					  $bin[]=$sw1b22;
                     //  echo $sw1b22;
                        }
                        }
						
		//second ner w2 9.30 value
		$sql24 = "SELECT * FROM sun_binLevel_tbl WHERE binID='$secondNearest';";
                   $result24 = mysqli_query($con, $sql24);
                   if (mysqli_num_rows($result24) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result24)) {   
                      $sw2b21 = $row['week_2_09:30'];
					  $bin[]=$sw2b21;
                      // echo $sw2b21;
                        }
                        }
		//second ner w2 21.30 value
		$sql25 = "SELECT * sun_binLevel_tbl WHERE binID='$secondNearest';";
                   $result25 = mysqli_query($con, $sql25);
                   if (mysqli_num_rows($result25) > 0)
                     {
                      while($row = mysqli_fetch_assoc($result25)) {   
                      $sw2b22 = $row['week_2_21:30'];
					  $bin[]=$sw2b22;
                      // echo $sw2b22;
                        }
                        }
                       
						  
					$n=0;
				for ($i = 0; $i < count($bin); $i++) {
					if($bin[$i]>=80)
					{
						$n++;
					}
					
				
				}
				//echo "<br>";
				//echo $n;
				
				$f = $n/24;
				if($f >= 0.7)
				{
				//echo "<br>";
				$sql = "INSERT INTO binReqFeedBack_tbl (cemail, latitude, longitude, nearBin_1, nearBin_2, biodegradable, plastic, paper, glass, BinAvailable, binconfirm, region) VALUES ('$email', '$lat', '$lon', '$firstNearest', '$secondNearest', '$rad1', '$rad2', '$rad3', '$rad4', '$rad5', '$yes', '$spinn')";
				//echo "success";
				}
				else
				{
				//echo "<br>";
				$sql = "INSERT INTO binReqFeedBack_tbl (cemail, latitude, longitude, nearBin_1, nearBin_2, biodegradable, plastic, paper, glass, BinAvailable, binconfirm, region) VALUES ('$email', '$lat', '$lon', '$firstNearest', '$secondNearest', '$rad1', '$rad2', '$rad3', '$rad4', '$rad5', '$no', '$spinn')";
				//echo "noo";
				}


		

			
		if(mysqli_query($con,$sql)){
				
			echo "Success";

		}else{
				
			echo "Failed";
			
		}

		mysqli_close($con);

		}

   	}

	
?>