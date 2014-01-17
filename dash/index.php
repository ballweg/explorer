	<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Open Day Explorer Dashboard</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <link href='http://fonts.googleapis.com/css?family=Muli:300,400' rel='stylesheet' type='text/css'>
    
    <script src="raphael.2.1.0.min.js"></script>
	<script src="justgage.1.0.1.min.js"></script>
    
    <script type="text/javascript">
    			
		function mapInit() {
		
		  var cdu = new google.maps.LatLng(-12.372056, 130.869);
		
		  var swBound = new google.maps.LatLng(-12.376493,130.863291);
		  var neBound = new google.maps.LatLng(-12.367739,130.874569);
		  var bounds = new google.maps.LatLngBounds(swBound, neBound);
		
		  var imageBounds = new google.maps.LatLngBounds(swBound, neBound);
			
		  
		  var mapOptions = {
		    zoom: 17,
		    center: cdu,
		    mapTypeId: google.maps.MapTypeId.ROAD
		  }		  
		  
		  //var bldgOverlayOptions = {opacity: 1}		  
		  var odayOverlayOptions = {opacity:1}	  
		  var pathOverlayOptions = {opacity:0.6}
		
		  map = new google.maps.Map(document.getElementById('map'), mapOptions);
		
		    var paths = new google.maps.GroundOverlay(
		      '/assets/img/map/paths.png',
		      imageBounds, pathOverlayOptions);
		  paths.setMap(map);
		  
		  var bldgs = new google.maps.GroundOverlay(
		      '/assets/img/map/bldgs.png',
		      imageBounds);
		  bldgs.setMap(map);
		  
		  var oday = new google.maps.GroundOverlay(
		      '/assets/img/map/oday.png',
		      imageBounds, odayOverlayOptions);
		  oday.setMap(map);
		  
		  $.ajax({
		  	type:    "GET",
			url:     "getGeo.php?loc=true",
			dataType: "json",
			cache:   false,
			success: function(data){prepareMarker(data)},
			error:   callbackError
		  });
		  
		  //createMarker(map, new google.maps.LatLng(-12.372056,130.869));
		  
		}
		
		//function update

		function createMarker(map, latlng, txt, questid){
		
		  /*var icon = new google.maps.Icon({
			 url: '/assets/img/map/markers/teal.png',
			 size: new google.maps.Size(10,10) 
		  });*/
		  
			  var icon = new google.maps.MarkerImage("/assets/img/map/markers/teal.png", null, null, null, new google.maps.Size(8,8));
			  
			  var map;
			  
			  var dot = {
				  fillColor: "paleturquoise",
				  fillOpacity: 1,
				  strokeColor: "black",
				  strokeWeight: 1,
				  scale: 1,
				  path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW
			  }
			
			  var marker = new google.maps.Marker({
			      position: latlng,
			      map: map,
			      title: txt,
			      icon: icon,
			  });
			  
			  marker.setMap(map);
		}
		
		function prepareMarker(data){
			for(i=0; i<data.length; i++){
				//console.log(data[i].lat, data[i].lon, data[i].location, data[i].quest_id);
				ll = new google.maps.LatLng(data[i].lat, data[i].lon);
				createMarker(map, ll, data[i].location, data[i].quest_id);
			}
		}
		
		
		/* generic callback error messaging */
		function callbackError(){
			console.log('there was an error fetching key data from the server - map engine');
		}
		
		//google.maps.event.addDomListener(window, 'load', mapInit());
		$(document).ready(function(){
			$('#dashboard').css('height', $(window).height());
			//mapInit();	  
		});
		
		$(window).resize(function(){
			$('#dashboard').css('height', $(window).height());
		});
		

		var g1;	
		window.onload = function(){
		
			/* setup gauge */
			var g1 = new JustGage({
				id: "completed-gauge", 
			    value: 0, 
			    min: 0,
			    max: 100,
			    title: 'Completed',
			    label: "percent",
			    titleFontColor: '#555',
			    levelColours: ['#fff','#cca'],
			    showInnerShadow: false
			});
		
			/* update percent completed guague */
			setInterval(function() {
			    $.get('/getStatus.php?task=pct_complete', function(data) {
			    	/*var json = $.parseJSON(data);
			    	g1.refresh(json[0]["count(id)"]);*/		    	
			    	g1.refresh(Math.round(data*100));
			    	
			    });         
			}, 2500);
		
			/* Update total users */
			setInterval(function() {
			    $.get('/getStatus.php?task=total_users', function(data) {	    	
			    	var json = $.parseJSON(data);
			    	var num = json[0]["user_count"];
			    	$('#total-users .user-no').html(num);
			    });         
			}, 2500);
			
			/* setup badges */
			$.get('/getStatus.php?task=badge_info', function(data){
				var json = $.parseJSON(data);
				$('#badges').append('<ul></ul>');
				$(json).each(function(index){
					var li = document.createElement("li");
					$(li).append("<img src='"+this.image_url+"' />");
					$(li).append("<span id='badge-"+this.id+"' class='badge-tally'>"+this.completed+"</span>");
					$('#badges ul').append(li);
					//$('#badges ul').append("<li id="+this.id+">").append("<img src='"+this.image_url+"' />");
					//console.log(this.id + ' ' + this.image_url + ' ' + this.name + ' ' + this.completed);
				});
				
			});
			
			/* refresh badges */
			setInterval(function() {
				$.get('/getStatus.php?task=badge_info', function(data) {
					var json = $.parseJSON(data);
					$(json).each(function(){
						var id = '#badge-'+this.id;
						$(id).html(this.completed);
					});
				});
			}, 2500);
			
			/* Percent completed guague */
			setInterval(function() {
			    $.get('/getStatus.php?task=pct_complete', function(data) {
			    	/*var json = $.parseJSON(data);
			    	g1.refresh(json[0]["count(id)"]);*/		    	
			    	g1.refresh(Math.round(data*100));
			    	
			    });         
			}, 2500);
			
			/* Update latest user */
			setInterval(function() {
				$.get('/getStatus.php?task=newest_user', function(data){
				var json = $.parseJSON(data);
				$('#user-name').html(json[0]['name']);
				});
			}, 2500);
		};

    </script>
    <link rel="stylesheet" type="text/css" href="dash.css"/>
  </head>
  <body>
    <div id="dashboard">
    	<div class="top">
	        <div id="logo">
	        	<img src="/assets/img/exp_splash.svg">
	        </div>
	        <div class="explorer-url">Take your mobile device to<br/><h1>explorer.cdu.edu.au</h1></div>
	    	<div id="total-users" class="total-users">
	    		<div class="title">Total Users</div>
	    		<div class="user-no"></div>
	    	</div>
    	</div>
    	<div class="clear"></div>
    	<div>
	    	<div id="latest-user" class="latest-user">
	    		<div class="title">Latest User</div>
	    		<div id="user-name" class="user-name"></div>
	    	</div>
    	</div>
    	<div class="clear"></div>
    	<div class="bottom">
	    	<div id="completed-gauge" class="big-guage">
	    	</div>
	    	<div id="badges" class="badges">
	    		<span class="title">Badges Earned</span>
	    	</div>
    	</div>
    </div>
  </body>
</html>