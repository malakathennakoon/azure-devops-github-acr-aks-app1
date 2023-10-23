<?php
$path = $_SERVER['DOCUMENT_ROOT']; 
$path .= "/admin_dash/dashboard.php";
$url = 'http://' . $_SERVER['HTTP_HOST'];

$path = $_SERVER['DOCUMENT_ROOT']; 
$path .= "/Login/session.php";
include($path);

$path1 = $_SERVER['DOCUMENT_ROOT']; 
$path1 .= "/Login/dbcon.php";
include($path1);
 
echo $_SERVER['DOCUMENT_ROOT'];
/*echo "<br>";
echo $path;
echo "<br>";
echo $url;
echo "<br>";
*/

	$query = "SELECT id, paper FROM Waste_collected_per_month ORDER BY id;";
	$result = mysqli_query($con,$query);

	$data = array();
	foreach ($result as $row) {
		//if($row["id"]>9 && $row["id"]<69){
		$data[] = array($row["id"],$row["paper"]);
		//}
	}
	
	print json_encode($data); 
   
?>