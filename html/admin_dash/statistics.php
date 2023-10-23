<?php
$path = $_SERVER['DOCUMENT_ROOT']; 
$path .= "/Login/session.php";
include($path);

$path1 = $_SERVER['DOCUMENT_ROOT']; 
$path1 .= "/Login/dbcon.php";
include($path1);

$path2 = $_SERVER['DOCUMENT_ROOT']; 
$path2 .= "/admin_dash/regression/pa.php";
include($path2);


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
                    <li class="active">
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
                        <a class="navbar-brand" href="#"> Garbage Generation Statistics </a>
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
                            <div class="card">
                                <div class="card-header " data-background-color="white">
                                    <div class="ct-chart" id="monthavg" style="height: 300px; width: 100%;"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title">Total monthly collection in Tonnes</h4>
                                    <p class="category">
                                        <span class="text-success"><i class="fa fa-long-arrow-up"></i>  </span> Total monthly collection of garbage from the four types of garbage for each month.</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> Update Complete
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="card">
                                <div class="card-header " data-background-color="white">
                                    <div class="ct-chart" id="predicted" style="height: 300px; width: 100%;"></div>
                                </div>
                                <div class="card-content">
                                    <h4 class="title">Predicted monthly collection for the following year</h4>
                                    <p class="category">
                                        <span class="text-success"><i class="fa fa-long-arrow-up"></i>  </span> Predicted monthly collection of garbage from the four types of garbage for each month.</p>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">access_time</i> Update Complete
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="purple">
                                    <h4 class="title">Report</h4>
                                    <p class="category">Summary Report genarated from past and predicted garbage collection</p>
                                </div>
                                <div class="card-content">									
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h3 class="panel-title"><strong>Collection Amounts Summary</strong></h3>
												</div>
												<div class="panel-body">
													<div class="table-responsive">
														<table class="table table-condensed">
															<thead>
																<tr>
																	<td><strong>Year</strong></td>
																	<td class="text-center"><strong>Data Type</strong></td>
																	<td class="text-center"><strong>Garbage Type</strong></td>
																	<td class="text-right"><strong>Amount (tons)</strong></td>
																</tr>
															</thead>
															<tbody>
																<!-- foreach ($order->lineItems as $line) or some such thing here -->
																<tr>
																	<td>2017</td>
																	<td class="text-center">Collected</td>
																	<td class="text-center">Plastic</td>
																	<td class="text-right"><?php  	$sql = "SELECT SUM(PL) AS value_sum FROM monthlvlavg_tbl;";
																									$result = mysqli_query($con, $sql);	
																									$row = mysqli_fetch_assoc($result); 
																									$sum1 = $row['value_sum'];				
																									echo (round($sum1,2));?>
																	</td>
																</tr>
																<tr>
																	<td></td>
																	<td class="text-center"></td>
																	<td class="text-center">Paper</td>
																	<td class="text-right"><?php 	$sql = "SELECT SUM(PA) AS value_sum FROM monthlvlavg_tbl;";
																									$result = mysqli_query($con, $sql);	
																									$row = mysqli_fetch_assoc($result); 
																									$sum2 = $row['value_sum'];				
																									echo (round($sum2,2));?>
																	</td>
																</tr>
																<tr>
																	<td></td>
																	<td class="text-center"></td>
																	<td class="text-center">Glass</td>
																	<td class="text-right"><?php 	$sql = "SELECT SUM(GL) AS value_sum FROM monthlvlavg_tbl;";
																									$result = mysqli_query($con, $sql);	
																									$row = mysqli_fetch_assoc($result); 
																									$sum3 = $row['value_sum'];				
																									echo (round($sum3,2));?>
																	</td>
																</tr>
																<tr>
																	<td></td>
																	<td class="text-center"></td>
																	<td class="text-center">Biodegradable</td>
																	<td class="text-right"><?php 	$sql = "SELECT SUM(BD) AS value_sum FROM monthlvlavg_tbl;";
																									$result = mysqli_query($con, $sql);	
																									$row = mysqli_fetch_assoc($result); 
																									$sum4 = $row['value_sum'];				
																									echo (round($sum4,2));?>
																	</td>
																</tr>
																<tr>
																	<td class="no-line"></td>
																	<td class="no-line"></td>
																	<td class="no-line text-center"><strong>Total</strong></td>
																	<td class="no-line text-right"><?php 	$sql = "SELECT SUM(PL),SUM(PA),SUM(GL),SUM(BD),(SUM(PL)+SUM(PA)+SUM(GL)+SUM(BD)) AS value_sum FROM monthlvlavg_tbl;";
																											$result = mysqli_query($con, $sql);	
																											$row = mysqli_fetch_assoc($result); 
																											$sum = $row['value_sum'];				
																											echo (round($sum,2));?>
																	</td>
																</tr>
																<tr>
																	<td class="no-line danger"></td>
																	<td class="no-line danger"></td>
																	<td class="no-line text-center danger"><strong></strong></td>
																	<td class="no-line text-right danger"></td>
																</tr>
																<tr>
																	<td>2018</td>
																	<td class="text-center">Predicted</td>
																	<td class="text-center">Plastic</td>
																	<td class="text-right"><?php echo $tpl; ?></td>
																</tr>
																<tr>
																	<td></td>
																	<td class="text-center"></td>
																	<td class="text-center">Paper</td>
																	<td class="text-right"><?php echo $tpa; ?></td>
																</tr>
																<tr>
																	<td></td>
																	<td class="text-center"></td>
																	<td class="text-center">Glass</td>
																	<td class="text-right"><?php echo $tgl; ?></td>
																</tr>
																<tr>
																	<td></td>
																	<td class="text-center"></td>
																	<td class="text-center">Biodegradable</td>
																	<td class="text-right"><?php echo $tbd; ?></td>
																</tr>
																<tr>
																	<td class="no-line"></td>
																	<td class="no-line"></td>
																	<td class="no-line text-center"><strong>Total</strong></td>
																	<td class="no-line text-right"><?php echo $ttotal; ?></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h3 class="panel-title"><strong>Average Collection Rates Summary</strong></h3>
												</div>
												<div class="panel-body">
													<div class="table-responsive">
														<table class="table table-condensed">
															<thead>
																<tr>
																	<td><strong>Current Month</strong></td>
																	<td class="text-center"><strong>Type</strong></td>
																	<td class="text-center"><strong>Avg Past Months (tons)</strong></td>
																	<td class="text-center"><strong>Current Month (tons)</strong></td>
																	<td class="text-right"><strong>Variation Rate</strong></td>
																</tr>
															</thead>
															<tbody>
																<!-- foreach ($order->lineItems as $line) or some such thing here -->
																<tr>
																	<td><?php echo date('F'); ?></td>
																	<td class="text-center">Plastic</td>
																	<td class="text-center"><?php echo (round($avgpl,2)); ?></td>
																	<td class="text-center"><?php echo (round($data3[$d],2)); ?></td>
																	<td class="text-right"><?php echo (round($avgplr,2)); ?>%</td>
																</tr>
																<tr>
																	<td></td>
																	<td class="text-center">Paper</td>
																	<td class="text-center"><?php echo (round($avgpa,2)); ?></td>
																	<td class="text-center"><?php echo (round($data1[$d],2)); ?></td>
																	<td class="text-right"><?php echo (round($avgpar,2)); ?>%</td>
																</tr>
																<tr>
																	<td></td>
																	<td class="text-center">Glass</td>
																	<td class="text-center"><?php echo (round($avggl,2)); ?></td>
																	<td class="text-center"><?php echo (round($data2[$d],2)); ?></td>
																	<td class="text-right"><?php echo (round($avgglr,2)); ?>%</td>
																</tr>
																<tr>
																	<td></td>
																	<td class="text-center">Biodegradable</td>
																	<td class="text-center"><?php echo (round($avgbd,2)); ?></td>
																	<td class="text-center"><?php echo (round($data4[$d],2)); ?></td>
																	<td class="text-right"><?php echo (round($avgbdr,2)); ?>%</td>
																</tr>

															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h3 class="panel-title"><strong>Recycle Profit Margin</strong></h3>
												</div>
												<div class="panel-body">
													<div class="table-responsive">
														<table class="table table-condensed">
															<thead>
																<tr>
																	<td><strong>Garbage Type</strong></td>
																	<td class="text-center"><strong>Current Year Amount (tons)</strong></td>
																	<td class="text-center"><strong>Profit ($)</strong></td>
																	<td class="text-right"><strong>Carbon Emission (tons)</strong></td>
																</tr>
															</thead>
															<tbody>
																<!-- foreach ($order->lineItems as $line) or some such thing here -->
																<tr>
																	<td class="no-line">Plastic</td>
																	<td class="text-center"><?php echo (round($sum1,2));?></td>
																	<td class="no-line text-center">$<?php echo number_format($sum1*150); ?></td>
																	<td class="text-right"><?php echo (round(($sum1*6),2));?></td>
																</tr>
																<tr>
																	<td>Paper</td>
																	<td class="text-center"><?php echo (round($sum2,2));?></td>
																	<td class="no-line text-center">$<?php echo number_format($sum2*5); ?></td>
																	<td class="text-right"></td>
																</tr>
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
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

    });
</script>
  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("monthavg", {
					animationEnabled: true,
					backgroundColor: "transparent",	
					theme: "theme2",
					axisX: {
						labelFontSize: 14,
						labelFontColor: "white",
					},
					axisY: {
						labelFontSize: 14,
						labelFontColor: "white",
						suffix: "t"
						
					},
					toolTip: {
						borderThickness: 0,
						cornerRadius: 0,
						content: "<span style='\"'color: {color};'\"'>{name}</span>: {y} tons",
					},				


						        data: [
      {        
        type: "line",
		color: "#ff0000",
		name: "Paper",
		showInLegend: true,
        dataPoints: [
			  <?php
				
				$sql = "SELECT * FROM monthlvlavg_tbl;";
				$result = mysqli_query($con, $sql);		
				
			  if($result->num_rows > 0){
				  while($row = $result->fetch_assoc()){
					echo "{ label: '".$row['month']."', y: ".$row['PA']."},";

				  }
			  }
			  ?>
      
        ]
      },
        {        
        type: "line",
		color: "#45d125",
		name: "Plastic",
		showInLegend: true,
        dataPoints: [
			  <?php
				
				$sql = "SELECT * FROM monthlvlavg_tbl;";
				$result = mysqli_query($con, $sql);		
				
			  if($result->num_rows > 0){
				  while($row = $result->fetch_assoc()){
					echo "{ label: '".$row['month']."', y: ".$row['PL']."},";

				  }
			  }
			  ?>
      
        ]
      },
        {        
        type: "line",
		color: "#b023db",
		name: "Glass",
		showInLegend: true,
        dataPoints: [
			  <?php
				
				$sql = "SELECT * FROM monthlvlavg_tbl;";
				$result = mysqli_query($con, $sql);		
				
			  if($result->num_rows > 0){
				  while($row = $result->fetch_assoc()){
					echo "{ label: '".$row['month']."', y: ".$row['GL']."},";

				  }
			  }
			  ?>
      
        ]
      },
        {        
        type: "line",
		color: "#28cde0",
		name: "Biodegradable",
		showInLegend: true,
        dataPoints: [
			  <?php
				
				$sql = "SELECT * FROM monthlvlavg_tbl;";
				$result = mysqli_query($con, $sql);		
				
			  if($result->num_rows > 0){
				  while($row = $result->fetch_assoc()){
					echo "{ label: '".$row['month']."', y: ".$row['BD']."},";

				  }
			  }
			  ?>
      
        ]
      }
      ]
					  });

chart.render();
					

    var chart1 = new CanvasJS.Chart("predicted", {
					animationEnabled: true,
					backgroundColor: "transparent",	
					theme: "theme2",
					axisX: {
						labelFontSize: 14,
						labelFontColor: "white",
					},
					axisY: {
						labelFontSize: 14,
						labelFontColor: "white",
						suffix: "t"
						
					},
					toolTip: {
						borderThickness: 0,
						cornerRadius: 0,
						content: "<span style='\"'color: {color};'\"'>{name}</span>: {y} tons",
					},				


						        data: [
      {        
        type: "line",
		color: "#ff0000",
		name: "Paper",
		showInLegend: true,
        dataPoints: [
						<?php foreach ( $result5 as $row ) {
							echo "{ label: '".$row[0]."', y: ".$row[1]."},";
						} ?>
      
        ]
      },
        {        
        type: "line",
		color: "#45d125",
		name: "Plastic",
		showInLegend: true,
        dataPoints: [
						<?php foreach ( $result5 as $row ) {
							echo "{ label: '".$row[0]."', y: ".$row[2]."},";
						} ?>
      
        ]
      },
        {        
        type: "line",
		color: "#b023db",
		name: "Glass",
		showInLegend: true,
        dataPoints: [
						<?php foreach ( $result5 as $row ) {
							echo "{ label: '".$row[0]."', y: ".$row[3]."},";
						} ?>
      
        ]
      },
        {        
        type: "line",
		color: "#28cde0",
		name: "Biodegradable",
		showInLegend: true,
        dataPoints: [
						<?php foreach ( $result5 as $row ) {
							echo "{ label: '".$row[0]."', y: ".$row[4]."},";
						} ?>
      
        ]
      }
      ]
					  });

chart1.render();				
  }
</script>


</html>
<?php mysqli_close($con);?>