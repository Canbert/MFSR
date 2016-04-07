<?php
require('../../inc/connect.php');

//this will check if the username and password textboxes are empty and if not will continue the code
if(!empty($_POST['username']) AND !empty($_POST['password']))
{

	$user=$_POST['username'];
	$pass=$_POST['password'];

	// To protect from SQL injection
	$user = stripslashes($user);

	$data = $db->prepare('SELECT username,admin FROM users WHERE username =(:user) and password=(:pass) LIMIT 1');
	$data->bindParam( ':user', $user, PDO::PARAM_STR );
	$data->bindParam( ':pass', hash("sha512",$pass . $salt), PDO::PARAM_STR );
	$data->execute();

	// If result matched $user and $pass, table row must be 1 row
	if($data->rowCount()==1){
		// Register $username, and redirect to messenger
		session_start();
		$_SESSION["username"] = $user;
		$_SESSION["admin"] = $data->fetch()['admin'];
//		header("location:../messenger");
		echo '<script>location.href="../";</script>'; //using header doesn't work for some reason
	}
	else{
		echo "Username doesn't exist, or the username or password is incorrect";
	}
}
else
{
	echo "One or more fields is empty";
}
?>