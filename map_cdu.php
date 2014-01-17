<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Ground Overlays</title>
    <link href="http://explorer.local:8080/map.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
function initialize() {

  var newark = new google.maps.LatLng(40.740, -74.18);
  var imageBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(40.712216,-74.22655),
      new google.maps.LatLng(40.773941,-74.12544));

  var mapOptions = {
    zoom: 13,
    center: newark,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var oldmap = new google.maps.GroundOverlay(
      'https://www.lib.utexas.edu/maps/historical/newark_nj_1922.jpg',
      imageBounds);
  oldmap.setMap(map);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>