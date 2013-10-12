<?php
	$uploaddir = './';
	$file = basename($_FILES['uploadedfile']['name']);
	$uploadfile = $uploaddir . $file;

	if (move_uploaded_file($_files['uploadedfile']['name'], $uploadfile)) {

		echo $file;
	
	}
	else {
	
		echo "ERROR WRITING FILE TO HEROKU!!!";
	
	}

?>