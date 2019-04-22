//this script refreshes the file list on the files page 
// this is so that when someone uploads a new file it will display without needing to refresh the page
//Call it on the page load then check every second
$(document).ready(function() {
	$.ajax({
		url: 'php/list-files.php',
		success: function(data) {
			$('#list').html(data);
		}
	});

	var interval = setInterval(function() {
		$.ajax({
			url: 'php/list-files.php',
			success: function(data) {
				$('#list').html(data);
			}
		});
	}, 1000);
});