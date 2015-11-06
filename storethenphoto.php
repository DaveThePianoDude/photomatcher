<?php

	require_once ('db_conn.php');


		# Establish db connection
		$db = pg_connect(pg_connection_string());

		$uid = uuid_generate_v1mc();
		//$data = base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));

		$query = "INSERT INTO PHOTOS(id, data) Values('$uid')";

		pg_query($db, $query);
		pg_close($db);

		//echo base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));


?>