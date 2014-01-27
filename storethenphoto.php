<?php

	function pg_connection_string() {

		return "dbname=d2uj6hdbhq6rtc host=ec2-54-197-237-120.compute-1.amazonaws.com port=5432 user=jpsgrwfbyyulbb password=a9U30GMw2oMsgMhoqhmwDP4jaT sslmode=require";
	}
	
	if (isset($_FILES['uploadedfile']))
	{
		$info = getimagesize($_FILES['uploadedfile']['tmp_name']);
				
		# Establish db connection
		$db = pg_connect(pg_connection_string());
		
		$data = base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));
		
		$query = "SELECT * FROM THEN_PHOTOS";
		
		$result = pg_query($db, $query);
		
		$uid = pg_num_rows($result) + 1;
		
		$query = "INSERT INTO THEN_PHOTOS(id, data) Values('$uid', '$data')";
		
		pg_query($db, $query);
		
		pg_close($db);
		
		echo base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));
	}
	else
	{
		echo 'FILE DOES NOT EXIST';
	}
	
?>