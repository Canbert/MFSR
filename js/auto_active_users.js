$(document).ready(function() {
	var interval = setInterval(function() {
		$.ajax({
			url: 'php/active.php',
			success: function(data) {
				$('#activeUsers').html(data);
			}
		});
	}, 1000);
});