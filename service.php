<?php
if (!defined('ROOT')) exit('No direct script access allowed');

include_once __DIR__."/api.php";

handleActionMethodCalls();

function _service_send() {
	$status = LogiksValidator::validate($_POST, [
		"msg"=> "required",
		"id"=> "required",
		"chatid"=> "required",
	]);

	if($status===true) {
		set_time_limit(0);

		$sessID = false;
		$msgID = $_POST['id'];
		$chatID = $_POST['chatid'];
		// $appID = LOGIKSAI_APPID;

		if(!isset($_SESSION['LOGIKSAI'][$chatID])) {
			return [
				"id"=> $msgID,
				"chatid"=> $chatID,
				"status"=> "error",
				"msg"=> "Session Validation Failed, reload page again"
			];
		}
		$chatSession = $_SESSION['LOGIKSAI'][$chatID];

		$userFunction = $chatSession['USER_METHOD'];

		if($userFunction && function_exists($userFunction)) {
			call_user_func($userFunction, $_POST);
		}

		$params = $_POST;
		$userMessage = $_POST['msg'];
		
		if(isset($params['id'])) unset($params['id']);
		if(isset($params['chatid'])) unset($params['chatid']);
		if(isset($params['msg'])) unset($params['msg']);
		

		if(isset($chatSession['PERSONA']) && $chatSession['PERSONA']) $params['persona'] = $chatSession['PERSONA'];
		if(isset($chatSession['MODEL']) && $chatSession['MODEL']) $params['model'] = $chatSession['MODEL'];
		if(isset($chatSession['TOOLS']) && $chatSession['TOOLS']) $params['tools'] = $chatSession['TOOLS'];

		//PARAMS -> $miscParams
		if(isset($chatSession['PARAMS']) && $chatSession['PARAMS'] && is_array($chatSession['PARAMS'])) {
			$params = array_merge($params, $chatSession['PARAMS']);
		}

		$response = sendChatMessage($userMessage, $params, $sessID, $appID);

		// printArray([$_POST, $status]);

		if($response) {
			return [
				"id"=> $msgID,
				"chatid"=> $chatID,
				"status"=> "success",
				"user"=> "LogiksAI",
				"avatar"=>loadMedia("images/robot.png"),
				"msg"=> $response['data']["RESPONSE"],
			];
		} else {
			return [
				"id"=> $msgID,
				"chatid"=> $chatID,
				"status"=> "error",
				"user"=> "LogiksAI",
				"avatar"=>loadMedia("images/robot.png"),
				"msg"=> getLogiksAIError()
			];
		}

		// var_dump([$response['data']["RESPONSE"], getLogiksAIError()]);
	} else {
		return [
			"id"=> "0",
			"chatid"=> "0",
			"status"=> "error",
			"error"=> $status,
			"msg"=> "Validation Failed"
		];
	}
}
?>