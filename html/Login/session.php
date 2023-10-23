<?php
$path = 'http://' . $_SERVER['HTTP_HOST']; 
$path .= "/Login/sign-in.php";

include('dbcon.php');

session_start();
$user_check=$_SESSION['cid'];

$sql = mysqli_query($con,"SELECT * FROM client_tbl WHERE clientID='$user_check' ");
 
$row=mysqli_fetch_array($sql,MYSQLI_ASSOC);
 
$login_id=$row['clientID'];
$login_user=$row['clientName'];
$login_email=$row['cemail'];
$login_city=$row['areaName'];
 
if(!isset($user_check))
{
	header('Location:'.$path);
	exit;
}

?>
<?php mysqli_close($con);?>