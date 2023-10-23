<?php
require "init.php";
$id = '1';
$strSQL = "select areaID from workforce_tbl where  userID = '$id'";
$result = mysqli_query($con,$strSQL);
$row = mysqli_fetch_assoc($result);
echo $row['areaID'];




?>