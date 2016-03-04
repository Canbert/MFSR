<?php

require 'inc/core.inc.php';
require 'php/upload.php';

session_start();

//redirect the user to the main page if the user is not logged in
if(!isset($_SESSION['myusername'])){
	header("location:../");
}
?>
<!DOCTYPE html>
<html>
<head>
	<!--Tab Name-->
	<title>MFSR | Files</title>

	<!-- Metadata about the webpage-->
	<meta name="keywords" content=""/>
	<meta name="description" content="File upload page for MSFR"/>
	<meta name="author" content="Scott Thomson"/>

	<!-- Sitewide CSS -->
	<link rel="stylesheet" type="text/css" href="../css/mfsr.css">

	<!-- Page CSS -->
	<link rel="stylesheet" type="text/css" href="css/files.css">

	<!-- Jquery -->
	<script src="../js/jquery-2.1.3.min.js"></script>

	<!-- Javascript file that loads in the navigation bar-->
	<script type="text/javascript" src="../js/navBar.js"></script>

</head>
<body>

	<div class="banner"></div>
	
	<div id="wrapper">
		<div id="list" class="contentBox" >
		</div>
		<?php
		echo '<div class="contentBox">'.$msg.'</div>';
		echo displayUploadForm();

		?>
	</div>
	<script type="text/javascript" src="js/auto_list.js"></script>
</body>
</html>