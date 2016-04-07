//Message sending
$('#form-mess').submit(function() {
    var mess = $('#user-mess').val();
    $('#feedback').html("");
    $.ajax({
        url: 'php/send.php',
        data: { message: mess },
        success: function(data) {
            $('#feedback').html(data);

            $('#feedback').fadeIn('slow', function() {
                //$('#feedback').fadeOut(6000);
            });
            $('#user-mess').val('');
        }
    });
    return false;
});

//Active users
//Call it on the page load then check every second
$(document).ready(function() {

    $.ajax({
        url: 'php/active.php',
        success: function(data) {
            $('#active-users').html(data);
        }
    });

    var interval = setInterval(function() {
        $.ajax({
            url: 'php/active.php',
            success: function(data) {
                $('#active-users').html(data);
            }
        });
    }, 1000);
});

//Auto get messages
//Call it on the page load then check every second
$(document).ready(function() {

    $.ajax({
        url: 'php/chat.php',
        success: function(data) {
            $('#messages-box').html(data);

            if ($('#auto-scroll-check').is(':checked'))
            {
                var objDiv = document.getElementById("messages-box");
                objDiv.scrollTop = objDiv.scrollHeight;
            }
        }
    });

    var interval = setInterval(function() {
        $.ajax({
            url: 'php/chat.php',
            success: function(data) {
                $('#messages-box').html(data);

                if ($('#auto-scroll-check').is(':checked'))
                {
                    var objDiv = document.getElementById("messages-box");
                    objDiv.scrollTop = objDiv.scrollHeight;
                }
            }
        });
    }, 1000);
});

$('#user-mess').on('keydown', function(event){
    if (event.which == 13) {
        var content = this.value;
        if(event.ctrlKey){
            this.value +="\n";
            event.stopPropagation();
        } else {
            $('form').submit();
        }
    }
});