<?php

	require_once ('db_conn.php');

	# Establish db connection
	$db = pg_connect(pg_connection_string());

	$query = "SELECT * FROM photomatcher.SETTINGS(value) WHERE name = 'google_api'";
	$result = pg_query($db, $query);
	pg_close($db);

	$line = pg_fetch_row($result);
	$key = trim($line[0]);

	$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=".$key;

	$response_json = file_get_contents($url);
	$response = json_decode($response_json, true);

	echo 'got here';

	if ($response['status']=='OK')
	{
		echo 'got here too';
		$j = $response['results'][0].address_components[3].long_name;
		echo $j;
	}

?>