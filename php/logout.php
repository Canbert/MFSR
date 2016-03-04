<?php
require '../inc/connect.php';

session_start();

//if the user decides to logout this will set their status to offline
//this is so that they are automatically removed from the currently online user list
//then redirect to the main page
if(session_destroy())
{
	$user = $_SESSION['myusername'];
	mysql_query("update users set online=0 where username='$user'");
	header("Location: ../");
}
?>