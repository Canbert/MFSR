<?php
require('../../inc/connect.php');
require('../inc/chat.func.php');

session_start();

if(isset($_SESSION['myusername'])){
	$user=$_SESSION['myusername'];
	$date=date('c');
	mysql_query("update users set lastActive='$date',online=1 where username='$user'");
	update_active_users();
}
?>