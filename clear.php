<?php

	require_once ('db_conn.php');
	
	$db = pg_connect(pg_connection_string());
	
	$query = "DELETE FROM NOW_PHOTOS WHERE ID > 0";
	
	pg_query($db, $query);
	
	$query = "DELETE FROM THEN_PHOTOS WHERE ID > 0";
	
	pg_query($db, $query);
	
	$query = "DELETE FROM PLACES WHERE natId > 0";
	
	pg_query($db, $query);
	
	pg_close($db);
	
?>