<?php

	require_once ('db_conn.php');
	require_once ('uuid.php');

	# Establish db connection
	$db = pg_connect(pg_connection_string());

	$uuid = UUID::v4();

	// variables passed via URL:
	$userName = $_GET['userName'];
	$createdAt = $_GET['createdAt'];
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];

	// locally synthesized values:
	$now_photo = UUID::v4();
	$then_photo = UUID::v4();
	$description = 'test';

	$query = "INSERT INTO photomatcher.PLACES(id,lat,lon,now_photo,then_photo,description) Values('$uuid','$lat','$lon','$now_photo','$then_photo','$description')";
	pg_query($db, $query);
	pg_close($db);

	echo 'PLACES table updated.';
?>