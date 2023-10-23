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
								if ($_POST["password"] == $_POST["confirm"]) {
									$name = $_POST["name"];
									$email = $_POST["email"];
									$password = $_POST["password"];
									$city = $_POST["city"];
									

									$name = mysqli_real_escape_string($con, $name);
									$email = mysqli_real_escape_string($con, $email);
									$password = mysqli_real_escape_string($con, $password);
									$city = mysqli_real_escape_string($con, $city);
									
									
									
									$sql="SELECT * FROM client_tbl WHERE cemail='$email'";
									$result=mysqli_query($con,$sql);
									$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
									if(mysqli_num_rows($result) == 1)
									{
										$msg = "Sorry...This email already exist...";
										echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg') </SCRIPT>");
									}
									else
									{
										$query = "INSERT INTO client_tbl (clientName, password, cemail, areaName, role) VALUES ('$name', '$password', '$email', '$city', 'admin')";
										
										if(mysqli_query($con,$query)){
											$id = mysqli_insert_id($con);
											$id = "$id.jpg";
											move_uploaded_file($_FILES['pic']['tmp_name'], "../profilepictures/" .$id);
										}
										
										if($query)
											{
											$msg = "Administrator Account Created";
											echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg') </SCRIPT>");
											}

									}
								}
								else {
								   $msg = "The passwords do not match";
								   echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg') </SCRIPT>");
								}
							}
							
							if(isset($_POST["sumbit1"]))
							{	
								if ($_POST["password1"] == $_POST["confirm1"]) {
									$name = $_POST["name1"];
									$uname = $_POST["uname1"];
									$email = $_POST["email1"];
									$password = $_POST["password1"];
									$city = $_POST["city1"];
									$tel = $_POST["tel1"];

									$name = mysqli_real_escape_string($con, $name);
									$uname = mysqli_real_escape_string($con, $uname);
									$email = mysqli_real_escape_string($con, $email);
									$password = mysqli_real_escape_string($con, $password);
									$city = mysqli_real_escape_string($con, $city);
									$tel = mysqli_real_escape_string($con, $tel);
									
									
									
									$sql="SELECT * FROM workforce_tbl WHERE email='$email'";
									$result=mysqli_query($con,$sql);
									$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
									if(mysqli_num_rows($result) == 1)
									{
										$msg = "Sorry...This email already exist...";	
										echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg') </SCRIPT>");										
									}
									else
									{
										
										$query = "INSERT INTO workforce_tbl (uname, Name, email, contactNo, pWord, areaID, image) VALUES ('$uname', '$name', '$email', '$tel', '$password', '$city', '')";
										if(mysqli_query($con,$query)){
											$msg = "Workforce Account Created";
											echo ("<SCRIPT LANGUAGE='JavaScript'> window.alert('$msg') </SCRIPT>");
											//$id = mysqli_insert_id($con);
											//$id1 = "$id.jpg";
											//move_uploaded_file($_FILES['pic1']['tmp_name'], "../smartBin/uploads/" .$id1);
											//$path = "uploads/$id.png";
											//$actualpath = "http://52.220.95.27/smartBin/$path";
											//$sql1 = "UPDATE workforce_tbl SET image='$actualpath' WHERE userID = '$id';";
											//mysqli_query($con,$sql1);
										}
										
									}
								}
								else {
								   $msg = "The Passwords do not match";
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
                    <li class="active">
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
                        <a class="navbar-brand" href="#"> User Management </a>
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
                                <div class="card-header" data-background-color="purple">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <span class="nav-tabs-title">Create New User Account</span>
                                            <ul class="nav nav-tabs" data-tabs="tabs">
                                                <li class="active">
                                                    <a href="#admin" data-toggle="tab">
                                                        <i class="material-icons">bug_report</i> Administrator
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                                <li class="">
                                                    <a href="#workforce" data-toggle="tab">
                                                        <i class="material-icons">code</i> Workforce
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="admin">
											<div class="card-content">
												<form id="adminreg" method="POST" enctype="multipart/form-data">
													<div class="m-t-25 m-b--5 align-center">
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group label-floating">
																<label class="control-label">Name</label>
																<input name="name" type="text" class="form-control" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group label-floating">
																<label class="control-label" >Email</label>
																<input name="email" type="email" class="form-control" required>
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
													<div class="row">
														<div class="col-md-12">
																<label class="control-label" >Profile Picture</label>
																<input class="btn" name="pic" type="file" required>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group label-floating">
																<label class="control-label" >Password</label>
																<input type="password" class="form-control" name="password" minlength="6" required> 
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group label-floating">
																<label class="control-label" name="confirm">Confirm Password</label>
															   <input type="password" class="form-control" name="confirm" minlength="6" required>
															</div>
														</div>
													</div>
													
													<button type="submit" name="sumbit" class="btn btn-primary pull-right">Create User</button>
													<div class="clearfix"></div>
												</form>
											</div>
                                        </div>
                                        <div class="tab-pane" id="workforce">
											<div class="card-content">
												<form id="adminreg1" method="POST" enctype="multipart/form-data">
													<div class="m-t-25 m-b--5 align-center">
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group label-floating">
																<label class="control-label" >Full Name</label>
																<input name="name1" type="text" class="form-control" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group label-floating">
																<label class="control-label" >User Name</label>
																<input name="uname1" type="text" class="form-control" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group label-floating">
																<label class="control-label" >Email</label>
																<input name="email1" type="email" class="form-control" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group label-floating">
																<label class="control-label" >City</label>
																<select class="form-control" name="city1" required autofocus>
																  <option hidden ></option>
																  <option value="malabe">Malabe</option>
																  <option value="kaduwela">Kaduwela</option>
																</select>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group label-floating">
																<label class="control-label" >Telephone No.</label>
																<input name="tel1" type="number" class="form-control" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
																<label class="control-label" >Profile Picture</label>
																<input  class="btn" name="pic1" type="file" required>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group label-floating">
																<label class="control-label" >Password</label>
																<input name="password1" type="password" class="form-control" name="password" minlength="6" required>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-12">
															<div class="form-group label-floating">
																<label class="control-label" >Confirm Password</label>
															   <input name="confirm1" type="password" class="form-control" name="confirm1" minlength="6" required>
															</div>
														</div>
													</div>
													<button type="submit" name="sumbit1" class="btn btn-primary pull-right">Create User</button>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Workforce Account Management</h4>
                                </div>
                                <div class="card-content">
									<div class="row">
										<div class="col-xs-12 col-md-12">
											<table class="table table-condensed table-hover table-bordered">
												<thead>
												<tr>
													<th>ID</th>
													<th>Username</th>
													<th>Full Name</th>
													<th>Email</th>
													<th>Contact No.</th>
													<th>Area ID</th>
													<th>Delete</th>
												</tr>
												</thead>
												<tbody>
												  <?php 
												  include($path1);
												  $sql3 = "SELECT * FROM workforce_tbl";
												  $result3 = mysqli_query($con,$sql3);
												  while($row3 = mysqli_fetch_array( $result3 )) {
														echo "<tr>";
														echo '<td>' . $row3["userID"] . '</td>';
														echo '<td>' . $row3["uName"] . '</td>';
														echo '<td>' . $row3["Name"] . '</td>';
														echo '<td>' . $row3["email"] . '</td>';
														echo '<td>' . $row3["contactNo"] . '</td>';
														echo '<td>' . $row3["areaID"] . '</td>';
														echo '<td><a href="delete.php?id=' . $row3[0] . '">Delete</a></td>';
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