<?php

session_start();

if(!isset($_SESSION['username'])){
    header("location: login");
}
?>
<!DOCTYPE html>
<html>
<head>
    <!--Tab Name-->
    <title>MFSR | User</title>

    <!-- Metadata about the webpage-->
    <meta name="keywords" content=""/>
    <meta name="description" content="Messenger page for MSFR"/>
    <meta name="author" content="Scott Thomson"/>

    <!-- Sitewide CSS -->
    <link rel="stylesheet" type="text/css" href="css/mfsr.css">

    <!-- Page CSS -->
    <link rel="stylesheet" type="text/css" href="">

    <!-- Jquery -->
    <script src="js/jquery-2.1.3.min.js"></script>

    <!-- Javascript file that loads in the navigation bar-->
    <script type="text/javascript" src="js/navBar.js"></script>

</head>
<body>

    <h1>There's nothing here right now</h1>

</body>
</html>