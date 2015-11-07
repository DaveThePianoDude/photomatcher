<?php

	require_once ('db_conn.php');
	require_once ('uuid.php');

	# Establish db connection
	$db = pg_connect(pg_connection_string());

	$uuid = UUID::v4();

	// variables passed via URL:
	$userName = $_GET['userName'];
	$timestamp = $_GET['createdAt'];
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];

	// locally synthesized values:

	$query = "SELECT * FROM photomatcher.PHOTOS where created_at = '$timestamp' AND photo_type ='1'";
	$result = pg_query($db, $query);
	$line = pg_fetch_row($result);
	$now_photo = trim($line[0]);

	$query = "SELECT * FROM photomatcher.PHOTOS where created_at = '$timestamp' AND photo_type ='0'";
	$result = pg_query($db, $query);
	$line = pg_fetch_row($result);
	$then_photo = trim($line[0]);

	echo 'Processing description...';
	
	// description
	$query = "SELECT value FROM photomatcher.SETTINGS WHERE name = 'google_api'";
	$result = pg_query($db, $query);

	$line = pg_fetch_row($result);
	$key = trim($line[0]);

	$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lon."&key=".$key;

	$description = 'test';
	$response_json = file_get_contents($url);
	$response = json_decode($response_json, true);

	if ($response['status']=='OK')
	{
		$description = $response['results'][0]['address_components'][3]['long_name'];
		echo $description;
	}
	
	echo 'starting to insert.';

	$query = "INSERT INTO photomatcher.PLACES(id,lat,lon,now_photo,then_photo,description) Values('$uuid','$lat','$lon','$now_photo','$then_photo','test')";
	pg_query($db, $query);
	pg_close($db);

	echo 'PLACES table updated.';
?>