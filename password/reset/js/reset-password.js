$('form').submit(function() {
	var user = $("#username").val();
	var email = $("#email").val();
	$.ajax({
		url : 'php/reset-password.php',
		type: "POST",
		data : {
			username: user,
			email: email,
		    	},
		success: function(data) {
			if (data){
				$('#feedback').html(data);
				$('#feedback').siblings().hide();
					//$('#feedback').fadeIn('slow', function() {
					//	$('#feedback').fadeOut(6000);
					//});
			}	
		}
	});
	return false
});
