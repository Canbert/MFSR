//this script refreshes the file list on the files page 
// this is so that when someone uploads a new file it will display without needing to refresh the page
$(document).ready(function() {
	var interval = setInterval(function() {
		$.ajax({
			url: 'php/listFiles.php',
			success: function(data) {
				$('#list').html(data);
			}
		});
	}, 1000);
});