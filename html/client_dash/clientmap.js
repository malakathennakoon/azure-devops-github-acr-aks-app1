    $(document).ready(function() {
        if ($('.main-panel > .content').length == 0) {
            $('.main-panel').css('height', '100%');
        }


	var mapCenter = new google.maps.LatLng(6.902827, 79.955681); //Google map Coordinates
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
				maxZoom: 100,
				minZoom: 1,
				zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL //zoom control size
			},
				scaleControl: true, // enable scale control
				mapTypeId: google.maps.MapTypeId.ROADMAP // google map type
			};
		
		   	map = new google.maps.Map(document.getElementById("map"), googleMapOptions);			
			
			//Load Markers from the XML File, Check (map_process1.php)
			refreshbin();
			avabin();
			
			//Right Click to Drop a New Marker
			google.maps.event.addListener(map, 'rightclick', function(event) {
				//Edit form to be displayed with new marker
				var EditForm = '<p><div class="marker-edit">'+
				'<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">'+
				'<span>Bin Type Needed :</span><br><input type="checkbox" name="bio" class="bio" value="bio">Biodegradable<br><input type="checkbox" name="glass" class="glass" value="glass">Glass<br><input type="checkbox" name="paper" class="paper" value="paper">Paper<br><input type="checkbox" name="plastic" class="plastic" value="plastic">Plastic<br>'+
				'<span>Bin Available : </span> <select name="pType" class="save-type"><option value="yes">Yes</option><option value="no">No</option></select><br>'+
				'<span>Region : </span> <select name="pType" class="save-type1"><option value="MLB">Malabe</option><option value="KDU">Kaduwela</option></select>'+
				'</form>'+
				'</div></p><button name="save-marker" class="save-marker">Request Bin</button>';

				//Drop a new Marker with our Edit Form
				create_marker1(event.latLng, 'New Marker', EditForm, true, true, true, "icons/new1.png");
			});
										
	}
	
	//############### Create Marker Function ##############
	function create_marker(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, iconPath, bio, paper, plastic, glass, status)
	{	  	  		  
		
		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: map,
			draggable:DragAble,
			//animation: google.maps.Animation.DROP,
			title:"Hello World!",
			icon: iconPath
		});
		
		markersArray.push(marker);
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'User ID : '+MapTitle+'<br>'+
		'User Email : '+MapDesc+'<br>'+
		'Type : '+bio+' '+paper+' '+plastic+' '+glass+'<br>'+
		'Bin Status : '+status+'<br>'+
		'</span>'+
		'</div></div>');	

		
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		//Find remove button in infoWindow

		var saveBtn 	= contentString.find('button.save-marker')[0];


		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
				var mReplace = contentString.find('span.info-content'); //html to be replaced after success
				var mName = contentString.find('input.save-name')[0].value; //name input field value
				var mDesc  = contentString.find('textarea.save-desc')[0].value; //description input field value
				var mType = contentString.find('select.save-type')[0].value; //type of marker
				var mregion = contentString.find('select.save-type1')[0].value;
				
				if(mName =='' || mDesc =='')
				{
					alert("Please enter Name and Description!");
				}else{
					save_marker(marker, mName, mDesc, mType, mregion, mReplace); //call save marker function
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
	

				
	//############### Create Marker Function1 ##############
	function create_marker1(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, iconPath)
	{	  	  		  
		
		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: map,
			draggable:DragAble,
			animation: google.maps.Animation.DROP,
			title:"Hello World!",
			icon: iconPath
		});
		
		markersArray.push(marker);
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+MapDesc+'<br>'+
		'<button name="remove-marker" class="remove-marker" title="Remove Marker">Remove Bin</button></span>'+
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
			remove_marker(marker);
		});
		
		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
				var mReplace = contentString.find('span.info-content'); //html to be replaced after success
				console.log($('input.bio').is(":checked"));
				var mbio = $('input.bio').is(":checked") ? 'bio':''; 
				var mgl  = $('input.glass').is(":checked") ? 'gl':'';
				var mpa  = $('input.paper').is(":checked") ? 'pa':'';
				var mpl  = $('input.plastic').is(":checked") ? 'pl':'';
				var mType = contentString.find('select.save-type')[0].value; //position
				var mregion = contentString.find('select.save-type1')[0].value;
				
				save_marker(marker, mbio, mgl, mpa, mpl ,mType, mregion, mReplace); //call save marker function

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
				function create_marker3(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, iconPath)
				{	  	  		  
					
					//new marker
					var marker = new google.maps.Marker({
						position: MapPos,
						map: map,
						draggable:DragAble,
						//animation: google.maps.Animation.DROP,
						title:"Hello World!",
						icon: iconPath
					});
					
					
					
					markersArray.push(marker);
					//Content structure of info Window for the Markers
					var contentString = $('<div class="marker-info-win">'+'<div class="marker-inner-win"><span class="info-content">'+
					'<h1 class="marker-heading">'+MapTitle+'</h1>'+'Bin Level - '+
					MapDesc+'%'+ 
					'</span>'+
					'</div></div>');	

					
					//Create an infoWindow
					var infowindow = new google.maps.InfoWindow();
					//set the content of infoWindow
					infowindow.setContent(contentString[0]);

					//add click listner to save marker button	 */	 
					google.maps.event.addListener(marker, 'click', function() {
							infowindow.open(map,marker); // click on marker opens info window 
					});
					  
					if(InfoOpenDefault) //whether info window should be open by default
					{
					  infowindow.open(map,marker);
					}
				}
	
	//############### Remove Marker Function ##############
	function remove_marker(Marker)
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
			var myData = {del : 'true', latlang : mLatLang}; //post variables
			$.ajax({
			  type: "POST",
			  url: "map_process1.php",
			  data: myData,
			  success:function(data){
					Marker.setMap(null); 
					alert(data);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError); //throw any errors
				}
			});
		}

	}
	
	//############### Save Marker Function ##############
	function save_marker(Marker, mbio, mgl, mpa, mpl, mType, mregion, replaceWin)
	{
		//Save new marker using jQuery Ajax
		var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
		var myData = {bio : mbio, glass : mgl, paper : mpa, plastic : mpl, latlang : mLatLang, type : mType, region : mregion }; //post variables
		console.log(myData)
		console.log(replaceWin);		
		$.ajax({
		  type: "POST",
		  url: "map_process1.php",
		  data: myData,
		  success:function(data){
				Marker.setDraggable(false); //set marker to fixed
				Marker.setIcon('icons/new.png'); //replace icon
				refreshbin();
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
	
	function refreshbin(){
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
					var point 		= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));
					
					create_marker(point, binid, email, false, false, "icons/new.png", bio, paper, plastic, glass, status);

				});
			});	
	}
	
			function avabin(){
						$.get("map_process.php", function (data) {
							$(data).find("marker").each(function () {
								  var binid 		= $(this).attr('binid');
								  var areaname 		= $(this).attr('areaname');
								  var areaid 		= $(this).attr('areaid');
								  var filedlevel 	= $(this).attr('filedlevel');
								  var status 		= $(this).attr('status');
								  var point 		= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));
								  
								  create_marker3(point, binid, filedlevel, false, false, false, "icons/50.png"); 

				});
			});	
	}
	
    });
