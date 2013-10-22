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
		echo "Database connection succeeded...";
		
		$query = "CREATE TABLE IF NOT EXISTS NOW_PHOTOS(id INT PRIMARY KEY, data BYTEA);";
		
		pg_query($db, $query);
		
		$query = "CREATE TABLE IF NOT EXISTS THEN_PHOTOS(id INT PRIMARY KEY, data BYTEA);";
		
		pg_query($db, $query);
	}


	
	pg_close($db); 

	echo('DONE CREATING OR UPDATING TABLES');
?>