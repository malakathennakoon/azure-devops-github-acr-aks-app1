<?php
//$con = mysqli_connect("localhost","root","","smartbin");

$con = mysqli_connect("smtrash8.cmbmotdimkl5.ap-southeast-1.rds.amazonaws.com:3306", "smtrash8", "smartbin", "smartbin");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
