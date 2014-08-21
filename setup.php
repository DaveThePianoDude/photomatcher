<?php

	require_once ('db_conn.php');
	
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

		$query = "CREATE TABLE IF NOT EXISTS THEN_PHOTOS(id INT PRIMARY KEY, data BYTEA);";
		
		pg_query($db, $query);
		
	}


	
	pg_close($db); 

	echo('DONE CREATING OR UPDATING TABLES');
?>