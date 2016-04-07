<?php

require('../inc/connect.php');

function display_user_info()
{
    global $db;

    $data = $db->prepare('SELECT username,email FROM users WHERE username=(:username)');
    $data->bindParam(':username',$_SESSION['username'],PDO::PARAM_STR);
    $data->execute();

    if($data->rowCount() > 0){

        $user_info[] = $data->fetch();

        foreach($user_info as $row){
            echo "<p>Username: ".$row['username']."</p><p>E-mail: ".$row['email'] . "</p>";
        }
    }
}