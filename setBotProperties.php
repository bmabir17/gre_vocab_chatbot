<?php 
	include 'env.php';
	//API Url
	$url='https://graph.facebook.com/v2.6/me/messenger_profile?access_token='.$access_token;
	//Initiate cURL
	$ch=curl_init($url);

	//The JSON data
	$jsonData='{ 
	  "get_started":{
	    "payload":"hi there"
	  },
	  "persistent_menu":[
						  {
						    "locale":"default",
						    "composer_input_disabled": false,
						    "call_to_actions":[
											      {
											        "title":"My Settings",
											        "type":"nested",
											        "call_to_actions":[
																          {
																            "title":"Learn Vocabulary",
																            "type":"nested",
																            "call_to_actions":[
																            	{
																            		"title":"start learning",
																	            	"type":"postback",
																	            	"payload":"teach me"
																            	},
																            	{
																            		"title":"stop learning",
																	            	"type":"postback",
																	            	"payload":"not now"
																            	}
																            ]
																            
																          },
																          {
																            "title":"My points",
																            "type":"postback",
																            "payload":"my points"
																          },
																          {
																            "title":"Contact a human",
																            "type":"postback",
																            "payload":"contact a human"
																          }
																        ]
											      },
											      {
											        "type":"web_url",
											        "title":"My Learned Vocabulary Lists",
											        "url":"https://gre-chatbot.herokuapp.com/myVocabList.php",
											        "webview_height_ratio":"full"
											      }
											    ]
						  },
						  {
						    "locale":"zh_CN",
						    "composer_input_disabled":false
						  }
						]
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
