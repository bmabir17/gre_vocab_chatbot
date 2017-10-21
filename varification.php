<?php
$verify_token = "gre_vocab";
$hub_verify_token = null;
//Start of Verification
if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}
?>