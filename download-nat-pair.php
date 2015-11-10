<!DOCTYPE html>
<html>
<head>
</head>

<body>

	<?php
	
		// Download-Nat-Pair.  10/17/2015
		// Purpose: Downloads to the server a single pair of Now-And-Then photos.
		// Author: David A. Holland
	
		require_once ('db_conn.php');

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
		
		echo "<h3>Now and Then Pair:</h3>";
		
		$now = $_GET['NOW'];
		
		$now_result = pg_query($db, "SELECT * FROM photomatcher.PHOTOS WHERE id = '$now'");
		$now_line = pg_fetch_row($now_result);
		$img_str = trim($now_line[1]);
		
		file_put_contents(
			"$now.jpg", 
			base64_decode(
				str_replace("data:image/jpg;base64", "", $img_str)
			)
		);
		
		echo '<img src="'.$now.'.jpg"/>';
		
		$then = $_GET['THEN'];
		
		$then_result = pg_query($db, "SELECT * FROM photomatcher.PHOTOS WHERE id = '$then'");
		$then_line = pg_fetch_row($then_result);
		$img_str = trim($then_line[1]);
		
		file_put_contents(
			"$then.jpg", 
			base64_decode(
				str_replace("data:image/jpg;base64", "", $img_str)
			)
		);
		
		echo '<img src="'.$then.'.jpg"/>';
		
		pg_free_result($now_result);
		pg_free_result($then_result);		
		pg_close($db);
	?>
</body>
</html>


