$('form').submit(function() {
	var user = $("#username").val();
	var email = $("#email").val();
	$.ajax({
		url : 'php/forgotPass.php',
		type: "POST",
		data : {
			username: user,
			email: email,
		    	},
		success: function(data) {
			if (data){
				$('#feedback').html(data);
					$('#feedback').fadeIn('slow', function() {
						$('#feedback').fadeOut(6000);
					});	
			}	
		}
	});
	return false
});
