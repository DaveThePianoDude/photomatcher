<?php

	function pg_connection_string() {

		return "dbname=d7qq84ps7u5thb host=ec2-184-73-175-240.compute-1.amazonaws.com port=5432 user=jnnvxxjaenvzor password=Xpq6UHZoub1e6LIUPdUZrX6bSz sslmode=require";
	}
	
	# Establish db connection
	$db = pg_connect(pg_connection_string());
	
	// # Get the image file data
	$uploadedfile = $_files['uploadedfile']['tmp_name']);
	
	if (!empty($uploadedfile))
	{
		$finfo = finfo_open(fileinfo_mime_type);
		$mime=finfo_file($finfo, $_files['uploadedfile']['tmp_name']);
	}
	
	// $query = "SELECT * FROM NOW_PHOTOS";
	
	// $result = pg_query($db, $query); 
	
	// $uid = pg_num_rows($result) + 1;
	
	// if (!empty($mime))
	// {
		// # From the insertion query
		// $query = "INSERT INTO NOW_PHOTOS(id, data) Values(" . $uid . ", '$mime')";
		
		// pg_query($db, $query);
	// } else
	
	// echo "No mime type found";
	
	$query = "SELECT * FROM NOW_PHOTOS";
	
	# See if the insertion went through.
	$result = pg_query($db, $query); 
	
	$rows = pg_num_rows($result);

	echo $rows . " row(s) returned.\n";
	
	pg_free_result($result);
	
	pg_close($db); 
?>