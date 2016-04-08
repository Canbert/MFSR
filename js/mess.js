$(document).ready(function(){

    var uname = "";

    $.ajax({
        url: 'php/get.php',
        success: function(data) {
            $('#messages-box').append(data);
        }
    });

    $.ajax({
        url: 'php/sessuser.php',
        success: function(data) {
            uname = data;
        }
    });

    //create a new WebSocket object.
    var wsUri = "ws://localhost:9000/inc/server.php";
    websocket = new WebSocket(wsUri);

    websocket.onopen = function(ev) { // connection is open
        $('#message-box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
    }

    $('#form-mess-button').click(function(){ //use clicks message send button
        var mymessage = $('#user-mess').val(); //get message text
        var myname = "TEST USER"; //get user name

        if(myname == ""){ //empty name?
            alert("Enter your Name please!");
            return;
        }
        if(mymessage == ""){ //emtpy message?
            alert("Enter Some message Please!");
            return;
        }

        //prepare json data
        var msg = {
            message: mymessage,
            name: myname,
            color : '<?php echo $colours[$user_colour]; ?>'
        };
        //convert and send data to server
        websocket.send(JSON.stringify(msg));
    });

    //#### Message received from server?
    websocket.onmessage = function(ev) {
        var msg = JSON.parse(ev.data); //PHP sends Json data
        var type = msg.type; //message type
        var umsg = msg.message; //message text
        //var uname = msg.name; //user name
        var utimestamp = msg.timestamp; //user name

        if(type == 'usermsg')
        {
            $('#messages-box').append('<div class="message"><strong><a href="/user/?' + uname + '">' + uname + '</a>:</strong><br />' + umsg + '<p class="message-timestamp">'+utimestamp+'</p></div>');
        }
        if(type == 'system')
        {
            $('#messages-box').append("<div class=\"system_msg\">"+umsg+"</div>");
        }

        $('#message').val(''); //reset text
    };

    websocket.onerror	= function(ev){$('#message_box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");};
    websocket.onclose 	= function(ev){$('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");};
});