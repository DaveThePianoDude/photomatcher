<?php

	function pg_connection_string() {

		return "dbname=d7qq84ps7u5thb host=ec2-184-73-175-240.compute-1.amazonaws.com port=5432 user=jnnvxxjaenvzor password=Xpq6UHZoub1e6LIUPdUZrX6bSz sslmode=require";
	}
	
	$db = pg_connect(pg_connection_string());
	
	$query = "DELETE FROM NOW_PHOTOS WHERE ID > 0";
	
	pg_query($db, $query);
	
	$query = "DELETE FROM THEN_PHOTOS WHERE ID > 0";
	
	pg_query($db, $query);
	
	$query = "DELETE FROM PLACES WHERE ID > 0";
	
	pg_query($db, $query);
	
	pg_close($db);
	
?>