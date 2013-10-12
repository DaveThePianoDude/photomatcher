<?php

	if (isset($_FILES['uploadedfile']))
	{
		$info = getimagesize($_FILES['uploadedfile']['tmp_name']);
		
		//echo $info["mime"]; // will return the mime type
		
		echo base64_encode(file_get_contents($_FILES['uploadedfile']['tmp_name']));
	}
	else
	
		echo 'FILE DOES NOT EXIST';
	
?>