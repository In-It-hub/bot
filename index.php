<?php
	define(TOKEN, "1101027273:AAG4okJ5EXr_zjl-GRFVlzUYvPsK8bC22SQ");

	function bot($method, $data=[]) {
		$apiURL = "https://api.telegram.org/bot".TOKEN."/".$method;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $apiURL);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$res = curl_exec($curl);
		if (curl_error($curl)) {
			var_dump(curl_error($curl));
		}
		else {
			return json_decode($res);
		}

	}

	function typing($ch){
		return bot('sendChatAction',[
					'chat_id' => $ch,
					'action' => 'typing',
		]);
	}

	$update = json_decode(file_get_contents('php://input'));
	$message = $update->message;
	$chat_id = $message->chat->id;
	$text = $message->text;

	if (isset($text)) {
		typing($chat_id);
	}

	if ($text == "/start") {
		bot('sendMessage', [
			'chat_id' => $chat_id,
			'text' => 'Добро пожаловать!!!',
			'parse_mode' => 'markdown'
		]);
	}
?>
