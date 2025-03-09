<?php
if (!defined('ROOT')) exit('No direct script access allowed');

if (!function_exists("sendChatMessage")) {
    
    include_once "core.php";
    
    function sendChatMessage($message, $params = [], $sessID = false, $appID = false) {
        if(!$appID) {
            if(defined("LOGIKSAI_APPID")) {
                $appID = LOGIKSAI_APPID;
            }
        }
        
        if(!defined("LOGIKSAI_BASE_URL")) {
            $_ENV['CURL_ERROR'] = "LOGIKSAI_BASE_URL not defined";
            return false;
        }
        if(!defined("LOGIKSAI_AUTH_KEY")) {
            $_ENV['CURL_ERROR'] = "LOGIKSAI_AUTH_KEY not defined";
            return false;
        }

        $response = callLogiksAIAPI("chat", array_merge([
            "msg"=> $message,
        	], $params), $sessID, $appID);
        
        return $response;
    }
}
?>