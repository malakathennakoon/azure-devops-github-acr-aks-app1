<?php
$db_name="smartbin";
$mysql_user="smtrash8";
$mysql_pass="smartbin";
$server_name="smtrash8.cmbmotdimkl5.ap-southeast-1.rds.amazonaws.com:3306";
$con=mysqli_connect($server_name,$mysql_user,$mysql_pass,$db_name);
if(!$con)
{
	echo "Connection Error".mysqli_connect_error();
}

?>