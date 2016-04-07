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

					$hash = md5(rand(0,1000));

					$data = $db->prepare('INSERT INTO users(username,password,email,hash) VALUES (:username,:password,:email,:hash)');
					$data->bindParam( ':username', $user, PDO::PARAM_STR );
					$data->bindParam( ':password', hash("sha512",$pass . $salt), PDO::PARAM_STR );
					$data->bindParam( ':email', $email, PDO::PARAM_STR );
					$data->bindParam( ':hash', $hash, PDO::PARAM_STR );

					if($data->execute()){
						echo "User Created";

						$to      = $email; // Send email to our user
						$subject = 'Signup | Verification'; // Give the email a subject
						$message = '
						Thanks for signing up!
						Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

						------------------------
						Username: '.$user.'
						------------------------

						Please click this link to activate your account:
						http://mfsr.dev/verify.php?email='.$email.'&hash='.$hash.'

						'; // Our message above including the link

						$headers = 'From:noreply@mfsr.dev' . "\r\n"; // Set from headers
						if(mail($to, $subject, $message, $headers)){ // Send our email
							echo "Mail Sent";
						}
						else{
							echo "Mail Not Sent";
						}

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