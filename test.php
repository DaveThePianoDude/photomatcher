<?php

	if (isset($_FILES['uploadedfile']))
	{
		$info = getimagesize($_FILES['uploadedfile']['tmp_name']);
		
		echo $info;
	}
	else
	
		echo 'FILE DOES NOT EXIST';
	
?>