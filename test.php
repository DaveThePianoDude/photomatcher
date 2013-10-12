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
		echo "Database connection succeeded.";
		
		$query = "CREATE TABLE IF NOT EXISTS NOW_PHOTOS(id INT PRIMARY KEY, data BYTEA);";
		
		pg_query($db, $query);
	}

	//$uploaddir = 'uploads/';
	$file = basename($_FILES['uploadedfile']['name']);
	//$uploadfile = $uploaddir . $file;

	$uploadfile = $file;
	
	echo "file=".$file; //is empty, but shouldn't

	if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $uploadfile)) {
		echo $file;
	}
	else {
		echo "error";
	}

	
	$img = fopen($uploadfile, 'r') or die("cannot read image\n");
	$data = fread($img, filesize($uploadfile));

	$es_data = pg_escape_bytea($data);
	fclose($img);

	$query = "INSERT INTO images(id, data) Values(1, '$es_data')";
	pg_query($cdb, $query); 
	
	pg_close($db); 

?>