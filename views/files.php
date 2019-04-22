<?php
$feedback = array();

require 'php/inc/display-upload-form.php';
require 'php/upload.php';

//redirect the user to the main page if the user is not logged in
if(!isset($_SESSION['username'])){
	header("location:../");
}
?>
<!DOCTYPE html>
<html>
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
	<title>MFSR | Files</title>

	<link rel="stylesheet" href="../css/foundation.css">

	<!-- Sitewide CSS -->
	<link rel="stylesheet" href="../css/app.css">

</head>
<!--style="color: white;"-->
<body >
	<nav>
		<?php include_once("views/inc/navbar.php")?>
	</nav>

	<div class="row" >
		<div class="medium-12 columns">

			<div id="list">
<!--				<table class="files-table">-->
<!--					<thead><tr><td><b>Name</b></td><td><b>Last Modified</b></td><td><b>Size</b></td></tr></thead>-->
<!--					<tfoot><tr><td>count($files) files</td><td>Total Files Size: </td><td>@byte_convert($totalSize)</td></tr></tfoot>-->
<!--					<tbody>-->
<!--					</tbody>-->
<!--				</table>-->
			</div>
			<div class="content-box">
				<?php
					echo $html;
				?>
			</div>
			<?php
				echo displayUploadForm();
			?>
		</div>
	</div>

	<script src="../js/jquery.min.js"></script>
	<script src="../js/what-input.js"></script>
	<script src="../js/foundation.min.js"></script>
	<script src="../js/app.js"></script>
	<script src="js/auto-list.js"></script>
<!--	<script src="js/upload.js"></script>-->
</body>
</html>