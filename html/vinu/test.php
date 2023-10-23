<?php
    
	require_once('config.php');
	
    $lat =6.914751 ;
    $sql2 = "SELECT binID FROM bindetail_tbl where latitude < '$lat' ORDER BY latitude DESC LIMIT 1;";
    $sql3 = "SELECT binID FROM bindetail_tbl where latitude > '$lat' ORDER BY latitude ASC LIMIT 1;";
	
	$result1 = mysqli_query($con,$sql2);
	$result2 = mysqli_query($con,$sql3);
	
	//$num_rows1 = mysqli_num_rows($result1);
	//$num_rows2 = mysqli_num_rows($result2);

        //$row1=mysqli_fetch_assoc($result1);
        //echo $row1;
	


         if($result1)
		{
    			while($row=mysqli_fetch_array($result1))
  			{
    			$data1=$row["binID"];
  			}
    			//print(json_encode($data));
		}
       if($result2)
		{
    			while($row=mysqli_fetch_array($result2))
  			{
    			$data2=$row["binID"];
  			}
    			//print(json_encode($data));
		}
        echo $data1;
	echo $data2;
	
	
		
	
	
	
	
	?>
