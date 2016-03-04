<?php
	require('../../inc/connect.php');
	require('../inc/chat.func.php');
	
	$messages = get_msg();
			foreach($messages as $message) {
				echo '<div class="message"><strong>'.$message['sender'].':'.'</strong><br />';
				echo $message['message'].'<br />';
				echo '<p id="timestamp"> Sent at: '.$message['timestamp'].'</p>'.'</div>';
			}
	

?>