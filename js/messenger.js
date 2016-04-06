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
$(document).ready(function() {
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
$(document).ready(function() {
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