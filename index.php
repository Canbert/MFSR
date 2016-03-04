<?php
session_start();

//if the users session is already logged in it will automatically send them to the messenger page
if(isset($_SESSION['myusername']))
{
	header("location:messenger");
}
?>
<!DOCTYPE html>
<html>
<head>

	<!--Tab Name-->
	<title>MFSR | Login</title>

	<!-- Metadata about the webpage-->
	<meta name="keywords" content=""/>
	<meta name="description" content="Login page for MSFR"/>
	<meta name="author" content="Scott Thomson"/>

	<!-- Sitewide CSS -->
	<link rel="stylesheet" type="text/css" href="css/mfsr.css">

	<!-- Jquery -->
	<script src="../js/jquery-2.1.3.min.js"></script>
</head>
<body>
	<!-- Div that wraps all of the content on the page -->
	<div id="wrapper">
		<!-- Banner div that holds the MFSR title which the user can click on to go to the homepage of the site-->
		<div class="banner">
			<a href=""><h1>MFSR</h1></a>
		</div>
		<div class="contentBox">
			<h2>Login</h2>
			<form id="loginForm" method="POST" action="">
			<center>
			<table>
				<tr>
					<td>Username:</td>
					<td><input id="username" type="text" name="username" placeholder="Username"></td>
				</tr>	
				<tr>
					<td>Password:</td>
					<td><input id="password" type="password" name="password" placeholder="Password"></td>

				</tr>
				<tr>
					<td></td>
					<!-- redirects the user to the forgotten password page -->
					<td><a href="forgotpass">Forgotten Password?</a></td>
				</tr>
			</table>
			<table>
				<tr>
					<td><input name="submit" type="submit" value="Login"></td>
					<!-- redirects the user to the register account page -->
					<td><a href="register">Need an Account? Register Now</a></td>
				</tr>
			</table>
			<!-- area that will display text to the user, if they have entered something wrong -->
			<div id="feedback"></div>
			</center>
			</form>
		</div>
	</div>

	<!-- This script handles the feedback to the user. It fades the feedback text -->
	<script type="text/javascript" src="js/login.js"></script>
</body>
</html>