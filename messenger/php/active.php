<?php
	require('../../inc/connect.php');
	require('../inc/chat.func.php');

	session_start();

	if(isset($_SESSION['username'])){
		$user=$_SESSION['username'];
		$date=date('c');

		$data = $db->prepare('UPDATE users SET last_active=(:date),online=1 WHERE username=(:user)');
		$data->bindParam(':date',$date,PDO::PARAM_STR);
		$data->bindParam(':user',$user,PDO::PARAM_STR);
		$data->execute();

		update_active_users();
	}