<!DOCTYPE html>
<html>
<head>
	<!--Tab Name-->
	<title>MFSR | Register</title>

	<!-- Metadata about the webpage-->
	<meta name="keywords" content=""/>
	<meta name="description" content="Register page for MSFR"/>
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
		<!--
		
		-->
		<div class="contentBox">
			<h2>Register</h2>
			<form id="formReg" method="POST" action="">
			<center>
			<table>
				<tr>
					<td>Username:</td>
					<td><input id="username" type="text" name="username" placeholder="Username" value="<?php if (isset($_POST['usernamename'])) echo $_POST['username']; ?>"></td>
				</tr>
				<tr>
					<td>E-Mail:</td>
					<td><input id="email" type="text" name="email" placeholder="name@email.com"></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input id="password" type="password" name="password" placeholder="Password"></td>
				</tr>
				<tr>
					<td>Confirm Password:</td>
					<td><input id="repassword" type="password" name="repassword" placeholder="Confirm Password"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input name="submit" type="submit" value="Register"></td>
				</tr>
			</table>
			<div id="feedback"></div>
			</center>
			</form>
		</div>
	</div>

	<script type="text/javascript" src="js/reg.js"></script>
</body>
</html>