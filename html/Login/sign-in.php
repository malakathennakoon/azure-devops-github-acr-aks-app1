<?php 
session_start(); 
include('dbcon.php'); 

$path = 'http://' . $_SERVER['HTTP_HOST'];
$path .= "/admin_dash/dashboard.php";

$path1 = 'http://' . $_SERVER['HTTP_HOST'];
$path1 .= "/client_dash/dashboard.php";

	$msg = "";
	if (isset($_POST['sign-in']))
		{
			if(empty($_POST["username"]) || empty($_POST["password"]))
			{
				$msg = "Both fields are required.";
			}
			else
			{
				$username = mysqli_real_escape_string($con, $_POST['username']);
				$password = mysqli_real_escape_string($con, $_POST['password']);

				$query 		= mysqli_query($con, "SELECT * FROM client_tbl WHERE  password='$password' and clientName='$username'");
				$row		= mysqli_fetch_array($query);
				$num_row 	= mysqli_num_rows($query);
				if($row['role']=='admin')
				{
					if ($num_row > 0)
					{
						$_SESSION['cid']=$row['clientID'];
						header('location:'.$path);
						exit;

					}
				else
					{
						$msg = 'Invalid Username and Password Combination';
					}
				}
				else{
					if ($num_row > 0)
					{
						$_SESSION['cid']=$row['clientID'];
						header('location:'.$path1);
						exit;

					}
				else
					{
						$msg = 'Invalid Username and Password Combination';
					}
				}
			}
		}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In</title>
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

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Smart<b>Bin</b></a>
            <small>An Eco friendly Product</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Sign in to start your session</div>
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
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-brown">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-brown waves-effect" name="sign-in" type="submit">SIGN IN</button>
                        </div>

                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.php">Register Now!</a>
                        </div>
                    </div>
                </form>
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
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>
<?php mysqli_close($con);?>