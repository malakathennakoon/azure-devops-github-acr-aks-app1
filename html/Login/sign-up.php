<?php
							include("dbcon.php");
							$path = 'http://' . $_SERVER['HTTP_HOST'];
							$path .= "/Login/sign-in.php";
							
							$msg = "";
							if(isset($_POST["sumbit"]))
							{
								$name = $_POST["name"];
								$email = $_POST["email"];
								$password = $_POST["password"];
								$city = $_POST["city"];

								$name = mysqli_real_escape_string($con, $name);
								$email = mysqli_real_escape_string($con, $email);
								$password = mysqli_real_escape_string($con, $password);
								$city = mysqli_real_escape_string($con, $city);
								//$password = md5($password);
								
								
								$sql="SELECT * FROM client_tbl WHERE cemail='$email'";
								$result=mysqli_query($con,$sql);
								$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
								if(mysqli_num_rows($result) == 1)
								{
									$msg = "Sorry...This email already exist...";
								}
								else
								{
									$query = mysqli_query($con, "INSERT INTO client_tbl (clientName, password, cemail, areaName, role) VALUES ('$name', '$password', '$email', '$city', 'client')");
									if($query)
										{
										$msg = "Thank You! You are now registered. You will be ridrected to the Sign-In Page";
										echo ("<SCRIPT LANGUAGE='JavaScript'>
												window.alert('$msg')
												window.location.href='$path';
												</SCRIPT>");
										}

								}
							}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign Up | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style1.css" rel="stylesheet">
</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">Smart<b>Bin</b></a>
            <small>An Eco friendly Product</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST">
                    <div class="msg">Register a new membership</div>
					<div class="m-t-25 m-b--5 align-center">
                        <a><?php echo $msg; ?></a>
                    </div>
					<div class="m-t-25 m-b--5 align-center">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" placeholder="Name Surname" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <select class="form-control" name="city" required autofocus>
							  <option value="City" disabled selected>City</option>
							  <option value="Malabe">Malabe</option>
							  <option value="Kaduwela">Kaduwela</option>
							</select>
                        </div>
                    </div>					
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>

                    <button class="btn btn-block btn-lg bg-pink waves-effect" name="sumbit" type="submit" >SIGN UP</button>
					
                    <div class="m-t-25 m-b--5 align-center">
                        <a href="sign-in.php">You already have a membership?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
      
    </div>
  </div>
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-up.js"></script>
</body>

</html>
<?php mysqli_close($con);?>