<?php
require 'inc/core.inc.php';

session_start();

if(!isset($_SESSION['username'])){
	header("location: login");
}
?>
<!DOCTYPE html>
<html>
<head>
	<!--Tab Name-->
	<title>MFSR | Messenger</title>

	<!-- Metadata about the webpage-->
	<meta name="keywords" content=""/>
	<meta name="description" content="Messenger page for MSFR"/>
	<meta name="author" content="Scott Thomson"/>

	<!-- Sitewide CSS -->
	<link rel="stylesheet" type="text/css" href="css/mfsr.css">

	<!-- Page CSS -->
	<link rel="stylesheet" type="text/css" href="css/messenger.css">

	<!-- Jquery -->
	<script src="js/jquery-2.1.3.min.js"></script>

	<!-- Javascript file that loads in the navigation bar-->
	<script type="text/javascript" src="js/navBar.js"></script>

</head>
<body>
	
	<div class="banner"></div>

	<div id="wrapper">
		
		<div id="sideBarWrapper">
			<div id="sideBar">
				<div id="innerSideBarWrapper">
				<h4>User Details:</h4>
				<?php
					display_user_info();
				?>
				<br/>
				<a href="changepass">Change Password</a>

				<h4>Users Online:</h4>

				<div id="activeUsers"></div>

				</div>
			</div>

			<button id="toggleSideBar"></button>

		</div>

		<div id="messengerWrapper">
			
			<div class="contentBox" id="messagesBox"></div>

			<form class="contentBox" id="formMess" method="POST" action="">
				<label for="autoScrollCheck">Autoscroll messages</label>
				<input id="autoScrollCheck" type="checkbox" checked="checked" >
				<input id="userMess" name="userMess" type="text" maxlength="300" autocomplete="off">
				<input id="sendButt" name="submit" type="submit" value="Send">
				<div id="feedback"></div>
			</form>

			<?php
				echo displayUploadForm();
			?>
		</div>
		
	</div>

	<script type="text/javascript" src="js/sideBarToggle.js"></script>
	<script type="text/javascript" src="js/auto_chat.js"></script>
	<script type="text/javascript" src="js/send.js"></script>
	<script type="text/javascript" src="js/auto_active_users.js"></script>
</body>
</html>