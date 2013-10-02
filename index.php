<!DOCTYPE html>
<html>
  <head>
    <title>Ruby on Rails: Welcome aboard</title>
	
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.css" />
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>

	<style type="text/css" media="screen">
	
	#map { height: 500px;
			border-style:solid;
			border-width:1px;
			border-color:red }
	
    </style>

	<script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>

  </head>
  
  <body>

	<div id="map"></div>
	
	<?php
	
	phpinfo();
	
	?>
	
  </body>
  	<script type="text/javascript">		
		var map = L.map('map').setView([38.7, -77.2], 8);
		
		L.tileLayer('http://{s}.tile.cloudmade.com/842d83399a1d4a588c20671f08990c5c/997/256/{z}/{x}/{y}.png', {
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>[…]',
			maxZoom: 18
		}).addTo(map);
		
		map.setView(london, 13).addLayer(osm);
	</script>
</html>


