<?php
require 'inc/core.inc.php';

session_start();

if(!isset($_SESSION['username'])){
	header("location: login");
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr" xmlns="http://www.w3.org/1999/html">
<head>
	<!-- Metadata about the webpage-->
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="keywords" content=""/>
	<meta name="description" content="Messenger page for MSFR"/>
	<meta name="author" content="Scott Thomson"/>

	<!--Tab Name-->
	<title>MFSR | Messenger</title>

	<link rel="stylesheet" href="css/foundation.css">

	<!-- Sitewide CSS -->
	<link rel="stylesheet" href="css/app.css">

</head>
<body>

	<nav>
		<?php include_once("inc/navbar.php")?>
	</nav>

	<div class="row">
		<div class="medium-8 columns">

			<div class="row content-box" id="messages-box"></div>

			<form class="row content-box" id="form-mess" method="POST" action="">
				<textarea id="user-mess"></textarea>
<!--				<input id="user-mess" name="user-mess" type="textarea" maxlength="300" autocomplete="off">-->
				<input id="form-mess-button" class="button" name="submit" type="submit" value="Send">
				<label for="auto-scroll-check">
					<input id="auto-scroll-check" type="checkbox" checked="checked" >Autoscroll messages
				</label>
				<div id="feedback"></div>

<!--				--><?php
//					echo displayUploadForm();
//				?>
			</form>
		</div>
		<div id="users-online" class="medium-4 columns">
			<h4 class="text-center">Users Online</h4>
			<div id="active-users"></div>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/what-input.js"></script>
	<script src="js/foundation.min.js"></script>
	<script src="js/app.js"></script>
	<script src="js/messenger.js"></script>
</body>
</html>