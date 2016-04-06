<?php
	require('../inc/chat.func.php');
	
	$messages = get_msg();
		foreach($messages as $message) {
			echo '<div class="message"><strong>'.$message['username'].':'.'</strong><br />';
			echo $message['message'].'<br />';
			echo '<p class="message-timestamp">'. date('l jS \of F Y \a\t h:i:s A',strtotime($message['timestamp'])) .'</p>'.'</div>';
		}