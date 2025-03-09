<?php
if (!defined('ROOT')) exit('No direct script access allowed');

if (!function_exists("loadLogiksAI")) {
    
    function loadLogiksAI() {
        if(APPS_STATUS=="development") {
            if(isset($_SESSION['LOGIKSAI_APILIST'])) unset($_SESSION['LOGIKSAI_APILIST']);
        }
        
        if(!isset($_SESSION['LOGIKSAI_APILIST'])) {
            $jsonData = json_decode(file_get_contents(__DIR__."/apilist.json"));
            if(!$jsonData) $jsonData = [];
            
            $_SESSION['LOGIKSAI_APILIST'] = $jsonData;
        }
    }
    
    function callLogiksAIAPI($endPoint, $data = [], $sessID = false, $appID = false) {
        if(!$sessID) $sessID = uniqid();
        if(!$appID) $appID = "app01";

        if(!defined("LOGIKSAI_DEBUG")) LOGIKSAI_DEBUG = false;
        
        if(!$_SESSION['LOGIKSAI_APILIST'][$endPoint]) {
            $_ENV['CURL_ERROR'] = "Incorrect Endpoint, Not Defined";
            return false;
        }
        
        $endPoint = $_SESSION['LOGIKSAI_APILIST'][$endPoint]['url'];
        $method = strtoupper($_SESSION['LOGIKSAI_APILIST'][$endPoint]['method']);
        
        if($data && is_array($data)) {
            $data = array_merge([
                    "channel"=> "aihub",
                	"uuid"=> $_SESSION['SESS_USER_ID'],
                	"debug"=> (LOGIKSAI_DEBUG=="true" || LOGIKSAI_DEBUG===true)
            	], $data);    
        }
        
        $curlConfig = array(
            CURLOPT_URL            => LOGIKSAI_BASE_URL.$endPoint,
            CURLOPT_HTTPHEADER     => [
                // "Accept: */*",
                // "Cache-Control: no-cache",
                // "Connection: keep-alive",
                // "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36",
                // "accept-encoding: gzip, deflate",
                "cache-control: no-cache",
                "Content-Type: application/json",
                "Authorization: Bearer ".LOGIKSAI_AUTH_KEY,
                // "x-haskey: ".sha1(LOGIKSAI_AUTH_SECRET.json_encode($data)),
                "appid: ".$appID,
                "sesskey: ".$sessID
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "utf8",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POST           => true,
            CURLOPT_CUSTOMREQUEST => $method,//"POST",
            
            CURLOPT_POSTFIELDS     => $data
        );
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        
        $ch = curl_init();
        curl_setopt_array($ch, $curlConfig);
        $result = curl_exec($ch);
        $err = curl_error($curl);
        curl_close($ch);
        
        if ($err) {
            $_ENV['CURL_ERROR'] = $err;
            return false;
        } else {
            return json_decode($response, true);
        }
    }
    
    
    function getLogiksAIError() {
        return (isset($_ENV['CURL_ERROR'])?$_ENV['CURL_ERROR']:"");
    }
    
    loadLogiksAI();
}
?>