<?php

	function get_msg() {
		
		$query = "SELECT username,message,timestamp FROM messenger.messages,messenger.users WHERE messages.user_id = users.user_id ORDER BY message_id";
		
		$run = mysql_query($query);

		$messages = array();
		
		while($message = mysql_fetch_assoc($run)) {
			$messages[] = array('sender'=>$message['username'],
								'message'=>$message['message'],
								'timestamp'=>$message['timestamp']);
		}
		
		return $messages;
		
	}
	
	function send_msg($sender, $message) {
		
		if(!empty($sender) && !empty($message)) {

			//Temp query

			$query = "SELECT user_id FROM messenger.users WHERE username = '$_SESSION[myusername]'";

			$run = mysql_query($query);

			$row = mysql_fetch_assoc($run);

			$sender = $row['user_id'];

//			$sender = mysql_real_escape_string($sender);
			$message = mysql_real_escape_string($message);
			$message = strip_tags($message);
			
			$query = "INSERT INTO messenger.messages VALUES (null,'$message', null,'$sender')";

			if($run = mysql_query($query)) {
				return true;
			} else {
				return false;
			}
			
		} else {
			return false;
		}
	}

	function display_user_info()
	{
		$sql= mysql_query("SELECT username,email FROM users WHERE username ='$_SESSION[myusername]'");
		if (mysql_num_rows($sql) > 0)
		{
			while($row = mysql_fetch_assoc($sql))
			{
				echo '<div id="userInfo">'.nl2br("Username: ".$row['username']."\n"."E-mail: ".$row['email'].'</div>');
			}
		}
	}

	function update_active_users()
	{
		$d=date('c',time()-2*60);//last 2 minutes
		mysql_query("update users set online=0 where last_active<'$d'");

		$q=mysql_query("select username from users where online=1");
		if(mysql_affected_rows()>0){
			print "<ul>";
			while($users=mysql_fetch_array($q)){
				print "<li>{$users[0]}</li>";
			}
			print "</ul>";
		}
	}

?>
