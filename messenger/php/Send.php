<?php
	require('../../inc/connect.php');
	require('../inc/chat.func.php');
	session_start();
	if(isset($_SESSION['myusername'])) {

		$sql= mysql_query("SELECT username FROM users WHERE username ='$_SESSION[myusername]'");
		$row = mysql_fetch_assoc($sql);
		$sender = $row['username'];
		
		if(isset($_GET['message'])&&!empty($_GET['message'])) {
			$message = $_GET['message'];
			
			if(send_msg($sender, $message)) {
				echo 'Message Sent';
			} else {
				echo 'Message wasn\'t sent';
			}
			
		} else {
			echo 'No Message was entered';
		}
		
	} else {
		echo 'Not logged in';
	}
	
?>