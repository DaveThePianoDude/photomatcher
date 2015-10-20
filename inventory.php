<!DOCTYPE html>
<html>
<head>

</head>

<body>

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

		$uid = '1';

		$nowCount = '47';

		while ($uid < $nowCount)
		{
			$places_result = pg_query($db, "SELECT * FROM Places WHERE natId = '$uid'");

			$places_line = pg_fetch_row($places_result);

			$natId = trim($places_line[0]);
			$lat = trim($places_line[5]);
			$lon = trim($places_line[6]);

			echo 'NAT ID: '.$natId.' ... LATITUDE: '.$lat.', LONGITUDE: '.$lon.'<br>';

			$now_result = pg_query($db, "SELECT * FROM NOW_PHOTOS WHERE id = '$uid'");

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

			$then_result = pg_query($db, "SELECT * FROM THEN_PHOTOS WHERE id = '$uid'");

			$then_line = pg_fetch_row($then_result);

			$img_str = trim($then_line[1]);

			file_put_contents(
				"thenimage$uid.jpg",
				base64_decode(
					str_replace("data:image/jpg;base64", "", $img_str)
				)
			);

			echo '<img src="thenimage'.$uid.'.jpg"/>';

			pg_query($db, "UPDATE PLACES SET (DESCRIPTION) = ('TEST') WHERE natid = '$uid'");

			pg_free_result($then_result);

			$uid = $uid + 1;
		}

		pg_close($db);

	?>
</body>
</html>


