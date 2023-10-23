<?php
session_start();
session_destroy();

$path = 'http://' . $_SERVER['HTTP_HOST'];
$path .= "/index.html";

header('location:'.$path);
exit;
?>
<?php mysqli_close($con);?>
