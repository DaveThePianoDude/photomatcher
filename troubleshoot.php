<?php

	if (isset($_FILES['uploadedfile']))
	{
		$data = file_get_contents($_FILES['uploadedfile']['tmp_name']);
		
		file_put_contents(
			"testimage.jpg", 
			base64_decode(
				str_replace("data:image/jpg;base64", "", $data)
			)
		);
	}
	else
	{
		echo 'FILE DOES NOT EXIST';
	}

?>