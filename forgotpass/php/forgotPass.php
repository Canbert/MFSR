<?php
include('../../inc/connect.php');


if (isset($_POST['username']) && !empty($_POST['username']))
{

	if (isset($_POST['email']) && !empty($_POST['email']))
	{

		$user = $_POST['username'];
		$email = $_POST['email'];
	
		$query = mysql_query("select username from users where username = '$user'");

		if (mysql_num_rows($query) != 0)
		{
			$randpass = md5(uniqid(rand(), true));
			mysql_query("update users set password=md5('$randpass') where username = '$user' and email = '$email'");
			//header('location:../index.php');
			echo "Password set to: ".nl2br($randpass);
		}

		else
		{
			echo "Username or E-Mail incorrect, or User doesn't exist";
		}
	}
	else
	{
		echo "E-mail field is empty";
	}
}
else
{
	echo "Username field is empty";
}

?>