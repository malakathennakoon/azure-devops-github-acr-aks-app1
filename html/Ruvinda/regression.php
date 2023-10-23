<?php
	require "init.php";
	$a=0;	//Value A
	//$n=70*3;	//Value n
	$fx=70;	//Value fx
	$b=1500000;	//Value B
	$h=200000;	//Value hy
	$timestamp = time();
	$date_time = date("m", $timestamp);
	$last_month=5;


	if($last_month==3)
	{
		$dx= array(0.5,1.5,2.5);
	}
	elseif($last_month==4) 
	{
		$dx= array(0.5,1.5,2.5,3.5);
	}
	elseif($last_month==5)
	{
		$dx= array(0.5,1.5,2.5,3.5,4.5);
	}
	elseif($last_month==6)
	{
		$dx= array(0.5,1.5,2.5,3.5,4.5,5.5);
	}
	elseif($last_month==7)
	{
		$dx= array(0.5,1.5,2.5,3.5,4.5,5.5,6.5);
	}
	elseif($last_month==8)
	{
		$dx= array(0.5,1.5,2.5,3.5,4.5,5.5,6.5,7.5);
	}	
	elseif($last_month==9)
	{
		$dx= array(0.5,1.5,2.5,3.5,4.5,5.5,6.5,7.5,8.5);
	}
	elseif($last_month==10)
	{
		$dx= array(0.5,1.5,2.5,3.5,4.5,5.5,6.5,7.5,8.5,9.5);
	}	
	elseif($last_month==11)
	{
		$dx= array(0.5,1.5,2.5,3.5,4.5,5.5,6.5,7.5,8.5,9.5,10.5);
	}	
	elseif($last_month==12)
	{
		$dx= array(0.5,1.5,2.5,3.5,4.5,5.5,6.5,7.5,8.5,9.5,10.5,11.5);
	}

	
	
	$dy= array(-7,-6,-5,-4,-3,-2,-1,0,1,2,3,4,5,6,7);
	
	$fdx=0;
	for ($row = 0; $row < $last_month; $row++) {
		
		$fdx=$fdx+($fx*$dx[$row]);	//Sigma fdx
	}
	echo "fdx: $fdx";
	echo "</br>";
	
	for ($row = 0; $row < $last_month; $row++) {
		
		$r=$row+1;
		for ($col = 0; $col < 15; $col++) {

			$sql = "select * from MLBregressionPA_tbl where month='$r';";
			$result=mysqli_query($con,$sql);
		 
			while($rows = mysqli_fetch_assoc($result)) {
			
				$cName = array($rows["0k_200k"], $rows["200k_400k"], $rows["400k_600k"],$rows["600k_800k"],$rows["800k_1000k"],$rows["1000k_1200k"],$rows["1200k_1400k"],$rows["1400k_1600k"],$rows["1600k_1800k"],$rows["1800k_2000k"],$rows["2000k_2200k"],$rows["2200k_2400k"],$rows["2400k_2600k"],$rows["2600k_2800k"],$rows["2800k_3000k"]);
				$data[$row][$col]=$cName[$col];
			 		
			}
		
		}
	}
	
	$fdxdy=0;
	for ($row = 0; $row < $last_month; $row++) {
			
		for ($col = 0; $col < 15; $col++) {
			$fdxdy=$fdxdy+$dy[$col]*$dx[$row]*$data[$row][$col];	//sigma fdxdy
				
		}
	}
	echo "fdxdy: $fdxdy";
	echo "</br>";
		
	$_fy=array();
	$fy=array();
	$s_fy=0;
	for ($col = 0; $col < 15; $col++) {
			
		$fy[$col]=0;
			
		for ($row = 0; $row < $last_month; $row++) {
			$fy[$col]=$fy[$col]+$data[$row][$col];
		}
			
	$_fy[$col]=$fy[$col];
	$s_fy=$s_fy+$_fy[$col];	//Value fy. Meka poddak blpn.210k kiyala enne.$n=70*3 wenuwata meka denna puluwan neda?Chart eka baluwama nam hari wage.. 
	}
	echo "s_fy: $s_fy";
	echo "</br>";
		
	$fdy=array();
	$_fdy=0;
	for ($col = 0; $col < 15; $col++) {
			
		$fdy[$col]=$_fy[$col]*$dy[$col];	
		$_fdy=$_fdy+$fdy[$col];	//sigma fdy
	}
		
	$_x=($a+($fdx/$s_fy));	//Value x-bar
	echo "unx: $_x";
	echo "</br>";
	
	$_y=$b+($_fdy/$s_fy)*$h;	//Value y-bar
	
	echo "uny: $_y";
	echo "</br>";
	echo "unfdy: $_fdy";
	echo "</br>";
		
	$fdx2=0;
	for ($row = 0; $row < $last_month; $row++) {
			
		$fdx2=$fdx2+$dx[$row]*$dx[$row]*$fx;	//sigma fdx2		
	}
	
		
	echo "fdx2: $fdx2";
	echo "</br>";
		
	$byx=((($s_fy*$fdxdy)-($fdx*$_fdy))/(($s_fy*$fdx2)-($fdx*$fdx)))*$h;	//Value byx
		
	$x=24;	//given x value
		
	$y=$byx*$x-($byx*$_x)+$_y;	//Result for the given x
	echo $y;
	
?>