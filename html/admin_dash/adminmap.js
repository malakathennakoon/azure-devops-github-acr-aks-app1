    $(document).ready(function() {
        if ($('.main-panel > .content').length == 0) {
            $('.main-panel').css('height', '100%');
        }


	var mapCenter = new google.maps.LatLng(6.902827, 79.955681); //Google map Coordinates
	var map;
	
	map_initialize(); // initialize google map
	
	//############### Google Map Initialize ##############
	function map_initialize()
	{
			var directionsService = new google.maps.DirectionsService;
			var directionsDisplay = new google.maps.DirectionsRenderer;
			
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
			directionsDisplay.setMap(map);
			//Load Markers from the XML File, Check (map_process1.php)
			$.get("map_process2.php", function (data) {
				var arCord=[];
				$(data).find("marker").each(function () {
					var binid 		= $(this).attr('binid');
					var level 		= $(this).attr('level');
					var point 		= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));
					arCord.push($(this).attr('lat')+","+$(this).attr('lng'));
					//create_marker(point, binid, level, false, false, "icons/inactive.png");
					
				});
				calculateAndDisplayRoute(directionsService, directionsDisplay,arCord);
			});	
								
	}
	
	function calculateAndDisplayRoute(directionsService, directionsDisplay,arCord) {
        var waypts = [];
        var checkboxArray = arCord;
        for (var i = 0; i < checkboxArray.length; i++) {
          waypts.push({
              location: checkboxArray[i],
              stopover: true
            });
        }
		console.log(waypts);
        directionsService.route({
          origin: {lat: 6.914751, lng: 79.972822},
		  destination: {lat: 6.931113, lng: 79.986955},
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
			  console.log(response);
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
			/*
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }
			*/
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
	/*//############### Create Marker Function ##############
	function create_marker(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, iconPath)
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
		
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'<span>User ID : '+MapTitle+'<br>'+
		'<span>Bin Level : '+MapDesc+'<br>'+
		'</span>'+
		'</div></div>');	

		
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		//add click listner to save marker button		 
		google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker); // click on marker opens info window 
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{
		  infowindow.open(map,marker);
		}
	}*/
	


   });
