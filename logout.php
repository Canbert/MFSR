<?php
require 'inc/connect.php';

session_start();

//if the user decides to logout this will set their status to offline
//this is so that they are automatically removed from the currently online user list
//then redirect to the main page
if(session_destroy())
{
	$user = $_SESSION['username'];

	$data = $db->prepare('UPDATE users SET online=0 WHERE username=(:user)');
	$data->bindParam(':user',$user,PDO::PARAM_STR);
	$data->execute();

	header("Location:../login");
}
?>