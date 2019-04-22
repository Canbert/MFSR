<?php

require('php/display-info.php');

if(!isset($_SESSION['username'])){
    header("location: ../login");
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
    <title>MFSR | Settings</title>

    <link rel="stylesheet" href="../css/foundation.css">

    <!-- Sitewide CSS -->
    <link rel="stylesheet" href="../css/app.css">

</head>
<body>

<nav>
    <?php include_once("views/inc/navbar.php")?>
</nav>

<div class="row">
    <div class="medium-6 medium-centered large-5 large-centered columns">
        <div class="row column content-box">
            <h4 class="text-center content-box-header">Settings</h4>
            <div class="content-box-content text-center">
                <?php display_user_info(); ?>
                <p><a href="../password/change">Change Password</a></p>
            </div>
        </div>
    </div>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/what-input.js"></script>
<script src="../js/foundation.min.js"></script>
<script src="../js/app.js"></script>

</body>
</html>