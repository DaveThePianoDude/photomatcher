<?php

	function pg_connection_string() {

		return "dbname=ddj80fqvfktej6 host=ec2-54-197-238-239.compute-1.amazonaws.com port=5432 user=xnzkzstbanolpo password=RMbAQCullzYZmfMSJ1V7BMz5vJ sslmode=require";
	}
	
	# Establish db connection
	$db = pg_connect(pg_connection_string());
	
	if (!$db) {
	
		echo "Database connection error...";
		exit;
		
	} else
	{
		echo "Database connection succeeded...";
		
		$query = "CREATE TABLE IF NOT EXISTS NOW_PHOTOS(id INT PRIMARY KEY, data BYTEA);";
		
		pg_query($db, $query);
		
	}


	
	pg_close($db); 

	echo('DONE CREATING OR UPDATING TABLES');
?>