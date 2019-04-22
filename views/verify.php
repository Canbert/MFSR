<?php
require('../../inc/connect.php');

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
    <title>MFSR | Verify User</title>

    <link rel="stylesheet" href="../../css/foundation.css">

    <!-- Sitewide CSS -->
    <link rel="stylesheet" href="../../css/app.css">

</head>
<body>

    <div class="row">
        <div class="medium-6 medium-centered large-5 large-centered columns">

            <div class="banner"><h2><a href="../../">MFSR</a></h2></div>

            <form method="POST">
                <div class="row column content-box">
                    <h4 class="text-center content-box-header">Verify</h4>
                    <div class="content-box-content">
                        <?php
                            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                                // Verify data
                                $email = $_GET['email']; // Set email variable
                                $hash = $_GET['hash']; // Set hash variable

                                $data = $db->prepare('SELECT email, hash, active FROM users WHERE email=(:email) AND hash=(:hash) AND active=0 LIMIT 1');
                                $data->bindParam(':email',$email,PDO::PARAM_STR);
                                $data->bindParam(':hash',$hash,PDO::PARAM_STR);

                                $data->execute();

                                if($data->rowCount() == 1){
                                    $data = $db->prepare('UPDATE users SET active=1 WHERE email=(:email) AND hash=(:hash) AND active=0');
                                    $data->bindParam(':email',$email,PDO::PARAM_STR);
                                    $data->bindParam(':hash',$hash,PDO::PARAM_STR);
                                    $data->execute();
                                    echo "Your account has been activated";
                                }
                                else{
                                    "No account or update failed";
                                }

                            }else{
                                // Invalid approach
                            }

                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script src="../../js/jquery.min.js"></script>
<script src="../../js/what-input.js"></script>
<script src="../../js/foundation.min.js"></script>
<script src="../../js/app.js"></script>

</body>
</html>