<?php

$path = $_SERVER['DOCUMENT_ROOT']; 
$path .= "/Login/session.php";
include($path);

$path1 = $_SERVER['DOCUMENT_ROOT']; 
$path1 .= "/Login/dbcon.php";
include($path1);

							$msg = "";
							if(isset($_POST["sumbit"]))
							{	
									$name = $_POST["name"];
									$email = $_POST["email"];
									$city = $_POST["city"];
									
									$name = mysqli_real_escape_string($con, $name);
									$email = mysqli_real_escape_string($con, $email);
									$city = mysqli_real_escape_string($con, $city);									
									
									$sql = "UPDATE client_tbl SET clientName='$name', cemail='$email', areaName='$city' WHERE clientID = '$login_id';";
									if (mysqli_query($con, $sql)) {
										$msg = "Record updated successfully";
										echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg') </SCRIPT>");
									} else {
										$msg = "Error updating record: ";
										echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg') </SCRIPT>");
									}

							}
							
							$msg1 = "";
							if(isset($_POST["sumbit1"]))
							{	
								if ($_POST["newpass"] == $_POST["confpass"]) {
									$cupass = $_POST["cupass"];
									$newpass = $_POST["newpass"];
									
									$cupass = mysqli_real_escape_string($con, $cupass);
									$newpass = mysqli_real_escape_string($con, $newpass);								
									
									$sql="SELECT * FROM client WHERE cpassword='$cupass'";
									$result=mysqli_query($con,$sql);
									$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
									if(mysqli_num_rows($result) == 1)
									{
										$sql = "UPDATE client_tbl SET password='$newpass' WHERE clientID = '$login_id';";
										if (mysqli_query($con, $sql)) {
											$msg1 = "Password updated successfully";
											echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg1') </SCRIPT>");
										} else {
											$msg1 = "Error updating password ";
											echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg1') </SCRIPT>");
										}							
									}
									else
									{
										$msg1 = "Current password does not match";
										echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg1') </SCRIPT>");
									}
								}
								else {
								   $msg1 = "The passwords do not match";
								   echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg1') </SCRIPT>");
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
                    <li class="active">
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
					<li>
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
                        <a class="navbar-brand" href="#"> User Profile </a>
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
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Edit Profile</h4>
                                    <p class="category">Complete your profile</p>
                                </div>
                                <div class="card-content">
                                    <form id="adminreg" method="POST" >
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label" >Name</label>
                                                    <input name="name" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email</label>
                                                    <input name="email" type="text" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
													<label class="control-label" >City</label>
													<select class="form-control" name="city" required autofocus>
														<option hidden ></option>
														<option value="malabe">Malabe</option>
														<option value="kaduwela">Kaduwela</option>
													</select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="sumbit" class="btn btn-primary pull-right">Update Profile</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
						<div class="col-md-4">
                            <div class="card card-profile">
                                <div class="card-avatar">
                                    <a href="#pablo">
										<?php echo '<img src="../profilepictures/'.$login_id.'.jpg" />'; ?>
                                    </a>
                                </div>
                                <div class="content">
                                    <h6 class="category text-gray">Administrator</h6>

                                    <p class="card-content">
										<?php
											$path1 = $_SERVER['DOCUMENT_ROOT']; 
											$path1 .= "/Login/dbcon.php";
											include($path1);
											$user_check=$_SESSION['cid'];

											$sql = mysqli_query($con,"SELECT * FROM client_tbl WHERE clientID='$user_check' ");
											 
											$row=mysqli_fetch_array($sql,MYSQLI_ASSOC);
											$login_email1=$row['cemail'];
											$login_city1=$row['areaName'];
											$login_user1=$row['clientName'];
											
											echo "Name : ".$login_user1;
											echo "<br>";
											echo "Email : ".$login_email1;
											echo "<br>";
											echo "City : ".$login_city1;

											$con->close();											
										?>
                                    </p>
                                    <a href="../Login/logout.php" class="btn btn-primary btn-round">Logout</a>
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
                                    <h4 class="title">Update Password</h4>
                                </div>
                                <div class="card-content">
                                    <form id="adminreg" method="POST">
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Current Password</label>
                                                    <input type="password" name="cupass" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">New Password</label>
                                                    <input type="password" name="newpass" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
										<div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Confirm New Password</label>
                                                    <input type="password" name="confpass" type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="sumbit1" class="btn btn-primary pull-right">Update Password</button>
                                        <div class="clearfix"></div>
                                    </form>
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