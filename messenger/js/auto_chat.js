$(document).ready(function() {
	var interval = setInterval(function() {
		$.ajax({
			url: 'php/Chat.php',
			success: function(data) {
				$('#messagesBox').html(data);

				if ($('#autoScrollCheck').is(':checked')) 
				{
					var objDiv = document.getElementById("messagesBox");
					objDiv.scrollTop = objDiv.scrollHeight;
				}
			}
		});
	}, 1000);
});