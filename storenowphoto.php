<?php

	require_once ('db_conn.php');
	require_once ('uuid.php');

	if (isset($_FILES['uploadedfile']))
	{
		# Establish db connection
		$db = pg_connect(pg_connection_string());

		$uid = UUID::v4();
		$data = base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));

		$query = "INSERT INTO PHOTOS(id, data) Values('$uid', '$data')";

		pg_query($db, $query);
		pg_close($db);

		echo base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));
	}
	else
	{
		echo 'FILE DOES NOT EXIST';
	}

?>