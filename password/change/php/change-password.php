<?php
include('../../inc/connect.php');

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
				if(strlen($_POST['newPass'])>=8) 
				{
					$user = $_SESSION['myusername'];
					$oldPass = md5($_POST['oldPass']);
					$sql="SELECT * FROM users WHERE username='$user' and password='$oldPass'";
					$result=mysql_query($sql);
					$count = mysql_num_rows($result);

					if ($count == 1)
					{
						mysql_query("update users set password=md5('$_POST[newPass]') where username = '$user'");
						echo "Password changed";
					}
					else
					{
						echo "Please re-enter old password as it may be incorrect";
					}
				}
				else
				{
					echo "Passwords mininmum length is 8 characters, Please re-enter";
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