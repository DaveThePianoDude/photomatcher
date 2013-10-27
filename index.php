<!DOCTYPE html>
<html>
  <head>
    <title>Ruby on Rails: Welcome aboard</title>
	
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.css" />
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>

	<script type="text/javascript">
			
		function reslide() {
		
				var Event = YAHOO.util.Event,
					Dom   = YAHOO.util.Dom,
					lang  = YAHOO.lang,
					slider, 
					bg="slider-bg", thumb="slider-thumb", 
					valuearea="slider-value", textfield="slider-converted-value"

				// The slider can move 0 pixels up
				var topConstraint = 0;

				// The slider can move 300 pixels down
				var bottomConstraint = 290;

				// Custom scale factor for converting the pixel offset into a real value
				var scaleFactor = 1.0;

				Event.onDOMReady(function() {

					slider = YAHOO.widget.Slider.getHorizSlider(bg, 
									 thumb, topConstraint, bottomConstraint, 0);

					// Sliders with ticks can be animated without YAHOO.util.Anim
					slider.animate = true;

					slider.getRealValue = function() {
						return Math.round(this.getValue() * scaleFactor);
					}

					slider.subscribe("change", function(offsetFromStart) {

						var valnode = Dom.get(valuearea);
						var fld = Dom.get(textfield);
						var pic = Dom.get("thenImage12");
						
						valnode.innerHTML = offsetFromStart;

						var actualValue = slider.getRealValue();
		
						pic.style.opacity = actualValue / 290;
						
						pic = Dom.get("nowImage12");
						
						pic.style.opacity = 1 - actualValue / 290;
									
						Dom.get(bg).title = "slider value = " + actualValue;
					});

					slider.subscribe("slideStart", function() {
							YAHOO.log("slideStart fired", "warn");
						});

					slider.subscribe("slideEnd", function() {
							YAHOO.log("slideEnd fired", "warn");
						});

					// Listen for keystrokes on the form field that displays the
					// control's value.  While not provided by default, having a
					// form field with the slider is a good way to help keep your
					// application accessible.
					Event.on(textfield, "keydown", function(e) {

						// set the value when the 'return' key is detected
						if (Event.getCharCode(e) === 13) {
							var v = parseFloat(this.value, 10);
							v = (lang.isNumber(v)) ? v : 0;

							// convert the real value into a pixel offset
							slider.setValue(Math.round(v/scaleFactor));
						}
					});
					
					// Use setValue to reset the value to white:
					Event.on("putval", "click", function(e) {
						slider.setValue(100, false); //false here means to animate if possible
					});
					
					// Use the "get" method to get the current offset from the slider's start
					// position in pixels.  By applying the scale factor, we can translate this
					// into a "real value
					Event.on("getval", "click", function(e) {
						YAHOO.log("Current value: "   + slider.getValue() + "\n" + 
								  "Converted value: " + slider.getRealValue(), "info", "example"); 
					});
				});
			}
	
	</script>
	
	<style type="text/css" media="screen">
	
	#map { height: 900px;
			border-style:solid;
			border-width:1px;
			border-color:red }
	
	ul.images { position: relative;}
	
	ul.images li {position: absolute;left:-4px;}
	
    </style>
	
	<style type="text/css">
			
		#slider { width: 15px; height:300px; }
		
		#slider-bg {
			background:url(http://yui.yahooapis.com/2.9.0/build/slider/assets/bg-fader.gif) 5px 0 no-repeat;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		#slider-thumb {
			left: 0;
		}
	</style>

	<script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>
	
	<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.9.0/build/yahoo-dom-event/yahoo-dom-event.js&2.9.0/build/dragdrop/dragdrop-min.js&2.9.0/build/slider/slider-min.js"></script>
	
  </head>
  
  <body>

	<div id="map"></div>
	<p>Pixel value: <span id="slider-value">0</span></p>
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
			
			echo "Now 'n' Then v. 0.127";
		}
		
		$query = "CREATE TABLE IF NOT EXISTS Places (natId bigserial primary key NOT NULL, userName varchar(20) NOT NULL, locationId bigserial, photoNowId bigserial, photoThenId bigserial, lat varchar(50) NOT NULL, lon varchar(50) NOT NULL);";
			
		pg_query($db, $query);

		$result = pg_query($db, "SELECT * FROM Places");
		 
		echo "<script type=\x22text/javascript\x22>";
	
		echo "var map = L.map(\x22map\x22).setView([38.7, -77.2], 8);";
		
		echo "L.tileLayer(\x22http://{s}.tile.cloudmade.com/842d83399a1d4a588c20671f08990c5c/997/256/{z}/{x}/{y}.png\x22, {";
		
		echo "attribution: 'Map data &copy; <a href=\x22http://openstreetmap.org\x22>OpenStreetMap</a> contributors, <a href=\x22http://creativecommons.org/licenses/by-sa/2.0/\x22>CC-BY-SA</a>, Imagery © <a href=\x22http://cloudmade.com\x22>CloudMade</a>[…]',";
		
		echo "maxZoom: 18";
		
		echo "}).addTo(map);";
		
		$x = 1;
		
		while ($row = pg_fetch_row($result))
		{
			 $count = count($row);
			 $y = 0;
			 
			 while ($y < $count)
			 {
				$c_row = current($row);
				 
				if ($y == 5)
			
					$lat = $c_row;
				
				if ($y == 6)
			
					$lon = $c_row;
			 
				next($row); $y = $y + 1; 
			}
		 	 
			if (is_numeric($lat) && is_numeric($lon))
			{
				echo "var marker = L.marker([$lat, $lon]).addTo(map);";
				
				$uid = $x;
	
				$result2 = pg_query($db, "SELECT * FROM NOW_PHOTOS WHERE id = '$uid'");
	
				$line = pg_fetch_row($result2);
	
				$img_str = trim($line[1]);
				
				$result2 = pg_query($db, "SELECT * FROM THEN_PHOTOS WHERE id = '$uid'");
				
				$line = pg_fetch_row($result2);
				
				$img_str2 = trim($line[1]);
		
				echo "marker.bindPopup(\x22<h3>Photo Title #".$x."</h3><div ID='bigdiv' style='width:320px;height:240px' ><ul class='images'><li><img ID='thenImage12' style='opacity:0' src='data:image/jpg;base64,".$img_str."' height='240px' width='300px'></img></li><li><img ID='nowImage12' style='opacity:1' src='data:image/jpg;base64,".$img_str2."' height='240px' width='300px'></img></li></ul></div><div id='slider-bg' class='yui-h-slider' tabindex='-1' title='Slider'><div id='slider-thumb' class='yui-slider-thumb'><img src='http://yui.yahooapis.com/2.9.0/build/slider/assets/thumb-n.gif'></div></div>\x22).openPopup();";
			}

			$x = $x + 1;			
		} 
		 
		echo "map.on('popupopen', reslide);";
		
		echo "map.setView(london, 13).addLayer(osm);";
		
		echo "</script>";
				
		pg_free_result($result);
		
		pg_close($db);
	
	?>
		<script type="text/javascript">
		
			(function() {
			
				var Event = YAHOO.util.Event,
					Dom   = YAHOO.util.Dom,
					lang  = YAHOO.lang,
					slider, 
					bg="slider-bg", thumb="slider-thumb", 
					valuearea="slider-value", textfield="slider-converted-value"

				// The slider can move 0 pixels up
				var topConstraint = 0;

				// The slider can move 300 pixels down
				var bottomConstraint = 290;

				// Custom scale factor for converting the pixel offset into a real value
				var scaleFactor = 1.0;

				Event.onDOMReady(function() {

					slider = YAHOO.widget.Slider.getHorizSlider(bg, 
									 thumb, topConstraint, bottomConstraint, 0);

					// Sliders with ticks can be animated without YAHOO.util.Anim
					slider.animate = true;

					slider.getRealValue = function() {
						return Math.round(this.getValue() * scaleFactor);
					}

					slider.subscribe("change", function(offsetFromStart) {

						var valnode = Dom.get(valuearea);
						var fld = Dom.get(textfield);
						var pic = Dom.get("thenImage12");
						
						valnode.innerHTML = offsetFromStart;

						var actualValue = slider.getRealValue();
		
						pic.style.opacity = actualValue / 290;
						
						pic = Dom.get("nowImage12");
						
						pic.style.opacity = 1 - actualValue / 290;
									
						Dom.get(bg).title = "slider value = " + actualValue;
					});

					slider.subscribe("slideStart", function() {
							YAHOO.log("slideStart fired", "warn");
						});

					slider.subscribe("slideEnd", function() {
							YAHOO.log("slideEnd fired", "warn");
						});

					// Listen for keystrokes on the form field that displays the
					// control's value.  While not provided by default, having a
					// form field with the slider is a good way to help keep your
					// application accessible.
					Event.on(textfield, "keydown", function(e) {

						// set the value when the 'return' key is detected
						if (Event.getCharCode(e) === 13) {
							var v = parseFloat(this.value, 10);
							v = (lang.isNumber(v)) ? v : 0;

							// convert the real value into a pixel offset
							slider.setValue(Math.round(v/scaleFactor));
						}
					});
					
					// Use setValue to reset the value to white:
					Event.on("putval", "click", function(e) {
						slider.setValue(100, false); //false here means to animate if possible
					});
					
					// Use the "get" method to get the current offset from the slider's start
					// position in pixels.  By applying the scale factor, we can translate this
					// into a "real value
					Event.on("getval", "click", function(e) {
						YAHOO.log("Current value: "   + slider.getValue() + "\n" + 
								  "Converted value: " + slider.getRealValue(), "info", "example"); 
					});
				});
			})();
			
	</script>

</html>


