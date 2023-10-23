<?php
$path = $_SERVER['DOCUMENT_ROOT']; 
$path .= "/Login/session.php";
include($path);
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
	<link href='../assets/css/map.css' rel='stylesheet' type='text/css'>
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
                    <li class="active">
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
                        <a class="navbar-brand" href="#"> Manage Active Bins </a>
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
            <div id="map"></div>
			<div id="legend">Legend</div>
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIVoB6zVRoEVqSUcmG9OVfg_LTe_FVDLs"></script>
<!-- Material Dashboard javascript methods -->
<script src="../assets/js/material-dashboard.js?v=1.2.0"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        if ($('.main-panel > .content').length == 0) {
            $('.main-panel').css('height', '100%');
        }


	var mapCenter = new google.maps.LatLng(6.921984, 79.970362); //Google map Coordinates
	var map;
	var markersArray = [];
	
	map_initialize(); // initialize google map
	
	//############### Google Map Initialize ##############
	function map_initialize()
	{
			var googleMapOptions = 
			{ 
				center: mapCenter, // map center
				zoom: 14, //zoom level, 0 = earth view to higher value
				maxZoom: 30,
				minZoom: 1,
				zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL //zoom control size
			},
				scaleControl: true, // enable scale control
				mapTypeId: google.maps.MapTypeId.ROADMAP // google map type
			};
		
		   	map = new google.maps.Map(document.getElementById("map"), googleMapOptions);			
			
			//Load Markers from the XML File, Check (map_process.php)
			refreshrem();
			
			//Load Markers from the XML File, Check (map_process1.php)
			refreshreq();
			
			//Load Markers from the XML File, Check (map_process3.php)
			refreshnew();
			
			//Right Click to Drop a New Marker
			google.maps.event.addListener(map, 'rightclick', function(event) {
				//Edit form to be displayed with new marker
				var EditForm = '<p><div class="marker-edit">'+
				'<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">'+
				'<label for="pName"><span>Bin Type</span><select name="pName" class="save-name"><option value="PL">Plastic</option><option value="PA">Paper</option><option value="GL">Glass</option><option value="BD">Biodegradable</option></select></label>'+
				'<label for="pDesc"><span>Region</span><select name="pDesc" class="save-desc"><option value="MLB">Malabe</option><option value="KDU">Kaduwela</option></select></label>'+
				'</form>'+
				'</div></p><button name="save-marker" class="save-marker">Save Marker Details</button>';

				//Drop a new Marker with our Edit Form
				create_marker4(event.latLng, 'Add New Bin', EditForm, true, true, true, "icons/new1.png");
			});
			

										
	}
	
	
	//############### Create Marker Function ##############
	function create_marker(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, iconPath, areaid)
	{	  	  		  
		
		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: map,
			draggable:DragAble,
			//animation: google.maps.Animation.DROP,
			title:"Multiple Bins Here!",
			icon: iconPath
		});
		
		markersArray.push(marker);
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'<h1 class="marker-heading">'+MapTitle+'</h1>'+
		'<span>Bin Level : '+MapDesc+'<br>'+ 
		'</span><button name="remove-marker" class="remove-marker" title="Remove Marker">Remove Bin</button>'+
		'</div></div>');	

		
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		//Find remove button in infoWindow
		var removeBtn 	= contentString.find('button.remove-marker')[0];
		var saveBtn 	= contentString.find('button.save-marker')[0];

		//add click listner to remove marker button
		google.maps.event.addDomListener(removeBtn, "click", function(event) {
			var mReplace = contentString.find('span.info-content'); //html to be replaced after success
			remove_marker(marker , MapTitle, areaid);
		});
		
		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
				var mReplace = contentString.find('span.info-content'); //html to be replaced after success
				var mName = contentString.find('select.save-name')[0].value; //name input field value
				var mDesc  = contentString.find('select.save-desc')[0].value; //description input field value
				
				if(mName =='' || mDesc =='')
				{
					alert("Please enter Name and Description!");
				}else{
					save_marker(marker, mName, mDesc, mType, mReplace); //call save marker function
				}
			});
		}
		
		//add click listner to save marker button		 
		google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker); // click on marker opens info window 
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{
		  infowindow.open(map,marker);
		}
	}
	
	//############### Create Marker1 Function ##############
	function create_marker1(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, iconPath, bio, paper, plastic, glass, status, region)
	{	  	  		  
		
		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: map,
			draggable:DragAble,
			//animation: google.maps.Animation.DROP,
			title:"Multiple Bins Here!",
			icon: iconPath
		});
		
		markersArray.push(marker);
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'<span>User ID : '+MapTitle+'<br>'+
		'<span>User Email : '+MapDesc+'<br>'+
		'<span>Type : </span>'+bio+' '+paper+' '+plastic+' '+glass+'<br>'+
		'<span>Bin Status : '+status+'<br>'+
		'</span><button name="remove-marker" class="remove-marker" title="Remove Marker">Approve Bin</button>'+
		'</div></div>');	

		
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		//Find remove button in infoWindow
		var removeBtn 	= contentString.find('button.remove-marker')[0];
		var saveBtn 	= contentString.find('button.save-marker')[0];

		//add click listner to remove marker button
		google.maps.event.addDomListener(removeBtn, "click", function(event) {
			approve_marker(marker, MapTitle, MapDesc, bio, paper, plastic, glass, status, region);
		});
		
		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
	
				approve_marker(marker, MapTitle, MapDesc, bio, paper, plastic, glass, status, region); //call save marker function

			});
		}
		
		//add click listner to save marker button		 
		google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker); // click on marker opens info window 
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{
		  infowindow.open(map,marker);
		}
	}
	
	//############### Create Marker Function ##############
	function create_marker3(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, iconPath, type, status)
	{	  	  		  
		
		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: map,
			draggable:DragAble,
			//animation: google.maps.Animation.DROP,
			title:"Multiple Bins Here!",
			icon: iconPath
		});
		
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'<span>Bin ID : '+MapTitle+'<br>'+
		'<span>User ID : '+MapDesc+'<br>'+
		'<span>Type : </span>'+type+'<br>'+
		'<span>Status : '+status+'<br>'+
		'</span>'+
		'</div></div>');	

		
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		var saveBtn 	= contentString.find('button.save-marker')[0];

		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
				var mReplace = contentString.find('span.info-content'); //html to be replaced after success
				var mName = contentString.find('input.save-name')[0].value; //name input field value
				var mDesc  = contentString.find('textarea.save-desc')[0].value; //description input field value
				var mType = contentString.find('select.save-type')[0].value; //type of marker
				
				if(mName =='' || mDesc =='')
				{
					alert("Please enter Name and Description!");
				}else{
					save_marker(marker, mName, mDesc, mType, mReplace); //call save marker function
				}
			});
		}
		
		//add click listner to save marker button		 
		google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker); // click on marker opens info window 
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{
		  infowindow.open(map,marker);
		}
	}
	
		//############### Create Marker Function ##############
	function create_marker4(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, iconPath)
	{	  	  		  
		
		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: map,
			draggable:DragAble,
			animation: google.maps.Animation.DROP,
			title:"Multiple Bins Here!",
			icon: iconPath
		});
		
		markersArray.push(marker);
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'<h1 class="marker-heading">'+MapTitle+'</h1>'+
		'<span>Bin Level : '+MapDesc+'<br>'+ 
		'<button name="remove-marker" class="remove-marker" title="Remove Marker">Remove Bin</button></span>'+
		'</div></div>');	

		
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		//Find remove button in infoWindow
		var saveBtn 	= contentString.find('button.save-marker')[0];
		var removeBtn 	= contentString.find('button.remove-marker')[0];
		
		//add click listner to remove marker button
		google.maps.event.addDomListener(removeBtn, "click", function(event) {
			remove_marker(marker, '', '');
		});
		
		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
				var mReplace = contentString.find('span.info-content'); //html to be replaced after success
				var mName = contentString.find('select.save-name')[0].value; //name input field value
				var mDesc  = contentString.find('select.save-desc')[0].value; //description input field value
				
				if(mName =='' || mDesc =='')
				{
					alert("Please enter Name and Description!");
				}else{
					save_marker(marker, mName, mDesc, mReplace); //call save marker function
				}
			});
		}
		
		//add click listner to save marker button		 
		google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker); // click on marker opens info window 
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{
		  infowindow.open(map,marker);
		}
	}
	
	//############### Remove Marker Function ##############
	function remove_marker(Marker, binid, areaid)
	{
		
		/* determine whether marker is draggable 
		new markers are draggable and saved markers are fixed */
		if(Marker.getDraggable()) 
		{
			Marker.setMap(null); //just remove new marker
		}
		else
		{
			//Remove saved marker from DB and map using jQuery Ajax
			var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
			var myData = {del : 'true', latlang : mLatLang, areaid : areaid, binid : binid}; //post variables
			console.log(myData)
			$.ajax({
			  type: "POST",
			  url: "map_process.php",
			  data: myData,
			  success:function(data){
					Marker.setDraggable(false); //set marker to fixed
					Marker.setIcon('icons/80.png'); //replace icon
					refreshrem();
					refreshnew();
					refreshreq();
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError); //throw any errors
				}
			});
		}

	}
	
	//############### Save Marker Function ##############
	function save_marker(Marker, mName, mAddress, replaceWin)
	{
		//Save new marker using jQuery Ajax
		var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
		var myData = {name : mName, address : mAddress, latlang : mLatLang }; //post variables
		console.log(myData)
		console.log(replaceWin);		
		$.ajax({
		  type: "POST",
		  url: "map_process.php",
		  data: myData,
		  success:function(data){
				Marker.setDraggable(false); //set marker to fixed
				Marker.setIcon('icons/80.png'); //replace icon
				refreshnew();
				refreshreq();
				refreshrem();
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //throw any errors
            }
		});
	}
	
	//############### Remove Marker Function ##############
	function approve_marker(Marker, reqid, email, bio, paper, plastic, glass, status, region)
	{
			//Remove saved marker from DB and map using jQuery Ajax
			var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
			var myData = {del : 'true', latlang : mLatLang, reqid : reqid, email : email, bio : bio, paper : paper, plastic : plastic, glass : glass, status : status, region : region}; //post variables
			console.log(myData);
			$.ajax({
			  type: "POST",
			  url: "map_process1.php",
			  data: myData,
			  success:function(data){
				Marker.setIcon('icons/80.png'); //replace icon
				refreshreq();
				refreshnew();
				refreshrem();
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError); //throw any errors
				}
			});

	}

	function clearOverlays() {
		for (var i = 0; i < markersArray.length; i++ ) {
			markersArray[i].setMap(null);
		}
		markersArray.length = 0;
	}
	
	function refreshnew(){
		clearOverlays();
			$.get("map_process3.php", function (data) {
				$(data).find("marker").each(function () {
					var binid 		= $(this).attr('binid');
					var userid 		= $(this).attr('userid');
					var type 		= $(this).attr('type');
					var status 		= $(this).attr('status');
					var point 		= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));
					
					if(status == 'In Progress'){
						create_marker3(point, binid, userid, false, false, "icons/80.png", type, status);
					}
				});
			});
	}
	
	function refreshrem(){
		clearOverlays();
		$.get("map_process.php", function (data) {
				$(data).find("marker").each(function () {
					var binid 		= $(this).attr('binid');
					var areaname 	= $(this).attr('areaname');
					var areaid 		= $(this).attr('areaid');
					var filedlevel 	= $(this).attr('filedlevel');
					var status 		= $(this).attr('status');
					var point 		= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));
					
					if(status=='Active')
					{
						create_marker(point, binid, filedlevel, false, false, false, "icons/50.png", areaid); 
					}
					else if(status=='Inactive')
					{
						create_marker(point, binid, filedlevel, false, false, false, "icons/inactive.png", areaid);
					}
				});
			});	
	}
	
	function refreshreq(){
		clearOverlays();
				$.get("map_process1.php", function (data) {
				$(data).find("marker").each(function () {
					var binid 		= $(this).attr('binid');
					var email 		= $(this).attr('email');
					var bio 		= $(this).attr('bio');
					var paper 		= $(this).attr('paper');
					var plastic		= $(this).attr('plastic');
					var glass 		= $(this).attr('glass');
					var status 		= $(this).attr('status');
					var confirm		= $(this).attr('confirm');
					var region		= $(this).attr('region');
					var point 		= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));
					
					if(status == 'Approval_Pending' && confirm == 'yes')
					{
						create_marker1(point, binid, email, false, false, "icons/new.png", bio, paper, plastic, glass, status, region);
					}
				});
			});
	}
				
				
    });
</script>

</html>
<?php mysqli_close($con);?>