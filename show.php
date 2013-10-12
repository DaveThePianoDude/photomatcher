<!DOCTYPE html>
	<?php
	
		header("Content-type: image/png");
		$png = fopen("/home/postgres/tmp.png","r");
		$image = fread($png,filesize("/home/postgres/tmp.png"));
		echo $image;

	?>