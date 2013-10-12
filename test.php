<?php
	$uploaddir = './';
	$file = basename($_FILES['uploadedfile']['name']);
	$uploadfile = $uploaddir . $file;

	echo('HERE IS THE PHP SCRIPT ECHO');
?>