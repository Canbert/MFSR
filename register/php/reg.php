<?php

require('../../inc/connect.php');

if(!empty($_POST['username']) AND !empty($_POST['email'])) //check if the username and email textbox is empty
{
	$query = mysql_query("select username from users where username = '$_POST[username]'")or die(mysql_error());
	if (mysql_num_rows($query) != 0)
	{
		echo "User already registered";
	}
	else
	{
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			if($_POST['password'] == $_POST['repassword'])
			{	
				if(strlen($_POST['password'])>=8)
				{
					$user = $_POST['username'];
					$email = $_POST['email'];
					$pass = $_POST['password'];
					
					if(newUser($user,$email,$pass))
					{
						echo "User Created";
					}
					else
					{
						echo "User not created";
					}
				}
				else
				{
					echo "Passwords mininmum length is 8 characters, Please re-enter";
				}
			}
			else
			{
				echo "Passwords must be the same";
			}
		}
		else
		{
			echo "E-mail is not valid";
		}
	}
}
else
{
	echo "One or More fields is empty";
}

function newUser($username,$email,$password)
{
	$query = "insert into users(username,email,password) values ('$username','$email',md5('$password'))";
	$data = mysql_query($query)or die(mysql_error());
	if($data)
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>