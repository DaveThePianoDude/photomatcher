<?php


	function pg_connection_string() {

		return "dbname=d2uj6hdbhq6rtc host=ec2-54-197-237-120.compute-1.amazonaws.com port=5432 user=jpsgrwfbyyulbb password=a9U30GMw2oMsgMhoqhmwDP4jaT sslmode=require";
	}
	
	$db = pg_connect(pg_connection_string());
	
	$query = "DELETE FROM NOW_PHOTOS WHERE ID > 0";
	
	pg_query($db, $query);
	
	$query = "DELETE FROM THEN_PHOTOS WHERE ID > 0";
	
	pg_query($db, $query);
	
	$query = "DELETE FROM PLACES WHERE natId > 0";
	
	pg_query($db, $query);
	
	pg_close($db);
	
?>