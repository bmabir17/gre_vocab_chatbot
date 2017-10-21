<?php 
	include 'env.php';
	//API Url
	$url='https://graph.facebook.com/v2.6/me/messenger_profile?access_token='.$access_token;
	//Initiate cURL
	$ch=curl_init($url);

	//The JSON data
	$jsonData='{ 
	  "get_started":{
	    "payload":"get started" 
	  }
	}';

	//Encode the array into JSON.
	$jsonDataEncoded=$jsonData;
	var_dump($jsonDataEncoded);
	//Tell CURL that we want to send a POST request
	curl_setopt($ch, CURLOPT_POST, 1);

	//Attach our encoded JSON string to the POST fields.
	curl_setopt($ch, CURLOPT_POSTFIELDS,$jsonDataEncoded);
	//Set the content type to application/json
	curl_setopt($ch,CURLOPT_HTTPHEADER,array('Content-Type:application/json'));
	//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
	 
	//Removes the ssl check (only for dev server)!!!!!!!! Please Remove it on Production
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // !!!!!! Remove this on production

	//Execute the request
	$result= curl_exec($ch);
	var_dump($result);
?>
