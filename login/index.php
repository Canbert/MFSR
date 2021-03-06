<?php
session_start();

//if the users session is already logged in it will automatically send them to the messenger page
if(isset($_SESSION['username']))
{
	header("location:../");
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
	<meta name="description" content="Login page for MSFR"/>
	<meta name="author" content="Scott Thomson"/>

	<!--Tab Name-->
	<title>MFSR | Login</title>

	<link rel="stylesheet" href="../css/foundation.css">

	<!-- Sitewide CSS -->
	<link rel="stylesheet" href="../css/app.css">

</head>
<body>

	<div class="row">
		<div class="medium-6 medium-centered large-5 large-centered columns">

			<div class="banner"><h2><a href="../">MFSR</a></h2></div>

			<form method="POST">
				<div class="row column content-box">
					<h4 class="text-center content-box-header">Login</h4>
					<div class="content-box-content">
						<label>Username
							<input id="username" type="text" name="username" placeholder="Username" required>
						</label>
						<label>Password
							<input id="password" type="password" name="password" placeholder="Password" required>
						</label>
						<div id="feedback"></div>
						<p class="text-center"><a href="/password/reset">Forgot your password?</a></p>
						<!--					<p><a type="submit" class="button expanded">Login</a></p>-->
						<input class="button expanded" name="submit" type="submit" value="Login">
						<p class="text-center"><a href="../register">Need an Account? Register Here</a></p>
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
	<script type="text/javascript" src="js/login.js"></script>
</body>
</html>