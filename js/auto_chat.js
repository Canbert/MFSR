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