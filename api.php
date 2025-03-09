<?php
if (!defined('ROOT')) exit('No direct script access allowed');

if (!function_exists("processLogiksAIAPI")) {
    
    include_once "core.php";
    
    function sendChatMessage($message, $params = [], $appID = false, $sessID = false) {
        $response = callLogiksAIAPI("chat", array_merge([
            "msg"=> $message,
        	], $params), $appID, $sessID);
        
        return $response;
    }
}
?>