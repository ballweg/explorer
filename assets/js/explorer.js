function getReward(){
	// callback to server
	console.log('checking for rewards');
	$.ajax({
		type:    "POST",
		url:     "getReward.php",
		cache:   false,
		success: rewardSuccess,
		error:   callbackError
	});
	return false;
}

function rewardSuccess(data){
	json = $.parseJSON(data);
	console.log(json);
	if(json.success == true){
		//console.log('that was true - youre getting a reward');
		//console.log(json.reward);
		reward = json.reward;
		
		$("#rewardDialog #diag-heading").html(reward.name);
		$("#rewardDialog #diag-image").attr('src',reward.image_url);
		$("#rewardDialog #diag-text").html(reward.text);
		$("#rewardDialog #diag-btn").click(function(){getReward();});
		
		$.mobile.changePage("#rewardDialog", {role: "dialog"});
	} else {
		//console.log('sorry, no reward for you right now.');
		$.mobile.changePage("");	
	}
}

function closeDialog(){
	$(this).dialog( "close" );
}

/* when user as entered correct answer to a question */
function qaSuccess(data, status){
	data = $.trim(data);
	//console.log(data);
	if(data == "true"){var msg = "Correct!";} else {var msg = data;}
	$.mobile.loading('show', {theme:"e", text:msg, textonly:true, textVisible: true});
	setTimeout(function(){
		if(data == "true"){
			getReward();
		} else {
			$.mobile.loading('hide');
		}
	}, 1500);
}

/*  On intitisation of a file containing jqm stuff  */
$(document).bind('pageinit', function(event) {
	// undelegate/delegate maneuver prevents event bindings from stacking up
	$(document).undelegate('.qasubmit', 'click').delegate('.qasubmit', 'click', function() {
		var formData = $(this).parent().parent().parent().parent().parent().serialize();
		event.preventDefault();
			
		$.ajax({
			type:    "POST",
			url:     "getAnswer.php",
			cache:   false,
			data:    formData,
			success: function(data){qaSuccess(data);},
			error:   callbackErrorQA
		});
		return false;
	});
});

var map;
/*  On showing of a jqm page  */
$(document).on('pageshow', function(){
	if($.mobile.activePage.attr("id")!='login' && $.mobile.activePage.attr("id")!='registration' && $.mobile.activePage.attr("id")!='terms'){
		$.ajax({
			type:    "POST",
			url:     "getCompleted.php",
			dataType: "json",
			cache:   false,
			success: updateCompleted,
			error:   callbackError
		});
	}
	if($.mobile.activePage.attr("id")=='home'){
		$('#home .ui-btn-left').hide();
		var height = $(window).height();
		var width = $(window).width();
		
		if(width > height && width > 650){
			var mapheight = height - 120;
			$('#map').css('height',mapheight+'px');
		}
		mapInit();
	}
	//if($.mobile.activePage.attr("id")=='rewardDialog'){
	/*	$('#diag-btn').click(function(){
			getReward();
		});
		*/
	//}
	return false;
});

/* updates ui each time a jqm page is shown to indicate completed challenges */
function updateCompleted(data){
	json = $.parseJSON(data);
	if(json){
		$.each(json, function(k, v){
			$('#challenge-'+v).addClass('completed');
			$('#challenge-'+v).buttonMarkup({ icon: "check" });
			/* data-collapsed-icon="gear" data-expanded-icon="delete"*/
			$('#qa-'+v).hide();
			$('#completed-'+v).show();
		});
	}
}

/* generic callback error messaging */
function callbackErrorQA(){
	console.log('there was an error fetching key data from the server - QA');
}
/* generic callback error messaging */
function callbackErrorGR(){
	console.log('there was an error fetching key data from the server - GR');
}
/* generic callback error messaging */
function callbackError(){
	console.log('there was an error fetching key data from the server - Generic');
}

/* inline validation for the registration page */
function validateRegistration(){
	$.extend($.validator.messages, { required: "Required" });
	$.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
		}); 
	$("#registrationform").validate({
		rules: {
			username: {required: true, alphanumeric: true},
			email: "required",
			pass1: "required",
			pass2: { equalTo: "#pass1" },
			submitHandler: function(form) {
		        //console.log("Call Registration Action");
				$.post('/?task=reg-submit', function(data){
		        	//console.log('success!');
				});
			}
		},
		messages: {
			username: {
				required: "Enter a username",
				minlength: "At least {0} characters please",
				alphanumeric: "Only letters and numbers please"
			},
			email: {
				required: "Enter an email address",
				maxlength: $.format("Maximum length is {0} characters")
			},
			pass1: {
				required: "A password is required",
				maxlength: $.format("Maximum length is {0} characters"),
				minlength: $.format("At least {0} characters please")
			},
			pass2: {
				equalTo: "Passwords don't match"
			}
		}
	});
}

function createMarker(map, latlng, txt, questid){

  /*var icon = new google.maps.Icon({
	 url: '/assets/img/map/markers/teal.png',
	 size: new google.maps.Size(10,10) 
  });*/
  
  var icon = new google.maps.MarkerImage("/assets/img/map/markers/teal.png", null, null, null, new google.maps.Size(8,8));
  
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
