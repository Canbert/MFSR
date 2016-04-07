<?php
include('../../../inc/connect.php');
require('../../../php/PHPMailerAutoload.php');

if (isset($_POST['username']) && !empty($_POST['username']))
{

	if (isset($_POST['email']) && !empty($_POST['email']))
	{

		$user = $_POST['username'];
		$email = $_POST['email'];

		$data = $db->prepare('SELECT username,email FROM users WHERE username=(:user) AND email=(:email) LIMIT 1');
		$data->bindParam(':user',$user,PDO::PARAM_STR);
		$data->bindParam(':email',$email,PDO::PARAM_STR);

		$data->execute();

		if ($data->rowCount() == 1)
		{

			$pass = md5(rand(0,1000));

			$data = $db->prepare('UPDATE users SET password=(:pass) WHERE username=(:user) AND email=(:email)');
			$data->bindParam(':user',$user,PDO::PARAM_STR);
			$data->bindParam(':email',$email,PDO::PARAM_STR);
			$data->bindParam(':pass',hash("sha512",$pass . $salt),PDO::PARAM_STR);

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

			$mail->Subject = 'MFSR Password Reset';
			$mail->Body    =
					'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
						<html>
						<head>
						  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
						  <title>MFSR Password Reset</title>
						</head>
						<body>
							<p>Your password has been reset, you can login with the following credentials.</p>
							<p>------------------------</p>
							<p>Username: '.$user.'</p>
							<p>Password: '.$pass.'</p>
							<p>------------------------</p>
							<a href="http://'.$_SERVER['SERVER_NAME'].'/login">Click here to login</a>
						</body>
						</html>';

			if($mail->send()){
				echo "Mail Sent";
				$data->execute();
			}
			else{
				echo "Mail Not Sent";
				echo "Mailer Error:" . $mail->ErrorInfo;
			}

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