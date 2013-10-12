<?php

	if (isset($_FILES['uploadedfile']))
	{
		echo $_FILES['uploadedfile']['tmp_name'];
	}
	else
	
		echo 'FILE DOES NOT EXIST';
	
?>