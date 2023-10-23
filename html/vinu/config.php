<?php
 define('HOST','smtrash8.cmbmotdimkl5.ap-southeast-1.rds.amazonaws.com:3306');
 define('USER','smtrash8');
 define('PASS','smartbin');
 define('DB','smartbin');
 
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');


?> 