$(document).ready(function(){


    // Let's check if the browser supports notifications
    if (!("Notification" in window)) {
        //alert("This browser does not support desktop notification");
        alert("PETER PLZ!!!");
    }

    Notification.requestPermission();

    var myusername = "";

    $.ajax({
        url: 'php/get.php',
        success: function(data) {
            $('#messages-box').append(data);
            $('#messages-box').scrollTop(document.getElementById("messages-box").scrollHeight);
        }
    });

    $.ajax({
        url: 'php/sessuser.php',
        success: function(data) {
            myusername = data;
        }
    });

    $('#user-mess').on('keydown', function(event){
        if (event.which == 13) {
            var content = this.value;
            if(event.ctrlKey || event.shiftKey || event.altKey){
                this.value +="\n";
                event.stopPropagation();
            } else {
                $('#form-mess-button').click();
                event.preventDefault();
            }
        }
    });

    //$('#auto-scroll-check:checked').click(function () {
    //    var objDiv = document.getElementById("messages-box");
    //    objDiv.scrollTop = objDiv.scrollHeight;
    //});

    //create a new WebSocket object.
    var wsUri = "ws://2.27.93.102:9000/inc/server.php";
    websocket = new WebSocket(wsUri);

    websocket.onopen = function(ev) { // connection is open
        //$('#users-online').append("<div class=\"system_msg\">Connected!</div>"); //notify user
        //$('#users-online').append('<ul><li><a href="/user/?username='+ myusername + '">' + myusername + '</a></li></ul>')
    }

    $('#form-mess-button').on('click',function(){ //use clicks message send button
        var mymessage = $('#user-mess').val(); //get message text

        //prepare json data
        var msg = {
            message: mymessage,
            name: myusername
        };
        //convert and send data to server
        websocket.send(JSON.stringify(msg));

        $('#user-mess').val(""); //reset text
    });

    //#### Message received from server?
    websocket.onmessage = function(ev) {
        var msg = JSON.parse(ev.data); //PHP sends Json data
        var type = msg.type; //message type
        var umsg = msg.message; //message text
        var uname = msg.name; //user name
        var utimestamp = msg.timestamp; //user name

        if(type == 'usermsg')
        {
            $('#messages-box').append('<div class="message"><strong><a href="/user/?' + uname + '">' + uname + '</a>:</strong><br />' + umsg + '<p class="message-timestamp">'+utimestamp+'</p></div>');
        }
        if(type == 'system')
        {
            $('#messages-box').append("<div class=\"system_msg\">"+umsg+"</div>");
        }

        // Let's check whether notification permissions have already been granted
        if (Notification.permission === "granted" && myusername != uname && !window.isFocus) {
            // If it's okay let's create a notification
            var options = {
                body: umsg
            }
            var notification = new Notification(uname + " said",options);
        }

        // Otherwise, we need to ask the user for permission
        else if (Notification.permission !== 'denied') {
            Notification.requestPermission(function (permission) {
                // If the user accepts, let's create a notification
                if (permission === "granted" && myusername != uname  && !window.isFocus) {
                    var options = {
                        body: umsg
                    }
                    var notification = new Notification(uname + " said",options);
                }
            });
        }
        $('#messages-box').scrollTop(document.getElementById("messages-box").scrollHeight);
    };

    websocket.onerror	= function(ev){$('#messages-box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");};
    websocket.onclose 	= function(ev){$('#message-box').append("<div class=\"system_msg\">Connection Closed</div>");};
});