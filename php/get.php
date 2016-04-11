<?php
require '../inc/connect.php';
require('emoji.php');

function get_msg() {

    global $db;

    $data = $db->prepare('SELECT username,message,timestamp FROM messenger.messages,messenger.users WHERE messages.user_id = users.user_id ORDER BY message_id');
    $data->execute();

    $messages = $data->fetchAll();

    echo json_encode($messages);
}

get_msg();