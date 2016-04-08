<?php
require '../inc/connect.php';
require('emoji.php');

function get_msg() {

    global $db;

    $data = $db->prepare('SELECT username,message,timestamp FROM messenger.messages,messenger.users WHERE messages.user_id = users.user_id ORDER BY message_id');
    $data->execute();

    $messages = $data->fetchAll();
    foreach($messages as $message) {
        echo '<div class="message"><strong><a href="/user/?username='. $message['username'] .'">' . $message['username'] . '</a>:</strong><br />';
        echo $message['message'].'<br />';
        echo '<p class="message-timestamp">'. date('l jS \of F Y \a\t h:i:s A',strtotime($message['timestamp'])) .'</p>'.'</div>';
    }
}

get_msg();