<?php
$path = $_SERVER['DOCUMENT_ROOT']; 
$path .= "/Login/session.php";
include($path);

$path1 = $_SERVER['DOCUMENT_ROOT']; 
$path1 .= "/Login/dbcon.php";
include($path1);

$sql = "SELECT * FROM bindetail_tbl";
$result = mysqli_query($con,$sql);
$count=0;
while($row = mysqli_fetch_array( $result )) {
	if($row['Status']=='Active')
	{
		$count++;
	}
}

$sql1 = "SELECT * FROM binSensor_tbl";
$result1 = mysqli_query($con,$sql1);
$count1=0;
while($row1 = mysqli_fetch_array( $result1 )) {
	if($row1['status']=='Faulty')
	{
		$count1++;
	}
}

$sql2 = "SELECT * FROM binReqFeedBack_tbl WHERE status='Approved'";
$result2 = mysqli_query($con,$sql2);
$count2=0;
while($row2 = mysqli_fetch_array( $result2 )) {
	if($row2['reqID']!= '0')
	{
		$count2++;
	}
}

$sql3 = "SELECT * FROM workforceTask_tbl";
$result3 = mysqli_query($con,$sql3);
$count3=0;
while($row3 = mysqli_fetch_array( $result3 )) {
	if($row3['taskID']!= '0')
	{
		$count3++;
	}
}

		$sql = "SELECT COUNT(*) FROM workforceTask_tbl WHERE userID='1' AND taskType='Add new bin';";
		$result = mysqli_query($con, $sql);
		$row1 = mysqli_fetch_array($result);

		$sql = "SELECT COUNT(*) FROM workforceTask_tbl WHERE userID='1' AND taskType='Maintenance';";
		$result = mysqli_query($con, $sql);
		$row2 = mysqli_fetch_array($result);

		
		$sql = "SELECT COUNT(*) FROM workforceTask_tbl WHERE userID='1' AND taskType='Remove a bin';";
		$result = mysqli_query($con, $sql);
		$row3 = mysqli_fetch_array($result);


		$sql = "SELECT COUNT(*) FROM workforceTask_tbl WHERE userID='2' AND taskType='Add new bin';";
		$result = mysqli_query($con, $sql);
		$row4 = mysqli_fetch_array($result);

		
		$sql = "SELECT COUNT(*) FROM workforceTask_tbl WHERE userID='2' AND taskType='Maintenance';";
		$result = mysqli_query($con, $sql);
		$row5 = mysqli_fetch_array($result);

		
		$sql = "SELECT COUNT(*) FROM workforceTask_tbl WHERE userID='2' AND taskType='Remove a bin';";
		$result = mysqli_query($con, $sql);
		$row6 = mysqli_fetch_array($result);
		
		$sql = "SELECT COUNT(*) FROM client_tbl WHERE areaName='Colombo';";
		$result = mysqli_query($con, $sql);
		$row7 = mysqli_fetch_array($result);
		
		$sql = "SELECT COUNT(*) FROM client_tbl WHERE areaName='Malabe';";
		$result = mysqli_query($con, $sql);
		$row8 = mysqli_fetch_array($result);
		
		$sql = "SELECT COUNT(*) FROM client_tbl WHERE areaName='Kaduwela';";
		$result = mysqli_query($con, $sql);
		$row9 = mysqli_fetch_array($result);



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
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="../assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo">
                <a href="#" class="simple-text">
                    SmartBin
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="./user.php">
                            <i class="material-icons">person</i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="./map_binstatus.php">
                            <i class="material-icons">delete</i>
                            <p>Bin Status</p>
                        </a>
                    </li>
                    <li>
                        <a href="./map_reqbins.php">
                            <i class="material-icons">edit_location</i>
                            <p>Request Bins</p>
                        </a>
                    </li>
					<li>
                        <a href="./feedback.php">
                            <i class="material-icons text-gray">feedback</i>
                            <p>Feedback</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#"> Dashboard Home </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    <p class="hidden-lg hidden-md">Profile</p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#">Logged in as : <?php echo $login_user ?></a>
                                    </li>
                                    <li>
                                        <a href="../Login/logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
<div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="green">
                                    <i class="material-icons">delete</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Active Bins</p>
                                    <h3 class="title"><?php echo $count ?> 
                                    </h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Last 24 Hours
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="yellow">
                                    <i class="material-icons">account_box</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Users</p>
                                    <h3 class="title"><?php echo $count1 ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">verified_user</i> Total Registered Users
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="blue">
                                    <i class="material-icons">delete_sweep</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Approved Bins</p>
                                    <h3 class="title"><?php echo $count2 ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">local_offer</i> Total Approved Bins
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-stats">
                                <div class="card-header" data-background-color="orange">
                                    <i class="material-icons">assignment</i>
                                </div>
                                <div class="card-content">
                                    <p class="category">Tasks Assigned</p>
                                    <h3 class="title"><?php echo $count3 ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">update</i> Just Updated
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="orange">
                                    <h4 class="title">System News</h4>
                                    <p class="category">Get the latest system news below</p>
                                </div>
                                <div class="card-content table-responsive">
                                    <table class="table table-hover">
                                        <thead class="text-warning">
                                            <th>News</th>
                                        </thead>
												<tbody>
												  <?php 
												  include($path1);
												  $sql3 = "SELECT * FROM newsalerts_tbl";
												  $result3 = mysqli_query($con,$sql3);
												  while($row3 = mysqli_fetch_array( $result3 )) {
														echo "<tr>";
														echo '<td>' . $row3["alert"] . '</td>';
														echo "</tr>";
													}
												  ?>
												</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://2.220.95.27">SmartBin</a>, For A Cleaner City
                    </p>
                </div>
            </footer>
        </div>
    </div>
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
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
</script>

</html>
<?php mysqli_close($con);?>