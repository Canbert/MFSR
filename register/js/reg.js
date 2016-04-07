$('form').submit(function() {
	var user = $("#username").val();
	var email = $("#email").val();
	var pass = $("#password").val();
	var repass = $("#repassword").val();
	$.ajax({
		url : 'php/reg.php',
		type: "POST",
		data : {
			username: user,
			email: email,
			password: pass,
			repassword: repass
		    	},
		success: function(data) {
			if (data){
				$('#feedback').html(data);
					//$('#feedback').fadeIn('slow', function() {
					//	$('#feedback').fadeOut(6000);
					//});
				$('#feedback').siblings().hide();
				//if(data == "User Created"){
				//	$('#feedback').siblings().hide();
				//	$('#feedback').html(data + ", To activate your account use the link sent to your email address");
				//}
			}	
		}
	});
	return false
});
