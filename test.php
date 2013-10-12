<?php

	if (isset($_FILES['uploadedfile']))
	{
		$info = getimagesize($_FILES['uploadedfile']['tmp_name']);
		
		//echo $info["mime"]; // will return the mime type
		
		echo $info["size"];
	}
	else
	
		echo 'FILE DOES NOT EXIST';
	
?>