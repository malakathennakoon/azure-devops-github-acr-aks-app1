<?php
	require "init.php";
	$uid = 1;
    //$date=date("D");
	$date='mon';
	//$time=date("H");
	$time='15';
	$id = array();
	

		$strSQL = "select areaID from workforce_tbl where  userID = '$uid'";
		$re = mysqli_query($con,$strSQL);
		$data = mysqli_fetch_assoc($re);
	 	$area=$data['areaID'];

	
		if(strcasecmp('mon', $date) == 0)
		{
			$table='mon_binLevel_tbl';
			
		} elseif (strcasecmp('tue', $date) == 0){
			$table='tue_binLevel_tbl';
		}
		elseif (strcasecmp('wed', $date) == 0){
			$table='wen_binLevel_tbl';
		}
		elseif (strcasecmp('thu', $date) == 0){
			$table='thu_binLevel_tbl';
		}
		elseif (strcasecmp('fri', $date) == 0){
			$table='fri_binLevel_tbl';
		}
		elseif (strcasecmp('sat', $date) == 0){
			$table='sat_binLevel_tbl';
		}
		else
		{
			$table='sun_binLevel_tbl';
		}
	
	if(($time>=0) && ($time<12))
	{
		
			$sql = "select * from `".$table."`;";
			$result=mysqli_query($con,$sql);
			$num_rows = mysqli_num_rows($result);
			
			 while ($row = mysqli_fetch_assoc($result)) {
       
				$data = array($row["week_1_09:30"], $row["week_2_09:30"], $row["week_3_09:30"],$row["week_4_09:30"],$row["week_5_09:30"]);
				
				$arrlength = count($data);
				$n=0;
				$m=0;
				$sum=0;
				
				for($x = 0; $x < $arrlength; $x++) {
					if($data[$x]!=0)
					{
						$n++;
					}
					if($data[$x]>=80)
					{
						$m++;
					}
				}
				$p=$m/$n;
				if($p>=0.5)
				{
					$id[]=$row["binID"];
				}    
	
			}
				
				
				
				
			
	}
	elseif(($time>=12) && ($time<16))
	{
		
		
			$sql = "select * from `".$table."`;";
			$result=mysqli_query($con,$sql);
			$num_rows = mysqli_num_rows($result);
			
			 while ($row = mysqli_fetch_assoc($result)) {
       
				$data = array($row['week_1_15:30'], $row['week_2_15:30'], $row['week_3_15:30'],$row['week_4_15:30'],$row['week_5_15:30']);
				
				$arrlength = count($data);
				$n=0;
				$m=0;
				$sum=0;
				
				for($x = 0; $x < $arrlength; $x++) {
					if($data[$x]!=0)
					{
						$n++;
					}
					if($data[$x]>=80)
					{
						$m++;
					}
				}
				$p=$m/$n;
				if($p>=0.5)
				{
					$id[]=$row["binID"];
				}	
			}
				
				
				
				
	}
	elseif((($time>=17) && ($time<=23)))
	{
		
		
			$sql = "select * from `".$table."`;";
			$result=mysqli_query($con,$sql);
			$num_rows = mysqli_num_rows($result);
						 while ($row = mysqli_fetch_assoc($result)) {
       
				$data = array($row['week_1_21:30'], $row['week_2_21:30'], $row['week_3_21:30'],$row['week_4_21:30'],$row['week_5_21:30']);
				$arrlength = count($data);
				$n=0;
				$m=0;
				$sum=0;
				
				for($x = 0; $x < $arrlength; $x++) {
					if($data[$x]!=0)
					{
						$n++;
					}
					if($data[$x]>=80)
					{
						$m++;
					}
				}
				$p=$m/$n;
				if($p>=0.5)
				{
					$id[]=$row["binID"];
				}    
	
			}
				
				
	}
	
		 $sql = "select * from bindetail_tbl;";
		 $result=mysqli_query($con,$sql);
		 
		 while($rows = mysqli_fetch_assoc($result)) {
				
			if($rows['filedLevel']>=80)
			{
				$id[]=$rows['binID'];
			}	
		}
				
		
	$id = join("', '", $id);
	$query = "SELECT binID,areaID,latitude,longitude,filedLevel FROM bindetail_tbl WHERE binID IN ('$id');";
	// $query => SELECT * FROM business WHERE business_id IN ('a', 'b', 'c', 'd')
	 $result1=mysqli_query($con,$query);
		 
		 while($rows1 = mysqli_fetch_assoc($result1)) {
				if(strcmp($area,$rows1['areaID'])==0)
				{
					$row1[]=$rows1;
				}
				
		}
		print(json_encode($row1));
		
       
	?>