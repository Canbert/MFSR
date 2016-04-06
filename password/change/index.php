<?php
session_start();

//if the users session is already logged in it will automatically send them to the messenger page
if(!isset($_SESSION['username']))
{
	header("location:../../");
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Metadata about the webpage-->
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="keywords" content=""/>
	<meta name="description" content="Change Password page for MSFR"/>
	<meta name="author" content="Scott Thomson"/>

	<!--Tab Name-->
	<title>MFSR | Change Password</title>

	<link rel="stylesheet" href="../../css/foundation.css">

	<!-- Sitewide CSS -->
	<link rel="stylesheet" href="../../css/app.css">
</head>
<body>
	<div class="row">
		<div class="medium-6 medium-centered large-5 large-centered columns">

			<div class="banner"><h2><a href="../">MFSR</a></h2></div>

			<form method="POST">
				<div class="row column content-box">
					<h4 class="text-center content-box-header">Change Password</h4>
					<div class="content-box-content">
						<label>Old Password
							<input id="oldPass" type="password" name="oldPass" placeholder="Old Password" required>
						</label>
						<label>New Password
							<input id="newPass" type="password" name="newPass" placeholder="New Password" autocomplete="off" required>
						</label>
						<label>Confirm New Password
							<input id="reNewPass" type="password" name="reNewPass" placeholder="Confirm New Password" autocomplete="off" required>
						</label>
						<div id="feedback"></div>
						<input class="button expanded" name="submit" type="submit" value="Submit">
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="../js/jquery.min.js"></script>
	<script src="../js/what-input.js"></script>
	<script src="../js/foundation.min.js"></script>
	<script src="../js/app.js"></script>

	<!-- This script handles the feedback to the user. It fades the feedback text -->
	<script type="text/javascript" src="js/changePass.js"></script>
</body>
</html>