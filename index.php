<!DOCTYPE html>
<html>
  <head>
    <title>Now and Then Photo Matcher</title>

	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.css" />

	<link rel="stylesheet" type="text/css" href="assets/css/nat.css">

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>

	<script type="text/javascript">
	$(document).ready(function(){
		$("#spinner").bind("ajaxSend", function() {
			console.log('ajax send');
			///$(this).show();
		}).bind("ajaxStop", function() {
			console.log('ajax stop');
			//$(this).hide();
		}).bind("ajaxError", function() {
			//$(this).hide();
		});

	});
	</script>

	<script type="text/javascript">

		function prepslides(e) {

				var natId = e.popup._source.options.natId;
				var baseUrl = "download-nat-pair.php?ID=";
				var spinnerId = "#spinner" + natId;
				var natpairId = "#natpair" + natId;

				$.ajax({
					 async: false,
					 type: 'GET',
					 url: baseUrl.concat(natId),
					 success: function(data) {
						  //callback
						  console.log('Done writing to server now and then image pair#'+natId);
						  setTimeout(function(){$(natpairId).show();$(spinnerId).hide();},500);
					 }
				});

				var Event = YAHOO.util.Event,
					Dom   = YAHOO.util.Dom,
					lang  = YAHOO.lang,
					slider,
					bg="slider-bg", thumb="slider-thumb",
					valuearea="slider-value", textfield="slider-converted-value"

				// The slider can move 0 pixels up
				var topConstraint = 0;

				// The slider can move 290 pixels down
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

						pic.style.opacity = actualValue / bottomConstraint;

						pic = Dom.get("nowImage12");

						pic.style.opacity = 1 - actualValue / bottomConstraint;

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

	</style>

	<script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>

	<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.9.0/build/yahoo-dom-event/yahoo-dom-event.js&2.9.0/build/dragdrop/dragdrop-min.js&2.9.0/build/slider/slider-min.js"></script>

	<script type="text/javascript">
		var timeIcon = L.icon({
			iconUrl: 'assets/Leaflet/dist/images/time-machine.png',
			iconRetinaUrl: 'assets/Leaflet/dist/images/time-machine@2x.png',
			iconSize: [57, 57],
			iconAnchor: [28, 28],
			popupAnchor: [-3, -28]
		});
	</script>

  </head>

  <body>

	<div id='slider-thumb'><img src='http://yui.yahooapis.com/2.9.0/build/slider/assets/thumb-n.gif'></div>

	<p>Pixel value: <span id="slider-value">0</span></p>

	<?php

		require_once ('db_conn.php');

		# Establish db connection
		$db = pg_connect(pg_connection_string());

		if (!$db) {

			echo "Database connection error...";

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

		echo "var map = L.map(\x22map\x22).setView([38.85, -77.09], 8);";

		echo "L.tileLayer(\x22http://{s}.tiles.mapbox.com/v3/hollandaise.j48k6kkg/{z}/{x}/{y}.png\x22, {";

		echo "attribution: 'Map data &copy; <a href=\x22http://openstreetmap.org\x22>OpenStreetMap</a> contributors, <a href=\x22http://creativecommons.org/licenses/by-sa/2.0/\x22>CC-BY-SA</a>, Imagery © <a href=\x22http://cloudmade.com\x22>CloudMade</a>[…]',";

		echo "maxZoom: 18";

		echo "}).addTo(map);";

		$x = 1;

		$PHOTO_THRESHOLD = 40;

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

			if (is_numeric($lat) && is_numeric($lon) && $x < $PHOTO_THRESHOLD)
			{
				$uid = $x;

				echo "var marker = L.marker([$lat, $lon], {icon: timeIcon, natId:".$uid." }).addTo(map);";

				echo "marker.bindPopup(\x22<h3>Now And Then, #".$uid."</h3><div ID='bigdiv' style='width:320px;height:240px' ><div id='spinner".$uid."' class='spinner'><img id='img-spinner".$uid."' src='assets/images/spinner.gif' alt='Loading'/></div><div id='natpair".$uid."' style='display:none' ><ul class='images'><li><img ID='thenImage12' style='opacity:0' src='thenimage".$uid.".jpg' height='240px' width='300px'></img></li><li><img ID='nowImage12' style='opacity:1' src='nowimage".$uid.".jpg' height='240px' width='300px'></img></li></ul></div></div><div id='slider-bg' class='yui-h-slider' tabindex='-1' title='Slider'><div id='slider-thumb'><img src='http://yui.yahooapis.com/2.9.0/build/slider/assets/thumb-n.gif'></div></div>\x22).openPopup();";
			}

			$x = $x + 1;
		}

		echo "map.on('popupopen', prepslides);";

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

				// The slider can move 290 pixels down
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

						pic.style.opacity = actualValue / bottomConstraint;

						pic = Dom.get("nowImage12");

						pic.style.opacity = 1 - actualValue / bottomConstraint;

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


