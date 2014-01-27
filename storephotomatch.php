<?php
	
	function pg_connection_string() {

		return "dbname=d2uj6hdbhq6rtc host=ec2-54-197-237-120.compute-1.amazonaws.com port=5432 user=jpsgrwfbyyulbb password=a9U30GMw2oMsgMhoqhmwDP4jaT sslmode=require";
	}

	# Establish db connection
	$db = pg_connect(pg_connection_string());
	
	if (!$db) {
	
		echo "Database connection error.";
		
		exit;
		
	}
	else
	{
		echo "Database connection succeeded.";
		
		echo "Now 'n' Then v. 0.127";
		
		$query = "CREATE TABLE IF NOT EXISTS Places (natId bigserial primary key NOT NULL, userName varchar(20) NOT NULL, locationId bigserial, photoNowId bigserial, photoThenId bigserial, lat varchar(50) NOT NULL, lon varchar(50) NOT NULL);";
		
		pg_query($db, $query);
	}
	
	$query = "SELECT * FROM Places";
		
	$result = pg_query($db, $query);
		
	$natId = pg_num_rows($result) + 1;
	
	$userName = $_GET['userName'];
	$locationId = $_GET['locationId'];
	$photoNowId = $_GET['photoNowId'];
	$photoThenId = $_GET['photoThenId'];
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];

	if ($natId != NULL)
	{
		$query = "INSERT INTO Places VALUES ($natId, '$userName', $locationId, $photoNowId, $photoThenId, '$lat', '$lon');";
		
		echo $query;
		
		pg_query($db, $query);
	}
?>