<?php

	function pg_connection_string() {

		return "dbname=d7qq84ps7u5thb host=ec2-184-73-175-240.compute-1.amazonaws.com port=5432 user=jnnvxxjaenvzor password=Xpq6UHZoub1e6LIUPdUZrX6bSz sslmode=require";
	}
	
	# Establish db connection
	//$db = pg_connect(pg_connection_string());
	
	// # Get the image file data
	$uploadedfile = pg_escape_bytea($_FILES['uploadedfile']['name']));
	
	// open it
	$fp = fopen($uploadedfile,'r');
	
	// read it
	$data = fread($fp, filesize($uploadedfile));
	
	fclose($fp);
	
	//pg_close($db);
	
	// return it
	echo $data;
?>