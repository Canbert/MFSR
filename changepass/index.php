<!DOCTYPE html>
<html>
<head>
	<!--Tab Name-->
	<title>MFSR | Change Password</title>

	<!-- Metadata about the webpage-->
	<meta name="keywords" content=""/>
	<meta name="description" content="Change password page for MSFR"/>
	<meta name="author" content="Scott Thomson"/>

	<!-- Sitewide CSS -->
	<link rel="stylesheet" type="text/css" href="../css/mfsr.css">

	<!-- Jquery -->
	<script src="../js/jquery-2.1.3.min.js"></script>
</head>
<body>
	<div id="wrapper">
		<div class="banner">
			<a href="../"><h1>MFSR</h1></a>
		</div>
		<div class="contentBox">
			<h2>Change Password</h2>
			<form method="POST" action="">
			<center>
			<table>
				<tr>
					<td>Old Password:</td>
					<td><input id="oldPass" type="password" name="oldPass" placeholder="Old Password"></td>
				</tr>
				<tr>
					<td>New Password:</td>
					<td><input id="newPass" type="password" name="newPass" placeholder="New Password" autocomplete="off"></td>
				</tr>
				<tr>
					<td>Confirm New Password:</td>
					<td><input id="reNewPass" type="password" name="reNewPass" placeholder="Confirm New Password" autocomplete="off"></td>
				</tr>
			</table>

			<table>
				<tr>
					<td><input name="submit" type="submit" value="Submit"></td>
				</tr>
			</table>
			<!-- area that will display text to the user, if they have entered something wrong -->
			<div id="feedback"></div>
			</center>
			</form>
		</div>
	</div>
	<!-- This script handles the feedback to the user. It fades the feedback text -->
	<script type="text/javascript" src="js/changePass.js"></script>
</body>
</html>