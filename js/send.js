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