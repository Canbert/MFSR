<?php
include('../../../inc/connect.php');

session_start();

//this changes the users password to the one entered in the new password textbox

if (!empty($_POST['oldPass']))
{
	if (!empty($_POST['newPass']))
	{
		if (!empty($_POST['reNewPass']))
		{
			if($_POST['newPass'] == $_POST['reNewPass']) // check if the passwords entered are the same
			{
				// check if the new password length is longer than 7 and if so change the users password to the new password
				if(strlen($_POST['newPass'])>=$minpasslen)
				{
					$user = $_SESSION['username'];
					$oldPass = $_POST['oldPass'];
					$oldPass = hash("sha512",$oldPass . $salt);

					$data = $db->prepare('SELECT username FROM users WHERE username=(:user) AND password=(:oldpass) LIMIT 1');
					$data->bindParam(':user',$user,PDO::PARAM_STR);
					$data->bindParam(':oldpass',$oldPass,PDO::PARAM_STR);

					$data->execute();

					if($data->rowCount() == 1){

						$newPass = $_POST['newPass'];
						$newPass = hash("sha512",$newPass . $salt);

						$data = $db->prepare('UPDATE users SET password=(:newpass) WHERE username=(:user) LIMIT 1');
						$data->bindParam(':user',$user,PDO::PARAM_STR);
						$data->bindParam(':newpass',$newPass,PDO::PARAM_STR);

						if($data->execute()){
							echo "Password changed";
						}
						else{
							echo "Something went wrong, password not changed";
						}

					}
					else{
						echo "User doesn't exist";
					}
				}
				else
				{
					echo "Passwords mininmum length is ". $minpasslen ." characters, Please re-enter";
				}
			}
			else
			{
				echo "Passwords entered are not the same";
			}
		}
		else
		{
			echo "Confirm New Password field is empty";
		}
		
	}
	else
	{
		echo "New Password field is empty";
	}
}
else
{
	echo "Old Password field is empty";
}

?>