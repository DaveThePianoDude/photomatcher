<?php

	require_once ('db_conn.php');
	require_once ('uuid.php');

	if (isset($_FILES['uploadedfile']))
	{
		# Establish db connection
		$db = pg_connect(pg_connection_string());

		$uuid = UUID::v4();
		$data = base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));
		$createdAt = $_GET['createdAt'];

		$query = "INSERT INTO photomatcher.PHOTOS(id,data,created_at) Values('$uuid','$data','$createdAt')";

		pg_query($db, $query);
		pg_close($db);

		echo base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));

		echo 'NOW ROW ADDED';
		echo $uuid;
	}
	else
	{
		echo 'FILE DOES NOT EXIST';
	}

?>