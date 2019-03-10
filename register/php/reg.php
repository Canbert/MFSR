<?php

require('../../inc/connect.php');
require('../../inc/phpmailer/PHPMailerAutoload.php');

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
				if(strlen($_POST['password'])>=$minpasslen)
				{
					$user = $_POST['username'];
					$email = $_POST['email'];
					$pass = $_POST['password'];

					$user = stripslashes($user);
					$user = htmlspecialchars($user);

					$hash = md5(rand(0,1000));

					$pass = hash("sha512",$pass . $salt);

					$data = $db->prepare('INSERT INTO users(username,password,email,hash) VALUES (:username,:password,:email,:hash)');
					$data->bindParam( ':username', $user, PDO::PARAM_STR );
					$data->bindParam( ':password', $pass, PDO::PARAM_STR );
					$data->bindParam( ':email', $email, PDO::PARAM_STR );
					$data->bindParam( ':hash', $hash, PDO::PARAM_STR );

					if($data->execute()){
						echo "User Created";


						$mail = new PHPMailer;

//						$mail->SMTPDebug = 3;                               // Enable verbose debug output

						$mail->isSMTP();                                      // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';  					// Specify main and backup SMTP servers
						$mail->SMTPAuth = true;                               // Enable SMTP authentication
						$mail->Username = 'mail.mfsr@gmail.com';                 // SMTP username
						$mail->Password = 'mailmfsr';                           // SMTP password
						$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 465;                                    // TCP port to connect to

						$mail->setFrom('mail.mfsr@gmail.com','MFSR');
						$mail->addAddress($email);
						$mail->addReplyTo('mail.mfsr@gmail.com','Mailer');

						$mail->isHTML(true);                                  // Set email format to HTML

						$mail->Subject = 'Activate your MFSR Account';
						$mail->Body    =
						'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
						<html>
						<head>
						  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
						  <title>MFSR Account Activation</title>
						</head>
						<body>
							<p><b>Thanks for signing up!</b></p>
							<p>Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.</p>
							<p>------------------------</p>
							<p>Username: '.$user.'</p>
							<p>------------------------</p>
							<p>Please click this link to activate your account:</p>
							<a href="http://'.$_SERVER['SERVER_NAME'].'/user/verify/?email='.$email.'&hash='.$hash.'">Activate Account</a>
						</body>
						</html>';

//						$mail->AltBody = 'Thanks for signing up!
//						Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
//
//						------------------------
//						Username: '.$user.'
//						------------------------
//
//						Please click this link to activate your account:
//						http://'.$_SERVER['SERVER_NAME'].'/user/verify/?email='.$email.'&hash='.$hash;


						if($mail->send()){
							echo "\nMail Sent";
						}
						else{
							echo "\nMail Not Sent";
							echo "\nMailer Error:" . $mail->ErrorInfo;
						}

					}
					else{
						echo "User Not Created";
					}
				}
				else
				{
					echo "Passwords mininmum length is " . $minpasslen . " characters, Please re-enter";
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