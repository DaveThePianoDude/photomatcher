<!DOCTYPE html>
<html>
<head>

</head>

<body>

	<?php
	
		function pg_connection_string() {

			return "dbname=d2uj6hdbhq6rtc host=ec2-54-197-237-120.compute-1.amazonaws.com port=5432 user=jpsgrwfbyyulbb password=a9U30GMw2oMsgMhoqhmwDP4jaT sslmode=require";
		}

		# Establish db connection
		$db = pg_connect(pg_connection_string());
		
		if (!$db) {
		
			echo "Database connection error.";
			
			exit;
			
		} else
		{
			echo "Database connection succeeded.";
			
			echo "Now 'n' Then v. 0.127";			
		}
		
		echo "<h3>Photo Inventory:</h3>";

		$uid = '1';
		
		$result = pg_query($db, "SELECT * FROM NOW_PHOTOS");
		
		while ($line = pg_fetch_row($result))
		{	
			$img_str = trim($line[1]);
			
			$inner_result = pg_query($db, "SELECT * FROM Places WHERE natId = '$uid'");
			
			$inner_line = pg_fetch_row($inner_result);
			
			$natId = trim($inner_line[0]);
			$lat = trim($inner_line[5]);
			$lon = trim($inner_line[6]);
			
			echo 'NAT ID: '.$natId.' ... LATITUDE: '.$lat.', LONGITUDE: '.$lon.'<br>';
			
			echo '<img src="data:image/jpg;base64,'.$img_str.'"/>';
			
			$inner_result = pg_query($db, "SELECT * FROM THEN_PHOTOS WHERE id = '$uid'");
			
			$inner_line = pg_fetch_row($inner_result);
			
			$img_str = trim($inner_line[1]);
			
			echo '<img src="data:image/jpg;base64,'.$img_str.'"/><br>';
				
			pg_free_result($inner_result);
		
			$uid = $uid + 1;
		}

		pg_free_result($result);
		
		pg_close($db);
	
	?>
</body>
</html>


