<?php

	require_once ('db_conn.php');
	
	if (isset($_FILES['uploadedfile']))
	{
		$info = getimagesize($_FILES['uploadedfile']['tmp_name']);
				
		//echo $info["mime"]; // will return the mime type
			
		# Establish db connection
		$db = pg_connect(pg_connection_string());
		
		$data = base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));
		
		$query = "SELECT * FROM NOW_PHOTOS";
		
		$result = pg_query($db, $query);
		
		$uid = pg_num_rows($result) + 1;
		
		$query = "INSERT INTO NOW_PHOTOS(id, data) Values('$uid', '$data')";
		
		pg_query($db, $query);
		
		pg_close($db);
		
		echo base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));
	}
	else
	{
		echo 'FILE DOES NOT EXIST';
		
	}
	
?>