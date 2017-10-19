<?php 
$access_token = "EAAPUl7Rs7S0BAGZAKbBTvWqyepEZCmsK8HLQ7xBEFfyGmAWkSnxSQ8quSBZCVfJL40t4NFnRiaWucPMDX8euHyQzl0osy9lirc9e3sjJdiF0EdF24Rh7vWVl075Bu2WkByfUdA4rbUy0bLr82ZB6OWJ7uwZC7KZARmQFsZCuajRkAZDZD";
$verify_token = "gre_vocab";
$hub_verify_token = null;
//Start of Verification
if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}


if ($hub_verify_token === $verify_token) {
    echo $challenge;
}
//end of verification


//Start of user message receiving
$input = json_decode(file_get_contents('php://input'), true);

//Get the sender ID from JSON
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
//Get the message sent from JSON
$message = $input['entry'][0]['messaging'][0]['message']['text'];
/**
 * Some Basic rules to validate incoming messages
 */

//check if the message contains the following keywords
if(preg_match('[time|current time|now]', strtolower($message))) {

    // Make request to Time API
    ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
    //$result = file_get_contents("http://www.timeapi.org/utc/now?format=%25a%20%25b%20%25d%20%25I:%25M:%25S%20%25Y");
    $result="Hi, This is GreVocabBot";
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
		"text":"'.$message_to_reply.'"
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



?>
