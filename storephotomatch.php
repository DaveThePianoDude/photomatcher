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

	$description = 'test';

	$query = "INSERT INTO photomatcher.PLACES(id,lat,lon,now_photo,then_photo,description) Values('$uuid','$lat','$lon','$now_photo','$then_photo','$description')";
	pg_query($db, $query);
	pg_close($db);

	echo 'PLACES table updated.';
?>