<?php
if (!defined('ROOT')) exit('No direct script access allowed');

if (!function_exists("sendChatMessage")) {
    
    include_once "core.php";

    function setupLogiksAI() {
        if(isset($_SESSION["LOGIKSAI_BASE_URL"])) return true;

        $configFeature = LogiksConfig::loadFeature("logiksAI");
        if(!$configFeature) $configFeature = [];

        foreach($configFeature as $k=>$v) {
            $k = str_replace("DEFINE-", "", $k);
            $_SESSION[$k] = $v;
        }

    }
    
    function sendChatMessage($message, $params = [], $sessID = false, $appID = false) {
        if(!$appID) {
            if(isset($_SESSION["LOGIKSAI_APPID"])) {
                $appID = $_SESSION["LOGIKSAI_APPID"];
            }
        }
        
        if(!isset($_SESSION["LOGIKSAI_BASE_URL"])) {
            $_ENV['CURL_ERROR'] = "LOGIKSAI_BASE_URL not defined";
            return false;
        }
        if(!isset($_SESSION["LOGIKSAI_AUTH_KEY"])) {
            $_ENV['CURL_ERROR'] = "LOGIKSAI_AUTH_KEY not defined";
            return false;
        }

        $response = callLogiksAIAPI("chat", array_merge([
            "msg"=> $message,
        	], $params), $sessID, $appID);
        
        return $response;
    }

    function configureLogiksAI($title = "LogiksAI !", $persona = false, $model = false, $tools = [], $miscParams = [], $theme = "", $userFunction = false) {
        if(!isset($_SESSION["LOGIKSAI_DEBUG"])) $_SESSION["LOGIKSAI_DEBUG"] = false;


        $_ENV["LOGIKSAI_UUID"] = uniqid();
        $_ENV["LOGIKSAI_TITLE"] = $title;
        $_ENV["LOGIKSAI_STYLE"] = $theme;

        if(!isset($_SESSION['LOGIKSAI'])) $_SESSION['LOGIKSAI'] = [];

        $_SESSION['LOGIKSAI'][$_ENV["LOGIKSAI_UUID"]] = [
            "TITLE" => $title,
            "PERSONA" => $persona,
            "MODEL" => $model,
            "TOOLS" => $tools,
            "PARAMS" => $miscParams,
            "USER_METHOD" => $userFunction
        ];
    }

    setupLogiksAI();
}
?>