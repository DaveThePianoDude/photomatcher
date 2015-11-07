<?php

	$key = "AIzaSyCJ204tQKkDkj0S-dSohznucBd3C-Hp788";

	$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=".$key;

	$response = file_get_contents($url);

	echo $response;

?>