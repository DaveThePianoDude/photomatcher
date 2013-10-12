<?php

	function pg_connection_string() {

		return "dbname=d7qq84ps7u5thb host=ec2-184-73-175-240.compute-1.amazonaws.com port=5432 user=jnnvxxjaenvzor password=Xpq6UHZoub1e6LIUPdUZrX6bSz sslmode=require";
	}
	
	if (isset($_FILES['uploadedfile']))
	{
		$info = getimagesize($_FILES['uploadedfile']['tmp_name']);
				
		//echo $info["mime"]; // will return the mime type
			
		# Establish db connection
		$db = pg_connect(pg_connection_string());
		
		$data = base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));
		
		$query = "INSERT INTO NOW_PHOTOS(id, data) Values(13, '$data')";
		
		pg_query($db, $query);
		
		pg_close($db);
		
		echo base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));
	}
	else
	{
		echo 'FILE DOES NOT EXIST';
		
	}
	
?>