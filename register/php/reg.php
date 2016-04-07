<?php

require('../../inc/connect.php');

if(!empty($_POST['username']) AND !empty($_POST['email'])) //check if the username and email textbox is empty
{

	$user = $_POST['username'];
//	$user = stripslashes( $user );
//	$user = mysqli_real_escape_string( $user );

	$data = $db->prepare('SELECT username FROM users WHERE username = (:user) LIMIT 1');
	$data->bindParam( ':user', $user, PDO::PARAM_STR );
	$data->execute();
	$row = $data->fetch();

	if($data-> rowCount() == 1){
		echo "User already registered";
	}
	else
	{
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
		{
			if($_POST['password'] == $_POST['repassword'])
			{	
				if(strlen($_POST['password'])>=4)
				{
					$user = $_POST['username'];
					$email = $_POST['email'];
					$pass = $_POST['password'];

					$user = stripslashes($user);
					$user = htmlspecialchars($user);

					$data = $db->prepare('INSERT INTO users(username,password,email) VALUES (:username,:password,:email)');
					$data->bindParam( ':username', $user, PDO::PARAM_STR );
					$data->bindParam( ':password', hash("sha512",$pass . $salt), PDO::PARAM_STR );
					$data->bindParam( ':email', $email, PDO::PARAM_STR );

					if($data->execute()){
						echo "User Created";
					}
					else{
						echo "User Not Created";
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
?>