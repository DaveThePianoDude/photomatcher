<!DOCTYPE html>
<html>
<head>

</head>

<body>

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
			
			echo "Now 'n' Then v. 0.127";			
		}
		
		echo "<h3>Photo Inventory:</h3>";

		$uid = '1';
		
		$result = pg_query($db, "SELECT * FROM NOW_PHOTOS");
		
		while ($line = pg_fetch_row($result))
		{	
			$img_str = trim($line[1]);
			
			echo '<img src="data:image/jpg;base64,'.$img_str.'"/>';
		
			$inner_result = pg_query($db, "SELECT * FROM THEN_PHOTOS WHERE id = '$uid'");
			
			$inner_line = pg_fetch_row($inner_result);
			
			$img_str = trim($inner_line[1]);
			
			$inner_result = pg_query($db, "SELECT * FROM Places WHERE natId = '$uid'");
			
			$lat = trim($line[5]);
			$lon = trim($line[6]);
			
			echo 'LATITUDE: '.$lat.', LONGITUDE: '.$lon.'<br>';
			
			echo '<img src="data:image/jpg;base64,'.$img_str.'"/><br>';
				
			pg_free_result($inner_result);
		
			$uid = $uid + 1;
		}

		pg_free_result($result);
		
		pg_close($db);
	
	?>
</body>
</html>


