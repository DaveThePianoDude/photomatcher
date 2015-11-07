<?php

	function CallAPI($method, $url, $data = false)
	{
	    $curl = curl_init();

	    switch ($method)
	    {
		case "POST":
		    curl_setopt($curl, CURLOPT_POST, 1);

		    if ($data)
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		    break;
		case "PUT":
		    curl_setopt($curl, CURLOPT_PUT, 1);
		    break;
		default:
		    if ($data)
			$url = sprintf("%s?%s", $url, http_build_query($data));
	    }

	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

	    $result = curl_exec($curl);

	    curl_close($curl);

	    return $result;
	}

	$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=AIzaSyD2BdERFJ1vsTqKahMIvCw2Lzjmgwsk438";

	echo 'GOT HERE';

	$response = file_get_contents($url);

	echo $response;

?>