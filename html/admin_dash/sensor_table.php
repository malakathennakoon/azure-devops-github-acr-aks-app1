<?php

$path = $_SERVER['DOCUMENT_ROOT']; 
$path .= "/Login/session.php";
include($path);

$path1 = $_SERVER['DOCUMENT_ROOT']; 
$path1 .= "/Login/dbcon.php";
include($path1);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Material Dashboard by Creative Tim</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="../assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
	<meta http-equiv="refresh" content="60">
</head>

<body>

	<table class="table table-condensed table-hover table-bordered">
		<thead>
			<tr>
				<th><b>Bin ID</b></th>
				<th><b>Sensor Status</b></th>
				<th><b>Bin Status</b></th>
				<th><b>Change Bin Status</b></th>
			</tr>
		</thead>
		<tbody>
		<?php 
			include($path1);
												  
			$sql1 = "SELECT * FROM binSensor_tbl";
			$result1 = mysqli_query($con,$sql1);
			while($row1 = mysqli_fetch_array( $result1 )) 
			{
				if($row1[1]=='Faulty')
				{
					echo "<tr class='danger'>";
					echo '<td>' . $row1["binID"] . '</td>';
					echo '<td>' . $row1["status"] . '</td>';
					echo '<td>' . $row1["binStatus"] . '</td>';
					echo '<td><a href="change_binstatus.php?id=' . $row1[0] . '">Switch State</a></td>';
					echo "</tr>";
								
				}
	
				else
				{
					echo "<tr>";
					echo '<td>' . $row1["binID"] . '</td>';
					echo '<td>' . $row1["status"] . '</td>';
					echo '<td>' . $row1["binStatus"] . '</td>';
					echo '<td><a href="change_binstatus.php?id=' . $row1[0] . '">Switch State</a></td>';
					echo "</tr>";
				}
			}
		?>
		</tbody>
		</table>
											
</body>
<!--   Core JS Files   -->
<script src="../assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="../assets/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="../assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="../assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="../assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>

</html>
<?php mysqli_close($con);?>