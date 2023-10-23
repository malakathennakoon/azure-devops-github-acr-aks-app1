<?php

$path = $_SERVER['DOCUMENT_ROOT']; 
$path .= "/Login/session.php";
include($path);

$path1 = $_SERVER['DOCUMENT_ROOT']; 
$path1 .= "/Login/dbcon.php";
include($path1);

							
							$msg = "";
							if(isset($_POST["submit"]))
							{
								$news = $_POST["news"];

								$news = mysqli_real_escape_string($con, $news);
								
									$query = mysqli_query($con, "INSERT INTO newsalerts_tbl (addedby, alert) VALUES ('$login_email', '$news')");
									if($query)
										{
										$msg = "Thank You! Your feedback will be reviewed.";
										echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg') </SCRIPT>");
										}
							}
							
							$con->close();
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
                <a href="" class="simple-text">
                    SmartBin
                </a>
            </div>
            <div class="sidebar-wrapper">
				<ul class="nav">
                    <li>
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
                        <a href="./usermanage.php">
                            <i class="material-icons">supervisor_account</i>
                            <p>User Management</p>
                        </a>
                    </li>
                    <li>
                        <a href="./map_binstatus.php">
                            <i class="material-icons">delete</i>
                            <p>Bin Status</p>
                        </a>
                    </li>
                    <li>
                        <a href="./map_managebins.php">
                            <i class="material-icons">edit_location</i>
                            <p>Manage Bins</p>
                        </a>
                    </li>
                    <li>
                        <a href="./map_truckroutes.php">
                            <i class="material-icons text-gray">local_shipping</i>
                            <p>Active Truck Routes</p>
                        </a>
                    </li>
                    <li>
                        <a href="./statistics.php">
                            <i class="material-icons text-gray">insert_chart</i>
                            <p>Statistics</p>
                        </a>
                    </li>
					<li>
                        <a href="./sensorcheck.php">
                            <i class="material-icons">settings_remote</i>
                            <p>Sensor Status</p>
                        </a>
                    </li>
					<li  class="active">
                        <a href="./newsalerts.php">
                            <i class="material-icons text-gray">subject</i>
                            <p>Manage News Alerts</p>
                        </a>
                    </li>
					<li>
                        <a href="./feedback.php">
                            <i class="material-icons text-gray">feedback</i>
                            <p>User Feedback</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#"> News Management </a>
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
						<div class="col-md-12">
                            <div class="card card-nav-tabs">
								<div class="content">
												<div class="container-fluid">
													<div class="row">
														<div class="col-md-12">
															<div class="card">
																<div class="card-header" data-background-color="purple">
																	<h4 class="title">News</h4>
																	<p class="category">Provide news for clients</p>
																</div>
																<div class="card-content">
																	<form id="adminreg" method="POST">
																		<div class="row">
																			<div class="col-md-12">
																				<div class="form-group label-floating">
																					<label class="control-label">News</label>
																					<textarea name="news" class="form-control" rows="5"></textarea>
																				</div>
																			</div>
																		</div>
																		<button type="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
																		<div class="clearfix"></div>
																	</form>
																</div>
															</div>
														</div>
													</div>
												</div>
								</div>
                            </div>
                        </div>
					</div>
				</div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">News Management</h4>
                                </div>
                                <div class="card-content">
									<div class="row">
										<div class="col-xs-12 col-md-12">
											<table class="table table-condensed table-hover table-bordered">
												<thead>
												<tr>
													<th>News</th>
													<th>Added By</th>
													<th>Delete</th>
												</tr>
												</thead>
												<tbody>
												  <?php 
												  include($path1);
												  $sql3 = "SELECT * FROM newsalerts_tbl";
												  $result3 = mysqli_query($con,$sql3);
												  while($row3 = mysqli_fetch_array( $result3 )) {
														echo "<tr>";
														echo '<td>' . $row3["alert"] . '</td>';
														echo '<td>' . $row3["addedby"] . '</td>';
														echo '<td><a href="deletenews.php?id=' . $row3["id"] . '">Delete</a></td>';
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



</html>
<?php mysqli_close($con);?>