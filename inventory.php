<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
</head>

<body>

	<input type='hidden' name='descriptext' value='blah'/>

	<?php

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

		echo "<h3>Photo Inventory:</h3>";

		$uid = 0;

		$nowCount = pg_query($db, "SELECT COUNT(*) FROM photomatcher.PLACES");

		$count_result = pg_fetch_row($nowCount);

		$count = $count_result[0];

		echo 'Number of Place Records:'.$count.'.';

		$places_result = pg_query($db, "SELECT * FROM photomatcher.PLACES");
		
		while ($uid <= $nowCount)
		{
			$places_line = pg_fetch_row($places_result);

			$lat = trim($places_line[1]);
			$lon = trim($places_line[2]);
			$now = trim($places_line[3]);
			$then = trim($places_line[4]);
			$description = trim($places_line[5]);

			echo nl2br 'Now+Then '.$description.' ... LATITUDE: '.$lat.', LONGITUDE: '.$lon.'<br>\n';

			echo 'NOW='.$now.'\n';
			echo 'THEN='.$then.'\n';
			
			$now_result = pg_query($db, "SELECT * FROM photomatcher.PHOTOS WHERE id = '$now'");

			$now_line = pg_fetch_row($now_result);

			$img_str = trim($now_line[1]);

			file_put_contents(
				"nowimage$uid.jpg",
				base64_decode(
					str_replace("data:image/jpg;base64", "", $img_str)
				)
			);

			echo '<img src="nowimage'.$uid.'.jpg"/>';

			pg_free_result($now_result);

			$then_result = pg_query($db, "SELECT * FROM photomatcher.PHOTOS WHERE id = '$then'");

			$then_line = pg_fetch_row($then_result);

			$img_str = trim($then_line[1]);

			file_put_contents(
				"thenimage$uid.jpg",
				base64_decode(
					str_replace("data:image/jpg;base64", "", $img_str)
				)
			);

			echo '<img src="thenimage'.$uid.'.jpg"/>';

			pg_free_result($then_result);

			$uid = $uid + 1;
		}

		pg_close($db);

	?>
</body>
</html>


