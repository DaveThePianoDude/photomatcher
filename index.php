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
	
		function pg_connection_string() {

			return "dbname=d7qq84ps7u5thb host=ec2-184-73-175-240.compute-1.amazonaws.com port=5432 user=jnnvxxjaenvzor password=Xpq6UHZoub1e6LIUPdUZrX6bSz sslmode=require";
		
		}

		# Establish db connection
		$db = pg_connect(pg_connection_string());
		
		if (!$db) {
		
			echo "Database connection error.";
			exit;
			
		} else
		{
			echo "Database connection succeeded.";
			
			echo "Now 'n' Then v. 0.124";
			
			$query = "CREATE TABLE IF NOT EXISTS Places (natId bigserial primary key NOT NULL, userName varchar(20) NOT NULL, locationId bigserial, photoNowId bigserial, photoThenId bigserial, lat varchar(50) NOT NULL, lon varchar(50) NOT NULL);";
			
			pg_query($db, $query);
			
			echo "got here";	
		}
		
		$natId = $_GET['natId'];
		$userName = $_GET['userName'];
		$locationId = $_GET['locationId'];
		$photoNowId = $_GET['photoNowId'];
		$photoThenId = $_GET['photoThenId'];
		$lat = $_GET['lat'];
		$lon = $_GET['lon'];
	
		if (&natId != NULL)
		{
	
		$query = "INSERT INTO Places VALUES ($natId, '$userName', $locationId, $photoNowId, $photoThenId, '$lat', '$lon');";
		
		echo $query;
		
		pg_query($db, $query);// comment
		
		echo "inserted row";
		}
	
		$result = pg_query($db, "SELECT * FROM Places");
	
		$i = 0;
		
		echo '<html><body><table><tr>';

		 while ($i < pg_num_fields($result))

		 { $fieldName = pg_field_name($result, $i);

		 echo '<td>' . $fieldName . '</td>';

		 $i = $i + 1;

		 }

		 echo '</tr>'; $i = 0;

		 while ($row = pg_fetch_row($result))
		 { 
		 echo '<tr>';
		 $count = count($row);
		 $y = 0;
		 while ($y < $count)
		 {
		 $c_row = current($row);
		 echo '<td>' . $c_row . '</td>';
		 next($row); $y = $y + 1; 
		 } 
		 echo '</tr>';
		 $i = $i + 1; } 
		 
		 pg_free_result($result);
		 
		 echo '</table></body></html>';

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


