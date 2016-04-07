<?php
	require('../inc/chat.func.php');
	session_start();
	if(isset($_SESSION['username'])) {

		$user = $_SESSION['username'];

		$data = $db->prepare('SELECT user_id FROM messenger.users WHERE username = (:user) LIMIT 1');
		$data->bindParam( ':user', $user, PDO::PARAM_STR );
		$data->execute();

		$sender = $data->fetchColumn();

		if(!empty($_GET['message'])) {
			$message = $_GET['message'];
			
			if(send_msg($sender, $message)) {
//				echo 'Message Sent';
			} else {
				echo 'Message wasn\'t sent';
			}
			
		} else {
//			echo 'No Message was entered';
		}
		
	} else {
		echo 'Not logged in';
	}