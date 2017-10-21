<?php 
	//Start of user message receiving
	$input = json_decode(file_get_contents('php://input'), true);

	//Get the sender ID from JSON
	$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
	//Get the message sent from JSON
	$message = $input['entry'][0]['messaging'][0]['message']['text'];
?>