	<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Open Day Explorer Data</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Muli:300,400' rel='stylesheet' type='text/css'>
	
	<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
    
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart','table']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawCompletionByUser);
    google.setOnLoadCallback(drawCompletionByStand);
    
    var map;
    var cdu = new google.maps.LatLng(-12.372056, 130.869);
    var mapOptions = { center: cdu, zoom: 17, mapTypeId: google.maps.MapTypeId.ROADMAP };
    var markers = [];
    
    function initialize() {
        map = new google.maps.Map(document.getElementById("user_travel_map"), mapOptions);
        
        var contentLocsJSON = $.ajax({
          url: "/getData.php?task=content_loc",
          dataType:"json",
          async: false
          }).responseText;
        
        var contentLocations = [];
        var contentLocs = $.parseJSON(contentLocsJSON);
        $.each(contentLocs, function(i, item){
        	var gpoint = new google.maps.LatLng(contentLocs[i].lat, contentLocs[i].lon);
        	contentLocations.push({id: i,latlong: gpoint}); 
        }); 
        
        //console.log(contentLocations);
        // get user data
        
        var userPathJSON = $.ajax({
          url: "/getData.php?task=user_paths",
          dataType:"json",
          async: false
          }).responseText;
          
        var userPath = $.parseJSON(userPathJSON);
        //console.log(userPath);
        
        //console.log('everyones first checkin id');
        $.each(userPath, function(i, item){
        	// need to work out why this is trying to read null arrays
        	//console.log(typeof(userPath[i].task_path));
        	if(userPath[i].task_path == null){
        		console.log('just hit a null one');
        	}
        	if(userPath[i].task_path != null){
        		var path_arr = [];
        		//console.log(userPath[i].task_path);
        		var path = userPath[i].task_path;
	        	/*var first_stand = path[0];
		        var second_stand = path[1];*/
		        /*if(first_stand && second_stand){
			        //addMarkerPath(contentLocations[first_stand].latlong, contentLocations[second_stand].latlong);
			        //addMarkerPath();
			    }*/
			    //addMarkerPath(path);
			    //console.log('path');
			    //console.log(path);
			    //if(path[p] != null){
				    for(var p=0; p < path.length; p++){
				    	var node_id = path[p];
				    	console.log('location:'+contentLocations[node_id].latlong);
				    	path_arr.push(contentLocations[node_id].latlong);
				    }
			    //}
	        	console.log('path arr');
	        	addMarkerPath(path_arr);
			    
        	}
    //    	addMarkerPath(path_arr);
	        //addMarker(, )
        });
                
        // loop through each set of lat-lngs creating points and pushing them to an array for each user
        
        // crate a 2-d array where one level is users and the other is the array of latlngs (thier "path")
        
        /*from1 = new google.maps.LatLng(0,0);
        to1 = new google.maps.LatLng(30,12);

        from2 = new google.maps.LatLng(-30,15);
        to2 = new google.maps.LatLng(10,-100);

        from3 = new google.maps.LatLng(0,-50);
        to3 = new google.maps.LatLng(0,50);
        
        // add markers, and pass in each one's array.
      
        addMarker(from1,to1);
        addMarker(from2,to2);
        addMarker(from3,to3);*/
    }
    
    function addMarkerPath(pos_arr) {
    	// rewrite this to march through the array instead of taking two
    	//$.each(pos_arr){
    		var marker = new google.maps.Marker({
    			map: map,
    			position: pos_arr[0],
    			path: pos_arr
    		});
    	//}
    	
        /*var marker = new google.maps.Marker({
          map: map,
          position: pos,
          destination: dest
		});*/
		
		/*
          fromLat = marker.position.lat();
          fromLng = marker.position.lng();
          toLat = marker.destination.lat();
          toLng = marker.destination.lng();
        */
		
		setTimeout(function(){
			$.each(function(index){
				frames = [];
		    	for (var percent = 0; percent < 1; percent += 0.01) {
		    		console.log('line 122');
		    		console.log(marker.position);
		        	curLat = marker.position[index].lat() + percent * (marker.position[index+1].lat() - marker.position[index].lng());
		            curLng = marker.position[index+1].lng() + percent * (marker.position[index+1].lng() - marker.position[index].lng());
		            frames.push(new google.maps.LatLng(curLat, curLng));
		        }
		
				move = function(marker, latlngs, index, wait, newDestination) {
		        	marker.setPosition(latlngs[index]);
		        	if(index != latlngs.length-1) {
		        		// call the next "frame" of the animation
		            	setTimeout(function() { 
		            		move(marker, latlngs, index+1, wait, newDestination); 
		            	}, wait);
		        	} else {
		        		// assign new route
		        		marker.position = marker.destination;
		        		marker.destination = newDestination;
            		}
          		}
          		// send to the next location after this position completes
          		move(marker, frames, 0, 20, marker.position);
			});
		}, 2500);
		
		markers.push(marker);
    }
    
    function addMarker(pos, dest) {
    	// get each markers array, and render it at the [0] position

        var marker = new google.maps.Marker({
          map: map,
          position: pos,
          destination: dest
		});
		
		//google.maps.event.addListener(marker, 'click', function(event) {
		setTimeout(function(){
          fromLat = marker.position.lat();
          fromLng = marker.position.lng();
          toLat = marker.destination.lat();
          toLng = marker.destination.lng();

          // store a LatLng for each step of the animation
          frames = [];
          for (var percent = 0; percent < 1; percent += 0.01) {
            curLat = fromLat + percent * (toLat - fromLat);
            curLng = fromLng + percent * (toLng - fromLng);
            frames.push(new google.maps.LatLng(curLat, curLng));
          }

		  move = function(marker, latlngs, index, wait, newDestination) {
            marker.setPosition(latlngs[index]);
            if(index != latlngs.length-1) {
              // call the next "frame" of the animation
              setTimeout(function() { 
                move(marker, latlngs, index+1, wait, newDestination); 
              }, wait);
            }
            else {
              // assign new route
              marker.position = marker.destination;
              marker.destination = newDestination;
            }
          }

          // send to the next location after this position completes
          
          move(marker, frames, 0, 20, marker.position);
        //});
        },2500);

		markers.push(marker);
    }
    
    google.maps.event.addDomListener(window, 'load', initialize);
    
	/* draw user completion levels by number of tasks completed */ 
    function drawCompletionByUser() {
      var jsonData = $.ajax({
          url: "/getData.php?task=completion_distribution",
          dataType:"json",
          async: false
          }).responseText;
          
      var data = new google.visualization.DataTable(jsonData);
	  data.sort([{column:0, desc: false}]);
     
      var chart = new google.visualization.ColumnChart(document.getElementById('completion_dist_chart_div'));
      var options =  {
      	title: 'Completed Tasks by User', 
      	width: 1000, height: 400, 
      	hAxis: {title: 'Total Tasks Completed'},
      	vAxis: {title: 'Number of Users'}
      };
      chart.draw(data, options);
      
      var table = new google.visualization.Table(document.getElementById('completion_dist_table_div'));
      var options = {
	    showRowNumber: false,
	    width: 1000, height: 400,  
      };
      table.draw(data, options);
    }
    
    
    /* draw completion chart for each stand */
    function drawCompletionByStand() {
      var jsonData = $.ajax({
          url: "/getData.php?task=completion_distribution_by_content",
          dataType:"json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);
	  data.sort([{column:0, desc: false}]);
	  
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.ComboChart(document.getElementById('completion_stands_chart_div'));
      var options = {
      	title: 'Number of Users Completing Each Task', 
      	width: 1000, height: 400,
	    vAxis: {title: 'Number of Users Completing', minValue: 0},
	    seriesType: "bars",
	    series: {1: {type: "line"}}
      };
      chart.draw(data, options);     
      
      var table = new google.visualization.Table(document.getElementById('completion_stands_table_div'));
      var options = {
	    showRowNumber: false,
	    width: 1000, height: 400,  
      };
      table.draw(data, options);
    }

    </script>
    <script type="text/javascript">

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
			/* Update total users */
		    $.get('/getStatus.php?task=total_users', function(data) {	    	
		    	var json = $.parseJSON(data);
		    	var num = json[0]["user_count"];
		    	$('#total-users .user-no').html(num);
		    });
			
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
			$.get('/getStatus.php?task=badge_info', function(data) {
				var json = $.parseJSON(data);
				$(json).each(function(){
					var id = '#badge-'+this.id;
					$(id).html(this.completed);
				});
			});
			
			
			/* Update latest user */
			$.get('/getStatus.php?task=newest_user', function(data){
			var json = $.parseJSON(data);
			$('#user-name').html(json[0]['name']);
			});
			
			$.getJSON('/getData.php', function(json) {
				var dataTable = new google.visualization.DataTable(json);
			});
		};

    </script>
    <link rel="stylesheet" type="text/css" href="data.css"/>
  </head>
  <body>
    <div id="dashboard">
    	<div class="top">
	        <div id="logo">
	        	<img src="/assets/img/exp_splash.svg">
	        </div>
	        
	        <div class="title">User Travel</div>
	        <div id="user_travel_map"></div>
	        
	        <div class="title">How far did users get? Tasks completed</div>
	        <div id="completion_dist_chart_div"></div>
	        <div id="completion_dist_table_div"></div>
	        
	        <div class="title">Which stands were completed?</div>
	        <div id="completion_stands_chart_div"></div>
	        <div id="completion_stands_table_div"></div>	        
	        	        
	        <div class="explorer-url"><h1>System Data</h1></div>
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