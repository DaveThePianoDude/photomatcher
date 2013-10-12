<?php

	function pg_connection_string() {

		return "dbname=d7qq84ps7u5thb host=ec2-184-73-175-240.compute-1.amazonaws.com port=5432 user=jnnvxxjaenvzor password=Xpq6UHZoub1e6LIUPdUZrX6bSz sslmode=require";
	}
	
	# Establish db connection
	$db = pg_connect(pg_connection_string());
	
	# Get the image file data
	$es_data = pg_escape_bytea($_FILES['uploadedfile']['name']);
	
	# From the insertion query
	$query = "INSERT INTO NOW_PHOTOS(id, data) Values(2, '$es_data')";
	
	pg_query($db, $query); 
	
	$query = "SELECT * FROM NOW_PHOTOS";
	
	# See if the insertion went through.
	$result = pg_query($db, $query); 
	
	$rows = pg_num_rows($result);

	echo $rows . " row(s) returned.\n";
	
	pg_free_result($result);
	
	pg_close($db); 
?>