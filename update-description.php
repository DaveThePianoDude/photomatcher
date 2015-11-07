<?php
	// demo page for use of google geocache api

	require_once ('db_conn.php');

	# Establish db connection
	$db = pg_connect(pg_connection_string());

	$query = "SELECT value FROM photomatcher.SETTINGS WHERE name = 'google_api'";
	$result = pg_query($db, $query);

	$line = pg_fetch_row($result);
	$key = trim($line[0]);

	echo "key=".$key;
	
	$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=".$key;

	$response_json = file_get_contents($url);
	$response = json_decode($response_json, true);

	if ($response['status']=='OK')
	{
		$j = $response['results'][0]['address_components'][3]['long_name'];
		echo $j;
	}
	pg_close($db);
?>