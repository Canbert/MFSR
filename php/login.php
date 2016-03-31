<?php
require('../inc/connect.php');

//this will check if the username and password textboxes are empty and if not will continue the code
if(!empty($_POST['username']) AND !empty($_POST['password']))
{

	$user=$_POST['username'];
	$pass=$_POST['password'];

	// To protect MySQL injection
	$user = stripslashes($user);
	$pass = md5($pass);
	$user = mysql_real_escape_string($user);
	$pass = mysql_real_escape_string($pass);

	$sql="SELECT * FROM users WHERE username='$user' and password='$pass'";

	$result=mysql_query($sql);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $user and $pass, table row must be 1 row
	if($count==1){
		// Register $myusername, $mypassword and redirect to messenger
		session_start();
		$_SESSION["myusername"] = $user;
//		header("location:messenger");
		echo '<script>location.href="messenger";</script>'; //using header doesn't work for some reason
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