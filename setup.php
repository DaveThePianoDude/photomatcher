<?php

	function pg_connection_string() {

		return "dbname=d2uj6hdbhq6rtc host=ec2-54-197-237-120.compute-1.amazonaws.com port=5432 user=jpsgrwfbyyulbb password=a9U30GMw2oMsgMhoqhmwDP4jaT sslmode=require";
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