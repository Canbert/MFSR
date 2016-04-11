var Server;

function log( text ) {
    $log = $('#messages-box');
    //Add text to log
    $log.append(($log.val()?"\n":'')+text);
    //Autoscroll
    $log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
}

function send(username) {
    var message = $('#user-mess').val(); //get message text

    var msg = {
        message:message,
        username:username
    };

    $('#user-mess').val(""); //reset text

    Server.send( 'message', JSON.stringify(msg) );
}

//loads all the messages from the database
function loadMessages(){
    $.ajax({
        url: 'php/get.php',
        success: function(data) {
            var messages = JSON.parse(data);
            for(var i = 0;i<messages.length;i++){
                log(messageFormat(messages[i].username,messages[i].message,messages[i].timestamp));
            }
        }
    });
}

//formats the messages to have the right css
function messageFormat(username,message,timestamp){

    return '<div class="message"><strong><a href="/user/?username=' + username + '">' + username + '</a>:</strong><br/>'
        + message
        + '<p class="message-timestamp">' + new Date(timestamp.replace("-", " ", "g")) +'</p></div>';

}

$(document).ready(function() {
    log('Connecting...');
    Server = new FancyWebSocket('ws://127.0.0.1:9300');

    loadMessages();

    var username = ""; //user's session name

    $.ajax({
        url: 'php/sessuser.php',
        success: function(data) {
            username = data;
        }
    });

    $('#user-mess').on('keydown', function(event){
        if (event.which == 13) {
            if(event.ctrlKey || event.shiftKey || event.altKey){
                this.value +="\n";
                event.stopPropagation();
            } else {
                send(username);
                event.preventDefault();
            }
        }
    });

    $('#form-mess-button').on('click',function(){ //use clicks message send button
        send(username);
    });

    //Let the user know we're connected
    Server.bind('open', function() {
        log( "Connected." );
    });

    //OH NOES! Disconnection occurred.
    Server.bind('close', function( data ) {
        log( "Disconnected." );
    });

    //Log any messages sent from server
    Server.bind('message', function( payload ) {
        var msg = JSON.parse(payload); //PHP sends Json data
        var user = msg.user; //user name
        var message = msg.message; //message text
        var timestamp = msg.timestamp; //timestamp
        log(messageFormat(user,message,timestamp) );

        // Let's check whether notification permissions have already been granted
        if (Notification.permission === "granted" && user != username && !window.isFocus) {
            // If it's okay let's create a notification
            var options = {
                body: message
            }
            var notification = new Notification(user ,options);
        }

        // Otherwise, we need to ask the user for permission
        else if (Notification.permission !== 'denied') {
            Notification.requestPermission(function (permission) {
                // If the user accepts, let's create a notification
                if (permission === "granted" && user != username && !window.isFocus) {
                    var options = {
                        body: message
                    }
                    var notification = new Notification(user ,options);
                }
            });
        }
    });

    Server.connect();
});