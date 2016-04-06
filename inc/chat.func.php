<?php

	$db =  new PDO('mysql:host=localhost;dbname=messenger',"root","");

	function get_msg() {

		global $db;

		$data = $db->prepare('SELECT username,message,timestamp FROM messenger.messages,messenger.users WHERE messages.user_id = users.user_id ORDER BY message_id');
		$data->execute();

		$messages = $data->fetchAll();

		return $messages;
		
	}
	
	function send_msg($sender, $message) {
		
		if(!empty($sender) && !empty($message)) {

			global $db;

			$data = $db->prepare('INSERT INTO messenger.messages VALUES (null,(:message),null,(:sender))');
			$data->bindParam( ':message', nl2br(htmlspecialchars($message)), PDO::PARAM_STR );
			$data->bindParam( ':sender', $sender, PDO::PARAM_STR );
			if($data->execute()){
				return true;
			}
		} else {
			return false;
		}
	}

	function display_user_info()
	{
		global $db;

		$data = $db->prepare('SELECT username,email FROM users WHERE username=(:username)');
		$data->bindParam(':username',$_SESSION['username'],PDO::PARAM_STR);
		$data->execute();

		if($data->rowCount() > 0){

			$user_info[] = $data->fetch();

			foreach($user_info as $row){
				echo '<div id="userInfo">'.nl2br("Username: ".$row['username']."\n"."E-mail: ".$row['email'].'</div>');
			}
		}
	}

	function update_active_users()
	{
		global $db;

		$d=date('c',time()-2*60);//last 2 minutes

		$data = $db->prepare('UPDATE users SET online=0 WHERE last_active<(:d)');
		$data->bindParam(':d',$d,PDO::PARAM_STR);
		$data->execute();

		$data = $db->prepare('SELECT username FROM users WHERE online=1');
		$data->execute();

		if($data->rowCount()>0){
			echo '<ul><li><a>' . $data->fetchColumn() . '</a></li></ul>';
		}
	}