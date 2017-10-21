<?php 
include 'env.php';
include 'varification.php';


if ($hub_verify_token === $verify_token) {
    echo $challenge;
}else{
	include 'receive_msg.php';
	/**
	 * Some Basic rules to validate incoming messages
	 */

	//check if the message contains the following keywords
	if(preg_match('[get|started hi|there]', strtolower($message))) {

	    // Make request to Time API
	    ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
	    //$result = file_get_contents("http://www.timeapi.org/utc/now?format=%25a%20%25b%20%25d%20%25I:%25M:%25S%20%25Y");
	    $result="Hi this GRE Vocabulary Bot Powered By BluespereIt. Please Respond by saying vocab to learn new GRE Vocab everyday";
	    if($result != '') {
	        $message_to_reply = $result;
	    }
	} else {
	    $message_to_reply = 'Huh! what do you mean?';
	}
	//print $message_to_reply;


	//Start of Sending Message

	//API Url
	$url='https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;
	//Initiate cURL
	$ch=curl_init($url);

	//The JSON data
	$jsonData='{
		"recipient":{
			"id":"'.$sender.'"
		},
		"message":{
			"text":"'.$message_to_reply.'",
			"quick_replies":[
				{
					"content_type":"text",
					"title":"yes, teach me!",
					"payload":"teach me",

				},
				{
					"content_type":"text",
					"title":"Not now bro",
					"payload":"not now",

				}

			]
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
	if(!empty($input['entry'][0]['messaging'][0]['message'])){
		$result= curl_exec($ch);
		var_dump($result);
	}
}
//end of verification






?>
