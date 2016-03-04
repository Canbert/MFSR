$('#formMess').submit(function() {
	var mess = $('#userMess').val();
	$.ajax({
		url: 'php/Send.php',
		data: { message: mess }, 
		success: function(data) {
			$('#feedback').html(data);
			
				$('#feedback').fadeIn('slow', function() {
					$('#feedback').fadeOut(6000);
				});
			
			$('#userMess').val('');
			
		}
	});
	
	return false;
});